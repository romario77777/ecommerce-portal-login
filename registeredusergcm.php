<?php  
include 'config.php';
$phonenumber = isset($_GET['phonenumber']) ? $_GET['phonenumber'] : '';
$gcm_regid = isset($_POST['gcm_regid']) ? $_POST['gcm_regid'] : '';

$res = mysql_query("SELECT ID FROM test.registered_user ru WHERE ru.gcm_registrationID = '$_POST[gcm_regid]'", $connect);

while($row = mysql_fetch_assoc($res))
       $rows[]=$row;
$num_rows = mysql_num_rows($res);	   


 if ($num_rows!=0) {
    mysql_query("UPDATE test.registered_user SET d_active=0 WHERE gcm_registrationID = '$gcm_regid'", $connect);
	$tID = mysql_query("SELECT ID FROM test.registered_user ru WHERE ru.gcm_registrationID = '$_POST[gcm_regid]'", $connect);
       while($eID = mysql_fetch_assoc($tID))
             $id[]=$eID;
       print(json_encode($id));
  }else{
    	mysql_query("Insert Into registered_user (gcm_registrationID, phone_number, device_timestamp, server_timestamp, d_active) values ('$_POST[gcm_regid]', SUBSTRING('$_POST[phonenumber]',-10), NOW(), NOW(), 1) ", $connect);
	$tID = mysql_query("SELECT ID FROM test.registered_user ru WHERE ru.gcm_registrationID = '$_POST[gcm_regid]'", $connect);
      while($eID = mysql_fetch_assoc($tID))
           $id[]=$eID;
      print(json_encode($id));
    }

mysql_close($connect);
?>
