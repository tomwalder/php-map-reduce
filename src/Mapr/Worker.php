<?php
/**
 * The core of our workers
 *
 * @author Tom Walder <tom@docnet.nu>
 */

namespace Mapr;

use League\Pipeline\Pipeline;
use Mapr\Pipeline\Stage\Worker\End;
use Mapr\Pipeline\Stage\Worker\Fail;
use Mapr\Pipeline\Stage\Worker\Start;

/**
 * Worker
 *
 * @package Mapr
 */
class Worker {

    /**
     * @var Pipeline
     */
    protected $obj_pipeline = null;

    /**
     * Build the worker Pipeline, with the user Stages (Pipeline) in the middle
     *
     * @param Pipeline $obj_user_pipeline
     */
    public function __construct(Pipeline $obj_user_pipeline)
    {
        $this->obj_pipeline = (new Pipeline())
            ->pipe($this->getStartStage())
            ->pipe($obj_user_pipeline)
            ->pipe($this->getEndStage())
        ;
    }

    /**
     * Process the Mapr\Payload
     *
     * @param Payload $payload
     * @return mixed
     */
    public function process(Payload $payload)
    {
        try {
            return $this->obj_pipeline->process($payload);
        } catch (\Exception $obj_ex) {
            return $this->getFailStage()->process($payload);
        }
    }


    protected function getStartStage()
    {
        return new Start();
    }

    protected function getEndStage()
    {
        return new End();
    }

    protected function getFailStage()
    {
        return new Fail();
    }

}