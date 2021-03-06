<?php // $file = /Users/wddep-user/Local Sites/sortit-cases/app/public/wp-content/themes/yootheme/vendor/yootheme/theme-wordpress-woocommerce/config/customizer.json

return [
  'sections' => [
    'layout' => [
      'fields' => [
        'layout' => [
          'items' => [
            'woocommerce' => 'WooCommerce'
          ]
        ]
      ]
    ]
  ], 
  'panels' => [
    'navbar-items' => [
      'fields' => [
        'items' => [
          'fields' => [
            'woocommerce_cart_quantity' => [
              'label' => 'Cart Quantity', 
              'description' => 'Display the cart quantity in brackets or as a badge.', 
              'type' => 'select', 
              'options' => [
                'Brackets' => '', 
                'Badge' => 'badge'
              ], 
              'show' => sprintf('this.panel.item.object_id === %s', $config->get('woocommerce.cartPage'))
            ]
          ]
        ]
      ]
    ], 
    'woocommerce' => [
      'title' => 'WooCommerce', 
      'width' => 400, 
      'fields' => [
        'woocommerce.price.from' => [
          'label' => 'Variable Product', 
          'description' => 'Show the lowest price instead of the price range.', 
          'type' => 'checkbox', 
          'text' => 'Show lowest price'
        ], 
        'woocommerce.price.sale_after_regular' => [
          'label' => 'On Sale Product', 
          'description' => 'Show the sale price before or after the regular price.', 
          'text' => 'Switch prices', 
          'type' => 'checkbox'
        ], 
        'woocommerce.product_thumbnails_columns' => [
          'label' => 'Gallery Thumbnail Columns', 
          'description' => 'Set the number of columns for the gallery thumbnails.', 
          'type' => 'select', 
          'default' => '4', 
          'options' => [
            2 => '2', 
            3 => '3', 
            4 => '4', 
            5 => '5', 
            6 => '6'
          ]
        ]
      ]
    ]
  ]
];
