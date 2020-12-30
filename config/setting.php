<?php

    return [
        'comment' => [
            'accept' => 1,
        ],

        'paginate' => [
            'image' =>'image',
            'product_detail' =>'product-detail',
            'comment' => 'comment',
            'product' => 9,
            'order' => 10,
        ],

        'image' => [
            'product' => 'bower_components/bower_project1/user/images/products/',
            'user1' => "bower_components/bower_project1/user/images/person_1.jpg",
            'slide1' => 'bower_components/bower_project1/user/images/bg_1.png',
            'slide2' => 'bower_components/bower_project1/user/images/bg_2.png',
            'default' => 'bower_components/bower_project1/user/images/product_1.jpg',
        ],

        'http_status' => [
            'success' => '200',
            'errors' => '404',
            'server' => '505',
        ],

        'range_price' => [
            'price_from' => [
                '100000',
                '200000',
                '500000',
            ],
            'price_to' => [
                '1000000',
                '2000000',
                '5000000',
                '10000000',
            ],
        ],

    'number_paginate' => '8',
    'rate' => 5,
    'errors404' => 404,
    'number_product' => '8',
    'paid' => [
        'payed' => '1',
        'unpaid' => '0',
    ],
    'load_more' => 5,
    'report_time_order_pending' => '16:00',
    'date' => 'H:i:s d/m/Y',
    'password_default' => 12345678,
    'user_image' => 'bower_components/bower_project1/user/images/',
];
