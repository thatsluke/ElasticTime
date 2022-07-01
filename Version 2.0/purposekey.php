<?php
date_default_timezone_set('America/Chicago');
$dayweek=date("N");
$daypurpose = array(
    'Orient' => '1',
    'Clarify' => '2',
    'Align' => '3',
    'Progress' => '4',
    'Revise' => '5',
    'Repair' => '6',
    'Prepare' => '7',
);
$purposekey = array_search ("$dayweek", $daypurpose);
echo "<div style='border: 2px solid #333; background: #222; border-top: none; width: 300px; padding:5px; margin: 0px auto; margin-bottom: 20px; border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;'>$purposekey</div>";
?>