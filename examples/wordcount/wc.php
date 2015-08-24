<?php
/**
 * Example word count MapReduce
 */

date_default_timezone_set('Europe/London');

$str_autoload_file = __DIR__ . '/../../vendor/autoload.php';
if(!file_exists($str_autoload_file)) {
    say("Missing autoload file. Run composer?");
    exit(1);
}
require_once($str_autoload_file);

require_once(__DIR__ . '/classes/TextFile.php');
require_once(__DIR__ . '/classes/FileSplitter.php');
require_once(__DIR__ . '/classes/WordCounter.php');
require_once(__DIR__ . '/classes/Summer.php');

function say($str) { echo $str, PHP_EOL; }

// Load the Job from the JSON file supplied
$obj_builder = new \Mapr\JobBuilder();
$obj_job = $obj_builder->fromJson(__DIR__ . '/wordcount.json');



// @todo Instances are immutable?
$obj_instance = $obj_job->createInstance();

// @todo how to configure a configurable Workload / Sharder ?
// @todo new interface: RuntimeConfigurable / Instance Time config ?

$obj_instance->run();

// Temp output
print_r($obj_job);
