<?php

if (!$props['content']) {
    return;
}

// Content
$content = $this->el('div', [

    'class' => [
        'el-content uk-panel',
        'uk-text-{content_style}',
    ],

]);

// Link
$link = $this->el('a', [
    'class' => [
        'uk-link-{0}' => $element['link_style'],
        'uk-margin-remove-last-child',
    ],
    'href' => ['{link}'],
    'target' => ['_blank {@link_target}'],
    'uk-scroll' => str_starts_with((string) $props['link'], '#'),
]);

echo $content($element, $props['link'] ? $link($props, $props['content']) : $props['content']);
