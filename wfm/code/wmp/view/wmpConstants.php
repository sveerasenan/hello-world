<?php
//$config = include_once(WMP_CONFIG_DIR .DS."config_" . ENVIRONMENT . ".php");

$config = include_once(__DIR__ ."/../../../../appconfigs/wmp/config_local.php");

//$config = include_once("/../../../appconfigs/wmp/config_local.php");


define("APP_PATH",$config["APP_PATH"]);
define("OIM_LOGIN_PAGE",$config["OIM_LOGIN_PAGE"]);
define("OIM_LOGOUT_PAGE",$config["OIM_LOGOUT_PAGE"]);
define("APP_RESOURCE_PATH",$config["APP_RESOURCE_PATH"]);
define("APP_PHOTOS_PATH",$config["APP_PHOTOS_PATH"]);
define("USE_SSO",$config["USE_SSO"]);
define("CEO_USER_NAME",$config["CEO_USER_NAME"]);
define("ADMIN_ROLE", "1");
define("EM_USER_ROLE", "2");
define("CEO_VIEW_USER_ROLE", "4");
define("STATUS_PAGE_LIMIT", "100");
define("CEO_EMP_ID", "3346");
define("EVACUATION_STATUS", "1");
define("ALL_CLEAR_STATUS", "2");
define("CLOSED_STATUS", "3");
define("UNAUTH_USR_ERR_MSG", "User access to this system is restricted. Please contact the system administrator for access.");
define("INVALID_USR_ERR_MSG", "You have entered an incorrect username and password combination. Try again. If you exceed 3 failed attempts,your account will be locked.");
