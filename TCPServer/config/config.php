<?php

declare(strict_types=1);

return [
    'configs'    => [
    ],
    'beans'    => [
        'TcpDispatcher'    => [
            'middlewares'    => [
                \Imi\Server\TcpServer\Middleware\RouteMiddleware::class,
            ],
        ],
        'GroupRedis'    => [
            'redisPool'    => 'redis',
        ],
        'ServerGroup'   => [
            'status'        => false,
        ],
        'ConnectContextRedis'    => [
            'redisPool' => 'redis',
            'lockId'    => 'redis',
        ],
    ],
];
