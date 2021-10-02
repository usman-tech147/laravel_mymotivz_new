<?php
function get_date_diff($time1, $time2=null, $precision = 2)
{
    if(!$time2){
        $time2=date('Y-m-d H:i:s');
    }
    // If not numeric then convert timestamps
    if (!is_int($time1)) {
        $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
        $time2 = strtotime($time2);
    }

    // If time1 > time2 then swap the 2 values
    if ($time1 > $time2) {
        list($time1, $time2) = array($time2, $time1);
    }

    // Set up intervals and diffs arrays
    $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
    $diffs = array();

    foreach ($intervals as $interval) {
        // Create temp time from time1 and interval
        $ttime = strtotime('+1 ' . $interval, $time1);
        // Set initial values
        $add = 1;
        $looped = 0;
        // Loop until temp time is smaller than time2
        while ($time2 >= $ttime) {
            // Create new temp time from time1 and interval
            $add++;
            $ttime = strtotime("+" . $add . " " . $interval, $time1);
            $looped++;
        }

        $time1 = strtotime("+" . $looped . " " . $interval, $time1);
        $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();
    foreach ($diffs as $interval => $value) {
        // Break if we have needed precission
        if ($count >= $precision) {
            break;
        }
        // Add value and interval if value is bigger than 0
        if ($value > 0) {
            if ($value != 1) {
                $interval .= "s";
            }
            // Add value and interval to times array
            $times[] = $value . " " . $interval;
            $count++;
        }
    }

    // Return string with times
    return implode(", ", $times) . ' ago';
}

function getHumanDate($date)
{
    $startTime = \Carbon\Carbon::parse($date);
    $endTime = \Carbon\Carbon::parse(\Carbon\Carbon::now());
    $totalDuration = $endTime->diff($startTime);
    if ($totalDuration->y > 0) {
        if ($totalDuration->y > 1) {
            $duration = $totalDuration->y . " years ago";
        } else {
            $duration = $totalDuration->y . " year ago";
        }
    } else if ($totalDuration->m > 0) {
        if ($totalDuration->m > 1) {
            $duration = $totalDuration->m . " months ago";
        } else {
            $duration = $totalDuration->m . " month ago";
        }
    } else if ($totalDuration->d > 0) {
        if ($totalDuration->d > 1) {
            $duration = $totalDuration->d . " days ago";
        } else {
            $duration = $totalDuration->d . " day ago";
        }
    } else if ($totalDuration->h > 0) {
        if ($totalDuration->h > 1) {
            $duration = $totalDuration->h . " hours ago";
        } else {
            $duration = $totalDuration->h . " hour ago";
        }
    } else if ($totalDuration->i > 0) {
        if ($totalDuration->i > 1) {
            $duration = $totalDuration->i . " minutes ago";
        } else {
            $duration = $totalDuration->i . " minute ago";
        }
    } else {
        $duration = "just now";
    }
    return $duration;
}

function clean($str)
{
    $str = utf8_decode($str);
    $str = str_replace("&nbsp;", " ", $str);
    $str = preg_replace('/\s+/', ' ', $str);
    $str = trim($str);
    return $str;
}

function dateFormat($date){
    $d = new \Carbon\Carbon($date);
    return $d->format('m/d/Y');
}

function checkValue($object){
    if($object){
        return $object;
    }
    return 'N/A';
}

function packageFormat($package, $package_to, $sign, $type){
    if($package && !empty($package)){
        if($package_to && !empty($package_to)){
            return $sign . '' . $package . '-' . ''.$sign . '' . $package_to . ' / ' . $type;
        }
        return $sign . '' . $package . ' / ' . $type;
    }
    return 'N/A';
}
