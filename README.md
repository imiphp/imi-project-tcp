# 说明

imi 框架：https://www.imiphp.com

## 安装

### 方法一

* git 拉取下本项目

* 在本项目目录中，执行命令：`composer update`

### 方法二

* `composer create-project imiphp/project-tcp:2.0.x-dev`

## Swoole

为 Windows 系统用户兼容考虑，默认没有引入 Swoole 组件，如有需要请手动引入：`composer require imiphp/imi-swoole:2.0.x-dev`

## 启动命令

Swoole：`vendor/bin/imi-swoole swoole/start`

Workerman：`vendor/bin/imi-workerman workerman/start`

## 权限

`.runtime` 目录需要有可写权限

## 测试客户端

`test-client` 目录中附带了测试客户端，可以用于测试。
