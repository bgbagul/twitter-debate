<?php

    //Twitter Debate, v0.2
    //By Christopher Blair, Patrick McAuliffe, Balasaheb Bagul, Jane Janeczko, and Michael Madaus
    //EECS 338 Practicum in Intelligent Information Systems (Fall 2011)

class Timeline
{    
    // Returns all Tweets from an array of user names, for example: array("barackobama", "whitehouse");
    static function getMultiUserTimeline($arrayOfUsers)
    {
        $collectedTweets = array();
        foreach ($arrayOfUsers as &$individualUser)
        {
            $newTweets = Timeline::getUserTimeline($individualUser);
            if ($newTweets == FALSE)
            {
                print "An unknown erorr has occurred.";
                print "<br>";
            }
            else
            {
                foreach($newTweets as &$tweet)
                {
                    $tweet->name=$individualUser;
                    array_push($collectedTweets, $tweet);
                }
            }
        }
        usort($collectedTweets, "Timeline::sortByTime");
        return $collectedTweets;
    }
        
    // Makes a wrapper to search Twitter for a specific user's Tweets
    static function getUserTimeline($user)
    {
        $searchUrl = "http://api.twitter.com/1/statuses/user_timeline.json?&screen_name=";
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
                usort($jsonSearch, "Timeline::sortByTime");
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
    
    static function sortByTime($a, $b)
    {
        $timeA = strtotime($a->created_at);
        $timeB = strtotime($b->created_at);
        
        if ($timeA == $timeB)
        {
            return 0;
        }
        elseif ($timeA < $timeB)
        {
            return 1;
        }
        else
        {
            return -1;
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
        global $excludeArray;
        
        foreach ($excludeArray as &$searchTerm)
        {
            if (stripos($str, $searchTerm) !== FALSE)
            {
                return FALSE;
            }
        }
        
        foreach ($arr as &$searchTerm)
        {
            if (stripos($str, $searchTerm) !== FALSE)
            {
                return TRUE;
            }
        }
        return FALSE;
    }
    
    // Searches a string with an array of strings
    // It returns a string with words bolded that are in the array
    // Returns false otherwise
    static function searchStringBold($str, $arr)
    {
        $stringResult = $str;
        
        foreach ($arr as &$searchTerm)
        {
            $searchResult = stripos($stringResult, $searchTerm);
            if ($searchResult != false)
            {
                $stringResult = StringUtility::stringInsert("</B>", $stringResult, $searchResult + strlen($searchTerm));
                $stringResult = StringUtility::stringInsert("<B>", $stringResult, $searchResult);
                $buffer = $stringResult;
                $position = stripos($stringResult, "</B>")+4;
                
                while (stripos(substr($buffer,$position), $searchTerm) != false)
                {
                    $searchResult = stripos(substr($stringResult,$position), $searchTerm);
                    $stringResult = StringUtility::stringInsert("</B>", $stringResult,
                                                                $position + $searchResult + strlen($searchTerm));
                    $stringResult = StringUtility::stringInsert("<B>", $stringResult, $position + $searchResult);
                    $position += stripos(substr($stringResult,$position), "</B>")+4;
                }
            }
        }
        return $stringResult;
    }

    //From- http://forums.digitalpoint.com/showthread.php?t=182666
    // $insertstring - the string you want to insert
    // $intostring - the string you want to insert it into
    // $offset - the offset
    function stringInsert($insertstring, $intostring, $offset)
    {
        $part1 = substr($intostring, 0, $offset);
        $part2 = substr($intostring, $offset);
  
        $part1 = $part1 . $insertstring;
        $whole = $part1 . $part2;
        return $whole;
    }
}
?>
