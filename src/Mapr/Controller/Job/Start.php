<?php

namespace Mapr\Controller\Job;

use Mapr\Async\TaskManagerInterface;

class Start extends \Mapr\Controller
{

    /**
     * @var TaskManagerInterface
     */
    private $obj_task_manager = null;

    /**
     * @param TaskManagerInterface $obj_task_manager
     */
    public function __construct(TaskManagerInterface $obj_task_manager)
    {
        $this->obj_task_manager = $obj_task_manager;
    }

    /**
     * Main
     */
    public function dispatch()
    {
        $this->obj_task_manager->createNamedQueue('default')->addTask(
            $this->obj_task_manager->createHttpCallback('/mapr/shard', ['awesome' => true])
        );
        $this->setResponse(['shard' => 'queued']);
    }

}