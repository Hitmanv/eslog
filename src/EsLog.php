<?php

namespace Hitman\Elasticsearch;

use Elasticsearch\ClientBuilder;
use Exception;

class EsLog
{
	protected $client;

	public function __construct()
	{
		$this->client = ClientBuilder::create()->setHosts(config('es.hosts'))->build();
	}

    public function log($type, $data)
    {
        $data['timestamp'] = time() * 1000;
        $data['app'] = config('es.app');

        $params = [
            'index' => 'log',
            'type' => $type,
            'body' => $data,
        ];

        return $this->client->index($params);
    }

    public function event($data)
    {
        return $this->log('event', $data);
    }

    public function error($data)
    {
        return $this->log('error', $data);
    }

    public function info($data)
    {
        return $this->log('info', $data);
    }

    public function exception(Exception $ex)
    {
        $data = [];
        $data['message'] = get_class($ex) . ": " . $ex->getMessage();
        $data['trace'] = $ex->getTraceAsString();
        return $this->error('error', $data);
    }
}