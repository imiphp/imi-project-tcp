# 说明

imi 框架：https://www.imiphp.com

## 安装

创建项目：`composer create-project imiphp/project-tcp:~2.1.0`

如果你希望在 Swoole 运行 imi：`composer require imiphp/imi-swoole:~2.1.0`

## 启动命令

Swoole：`vendor/bin/imi-swoole swoole/start`

Workerman：`vendor/bin/imi-workerman workerman/start`

## 权限

`.runtime` 目录需要有可写权限

## 测试客户端

`test-client` 目录中附带了测试客户端，可以用于测试。
