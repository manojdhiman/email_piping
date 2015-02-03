#!/usr/bin/php -q
<?php
//Listen to incoming e-mails
//include email parser
require_once('parser/PlancakeEmailParser.php');


$sock = fopen ("php://stdin", 'r');
$email = '';

//Read e-mail into buffer
while (!feof($sock))
{
    $email .= fread($sock, 1024);
}

//Close socket
fclose($sock);
?>

<?php

   $emailParser = new PlancakeEmailParser($email);

$to 	 = $emailParser->getHeader('To');
$from 	 = $emailParser->getHeader('From');
$subject2 = $emailParser->getSubject();
$message = $emailParser->getBody();

   
	
	$con=mysql_connect('localhost','root','mysql@123'); 
 	$db=mysql_select_db('cronjob');
	$query="INSERT INTO tbl_piping (e_sub,e_body,e_date,e_sender) values('".$subject2."', '".$message."', '".date('d M,Y h:i:s')."', '".$from."')"; 
 	$res=mysql_query($query);
 	if(!$res) 
 	{
 		$to2 = "manoj@rudrainnovatives.com";
 		$subject = "Mysql error to insert the values to database";
 		$from="root@manojdhiman.com";		
 		
		$header = "MIME-Version: 1.0\r\n";
		$header .= "From: ".$from." \r\n";
		$header .= "Content-type: text/html\r\n";
		$msg="hey ! Admin i Got an error while you trying to insert the email content into the databse the error is <b>".mysql_error()."</b> and the query was<b>".$query."</b>";
 		$res = mail($to2,$subject,$msg,$header);
 	}
	
 
 
?> 
