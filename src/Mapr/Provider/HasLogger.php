<?php

namespace Mapr\Provider;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

trait HasLogger
{
    /**
     * @var LoggerInterface
     */
    protected $obj_logger = null;

    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->obj_logger = $logger;
    }

    /**
     * Gets a logger.
     *
     * @return LoggerInterface
     */
    protected function getLogger()
    {
        if (null === $this->obj_logger) {
            $this->obj_logger = new NullLogger();
        }
        return $this->obj_logger;
    }
}