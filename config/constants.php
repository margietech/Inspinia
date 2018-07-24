<?php
defined("BASEPATH") OR exit("No direct script access allowed");

//$isLocal = true;
define("CON_DS","/");
define("CON_PROTOCOL",empty($_SERVER["HTTPS"]) ? "http" : "https");
define("CON_SERVER_URL", CON_PROTOCOL."://".$_SERVER["SERVER_NAME"]);

//if($isLocal) {
define("CON_APP_NAME","ci_template");
define("CON_DATABASE_HOSTNAME", "localhost");
define("CON_DATABASE_USERNAME", "root");
define("CON_DATABASE_PASSWORD", "a");
define("CON_DATABASE_NAME", "ci_task");
// }
// else {
// define("CON_APP_NAME","app");
// define("CON_DATABASE_HOSTNAME", "jibudo-dev.colvxjedb8oy.ap-south-1.rds.amazonaws.com");
// define("CON_DATABASE_USERNAME", "jibud0devel0p");
// define("CON_DATABASE_PASSWORD", "j43b$%67#$%d0el0p");
// define("CON_DATABASE_NAME", "jibudodev");
// }

// define("CON_ENCRYPTION_KEY","865465JRKJDNF84545KEJRKJFJDH44"); 

define("CON_ASSETS_DIR","assets");
define("CON_UPLOADS_DIR","uploads");

define("CON_APP_URL", CON_SERVER_URL.CON_DS.CON_APP_NAME.CON_DS);
define("CON_UPLOADS_URL",CON_APP_URL.CON_UPLOADS_DIR.CON_DS);

define("CON_APP_PATH",FCPATH);
define("CON_UPLOADS_PATH",CON_APP_PATH.CON_UPLOADS_DIR.CON_DS);

define("CON_ROLE_MANAGER",1);
define("CON_ROLE_EMPLOYEE",2);
define("CON_ROLE_CEO",3);

define("CON_EMAIL_ONE","girishd.etechmavens@gmail.com");
define("CON_EMAIL_TWO","manojg.etechmavens@gmail.com");

define("CON_LIMIT_PER_PAGE",10);

define("CON_DB_DATETIME_FORMAT","Y-m-d H:i:s");
define("CON_DB_DATE_FORMAT","Y-m-d");
define("CON_DB_TIME_FORMAT","H:i:s");

define("CON_PARAM_FLAG","flag");
define("CON_PARAM_MESSAGE","message");
define("CON_PARAM_DATA","data");
define("CON_FLAG_SUCCESS","1");
define("CON_FLAG_FAIL","0");

define("CON_OTP_EXPIRE_MINUTES",60);// min

define('CON_S3_BUCKET_NAME','uploads');
define('CON_S3_BUCKET_URL','http://s3.amazonaws.com/'.CON_S3_BUCKET_NAME.CON_DS);

define('CON_COMPLAIN_RADIUS',100); //km

define("FORCE_UPDATE_APP_IOS","no");
define("IOS_APP_VERSION","0.5");
define("IOS_URL","https://itunes.apple.com/in/app/onjyb/id1149333186?mt=8");

define("FORCE_UPDATE_APP_ANDROID","no");
define("ANDROID_APP_VERSION","1.0");
define("ANDROID_URL","https://play.google.com/store/apps/details?id=com.onjyb");

