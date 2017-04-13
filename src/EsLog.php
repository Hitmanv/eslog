<?php

namespace Hitman\Elasticsearch;

use Elasticsearch\ClientBuilder;
use Exception;
use Hitman\Elasticsearch\Jobs\LogToEs;

class EsLog
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->setHosts(config('eslog.hosts'))->build();
    }

    public function log($logType, $data)
    {
        $data['timestamp'] = time() * 1000;
        $data['log_type']  = $logType;

        $params          = [];
        $params['index'] = config('eslog.index');
        $params['type']  = config('eslog.type');
        $params['body']  = $data;

        if (config('eslog.async')) {
            dispatch((new LogToEs($params))->onQueue(config('eslog.queue'))); // 队列中执行
        } else {
            $this->client->index($params);
        }
    }

    public function event($event, $data)
    {
        $data['event'] = $event;
        $this->log('event', $data);
    }

    public function error($data)
    {
        $this->log('error', $data);
    }

    public function info($data)
    {
        $this->log('info', $data);
    }

    public function exception(Exception $ex)
    {
        $data            = [];
        $data['message'] = get_class($ex) . ": " . $ex->getMessage();
        $data['trace']   = $ex->getTraceAsString();
        $this->error($data);
    }
}