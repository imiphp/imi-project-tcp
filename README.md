# 说明

这是一个 imi TCP 项目开发骨架项目，你可以基于这个项目来开发你的项目。

imi 框架：<https://www.imiphp.com>

imi 文档：<https://doc.imiphp.com>

## 安装

创建项目：`composer create-project imiphp/project-tcp:~2.1.0`

如果你希望在 Swoole 运行 imi：`composer require imiphp/imi-swoole:~2.1.0`

## 配置

### 项目命名空间

默认是 `ImiApp`，可以在 `composer.json` 中修改：

* `autoload.psr-4.ImiApp`

* `imi.namespace`

然后替换代码中的命名空间即可。

### 运行配置

项目配置目录：`config`

TCP 服务器配置目录：`TCPServer/config`

## 启动命令

Swoole：`vendor/bin/imi-swoole swoole/start`

Workerman：`vendor/bin/imi-workerman workerman/start`

## 权限

`.runtime` 目录需要有可写权限

## 测试客户端

`test-client` 目录中附带了测试客户端，可以用于测试。

## 生产环境

**关闭热更新：**`config/beans.php` 中 `hotUpdate.status` 设为 `false`

生产环境建议只保留一个容器，可以提升性能，imi 官方推荐使用 **Swoole**！

**移除 `imi-workerman`：**`composer remove imiphp/imi-workerman`

**移除 `imi-swoole`：**`composer remove imiphp/imi-swoole`（不推荐）

## 代码质量

### 格式化代码

内置 `php-cs-fixer`，统一代码风格。

配置文件 `.php-cs-fixer.php`，可根据自己实际需要进行配置，文档：<https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/config.rst>

**格式化项目：** `./vendor/bin/php-cs-fixer fix`

**格式化指定文件：** `./vendor/bin/php-cs-fixer fix test.php`

### 代码静态分析

内置 `phpstan`，可规范代码，排查出一些隐藏问题。

配置文件 `phpstan.neon`，可根据自己实际需要进行配置，文档：<https://phpstan.org/config-reference>

**分析项目：** `./vendor/bin/phpstan`

**分析指定文件：** `./vendor/bin/phpstan test.php`

### 测试用例

内置 `phpunit`，可以实现自动化测试。

**文档：**<https://phpunit.readthedocs.io/en/9.5/>

**测试用例 demo：**`tests/Module/Test/TestServiceTest.php`

**运行测试用例：**`composer test`
