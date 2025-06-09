## 项目简介
该项目是 AIGC 的聊天应用的 web 端，使用 php 语言的 laravel 框架编写，通过向 tcp  服务（aigc-alpha）发送信息，由 tpc 服务垂询指定的大语言模型的接口输出结果。该部分负责控制用户的行为以及向 tcp 服务发送指令。它的领域模型的文档请参考[链接](https://github.com/turbulent-flow/aigc-web/blob/main/AIGC%20%E9%A2%86%E5%9F%9F%E6%A8%A1%E5%9E%8B.pdf)。

## 本地启动
### 1. 启动 mysql(asdf 安装)
使用 asdf 安装 mysql 8 后，需要定位 mysql 的安装位置：
```shell
asdf which mysqld | sed 's!/bin/mysqld!!'
```
然后再启动 mysql：
```shell
[YOUR_MYSQL_PATH]/bin/mysqld
```

### 2. 配置环境变量
在项目根目录放置`.env`，内容如下：
```text
APP_NAME=aigc-web
APP_ENV=local
APP_KEY=[YOUR_APP_KEY]
APP_DEBUG=true
APP_TIMEZONE=Asia/Shanghai
APP_URL=[YOUR_APP_URL] # 本地运行的话，默认使用 http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aigc_web
DB_USERNAME=[YOUR_DB_USERNAME]
DB_PASSWORD=[YOUR_DB_PASSWORD]

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

API_V0_TOKEN=[YOUR_API_TOKEN] # 使用 api 创建 token   
AIGC_SERVER_HOST=127.0.0.1
AIGC_SERVER_PORT=[YOUR_SERVER_PORT] # 默认是 4040
```

### 3. 数据迁移后，启动 web server
```shell
php artisan serve
```

## 测试
