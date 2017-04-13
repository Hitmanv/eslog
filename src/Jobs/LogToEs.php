<?php

namespace Hitman\Elasticsearch\Jobs;

use Elasticsearch\ClientBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogToEs implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }


    public function handle()
    {
        $client = ClientBuilder::create()->setHosts(config('eslog.hosts'))->build();
        $client->index($this->params);
    }
}
