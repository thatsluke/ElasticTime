<?php
date_default_timezone_set('America/Chicago');
$dayweek=date("N");
$daypurpose = array(
    'Orient' => '1',
    'Clarify' => '2',
    'Align' => '3',
    'Progress' => '4',
    'Share' => '5',
    'Repair' => '6',
    'Prepare' => '7',
);
$purposekey = array_search ("$dayweek", $daypurpose);
echo "<div style='border-radius: 50%; border: 2px solid #111; background: #555; border-top: none; width: 300px; padding:10px; margin: 0px auto; margin-bottom: 15px; border-top-left-radius: 0px;border-top-right-radius: 0px;'>$purposekey</div>";
?>