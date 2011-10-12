<?php

    //Twitter Debate, v0.0
    //By Christopher Blair, Patrick McAuliffe, Balasaheb Bagul, Jane Janeczko, and Michael Madaus
    //EECS 338 Practicum in Intelligent Information Systems (Fall 2011)

class Timeline
{
    // Makes a wrapper to search Twitter for a specific user's Tweets
    static function getUserTimeline($user) {
        $searchUrl .= "https://api.twitter.com/1/statuses/user_timeline.json?&screen_name=";
        $searchUrl .= "$user";
        $searchUrl .= "&count=200";
        $searchString = file_get_contents($searchUrl);
        $jsonSearch = json_decode($searchString);
        return $jsonSearch;
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