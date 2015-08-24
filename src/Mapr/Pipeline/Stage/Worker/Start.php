<?php
/**
 * @author Tom Walder <tom@docnet.nu>
 */
namespace Mapr\Pipeline\Stage\Worker;

use League\Pipeline\StageInterface;

class Start implements StageInterface {

    /**
     * Process the payload.
     *
     * @todo Register the Worker/Payload as "started"
     * @todo Use the provided meta data to obtain the MapReduce "Worker Payload"
     *
     * @param mixed $payload
     * @return mixed
     */
    public function process($payload)
    {

        $this->notify('job-instance-id', 'starting');

        // $payload is the META DATA

        $mapreduce_payload = null;

        return $mapreduce_payload;
    }

}