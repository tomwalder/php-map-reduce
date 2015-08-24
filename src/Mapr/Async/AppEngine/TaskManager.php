<?php

namespace Mapr\Async\AppEngine;

use Mapr\Async\HttpCallbackInterface;
use Mapr\Async\NamedQueueInterface;
use Mapr\Async\TaskManagerInterface;

class TaskManager implements TaskManagerInterface
{

    /**
     * Create a named Queue
     *
     * @param $name
     * @return NamedQueueInterface
     */
    public function createNamedQueue($name = 'default')
    {
        return new NamedQueue($name);
    }

    /**
     * Create an HttpCallback
     *
     * @param $url
     * @param array $payload
     * @param int $delay
     * @return HttpCallbackInterface
     */
    public function createHttpCallback($url, array $payload = [], $delay = 0)
    {
        return new HttpCallback($url, $payload, $delay);
    }

}
