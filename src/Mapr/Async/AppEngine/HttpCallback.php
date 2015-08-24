<?php

namespace Mapr\Async\AppEngine;

use google\appengine\api\taskqueue\PushTask;
use Mapr\Async\HttpCallbackInterface;

class HttpCallback implements HttpCallbackInterface
{

    private $obj_task = null;

    /**
     * @param $url
     * @param array $payload
     * @param int $delay
     */
    public function __construct($url, array $payload = [], $delay = 0)
    {
        $this->obj_task = new PushTask($url, $payload, [
            'delay_seconds' => $delay
        ]);
    }

    public function getTask()
    {
        return $this->obj_task;
    }

}