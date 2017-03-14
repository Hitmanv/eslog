# eslog
日志记录工具

## 安装
```shell
composer require hitman/eslog:dev-master
```

## 使用
### Step1 config/app.php 添加
```php
Hitman\Elasticsearch\EsLogServiceProvider::class,

// 添加Facade
'EsLog' => Hitman\Elasticsearch\Facade\EsLog::class,
```

### Step2 生成配置文件 config/es.php
```shell
php artisan vendor:publish
```

### Step3 修改配置
```php
<?php
return [
	'app' => config('app.name'), // 项目名称 用于标识项目
	'hosts' => ['127.0.0.1'], // es 地址
];
```

### Step4 使用
```php
// 使用DI
$eslog = resolve('eslog');
$eslog->error($data);
$eslog->info($data);
$eslog->event($event, $data);
$eslog->exception($exception);
$eslog->log($type, $data); // 自定义类型日志

## 使用Facade 
use EsLog;
EsLog::error($data);
EsLog::info($data);
EsLog::event($event, $data);
EsLog::exception($exception);
EsLog::log($type, $data); // 自定义类型日志

```
