<?php // $file = /Users/wddep-user/Local Sites/sortit-cases/app/public/wp-content/themes/yootheme/vendor/yootheme/builder-wordpress-woocommerce/elements/upsell_products/element.json

return [
  '@import' => $filter->apply('path', './element.php', $file), 
  'name' => 'woo_upsell_products', 
  'title' => 'Upsell Products', 
  'group' => 'woocommerce', 
  'icon' => $filter->apply('url', './images/icon.svg', $file), 
  'iconSmall' => $filter->apply('url', './images/iconSmall.svg', $file), 
  'element' => true, 
  'defaults' => [
    'posts_per_page' => 4, 
    'columns' => 4, 
    'orderby' => 'rand', 
    'order' => 'desc', 
    'show_headline' => true, 
    'show_title' => true, 
    'show_rating' => true
  ], 
  'templates' => [
    'render' => $filter->apply('path', './templates/template.php', $file)
  ], 
  'fields' => [
    'posts_per_page' => [
      'label' => 'Limit', 
      'description' => 'Limit the number of products.', 
      'type' => 'number'
    ], 
    'columns' => [
      'label' => 'Columns', 
      'description' => 'Set the number of grid columns for desktops and larger screens. On smaller viewports the columns will adapt automatically.', 
      'type' => 'number'
    ], 
    'orderby' => [
      'label' => 'Order', 
      'description' => 'Set the product ordering.', 
      'type' => 'select', 
      'options' => [
        'Id' => 'id', 
        'Date' => 'date', 
        'Modified' => 'modified', 
        'Title' => 'title', 
        'Price' => 'price', 
        'Menu' => 'menu_order', 
        'Random' => 'rand'
      ]
    ], 
    'order' => [
      'label' => 'Order Direction', 
      'description' => 'Set the order direction.', 
      'type' => 'select', 
      'options' => [
        'Ascending' => 'asc', 
        'Descending' => 'desc'
      ]
    ], 
    'show_headline' => [
      'label' => 'Display', 
      'type' => 'checkbox', 
      'text' => 'Show headline'
    ], 
    'show_title' => [
      'type' => 'checkbox', 
      'text' => 'Show title'
    ], 
    'show_rating' => [
      'type' => 'checkbox', 
      'text' => 'Show rating'
    ], 
    'position' => $config->get('builder.position'), 
    'position_left' => $config->get('builder.position_left'), 
    'position_right' => $config->get('builder.position_right'), 
    'position_top' => $config->get('builder.position_top'), 
    'position_bottom' => $config->get('builder.position_bottom'), 
    'position_z_index' => $config->get('builder.position_z_index'), 
    'margin' => $config->get('builder.margin'), 
    'margin_remove_top' => $config->get('builder.margin_remove_top'), 
    'margin_remove_bottom' => $config->get('builder.margin_remove_bottom'), 
    'maxwidth' => $config->get('builder.maxwidth'), 
    'maxwidth_breakpoint' => $config->get('builder.maxwidth_breakpoint'), 
    'block_align' => $config->get('builder.block_align'), 
    'block_align_breakpoint' => $config->get('builder.block_align_breakpoint'), 
    'block_align_fallback' => $config->get('builder.block_align_fallback'), 
    'text_align' => $config->get('builder.text_align_justify'), 
    'text_align_breakpoint' => $config->get('builder.text_align_breakpoint'), 
    'text_align_fallback' => $config->get('builder.text_align_justify_fallback'), 
    'animation' => $config->get('builder.animation'), 
    '_parallax_button' => $config->get('builder._parallax_button'), 
    'visibility' => $config->get('builder.visibility'), 
    'name' => $config->get('builder.name'), 
    'status' => $config->get('builder.status'), 
    'id' => $config->get('builder.id'), 
    'class' => $config->get('builder.cls'), 
    'attributes' => $config->get('builder.attrs'), 
    'css' => [
      'label' => 'CSS', 
      'description' => 'Enter your own custom CSS. The following selectors will be prefixed automatically for this element: <code>.el-element</code>', 
      'type' => 'editor', 
      'editor' => 'code', 
      'mode' => 'css', 
      'attrs' => [
        'debounce' => 500
      ]
    ]
  ], 
  'fieldset' => [
    'default' => [
      'type' => 'tabs', 
      'fields' => [[
          'title' => 'Settings', 
          'fields' => [[
              'label' => 'WooCommerce', 
              'type' => 'group', 
              'divider' => true, 
              'fields' => ['posts_per_page', 'columns', 'orderby', 'order', 'show_headline', 'show_title', 'show_rating']
            ], [
              'label' => 'General', 
              'type' => 'group', 
              'fields' => ['position', 'position_left', 'position_right', 'position_top', 'position_bottom', 'position_z_index', 'margin', 'margin_remove_top', 'margin_remove_bottom', 'maxwidth', 'maxwidth_breakpoint', 'block_align', 'block_align_breakpoint', 'block_align_fallback', 'text_align', 'text_align_breakpoint', 'text_align_fallback', 'animation', '_parallax_button', 'visibility']
            ]]
        ], $config->get('builder.advanced')]
    ]
  ]
];
