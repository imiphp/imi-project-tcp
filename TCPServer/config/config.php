<?php

use Imi\Log\LogLevel;
return [
    'configs'    =>    [
    ],
    // bean扫描目录
    'beanScan'    =>    [
        'ImiApp\TCPServer\Controller',
    ],
    'beans'    =>    [
        'TcpDispatcher'    =>    [
            'middlewares'    =>    [
                \Imi\Server\TcpServer\Middleware\RouteMiddleware::class,
            ],
        ],
        'GroupRedis'    =>    [
            'redisPool'    =>    'redis',
        ],
        'ServerGroup'   =>  [
            'status'        =>  false,
        ],
        'ConnectContextRedis'    =>    [
            'redisPool' =>   'redis',
            'lockId'    =>   'redis',
        ],
    ],
];