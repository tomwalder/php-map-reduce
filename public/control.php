<?php
/**
 * Front controller
 */
use Auryn\Injector;
use Docnet\JAPI\SolidRouter;
use Monolog\Handler\SyslogHandler;

date_default_timezone_set('Europe/London');

define('APP_BASE_DIR', __DIR__ . '/..');
require(APP_BASE_DIR . '/vendor/autoload.php');

(new \Docnet\JAPI())->bootstrap(function () {

    // Set-up Di
    $obj_di = new Injector();

    // Memcached
    $obj_di->share('\\Memcached');

    // Logger
    $obj_di->share('\\Psr\\Log\\LoggerAwareInterface')->prepare('\\Psr\\Log\\LoggerAwareInterface',
        function (\Psr\Log\LoggerAwareInterface $obj_needs_logger) {
            $obj_psr_logger = new \Monolog\Logger('control');
            $obj_psr_logger->pushHandler(new SyslogHandler('main', LOG_USER));
            $obj_needs_logger->setLogger($obj_psr_logger);
        }
    );

    // Task Manager
    $obj_di->share('\\Mapr\\Async\\TaskManagerInterface');
    $obj_di->alias('\\Mapr\\Async\\TaskManagerInterface', '\\Mapr\\Async\\AppEngine\\TaskManager');

    // Route
    $str_controller = (new SolidRouter('\\Mapr\\Controller\\'))->route()->getController();

    // Make & return the controller
    return $obj_di->make($str_controller);

});
