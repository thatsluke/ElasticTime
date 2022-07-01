<?php
date_default_timezone_set('America/Chicago');
$year = date("Y"); 
$lastyear = "$year" - 1; 
$thisyear = "$year";
$birthyear = 1947;
$birthmonth = 8;
$birthday = 21;
$birthdayAdj = $birthday - 1;
$date1=date_create("$birthyear-$birthmonth-$birthdayAdj");
$date2=new DateTime('now');
$date3=date_create("$thisyear-$birthmonth-$birthdayAdj");
$dayweek=date("N");
$diff=date_diff($date1,$date2);
$diff2=date_diff($date3,$date2);
$diffFormat = $diff2->format(" %a");
$yearDay = $diffFormat;
$dayweek=date("N");
$ritualday = array(
    'Ancestors Day' => '363',
    'Fathers Day' => '364',
    'Mothers Day' => '365',
    'New Year Day' => '1',
    'Retrospection Day' => '2',
    'Introspection Day' => '3',
    'Projection Day' => '4',
);
$ritualkey = array_search ("$yearDay", $ritualday);
if ($ritualkey !== false) {
    echo "<div style='border: 2px solid #333; width: 200px; background:#222; padding:5px; margin: 10px auto; border-radius: 5px; color: #ccc;'>$ritualkey</div>";
} else {
// echo "<div style='border: 2px solid #333; width: 200px; background:#222; padding:5px; margin: 10px auto; border-radius: 5px; color: #ccc;'>Day of Peace</div>";
}

?>