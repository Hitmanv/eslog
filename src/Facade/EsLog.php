<?php
/**
 * User: hitman
 * Date: 15/01/2017
 * Time: 1:53 PM
 */

namespace Hitman\Elasticsearch\Facade;

use Illuminate\Support\Facades\Facade;

class EsLog extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'eslog';
    }
}
