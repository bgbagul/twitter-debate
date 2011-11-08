<?php

//    ini_set( "display_errors", 0);

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
                print "An error has occurred while processing this account:";
                print "<br>";
                print $individualUser;
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
        //global $excludeArray;
        //
        //foreach ($excludeArray as &$searchTerm)
        //{
        //    if (stripos($str, $searchTerm) !== FALSE)
        //    {
        //        return FALSE;
        //    }
        //}

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
            if ($searchResult !== false)
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
    static function stringInsert($insertstring, $intostring, $offset)
    {
        $part1 = substr($intostring, 0, $offset);
        $part2 = substr($intostring, $offset);

        $part1 = $part1 . $insertstring;
        $whole = $part1 . $part2;
        return $whole;
    }
}

class Archive
    {
        static function buildEntireArchive ()
        {
            global $candidateAccounts1;
            global $candidateAccounts2;
            global $candidateAccounts3;
            global $candidateAccounts4;
            global $candidateAccounts5;
            global $candidateAccounts6;
            global $candidateAccounts7;
            global $candidateAccounts8;
            global $candidateAccounts9;
            global $candidateAccounts10;
            
            echo "Building archive... this may take up to 15 minutes.<br>";
            Archive::buildCandidateArchive($candidateAccounts1);
            Archive::buildCandidateArchive($candidateAccounts2);
            Archive::buildCandidateArchive($candidateAccounts3);
            Archive::buildCandidateArchive($candidateAccounts4);
            Archive::buildCandidateArchive($candidateAccounts5);
            Archive::buildCandidateArchive($candidateAccounts6);
            Archive::buildCandidateArchive($candidateAccounts7);
            Archive::buildCandidateArchive($candidateAccounts8);
            Archive::buildCandidateArchive($candidateAccounts9);
            Archive::buildCandidateArchive($candidateAccounts10);
        }
        
        static function buildCandidateArchive ($candidateAccounts)
        {
            global $excludeArray;
            global $excludeArray2;
            global $excludeArray3;
            global $searchArray1;
            global $searchArray2;
            global $searchArray3;
            global $searchArray4;
            global $searchArray5;
            global $searchArray6;
            global $searchArray7;
            global $searchArray8;
            
            $economySave = array();
            $immigrationSave = array();
            $healthcareSave = array();
            $socialSecuritySave = array();
            
            $jobsSave = array();
            $taxesSave = array();
            $deficitSave = array();
            $environmentSave = array();
            
            $excludeArray = $excludeArray3; //no stop words
            
            $primeCandidateAccounts = $candidateAccounts;
            
                $results = Timeline::getMultiUserTimeline($primeCandidateAccounts);
            
                foreach($results as &$tweet)
                {
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray1))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray1);
                        array_push($economySave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray2))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray2);
                        array_push($immigrationSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray3))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray3);
                        array_push($healthcareSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray4))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray4);
                        array_push($socialSecuritySave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray5))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray5);
                        array_push($jobsSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray6))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray6);
                        array_push($taxesSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray7))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray7);
                        array_push($deficitSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray8))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray8);
                        array_push($environmentSave, clone $bufferTweet);
                    }
                }
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/economy.json";
                file_put_contents($file, json_encode($economySave));
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/immigration.json";
                file_put_contents($file, json_encode($immigrationSave));
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/healthcare.json";
                file_put_contents($file, json_encode($healthcareSave));
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/socialsecurity.json";
                file_put_contents($file, json_encode($socialSecuritySave));
                
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/jobs.json";
                file_put_contents($file, json_encode($jobsSave));
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/taxes.json";
                file_put_contents($file, json_encode($taxesSave));
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/deficit.json";
                file_put_contents($file, json_encode($deficitSave));
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/environment.json";
                file_put_contents($file, json_encode($environmentSave));
                
                return TRUE;
        }
        static function getCandidateFolderName ($account)
        {
            if ($account == "BarackObama")
            {
                return "obama";
            }
            elseif ($account == "THEHermanCain")
            {
                return "cain";
            }
            elseif ($account == "MittRomney")
            {
                return "romney";
            }
            elseif ($account == "RonPaul")
            {
                return "paul";
            }
            elseif ($account == "RickSantorum")
            {
                return "santorum";
            }
            elseif ($account == "MicheleBachmann")
            {
                return "bachmann";
            }
            elseif ($account == "NewtGingrich")
            {
                return "gingrich";
            }
            elseif ($account == "GovGaryJohnson")
            {
                return "johnson";
            }
            elseif ($account == "GovernorPerry")
            {
                return "perry";
            }
            elseif ($account == "JonHuntsman")
            {
                return "huntsman";
            }
        }
    }
?>
