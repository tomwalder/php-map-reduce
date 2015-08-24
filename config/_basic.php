<?php
/**
 * "ALL" configuration
 *
 * @author Tom Walder <tom@docnet.nu>
 */
date_default_timezone_set('Europe/London');
define('IS_APP_ENGINE', (isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Google App Engine') !== FALSE));
define('APP_BASE_DIR', dirname(dirname(__FILE__)));
define('DATETIME_DISPLAY', 'jS M Y, H:i');
define('DATETIME_PRETTY', 'Y-m-d\TH:i:s\Z');

define('DATE_DISPLAY', 'jS M Y');
