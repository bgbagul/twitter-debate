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
        //usort($collectedTweets, "Timeline::sortByTime");
        return $collectedTweets;
    }

    // Makes a wrapper to search Twitter for a specific user's Tweets
    //static function getUserTimeline($user)
    //{
    //    $searchUrl = "http://api.twitter.com/1/statuses/user_timeline.json?&screen_name=";
    //    $searchUrl .= "$user";
    //    $searchUrl .= "&count=200";
    //
    //    // Tests that a URL works before getting contents
    //    // Will try 5 times before failing
    //    for ($i=0; $i<5; $i++)
    //    {
    //        if (Timeline::urlExists($searchUrl))
    //        {
    //            $searchString = file_get_contents($searchUrl);
    //            $jsonSearch = json_decode($searchString);
    //            usort($jsonSearch, "Timeline::sortByTime");
    //            return $jsonSearch;
    //        }
    //    }
    //    return FALSE;
    //}
    
    static function getUserTimeline($user)
    {
        $searchUrl = "http://api.twitter.com/1/statuses/user_timeline.json?&screen_name=";
        $searchUrl .= "$user";
        $searchUrl .= "&count=200";       

        // Tests that a URL works before getting contents
        for ($i=0; $i<10; $i++)
        {
            $errorCode = Timeline::urlExistsWithHTTPCode($searchUrl);
            if ($errorCode == 400)
            {
                echo "Rate limit exceeded on ";
                echo "user: " . $user;
                echo "<br>";
                return FALSE;
            }
            elseif ($errorCode == 408)
            {
                echo "Timeout on ";
                echo "user: " . $user;
                echo "<br>";
                continue;
            }
            elseif ($errorCode == 502)
            {
                echo "Bad Gateway on ";
                echo "user: " . $user;
                echo "<br>";
                continue;
            }
            elseif ($errorCode == 503)
            {
                echo "Service Temporarily Available on ";
                echo "user: " . $user;
                echo "<br>";
                continue;
            }  
            $searchString = file_get_contents($searchUrl);
            if ($searchString !== FALSE)
            {
                $jsonSearch = json_decode($searchString);
                echo "Successfully fetched ";
                echo "user: " . $user;
                echo " ";
                echo "Length: " . count($jsonSearch);
                echo "<br>";
                return $jsonSearch;
            }
        }
        return "An error has occurred";
    }

    static function urlExistsWithHTTPCode($url=NULL)
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

        return $httpcode;
        //if($httpcode>=200 && $httpcode<300)
        //{
        //    return true;
        //}
        //else
        //{
        //    return false;
        //}
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
    static function sortByScoreGenerate($a, $b)
    {
        $scoreA = Archive::scoreTweet($a);
        $scoreB = Archive::scoreTweet($b);
        
        if ($scoreA == $scoreB)
        {
            return 0;
        }
        elseif ($scoreA < $scoreB)
        {
            return 1;
        }
        else
        {
            return -1;
        }
    }
    static function sortByScoreRetrieve($a, $b)
    {
        $scoreA = $a->score;
        $scoreB = $b->score;
        
        if ($scoreA == $scoreB)
        {
            return 0;
        }
        elseif ($scoreA < $scoreB)
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
    //static function searchStringBold($str, $arr)
    //{
    //    $stringResult = $str;
    //
    //    foreach ($arr as &$searchTerm)
    //    {
    //        $searchResult = stripos($stringResult, $searchTerm);
    //        if ($searchResult !== false)
    //        {
    //            $stringResult = StringUtility::stringInsert("</B>", $stringResult, $searchResult + strlen($searchTerm));
    //            $stringResult = StringUtility::stringInsert("<B>", $stringResult, $searchResult);
    //            $buffer = $stringResult;
    //            $position = stripos($stringResult, "</B>")+4;
    //
    //            while (stripos(substr($buffer,$position), $searchTerm) !== false)
    //            {
    //                $searchResult = stripos(substr($stringResult,$position), $searchTerm);
    //                $stringResult = StringUtility::stringInsert("</B>", $stringResult,
    //                                                            $position + $searchResult + strlen($searchTerm));
    //                $stringResult = StringUtility::stringInsert("<B>", $stringResult, $position + $searchResult);
    //                $position += stripos(substr($stringResult,$position), "</B>")+4;
    //            }
    //        }
    //    }
    //    return $stringResult;
    //}
    
    static function searchStringBold($str, $arr)
    {
        $stringResult = $str;

        foreach ($arr as &$searchTerm)
        {
            $position = 0;
            $buffer = $stringResult;
            while (stripos(substr($buffer,$position), $searchTerm) !== false)
            {
                $searchResult = stripos(substr($stringResult,$position), $searchTerm);
                $stringResult = StringUtility::stringInsert("</B>", $stringResult,
                                                            $position + $searchResult + strlen($searchTerm));
                $stringResult = StringUtility::stringInsert("<B>", $stringResult, $position + $searchResult);
                $position += stripos(substr($stringResult,$position), "</B>")+4;
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
            $foreignpolicySave = array();
            
            $excludeArray = $excludeArray3; //no stop words
            
            $primeCandidateAccounts = $candidateAccounts;
            
                $results = Timeline::getMultiUserTimeline($primeCandidateAccounts);
            
                foreach($results as &$tweet)
                {
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray1))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray1);
                        $bufferTweet->numberOfKeywords=Archive::countKeywords($tweet->text,$searchArray1);
                        array_push($economySave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray2))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray2);
                        $bufferTweet->numberOfKeywords=Archive::countKeywords($tweet->text,$searchArray2);
                        array_push($immigrationSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray3))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray3);
                        $bufferTweet->numberOfKeywords=Archive::countKeywords($tweet->text,$searchArray3);
                        array_push($healthcareSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray4))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray4);
                        $bufferTweet->numberOfKeywords=Archive::countKeywords($tweet->text,$searchArray4);
                        array_push($socialSecuritySave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray5))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray5);
                        $bufferTweet->numberOfKeywords=Archive::countKeywords($tweet->text,$searchArray5);
                        array_push($jobsSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray6))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray6);
                        $bufferTweet->numberOfKeywords=Archive::countKeywords($tweet->text,$searchArray6);
                        array_push($taxesSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray7))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray7);
                        $bufferTweet->numberOfKeywords=Archive::countKeywords($tweet->text,$searchArray7);
                        array_push($deficitSave, clone $bufferTweet);
                    }
                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray8))
                    {
                        $bufferTweet=$tweet;
                        $bufferTweet->boldText=StringUtility::searchStringBold($tweet->text,$searchArray8);
                        $bufferTweet->numberOfKeywords=Archive::countKeywords($tweet->text,$searchArray8);
                        array_push($foreignpolicySave, clone $bufferTweet);
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
                $file = "tweets/" . Archive::getCandidateFolderName($candidateAccounts[0]) . "/foreignpolicy.json";
                file_put_contents($file, json_encode($foreignpolicySave));
                
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
        static function getCandidateProperNames ($account)
        {
            global $candidateProper1;
            global $candidateProper2;
            global $candidateProper3;
            global $candidateProper4;
            global $candidateProper5;
            global $candidateProper6;
            global $candidateProper7;
            global $candidateProper8;
            global $candidateProper9;
            global $candidateProper10;
            
            if ($account == "BarackObama")
            {
                return $candidateProper1;
            }
            elseif ($account == "THEHermanCain")
            {
                return $candidateProper2;
            }
            elseif ($account == "MittRomney")
            {
                return $candidateProper3;
            }
            elseif ($account == "RonPaul")
            {
                return $candidateProper4;
            }
            elseif ($account == "RickSantorum")
            {
                return $candidateProper5;
            }
            elseif ($account == "MicheleBachmann")
            {
                return $candidateProper6;
            }
            elseif ($account == "NewtGingrich")
            {
                return $candidateProper7;
            }
            elseif ($account == "GovGaryJohnson")
            {
                return $candidateProper8;
            }
            elseif ($account == "GovernorPerry")
            {
                return $candidateProper9;
            }
            elseif ($account == "JonHuntsman")
            {
                return $candidateProper10;
            }
        }
        static function getOtherNames ($candidate)
        {
            global $candidateAccounts1; //obama
            global $candidateAccounts2; //cain
            global $candidateAccounts3; //romney
            global $candidateAccounts4; //paul
            global $candidateAccounts5; //santorum
            global $candidateAccounts6; //bachmann
            global $candidateAccounts7; //gingrich
            global $candidateAccounts8; //johnson
            global $candidateAccounts9; //perry
            global $candidateAccounts10; //huntsman
            
            global $candidateProper1;
            global $candidateProper2;
            global $candidateProper3;
            global $candidateProper4;
            global $candidateProper5;
            global $candidateProper6;
            global $candidateProper7;
            global $candidateProper8;
            global $candidateProper9;
            global $candidateProper10;
            
            if ($candidate == "BarackObama")
            {
                return array_merge($candidateAccounts2, $candidateAccounts3, $candidateAccounts4, $candidateAccounts5,
                                   $candidateAccounts6, $candidateAccounts7, $candidateAccounts8, $candidateAccounts9,
                                   $candidateAccounts10, Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("GovernorPerry"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "THEHermanCain")
            {
                return array_merge($candidateAccounts3, $candidateAccounts4, $candidateAccounts5,
                                   $candidateAccounts6, $candidateAccounts7, $candidateAccounts8, $candidateAccounts9,
                                   $candidateAccounts10, 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("GovernorPerry"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "MittRomney")
            {
                return array_merge($candidateAccounts2, $candidateAccounts4, $candidateAccounts5,
                                   $candidateAccounts6, $candidateAccounts7, $candidateAccounts8, $candidateAccounts9,
                                   $candidateAccounts10, Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("GovernorPerry"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "RonPaul")
            {
                return array_merge($candidateAccounts2, $candidateAccounts3, $candidateAccounts5,
                                   $candidateAccounts6, $candidateAccounts7, $candidateAccounts8, $candidateAccounts9,
                                   $candidateAccounts10, Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("GovernorPerry"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "RickSantorum")
            {
                return array_merge($candidateAccounts2, $candidateAccounts3, $candidateAccounts4, 
                                   $candidateAccounts6, $candidateAccounts7, $candidateAccounts8, $candidateAccounts9,
                                   $candidateAccounts10, Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("GovernorPerry"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "MicheleBachmann")
            {
                return array_merge($candidateAccounts2, $candidateAccounts3, $candidateAccounts4, $candidateAccounts5,
                                   $candidateAccounts7, $candidateAccounts8, $candidateAccounts9,
                                   $candidateAccounts10, Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("GovernorPerry"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "NewtGingrich")
            {
                return array_merge($candidateAccounts2, $candidateAccounts3, $candidateAccounts4, $candidateAccounts5,
                                   $candidateAccounts6, $candidateAccounts8, $candidateAccounts9,
                                   $candidateAccounts10, Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("GovernorPerry"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "GovGaryJohnson")
            {
                return array_merge($candidateAccounts2, $candidateAccounts3, $candidateAccounts4, $candidateAccounts5,
                                   $candidateAccounts6, $candidateAccounts7, $candidateAccounts9,
                                   $candidateAccounts10, Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovernorPerry"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "GovernorPerry")
            {
                return array_merge($candidateAccounts2, $candidateAccounts3, $candidateAccounts4, $candidateAccounts5,
                                   $candidateAccounts6, $candidateAccounts7, $candidateAccounts8, 
                                   $candidateAccounts10, Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("JonHuntsman"));
            }
            elseif ($candidate == "JonHuntsman")
            {
                return array_merge($candidateAccounts2, $candidateAccounts3, $candidateAccounts4, $candidateAccounts5,
                                   $candidateAccounts6, $candidateAccounts7, $candidateAccounts8, $candidateAccounts9,
                                    Archive::getCandidateProperNames("THEHermanCain"), 
                                    Archive::getCandidateProperNames("MittRomney"), 
                                    Archive::getCandidateProperNames("RonPaul"), 
                                    Archive::getCandidateProperNames("RickSantorum"), 
                                    Archive::getCandidateProperNames("MicheleBachmann"), 
                                    Archive::getCandidateProperNames("NewtGingrich"), 
                                    Archive::getCandidateProperNames("GovGaryJohnson"), 
                                    Archive::getCandidateProperNames("GovernorPerry"));
            }
        }
        static function countKeywords ($tweet,$search)
        {
            $score = 0;
            foreach($search as &$term)
            {
                $score = $score + substr_count(strtolower($tweet), strtolower($term));
                //echo "I found " . $term . " this many times: " . substr_count($tweet, strtolower($term));
                //echo "<br>";
            }
            return $score;
        }
        static function getPresentKeywords($tweets,$search)
        {
            $collectingArray = array();
            foreach($tweets as &$quote)
            {
                    foreach($search as &$term)
                    {
                            if(in_array($term,$collectingArray) == FALSE)
                            {
                                    if(stripos($quote->text,$term) !== FALSE)
                                    {
                                            array_push($collectingArray,$term);
                                    }
                            }
                    }
            }
	return $collectingArray;
        }
        static function scoreTweet ($tweet)
        {
            global $user1Accounts;
            global $user2Accounts;
            global $twitterUser1;
            global $twitterUser2;
            global $isAUser1Tweet;
            global $isAUser2Tweet;
            global $opCandidateMentionCoef;
            global $keywordScoreCoefficient;
            global $notOpCandidateMentionCoef;
            
            $user1Names = array_merge($user1Accounts,Archive::getCandidateProperNames($twitterUser1));
            $user2Names = array_merge($user1Accounts,Archive::getCandidateProperNames($twitterUser2));
            $user1NOTOpponentNames = array_diff(Archive::getOtherNames($twitterUser1), $user2Names);
            $user2NOTOpponentNames = array_diff(Archive::getOtherNames($twitterUser2), $user1Names);
            
            $score = 0;
            $score = Archive::processRetweetCount($tweet);
            $score = $score + $keywordScoreCoefficient*$tweet->numberOfKeywords;
            
            if ($isAUser1Tweet==TRUE && $isAUser2Tweet==FALSE)
            {
                foreach($user2Names as &$term)
                {
                    $score = $score + $opCandidateMentionCoef*substr_count(strtolower($tweet->text), strtolower($term));
                }
                foreach($user1NOTOpponentNames as &$term)
                {
                    $score = $score + $notOpCandidateMentionCoef*substr_count(strtolower($tweet->text), strtolower($term));
                }
                //$tweet->boldText = StringUtility::searchStringBold($tweet->boldText,$user2Names);
            }
            elseif ($isAUser1Tweet==FALSE && $isAUser2Tweet==TRUE)
            {
                foreach($user1Names as &$term)
                {
                    $score = $score + $opCandidateMentionCoef*substr_count(strtolower($tweet->text), strtolower($term));
                }
                foreach($user2NOTOpponentNames as &$term)
                {
                    $score = $score + $notOpCandidateMentionCoef*substr_count(strtolower($tweet->text), strtolower($term));
                }
                //$tweet->boldText = StringUtility::searchStringBold($tweet->boldText,$user1Names);
            }
            
            $tweet->score = $score;
            return $score;
        }
        static function processRetweetCount ($tweet)
        {
            $retweet = 0;
            if ($tweet->retweet_count == "100+")
            {
                $retweet = 101;
            }
            else
            {
                $retweet = $tweet->retweet_count;
            }
            return $retweet;
        }
    }
?>
