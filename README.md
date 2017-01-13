# eslog
日志记录工具

## 安装
```shell
composer require hitman/eslog:dev-master
```

## 使用
### Step1 config/app.php 添加
```php
Hitman\Elasticsearch\EsLogServiceProvider::class
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
$eslog = resolve('eslog')
$eslog->errorLog($data); // 错误日志记录
$eslog->debugLog($data); // 调试日志记录
$eslog->eventLog($data); // 事件日志记录
$eslog->log($type, $data); // 自定义日志记录
```
