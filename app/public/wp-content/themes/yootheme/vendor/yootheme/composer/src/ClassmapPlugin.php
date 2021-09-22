<?php

namespace YOOtheme\Composer;

use Composer\Script\Event;
use PhpParser\Lexer\Emulative;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\CloningVisitor;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class ClassmapPlugin
{
    public static function preAutoloadDump(Event $event)
    {
        $io = $event->getIO();
        $composer = $event->getComposer();
        $vendor = $composer->getConfig()->get('vendor-dir');
        $autoload = $composer->getPackage()->getAutoload();
        $installed = $composer->getRepositoryManager()->getLocalRepository();

        $extra = $composer->getPackage()->getExtra();
        $classmap = $extra['classmap']['psr-4'] ?? [];

        krsort($classmap);

        $parser = static::createParser();
        $printer = static::createPrinter($classmap);

        foreach ($installed->getPackages() as $package) {
            $name = $package->getName();

            if ($mapping = static::mapClasses($classmap, $package)) {
                $installed->removePackage($package);
            }

            foreach ($mapping as $namespace => $path) {

                if (!$toPath = static::getPath($autoload, $namespace)) {
                    continue;
                }

                $io->write("{$name} => {$toPath}");

                $dir = static::joinPath($vendor, $name);
                $src = static::joinPath($vendor, $path);
                $dest = static::joinPath(dirname($vendor), $toPath);

                $fs = new FileSystem();
                $fs->mkdir($dest);

                $exclude = $extra['classmap']['exclude'][$name] ?? [];
                $exclude = array_reduce((array) $exclude, function ($carry, $pattern) use ($dir) {
                    return array_merge($carry, glob(static::joinPath($dir, $pattern), GLOB_BRACE));
                }, []);

                foreach (Finder::create()->in($src) as $file) {

                    if (in_array($file->getPathname(), $exclude)) {
                        continue;
                    }
                    if ($file->isDir()) {
                        $fs->mkdir(static::joinPath($dest, $file->getRelativePathname()));
                    } else {
                        $fs->dumpFile(static::joinPath($dest, $file->getRelativePathname()), $printer(...$parser($file->getContents())));
                    }

                }
            }
        }
    }

    protected static function mapClasses(array $classmap, $package)
    {
        $autoload = $package->getAutoload()['psr-4'] ?? []; $mapping = [];

        foreach ($classmap as $oldNamespace => $newNamespace) {

            $length = strlen($oldNamespace);

            foreach ($autoload as $namespace => $path) {
                if ($oldNamespace === substr($namespace, 0, $length)) {
                    $mapping[$newNamespace] = static::joinPath($package->getName(), $path);
                }
            }
        }

        return $mapping;
    }

    protected static function createParser()
    {
        $lexer = new Emulative([
            'usedAttributes' => [
                'comments',
                'startLine', 'endLine',
                'startTokenPos', 'endTokenPos',
            ],
        ]);

        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7, $lexer);

        return function ($code) use ($parser, $lexer) {
            return [$parser->parse($code), $lexer->getTokens()];
        };
    }

    protected static function createPrinter(array $classmap)
    {
        $traverser = new NodeTraverser();
        $traverser->addVisitor(new CloningVisitor());
        $traverser->addVisitor(new ParentResolver());
        $traverser->addVisitor(new NameResolver(null, ['replaceNodes' => false]));
        $traverser->addVisitor(new NamespaceRenamer($classmap));

        return function ($stmts, $tokens) use ($traverser) {
            return (new Standard())->printFormatPreserving($traverser->traverse($stmts), $stmts, $tokens);
        };
    }

    protected static function getPath(array $autoload, string $namespace)
    {
        $path = $autoload['psr-4'][$namespace] ?? null;

        return is_array($path) ? $path[0] : $path;
    }

    protected static function joinPath(...$paths)
    {
        return preg_replace('~[/\\\\]+~', '/', join('/', $paths));
    }
}
