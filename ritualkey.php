<?php
date_default_timezone_set('America/Chicago');
$year = date("Y"); 
$lastyear = "$year" - 1; 
$thisyear = "$year";
$birthyear = 1981;
$birthmonth = 3;
$birthday = 19;
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
    'Partner Day (Yang) (7-4)' => '107',
	'Brothers Day (7-24)' => '127',
    'Rebirth Day (8-22)' => '156',
	'Reflection Day (12-22)' => '278',
	'Gratitude Day' => '279',
	'Sharing Day' => '280',	
	'Giving Day' => '281',	
	'New Earth Day (1-1)' => '288',
	'Partner Day (Yin) 1-3' => '290',
);
$ritualkey = array_search ($yearDay,$ritualday);
if ($ritualkey !== false) {
    echo "<div style='width: 200px; padding:10px; margin: 20px auto; border-radius: 5px; color: #777; background: #333'>$ritualkey</div>";
} else {
 echo "<div style='display: none;'>Day of Peace</div>";
}

?>