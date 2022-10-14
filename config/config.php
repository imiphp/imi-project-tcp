<?php

declare(strict_types=1);

use Imi\App;
use Imi\AppContexts;

$mode = App::isInited() ? App::getApp()->getType() : null;

return [
    // 项目根命名空间
    'namespace'    => 'ImiApp',

    // 配置文件
    'configs'    => [
        'beans'        => __DIR__ . '/beans.php',
    ],

    'ignoreNamespace'   => [
    ],

    // 主服务器配置
    'mainServer'    => 'swoole' === $mode ? [
        'namespace'    => 'ImiApp\TCPServer',
        // @phpstan-ignore-next-line
        'type'         => Imi\Swoole\Server\Type::TCP_SERVER,
        'host'         => '0.0.0.0',
        'port'         => 8082,
        'configs'      => [
            // 'worker_num'        =>  8,
            // 'task_worker_num'   =>  16,

            // 分包方式

            // 分包方式1-EOF自动分包
            'open_eof_split'    => true, //打开EOF_SPLIT检测
            'package_eof'       => "\r\n", //设置EOF

            // 分包方式2-固定包头
            // 'open_eof_split'        => false,
            // 'open_length_check'     => true,
            // 'package_length_type'   => 'N',
            // 'package_length_offset' => 0,       //第N个字节是包长度的值
            // 'package_body_offset'   => 4,       //第几个字节开始计算长度
            // 'package_max_length'    => 1024 * 1024,  //协议最大长度
        ],
        // EOF自动分包数据处理器
        'dataParser'        => \ImiApp\TCPServer\DataParser\JsonObjectEOFParser::class,
        // 固定包头分包数据处理器
        // 'dataParser'            => \ImiApp\TCPServer\DataParser\JsonObjectFixedParser::class,
    ] : [],

    // 子服务器（端口监听）配置
    'subServers'        => [
        // 'SubServerName'   =>  [
        //     'namespace'    =>    'ImiApp\XXXServer',
        //     'type'        =>    Imi\Server\Type::HTTP,
        //     'host'        =>    '0.0.0.0',
        //     'port'        =>    13005,
        // ]
    ],

    // Workerman 服务器配置
    'workermanServer' => [
        'tcp' => [
            'namespace'   => 'ImiApp\TCPServer',
            'type'        => Imi\Workerman\Server\Type::TCP,
            'host'        => '0.0.0.0',
            'port'        => 8082,
            'configs'     => [
                // EOF \r\n 自动分包数据处理器
                'protocol' => \Imi\Workerman\Server\Protocol\TextCRLF::class,
                // 固定包头分包数据处理器
                // 'protocol' => \Imi\Workerman\Server\Protocol\FrameWithLength::class,
            ],
            // EOF自动分包数据处理器
            'dataParser'        => \ImiApp\TCPServer\DataParser\JsonObjectEOFParser::class,
            // 固定包头分包数据处理器
            // 'dataParser'            => \ImiApp\TCPServer\DataParser\JsonObjectFixedParser::class,
        ],
    ],

    // 连接池配置
    'pools'    => 'swoole' === $mode ? [
        // 主数据库
        'maindb'    => [
            'pool'    => [
                // @phpstan-ignore-next-line
                'class'        => \Imi\Swoole\Db\Pool\CoroutineDbPool::class,
                'config'       => [
                    'maxResources'    => 10,
                    'minResources'    => 0,
                ],
            ],
            'resource'    => [
                'host'        => '127.0.0.1',
                'port'        => 3306,
                'username'    => 'root',
                'password'    => 'root',
                'database'    => 'mysql',
                'charset'     => 'utf8mb4',
            ],
        ],
        'redis'    => [
            'pool'    => [
                // @phpstan-ignore-next-line
                'class'        => \Imi\Swoole\Redis\Pool\CoroutineRedisPool::class,
                'config'       => [
                    'maxResources'    => 10,
                    'minResources'    => 0,
                ],
            ],
            'resource'    => [
                'host'      => '127.0.0.1',
                'port'      => 6379,
                'password'  => null,
            ],
        ],
    ] : [],

    // 数据库配置
    'db'    => [
        // 数默认连接池名
        'defaultPool'    => 'maindb',
        // FPM、Workerman 下用
        'connections'   => [
            'maindb' => [
                'host'        => '127.0.0.1',
                'port'        => 3306,
                'username'    => 'root',
                'password'    => 'root',
                'database'    => 'mysql',
                'charset'     => 'utf8mb4',
                // 'port'    => '3306',
                // 'timeout' => '建立连接超时时间',
                // 'charset' => '',
                // 使用 hook pdo 驱动（缺省默认）
                // 'dbClass' => \Imi\Db\Drivers\PdoMysql\Driver::class,
                // 使用 hook mysqli 驱动
                // 'dbClass' => \Imi\Db\Drivers\Mysqli\Driver::class,
                // 使用 Swoole MySQL 驱动
                // 'dbClass' => \Imi\Swoole\Db\Drivers\Swoole\Driver::class,
                // 数据库连接后，执行初始化的 SQL
                // 'sqls' => [
                //     'select 1',
                //     'select 2',
                // ],
            ],
        ],
    ],

    // redis 配置
    'redis' => [
        // 数默认连接池名
        'defaultPool'   => 'redis',
        // FPM、Workerman 下用
        'connections'   => [
            'redis' => [
                'host'	 => '127.0.0.1',
                'port'	 => 6379,
                // 是否自动序列化变量
                'serialize'	 => true,
                // 密码
                'password'	 => null,
                // 第几个库
                'db'	 => 0,
            ],
        ],
    ],

    // 日志配置
    'logger' => [
        'channels' => [
            'imi' => [
                'handlers' => [
                    [
                        'class'     => \Imi\Log\Handler\ConsoleHandler::class,
                        'formatter' => [
                            'class'     => \Imi\Log\Formatter\ConsoleLineFormatter::class,
                            'construct' => [
                                'level'  => \Imi\Log\MonoLogger::DEBUG, // 开发调试环境
                                // 'level'  => \Imi\Log\MonoLogger::INFO,  // 生产环境
                                'format'                     => null,
                                'dateFormat'                 => 'Y-m-d H:i:s',
                                'allowInlineLineBreaks'      => true,
                                'ignoreEmptyContextAndExtra' => true,
                            ],
                        ],
                    ],
                    [
                        'class'     => \Monolog\Handler\RotatingFileHandler::class,
                        'construct' => [
                            'level'  => \Imi\Log\MonoLogger::DEBUG, // 开发调试环境
                            // 'level'  => \Imi\Log\MonoLogger::INFO,  // 生产环境
                            'filename' => App::get(AppContexts::APP_PATH_PHYSICS) . '/.runtime/logs/log.log',
                        ],
                        'formatter' => [
                            'class'     => \Monolog\Formatter\LineFormatter::class,
                            'construct' => [
                                'dateFormat'                 => 'Y-m-d H:i:s',
                                'allowInlineLineBreaks'      => true,
                                'ignoreEmptyContextAndExtra' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
