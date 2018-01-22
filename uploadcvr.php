<?php
#$username = "vamshi_writer";
#$password = "team1";
#$hostname = "apple.heliohost.org:3306/"; 

#$day=substr(date("l"),0,3);
#$dt=date('d');

date_default_timezone_set('Asia/Calcutta');
$CurrDate=date('Y-m-d H:i:s');


$CurrPer = htmlentities($_GET['percentage']);
$id = htmlentities($_GET['id']);


if ($CurrPer > 100 )
{
    $CurrPer = 100;
}
if ($CurrPer < 0 )
{
    $CurrPer=0;
}
    $myfile = fopen($id.".txt","w");

    fwrite($myfile,$CurrPer."\n");
    fwrite($myfile,$CurrDate);
    fclose($myfile);

echo "Connection Successful</br>";
echo "successfully updated";



?>
