<?php 
	ob_start();
	session_start();
	date_default_timezone_set('Asia/Kathmandu');


	if($_SERVER['SERVER_ADDR'] =='127.0.0.3' || $_SERVER['SERVER_ADDR']=='::3'){
	define('ENVIRONMENT','DEVELOPMENT');
	}else{
	define('ENVIRONMENT','PRODUCTION');
	}
	
if (ENVIRONMENT=='DEVELOPMENT'){
	error_reporting(E_ALL);
	define('DB_HOST','localhost');
	define('DB_NAME','techupd');
	define('DB_USER','root');
	define('DB_PASS','');
	define('SITE_URL','http://techupd.com/');
}else{
	error_reporting(0);
	define('DB_HOST','localhost');
	define('DB_NAME','techupd');
	define('DB_USER','root');
	define('DB_PASS','');
	define('SITE_URL','http://www.techupd.com/');
}
define('CONFIG_PATH', $_SERVER['DOCUMENT_ROOT'].'config/');
define('ERROR_PATH', $_SERVER['DOCUMENT_ROOT'].'error/');
define('CLASS_PATH', $_SERVER['DOCUMENT_ROOT'].'class/');
define('UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'].'upload/');
define('ALLOWED_EXTENSION', ['jpg','png','jpeg','tif']);
define('UPLOAD_URL', SITE_URL."upload/");


?>
