<?php
$d = "12:00";
echo "创建日期是 " . date($d);
$d1 = date("H:i",mktime(12,0));
$d2 = date($d);
echo $d1==$d2;
?>
