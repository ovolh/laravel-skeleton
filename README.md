# 将Laravel框架进行一些配置处理，让其在开发API时更得心应手

## 来源

配置过程以及配置原理都来自博客:[手摸手教你让Laravel开发Api更得心应手](https://www.guaosi.com/2019/02/26/laravel-api-initialization-preparation/)


目前使用的`Laravel`版本是`8.x`

## 实现功能

- 统一Response响应处理

- Api-Resource资源返回

- jwt-auth用户认证与无感知自动刷新

- jwt-auth多角色认证不串号

- 单一设备登陆


## 环境

| 程序 | 版本 |
| -------- | -------- |
| PHP| `>= 7.3` && `< 8.0` |
| MySQL| `>= 5.5` |
| Redis| `>= 2.8` |

### 注意
扩展包：`tymon/jwt-auth` 1.0.2 不支持 php8， 要支持php8，暂先安装 `1.0.x-dev`,等后期更新

## 安装

1.先把项目克隆到本地

```
git clone git@github.com:ibyond/laravel-skeleton.git
```

2.打开项目目录，下载依赖扩展包

```
composer install
```

3.复制配置文件

```
cp .env.example .env
```

自行配置`.env`里的相关配置信息

4.生成`APP_KEY`和`JWT_SECRET`
```
php artisan key:generate
php artisan jwt:secret
```

5.创建迁移
```
php artisan migrate
```

6.填充数据
```
php artisan db:seed
```

7.启动队列
```
php artisan queue:work
```
