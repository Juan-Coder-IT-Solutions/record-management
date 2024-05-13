<?php
/** Core Path **/
define("view","pages/");




/** Database connection **/

define("host","localhost");
define("username","root");
define("password","");
define("database","record_management_db");
/** Auth **/


define("table","tbl_users");
define("user_session_id","user_id");
define("passwordHashing",true);
define("error_message","Your Credentials did not matched");

/** Function / Classes **/

//inside dirso
define ("VALUE",serialize (array ("auth.php","my_functions.php")));
