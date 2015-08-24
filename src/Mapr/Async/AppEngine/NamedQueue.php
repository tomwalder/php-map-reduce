<?php

namespace Mapr\Async\AppEngine;

use Mapr\Async\HttpCallbackInterface;
use Mapr\Async\NamedQueueInterface;
use google\appengine\api\taskqueue\PushQueue;

class NamedQueue implements NamedQueueInterface
{

    /**
     * Name of the queue
     *
     * @param $name
     */
    public function __construct($name = 'default')
    {
        $this->obj_queue = new PushQueue($name);
    }

    /**
     * Add a single task to the queue
     *
     * @param HttpCallbackInterface $callback
     * @return mixed
     */
    public function addTask(HttpCallbackInterface $callback)
    {
        /** @var HttpCallback $callback */
        $this->obj_queue->addTasks([$callback->getTask()]);
    }

    /**
     * Add many tasks to the queue
     *
     * @param HttpCallback[] $callbacks
     * @return mixed
     */
    public function addTasks(array $callbacks)
    {
        $arr_tasks = [];
        foreach($callbacks as $callback) {
            $arr_tasks[] = $callback->getTask();
        }
        $this->obj_queue->addTasks($arr_tasks);
    }

}
