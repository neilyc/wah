<?php
return [
  'settings' => [
    // View settings
    'view' => [
      'template_path' => __DIR__ . '/templates',
      'twig' => [
        'cache' => __DIR__ . '/../var/cache/twig',
        'debug' => true,
        'auto_reload' => true,
      ],
    ],

    // monolog settings
    'logger' => [
      'name' => 'app',
      'path' => __DIR__ . '/../var/log/'.date("Ymd").'/logs.log',
      'path_error' => __DIR__ . '/../var/log/'.date("Ymd").'/error.log',
    ],

    // doctrine settings
    'doctrine' => [
      'meta' => [
        'entity_path' => [
          'app/src/Entity'
        ],
        'auto_generate_proxies' => true,
        'proxy_dir' =>  __DIR__.'/../var/cache/proxies',
        'cache' => null,
      ],
      'connection' => [
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'waah',
        'user'     => 'root',
        'password' => '',
      ]
    ],

    'mailer' => [
      'host'        => 'smtp.bidule.com',
      'SMTPAuth'    => 'true',
      'SMTPSecure'  => 'tls',
      'port'        => '587',
      'user'        => 'user@bidule.com',
      'password'    => 'pass',      
    ]
  ],
];
