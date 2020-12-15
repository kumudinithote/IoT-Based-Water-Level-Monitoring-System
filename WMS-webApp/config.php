<?php
   define('DB_SERVER', 'xxxxx');    //enter server name ex:localhost
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');		//enter password if any else leave it blank
   define('DB_DATABASE', 'xxxxxx');	//Name of the databse
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
