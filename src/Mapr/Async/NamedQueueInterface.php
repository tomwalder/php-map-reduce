<?php

namespace Mapr\Async;

interface NamedQueueInterface
{

    /**
     * Name of the queue
     *
     * @param $name
     */
    public function __construct($name);

    /**
     * Add a single task to the queue
     *
     * @param HttpCallbackInterface $callback
     * @return mixed
     */
    public function addTask(HttpCallbackInterface $callback);

    /**
     * Add many tasks to the queue
     *
     * @param HttpCallbackInterface[] $callbacks
     * @return mixed
     */
    public function addTasks(array $callbacks);

}