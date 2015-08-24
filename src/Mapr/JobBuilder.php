<?php
/**
 *
 * @author Tom Walder <tom@docnet.nu>
 */
namespace Mapr;

use League\Pipeline\CallableStage;
use League\Pipeline\Pipeline;
use Psr\Log\InvalidArgumentException;

class JobBuilder {

    /**
     * Load a Job from a JSON definition file
     *
     * @param $str_json_file
     * @throws \Exception
     * @return Job
     */
    public function fromJson($str_json_file)
    {
        if(!file_exists($str_json_file)) {
            throw new \Exception("Could not find file: {$str_json_file}");
        }
        $obj_json = json_decode(file_get_contents($str_json_file));
        if(!$obj_json) {
            throw new \Exception("Unable to load JSON from file: {$str_json_file}");
        }
        return $this->build($obj_json);
    }

    /**
     * @param \stdClass $obj_json
     * @return Job
     */
    private function build(\stdClass $obj_json)
    {
        // Basics
        foreach(['name', 'workload', 'sharder', 'worker', 'agg'] as $str_param) {
            if(!isset($obj_json->{$str_param})) {
                throw new InvalidArgumentException("Missing required configuration: {$str_param}");
            }
        }

        // Create & Configure Job
        return (new Job())
            ->setName($obj_json->name)
            ->setWorkload($this->buildWorkload($obj_json->workload))
            ->setSharder($this->buildSharder($obj_json->sharder))
            ->setWorker($this->buildWorker($obj_json->worker))
            ->setAggregator($this->buildAggregator($obj_json->agg))
        ;
    }

    private function buildWorkload($mix_workload)
    {
        return $this->createAndConfigure('\\Mapr\\Workload', $mix_workload);
    }


    private function buildSharder($mix_sharder)
    {
        return $this->createAndConfigure('\\Mapr\\Sharder', $mix_sharder);
    }

    private function buildWorker()
    {
        return new Worker(new Pipeline([new CallableStage(function($payload){
            $payload .= 'thing';
            return $payload;
        })]));
    }

    private function buildAggregator($mix_agg)
    {
        return $this->createAndConfigure('\\Mapr\\Aggregator', $mix_agg);
    }

    /**
     * Create a Job component (and optionally configure)
     *
     * @param $str_desired_class
     * @param $mix_workload
     * @return mixed
     * @throws \Exception
     */
    private function createAndConfigure($str_desired_class, $mix_workload)
    {
        if(is_string($mix_workload)) {
            return $this->createObject($mix_workload, $str_desired_class);
        }
        if(is_object($mix_workload)) {
            foreach($mix_workload as $str_class => $mix_config) {
                $obj_workload = $this->createObject($str_class, $str_desired_class);
                $obj_workload->configure($mix_config);
                return $obj_workload;
            }
        }
        throw new \Exception("Could not build [{$str_desired_class}] from config");
    }

    /**
     * Validate and create an object of the requested type
     *
     * @param $str_class_name
     * @param null $str_instance_of
     * @return mixed
     */
    private function createObject($str_class_name, $str_instance_of = null)
    {
        if(!class_exists($str_class_name)) {
            throw new \InvalidArgumentException("Not a loadable Class: [{$str_class_name}]");
        }
        if(null !== $str_instance_of) {
            if(!is_a($str_class_name, $str_instance_of, true)) {
                throw new \InvalidArgumentException("Not a valid {$str_instance_of}: [{$str_class_name}]");
            }
        }
        return new $str_class_name;
    }


}