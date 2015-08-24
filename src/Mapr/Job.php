<?php
/**
 * @author Tom Walder <tom@docnet.nu>
 */
namespace Mapr;

class Job {

    /**
     * Possible states
     */
    const STATE_TEMPLATE = 'template';
    const STATE_NEW = 'new';
    const STATE_START_REQUESTED = 'start_please';
    const STATE_STARTED = 'started';
    const STATE_FAILED = 'failed';
    const STATE_COMPLETE = 'complete';

    /**
     * Current state
     *
     * @var string
     */
    protected $str_state = self::STATE_TEMPLATE;

    /**
     * Instance ID
     *
     * @var string
     */
    protected $str_instance_id = null;

    /**
     * Name of this Job
     *
     * @var string
     */
    protected $str_name = null;

    /**
     * Source workload
     *
     * @var Workload
     */
    protected $obj_workload = null;

    /**
     * How to shard the workload
     *
     * @var Sharder
     */
    protected $obj_sharder = null;

    /**
     * Does the work
     *
     * @var Worker
     */
    protected $obj_worker = null;

    /**
     * Munges the results back together
     *
     * @var Aggregator
     */
    protected $obj_agg = null;

    /**
     * Set the name
     *
     * @param $str_name
     * @return $this
     */
    public function setName($str_name)
    {
        $this->str_name = $str_name;
        return $this;
    }

    /**
     * Set the source Workload
     *
     * @param Workload $obj_workload
     * @return $this
     */
    public function setWorkload(Workload $obj_workload)
    {
        $this->obj_workload = $obj_workload;
        return $this;
    }

    /**
     * Set the Sharder
     *
     * @param Sharder $obj_sharder
     * @return $this
     */
    public function setSharder(Sharder $obj_sharder)
    {
        $this->obj_sharder = $obj_sharder;
        return $this;
    }

    /**
     * Set the Worker
     *
     * @param Worker $obj_worker
     * @return $this
     */
    public function setWorker(Worker $obj_worker)
    {
        $this->obj_worker = $obj_worker;
        return $this;
    }

    /**
     * Set the Aggregator
     *
     * @param Aggregator $obj_agg
     * @return $this
     */
    public function setAggregator(Aggregator $obj_agg)
    {
        $this->obj_agg = $obj_agg;
        return $this;
    }

    /**
     * Create an instance of this Job
     *
     * @return Job
     */
    public function createInstance()
    {
        $obj_instance = clone $this;
        $obj_instance->setState(self::STATE_NEW);
        $obj_instance->setInstanceId();
        return $obj_instance;
    }

}