<?php
include_once dirname(__FILE__) . '/vendor/phpmailer/class.phpmailer.php';
include_once dirname(__FILE__) . '/vendor/phpmailer/class.pop3.php';
include_once dirname(__FILE__) . '/vendor/phpmailer/class.smtp.php';
set_include_path(get_include_path() . PATH_SEPARATOR . "/vendor/dompdf/");
include_once dirname(__FILE__) . '/vendor/dompdf/dompdf_config.inc.php';