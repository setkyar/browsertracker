<?php 

namespace SetKyar\Tracker;

/**
 * 
 * 
 * @author Set Kyar Wa Lar <setkyar16@gmail.com>
*/
class Tracker
{
	/**
	 * undocumented function
	 *
	 * @return array
	 * @author Set Kyar Wa Lar <setkyar16@gmail.com>
	 **/
	public function getBrowserInfo()
	{
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

    	$bname 		= 'Unknown';
    	$platform 	= 'Unknown';
    	$Version 	= '';

    	die(var_dump($user_agent));

    	//First get the platform?
    	if (preg_match('/linux/i', $user_agent)) {
        	$platform = 'linux';
    	} elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
        	$platform = 'mac';
    	} elseif (preg_match('/windows|win32/i', $user_agent)) {
        	$platform = 'windows';
    	}
    
    	// Next get the name of the useragent yes seperately and for good reason
    	if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent)) 
    	{ 
        	$bname = 'Internet Explorer'; 
        	$ub = "MSIE"; 
    	} elseif(preg_match('/Firefox/i',$user_agent)) { 
        	$bname = 'Mozilla Firefox'; 
        	$ub = "Firefox"; 
    	} elseif(preg_match('/Chrome/i',$user_agent)) {
        	$bname = 'Google Chrome'; 
        	$ub = "Chrome"; 
    	} elseif(preg_match('/Safari/i',$user_agent)) { 
        	$bname = 'Apple Safari'; 
        	$ub = "Safari"; 
    	} elseif(preg_match('/Opera/i',$user_agent)) { 
        	$bname = 'Opera';
        	$ub = "Opera";
    	} elseif(preg_match('/Netscape/i',$user_agent)) {
        	$bname = 'Netscape'; 
        	$ub = "Netscape"; 
    	} 
    
    	// finally get the correct version number
    	$known = array('Version', $ub, 'other');
    	$pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    	
    	if (!preg_match_all($pattern, $user_agent, $matches)) {
        	// we have no matching number just continue
    	}
    
    	// see how many we have
    	$i = count($matches['browser']);

    	if ($i != 1) {
	        //we will have two since we are not using 'other' argument yet
	        //see if version is before or after the name
	        if (strripos($user_agent,"Version") < strripos($user_agent,$ub)){
	            $version= $matches['version'][0];
	        } else {
	            $version= $matches['version'][1];
	        }
    	} else {
        	$version= $matches['version'][0];
    	}
    
	    // check if we have a number
	    if ($version==null || $version=="") {$version="?";}
    
	    return array(
	        'userAgent' 	=> $user_agent,
	        'name'      	=> $bname,
	        'version'   	=> $version,
	        'platform'  	=> $platform,
	        'pattern'    	=> $pattern
	    );
	}
}