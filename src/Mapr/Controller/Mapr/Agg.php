<?php

namespace Mapr\Controller\Mapr;

class Agg extends \Mapr\Controller
{

    /**
     * Main
     */
    public function dispatch()
    {
        $this->getLogger()->warning("Agg triggered for ?");
    }

}