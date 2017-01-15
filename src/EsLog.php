<?php

namespace Hitman\Elasticsearch;

use Elasticsearch\ClientBuilder;

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
}