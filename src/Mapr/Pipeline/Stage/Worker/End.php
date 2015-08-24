<?php
/**
 * @author Tom Walder <tom@docnet.nu>
 */
namespace Mapr\Pipeline\Stage\Worker;

use League\Pipeline\StageInterface;

class End implements StageInterface {

    /**
     * Process the payload.
     *
     * @todo Register the Worker/Payload as "complete"
     *
     * @param mixed $payload
     * @return mixed
     */
    public function process($payload)
    {
        return $payload;
    }

}