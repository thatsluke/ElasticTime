<?php
$year = date("Y"); 
$lastyear = "$year" - 1; 
$pastdate = 12-31-$lastyear;
if( strtotime($pastdate) > strtotime('now') ) {
$thisyear = "$year";
} else {
$thisyear = $lastyear; 
}
$birthyear = 1947;
$birthmonth = 8;
$birthday = 21;
$birthdayAdj = $birthday - 1;
$date1=date_create("$birthyear-$birthmonth-$birthdayAdj");
$date2=new DateTime('now');
$date3=date_create("$thisyear-$birthmonth-$birthdayAdj");
$date4=date_create("$thisyear-$birthmonth-$birthdayAdj");
$dayweek=date("N");
$cycleCurrent=date("W");
$cycleWeek = $date3->format("W");
$diff=date_diff($date1,$date2);
$diff2=date_diff($date3,$date2);
$diff3=date_diff($date3,$date1);
$diff3b=date_diff($date4,$date1);
$diff4=date_diff($date2,$date4);
$diffFormat = $diff2->format(" %a");
$diffFormat1 = $diff4->format(" %a");
$diffFormat2 = $diff->format(" %a");
$diffFormat3 = $diff3->format(" %Y");
$diffFormat4 = $diff3b->format(" %Y");
if( strtotime($pastdate) < strtotime('now') ) {
$cycleAdj = $cycleCurrent - $cycleWeek;
$diffFormat = $diff2->format(" %a");
$yearlife = $diffFormat3 + 1;
} else {
$cycleAdj = $cycleCurrent + ($cycleWeek - $cycleCurrent) + 1;
$diffFormat = $diffFormat + ($diffFormat1 - $diffFormat) - 1;
$yearlife = $diffFormat4 + 1;
}
$cycles = $cycleAdj;
echo "chapter $cycles";
echo " / day $dayweek of 7<br>";
echo "day $diffFormat of ";
// echo $diff->format("year %Y");
echo "year $yearlife";
echo "<br> $diffFormat2 days of life";
// echo "<br>year $year<br>last year $lastyear";
?>