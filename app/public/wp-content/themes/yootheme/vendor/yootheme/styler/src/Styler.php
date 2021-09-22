<?php

namespace YOOtheme\Theme;

use YOOtheme\Config;
use YOOtheme\File;
use YOOtheme\Path;
use YOOtheme\Url;

class Styler
{
    /**
     * Constructor.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Gets theme styles.
     *
     * @return array
     */
    public function getThemes()
    {
        $themes = [];
        $directories = join(',', array_filter([
            $this->config->get('theme.rootDir'),
            $this->config->get('theme.childDir'),
        ]));

        foreach (File::glob("{{$directories}}/less/theme.*.less") as $file) {
            $themes[] = $this->getTheme(substr(basename($file, '.less'), 6));
        }

        return $themes;
    }

    public function getTheme($id)
    {
        $file = File::get("~theme/less/theme.{$id}.less");

        if (!$file) {
            return;
        }

        return array_merge([
            'id' => $id,
            'file' => $file,
            'name' => static::namify($id),
        ], static::getMeta($file));
    }

    public function resolveImports($file, $vars = [])
    {
        if (!file_exists($file)) {
            return [];
        }

        $imports = [Path::normalize(Url::to($file)) => $contents = @file_get_contents($file) ?: ''];

        if (preg_match_all('/^@import.*"(.*)";/m', $contents, $matches)) {

            $replacePairs = [];
            foreach ($vars as $name => $value) {
                $name = substr($name, 1);
                $replacePairs["@{{$name}}"] = $value;
            }

            foreach ($matches[1] as $path) {
                $imports += $this->resolveImports(dirname($file) . '/' . strtr($path, $replacePairs), $vars);
            }
        }

        return $imports;
    }

    protected static function getMeta($file)
    {
        $meta = [];
        $style = false;
        $handle = fopen($file, 'r');
        $content = str_replace("\r", "\n", fread($handle, 8192));
        fclose($handle);

        // parse first comment
        if (!preg_match('/^\s*\/\*(?:(?!\*\/).|\n)+\*\//', $content, $matches)) {
            return $meta;
        }

        // parse all metadata
        if (!preg_match_all('/^[ \t\/*#@]*(name|style|background|color|type|preview):(.*)$/mi', $matches[0], $matches)) {
            return $meta;
        }

        foreach ($matches[1] as $i => $key) {

            $key = strtolower(trim($key));
            $value = trim($matches[2][$i]);

            if (!in_array($key, ['name', 'style', 'preview'])) {
                $value = array_map('ucwords', array_map('trim', explode(',', $value)));
            }

            if ($key === 'preview') {
                $value = Url::to(Path::resolve(dirname($file), $value));
            }

            if (!$style && $key != 'style') {
                $meta[$key] = $value;
            } elseif ($key == 'style') {
                $style = $value;
                $meta['styles'][$style] = ['name' => static::namify($style)];
            } else {
                $meta['styles'][$style][$key] = $value;
            }
        }

        return $meta;
    }

    protected static function namify($id)
    {
        return ucwords(str_replace('-', ' ', $id));
    }
}
