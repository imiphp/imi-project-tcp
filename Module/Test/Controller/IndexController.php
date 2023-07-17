<?php

declare(strict_types=1);

namespace ImiApp\Module\Test\Controller;

use Imi\Server\TcpServer\Route\Annotation\TcpAction;
use Imi\Server\TcpServer\Route\Annotation\TcpController;
use Imi\Server\TcpServer\Route\Annotation\TcpRoute;

/**
 * 数据收发测试.
 *
 * @TcpController
 */
class IndexController extends \Imi\Server\TcpServer\Controller\TcpController
{
    /**
     * 发送消息.
     *
     * @TcpAction
     *
     * @TcpRoute({"action"="send"})
     *
     * @param mixed $data
     */
    public function send($data): array
    {
        $address = $this->data->getClientAddress();
        $message = '[' . $address->getAddress() . ':' . $address->getPort() . ']: ' . $data->message;

        return [
            'success'   => true,
            'data'      => $message,
        ];
    }
}
