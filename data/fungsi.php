<?php 
function pagination_new($total, $page, $limit, $sorot, $link)
{
	echo '<ul class="pagination">';
	$jumData = $total;
	// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
	$jumPage = ceil($jumData/$limit);
	//menampilkan link << Previous
	if ($page > 1){
	echo'<li><a href="'.$_SERVER['PHP_SELF'].''.$link.''.($page-1).''.$sorot.'" aria-label="Next">&laquo;</a></li>';
	}
	//menampilkan urutan paging
	for($i = 1; $i <= $jumPage; $i++){
	//mengurutkan agar yang tampil i+3 dan i-3
		if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $jumPage)){
			if($i==$jumPage && $page <= $jumPage-5) echo '<li class="disabled"><span><span aria-hidden="true">...</span></span></li>';
				if ($i == $page) echo ' <li class="active"><a href="'.$sorot.'">'.$i.'</a></li> ';
				else echo ' <li><a href="'.$_SERVER['PHP_SELF'].''.$link.''.$i.''.$sorot.'">'.$i.'</a></li> ';
				if($i==1 && $page >= 6) echo '<li class="disabled"><span><span aria-hidden="true">...</span></span></li>';
		}
	}
	//menampilkan link Next >>
	if ($page < $jumPage){
	echo '<li><a href="'.$_SERVER['PHP_SELF'].''.$link.''.($page+1).''.$sorot.'" aria-label="Next">&raquo;</a></li>';
	}
	echo '</ul>';
}
function jenis_kelamin($data){
	if($data == "l")
		$data = "Laki-Laki";
	else
		$data = "Perempuan";
	return $data;
}

function potong_kata($kata, $batas){
	if(strlen($kata) > $batas){
		$kata = substr($kata, 0, $batas).'...';
	}else{
		$kata = substr($kata, 0, $batas);
	}
	return $kata;
}

function anti_injection($data){

$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
$filter = mysql_real_escape_string($filter);

return $filter;

}

// DISPLAYS COMMENT POST TIME AS "1 year, 1 week ago" or "5 minutes, 7 seconds ago", etc...
function time_ago($date,$granularity=2) {
    $date = strtotime($date);
    $difference = time() - $date;
    $periods = array('decade' => 315360000,
        'year' => 31536000,
        'month' => 2628000,
        'week' => 604800, 
        'day' => 86400,
        'hour' => 3600,
        'minute' => 60,
        'second' => 1);

    foreach ($periods as $key => $value) {
        if ($difference >= $value) {
            $time = floor($difference/$value);
            $difference %= $value;
            $retval .= ($retval ? ' ' : '').$time.' ';
            $retval .= (($time > 1) ? $key.'s' : $key);
            $granularity--;
        }
        if ($granularity == '0') { break; }
    }
    return ' posted '.$retval.' ago';      
}

function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
 
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
 
    $now             = time();
    $unix_date         = strtotime($date);
 
       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }
 
    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
 
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
 
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
 
    $difference = round($difference);
 
    if($difference != 1) {
        $periods[$j].= "s";
    }
 
    return "$difference $periods[$j] {$tense}";
}

function madSafety($string) {
$string = stripslashes($string);
$string = strip_tags($string);
$string = mysql_real_escape_string($string);
return $string;
} 
?>