<?php
// config/adminlte_clientes.php
return [
    'menu' => [
        [
            'text' => 'Información',
            'url' => '/informacion',
            'icon' => 'fas fa-store mr-2',
            'classes' => 'bg-secondary text-white',
        ],
        [
            'text' => 'Catálogo',
            'url' => '/catalogo',
            'icon' => 'fas fa-shopping-bag mr-2',
            'classes' => 'bg-secondary text-white',
        ],
        [
            'text' => 'Compras',
            'url' => '/detalle_pedido',
            'icon' => 'fas fa-fw fa-shopping-cart',
            'classes' => 'bg-secondary text-white',
        ],
        [
            'text' => 'Pedidos',
            'url' => '/pedido',
            'icon' => 'fas fa-shopping-basket',
            'classes' => 'bg-secondary text-white',
        ],
    ]
];
