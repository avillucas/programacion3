<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        /** 
        'db'=>[
            'host' => isset($_ENV['DB_HOST']) ?  $_ENV['DB_HOST']:'localhost',
            'dbname' =>  isset($_ENV['DB_NAME']) ?  $_ENV['DB_NAME']:'id7086796_tpprog3',
            'user' =>  isset($_ENV['DB_USER']) ?  $_ENV['DB_USER']:'root',
            'pass' =>  isset($_ENV['DB_PASS']) ?  $_ENV['DB_PASS']:'',        
        ],  
        */ 
    ],
];
