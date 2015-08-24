<?php
/**
 *
 * @author Tom Walder <tom@docnet.nu>
 */

namespace Mapr;

use Mapr\Provider\HasLogger;
use Psr\Log\LoggerAwareInterface;

abstract class Controller extends \Docnet\JAPI\Controller implements LoggerAwareInterface {

    use HasLogger;

}