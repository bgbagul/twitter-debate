<?php

    //Twitter Debate, v0.0
    //By Christopher Blair, Patrick McAuliffe, Balasaheb Bagul, Jane Janeczko, and Michael Madaus
    //EECS 338 Practicum in Intelligent Information Systems (Fall 2011)

class Timeline
{
    // Makes a wrapper to search Twitter for a specific user's Tweets
    static function getUserTimeline($user)
    {
        $searchUrl = "https://api.twitter.com/1/statuses/user_timeline.json?&screen_name=";
        $searchUrl .= "$user";
        $searchUrl .= "&count=200";
        
        // Tests that a URL works before getting contents
        // Will try 5 times before failing
        for ($i=0; $i<5; $i++)
        {
            if (Timeline::urlExists($searchUrl))
            {
                $searchString = file_get_contents($searchUrl);
                $jsonSearch = json_decode($searchString);
                return $jsonSearch;
            }
        }
        return FALSE;
    }
    
    // Tests the existence of a URL
    // From: http://stackoverflow.com/questions/1239068/ping-site-and-return-result-in-php
    static function urlExists($url=NULL)  
    {  
        if($url == NULL)
        {
            return false;
        }
        
        $ch = curl_init($url);  
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = curl_exec($ch);  
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
        curl_close($ch);
        
        if($httpcode>=200 && $httpcode<300)
        {  
            return true;  
        }
        else
        {  
            return false;  
        }  
    }
}

class StringUtility
{
    // Searches a string with an array of strings
    // It returns true of any item in the array is in the string
    // Returns false otherwise
    static function searchStringWithArray($str, $arr)
    {
        while($searchTerm = next($arr))
        {
            if (stristr($str, $searchTerm))
            {
                //echo "<br><b>";
                //echo $searchTerm;
                //echo "<br></b>";
                return TRUE;
            }
        }
        return FALSE;
    }
}
?>