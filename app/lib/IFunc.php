<?php

namespace app\lib;

class IFunc{
    public function checkPostValues($post_array){
		$data=array();
		foreach ($post_array as $key => $value){
			if(isset($_POST[$key])){
				$el=trim($_POST[$key]);
				if($el!=''){
					$data[$key]=$el;
				}
			}
		}
		return $data;
	}

	/**
	 * Retruns array() from array
	 * @param from array(), to array()
	 */
	public function copyPost($from, $post_array){
		foreach ($post_array as $key => $value){
			if(isset($from[$key])){
				$post_array[$key]=$from[$key];
			}
		}
		return $post_array;
	}

	/**
	 * Redirect to new link
	 * @param $string
	 */
	public function redirect($url){
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$url);
		exit();
	}

	/**
	 * Returns current datetime
	 * @return date()
	 */
	function currentTime(){
		return date("Y-m-d H:i:s");
	}

	/**
	 * Returns date time to new format
	 * @param date()
	 */
	function correctDateTime($dateTime)
	{
		$year=substr($dateTime, 0, 4);
		$month=substr($dateTime, 5, 2);
		$day=substr($dateTime, 8, 2);
		$monthes=array('01' => 'jan.', '02' => 'feb.', '03' => 'mar.', '04' => 'apr.', '05' => 'may', '06' => 'jun.', '07' => 'jul.', '08' => 'aug.', '09' => 'sep.', '10' => 'oct.', '11' => 'nov.', '12' => 'dec.');
		if($month!=0){
			$month=$monthes[$month];
		}
		$date=$day.' '.$month.' '.$year;
		$time=substr($dateTime, 11, 5);
		$result=$date; // .' on '.$time;
		return $result;
	}

	/**
	 * Returns date time to new format
	 * @param date()
	 */
	function correctDateTimeT($dateTime)
	{
		$year=substr($dateTime, 0, 4);
		$month=substr($dateTime, 5, 2);
		$day=substr($dateTime, 8, 2);
		$monthes=array('01' => 'jan.', '02' => 'feb.', '03' => 'mar.', '04' => 'apr.', '05' => 'may', '06' => 'jun.', '07' => 'jul.', '08' => 'aug.', '09' => 'sep.', '10' => 'oct.', '11' => 'nov.', '12' => 'dec.');
		if($month!=0){
			$month=$monthes[$month];
		}
		$date=$day.' '.$month.' '.$year;
		$time=substr($dateTime, 11, 5);
		$result=$date.' on '.$time; // 
		return $result;
	}

	/**
	 * Returns letters from cyrilic to latin
	 * @param $string
	 */
	function rusToLatin($string){

	    $string    = strip_tags(trim($string));
	    $string    = mb_strtolower($string, 'utf-8');
	    $string    = str_replace(' ', '-', $string);

	    $slug = preg_replace ('/[^a-z??-????????????????????????????0-9\-]/u', '-', $string);
	    $slug = preg_replace('/([-]+)/i', '-', $slug);
	    $slug = trim($slug, '-');

	    $ru_en = array(
	        '??'=>'a','??'=>'b','??'=>'v','??'=>'g','??'=>'d',
	        '??'=>'e','??'=>'yo','??'=>'zh','??'=>'z',
	        '??'=>'i','??'=>'i','??'=>'k','??'=>'l','??'=>'m',
	        '??'=>'n','??'=>'o','??'=>'p','??'=>'r','??'=>'s',
	        '??'=>'t','??'=>'u','??'=>'f','??'=>'h','??'=>'c',
	        '??'=>'ch','??'=>'sh','??'=>'sch','??'=>'','??'=>'y',
	        '??'=>'','??'=>'e','??'=>'yu','??'=>'ja',
	        "??"=>"k", "??"=>"h", "??"=>"j", "??"=>"i", "??"=>"u", "??"=>"g", 
	        "??"=>"k", "??"=>"h", "??"=>"j", "??"=>"i", "??"=>"u", "??"=>"g"
	    );

	    foreach($ru_en as $ru=>$en){
	        $slug = str_replace($ru, $en, $slug);
	    }

	    if (!$slug){ $slug = 'untitled'; }
	    
	    return $slug;

	}
}