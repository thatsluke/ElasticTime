<?php
date_default_timezone_set('America/Chicago');
$year = date("Y"); 
$lastyear = "$year" - 1; 
$thisyear = "$year";
$birthyear = 1981;
$birthmonth = 3;
$birthday = 19;
$birthweek = 11;
$birthdayAdj = $birthday - 1;
$date1=date_create("$birthyear-$birthmonth-$birthdayAdj");
$date2=new DateTime('now');
$date3=date_create("$thisyear-$birthmonth-$birthdayAdj");
$date4=date_create("$thisyear-01-01");
$date5=date_create("$thisyear-$birthmonth-$birthday");
$dayweek=date("N");
$diff=date_diff($date1,$date2);
$diff2=date_diff($date3,$date2);
$diff3=date_diff($date3,$date1);
$diff4=date_diff($date4,$date3);
$diff5=date_diff($date5,$date2);
$diffFormat = $diff2->format(" %a");
$diffFormat2 = $diff->format(" %a");
$diffFormat3 = $diff3->format(" %Y");
$diffFormat4 = $diff4->format(" %a");
$diffFormat5 = $diff5->format(" %a");
$yearDay = $diffFormat5;
$yearBirthDay = $diffFormat4;
$dayweek=date("N");
$cycleCurrent=date("W");
$cycleWeek = $date2->format("W");
$maxCycles = 52;
$maxDays = 365; // eventually should become days this year (so can self adjust for leap year)
if($date2 < $date5) {
$cycleAdj = ($maxCycles - $birthweek) + $cycleCurrent;
$yearDay = ($maxDays - $yearDay);
$yearlife = $diffFormat3;
} else {
$cycleAdj = ($cycleCurrent - $birthweek) + 1;
//$diffFormat = $diffFormat + ($diffFormat1 - $diffFormat) - 1;
//$diffFormat = $diff2->format(" %a");
$yearDay = $diffFormat;
$yearlife = $diffFormat3 + 1;
}
$cycles = $cycleAdj;
echo "<div style='padding: 10px; width: 200px; border-radius: 10px; margin: auto; background: #666;'><span style='display: inline-block; padding-bottom: 5px;font-weight: bold;'>chapter $cycles </span><br>";
// echo " / day $dayweek of 7";
echo "day $yearDay of ";
// echo $diff->format("year %Y");
echo "year $yearlife</div>";
echo "<br><br> <strong>$diffFormat2 days of life</strong>";
// echo "<br>year $year<br>last year $lastyear";
?>


