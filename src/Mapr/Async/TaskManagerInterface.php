<?php

namespace Mapr\Async;

interface TaskManagerInterface
{

    /**
     * Create a named Queue
     *
     * @param $name
     * @return NamedQueueInterface
     */
    public function createNamedQueue($name);

    /**
     * Create an HttpCallback
     *
     * @param $url
     * @param array $payload
     * @param int $delay
     * @return HttpCallbackInterface
     */
    public function createHttpCallback($url, array $payload = [], $delay = 0);

}