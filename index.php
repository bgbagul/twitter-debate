<!--
    Twitter Debate, v0.2
    By Christopher Blair, Patrick McAuliffe, Balasaheb Bagul, Jane Janeczko, and Michael Madaus
    EECS 338 Practicum in Intelligent Information Systems (Fall 2011)
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <title>Twitter Debate</title>
        <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    </head>

    <body>

        <?php
            $onlyGetOneAccount = true;
            require "tDebate.php";
            require "terms.php";
            require "display.php";
            date_default_timezone_set('America/Chicago');

            function showOptionsDrop ($array, $active, $echo=true) {
                $string = '';

                foreach($array as $k => $v) {

                    $s = ($active == $k)? ' selected="selected"' : '';
                    $string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";
                }

                if ($echo) {
                    echo $string;

                } else {
                    return $string;
                }
            }

            if (!empty($_GET['topic'])) {

                $twitterTopic = $_GET['topic'];
                $twitterUser1 = $_GET['user1'];
                $twitterUser2 = $_GET['user2'];



                if ($twitterTopic === "economy") {
                    $searchArray = $searchArray1;

                } else if ($twitterTopic === "immigration") {
                    $searchArray = $searchArray2;

                } else if ($twitterTopic === "healthcare") {
                    $searchArray = $searchArray3;

                } else if ($twitterTopic === "socialsecurity") {
                    $searchArray = $searchArray4;

                } else if ($twitterTopic == "jobs") {
                    $searchArray = $searchArray5;

                } else if ($twitterTopic== "taxes") {
                    $searchArray = $searchArray6;

                } else if ($twitterTopic == "deficit") {
                    $searchArray = $searchArray7;
                } else if ($twitterTopic == "foreignpolicy") {
                    $searchArray = $searchArray8;
                }

            } else {
                $twitterTopic = "economy";
                $twitterUser1 = "MittRomney";
                $twitterUser2 = "BarackObama";
                $searchArray = $searchArray1;
            }

        ?>
        <!--
        <div class="titleImgContainer">
            <img class="titleImg" src="images/TitleBarackObama.jpg" alt="Barack Obama"/>
            <img class="titleImg" src="images/TitleHermanCain.jpg" alt="Herman Cain"/>
            <img class="titleImg" src="images/TitleMittRomney.jpg" alt="Mitt Romney"/>
            <img class="titleImg" src="images/TitleRonPaul.jpg" alt="Ron Paul"/>
            <img class="titleImg" src="images/TitleRickSantorum.jpg" alt="Rick Santorum"/>
            <img class="titleImg" src="images/TitleMichelleBachmann.jpg" alt="Michelle Bachmann"/>
            <img class="titleImg" src="images/TitleNewtGingrich.jpg" alt="Newt Gingrich"/>
            <img class="titleImg" src="images/TitleGaryJohnson.jpg" alt="Gary Johnson"/>
            <img class="titleImg" src="images/TitleRickPerry.jpg" alt="Rick Perry"/>
            <img class="titleImg" src="images/TitleJonHuntsman.jpg" alt="Jon Huntsman"/>
        </div>
        -->

        <div class="container">

            <div class="choiceContainer">

                <span class="titleElement">
                <br><br><br>
                    <select id="twitterAccounts1" name="twitterAccounts1[]" style="font-size:25px; color:Grey;"
                        onchange='topicChanged(document.getElementById("twitterTopics").value, this.value,
                            document.getElementById("twitterAccounts2").value)'>
                        <?php showOptionsDrop($twitterAccounts1, null, true); ?>
                    </select>

                    <div style="line-height:125%; color:black; text-align:center;">
                        <?php
                            Display::candidateTwitterAccounts($twitterUser1);
                        ?>
                    </div>

                </span>

                <span class="titleElement">
                    <div style="height:60px">
                        <font size="35px" color="white">twitter</font>
                        <font size="35px" color="black">debate</font>
                    </div>

                    <div style="line-height:125%; color:black; text-align:center;">
                    <div class="titleImgContainer">
                        <?php
                            Display::candidateTitleImage($twitterUser1);
                            echo '<font size="35px" color="black"> vs </font>';
                            Display::candidateTitleImage($twitterUser2);
                        ?>
                    </div>
                    </div>
                    
                    <span style="font-size:35px; color:white;">
                        on
                    </span>

                    <select id="twitterTopics" name="twitterTopics[]" style="font-size:25px; color:Grey;"
                        onchange='topicChanged(this.value, document.getElementById("twitterAccounts1").value,
                            document.getElementById("twitterAccounts2").value)'>
                        <?php showOptionsDrop($twitterTopics, null, true); ?>
                    </select>
                </span>

                <span class="titleElement">
                <br><br><br>
                    <select id="twitterAccounts2" name="twitterAccounts2[]" style="font-size:25px; color:Grey;"
                        onchange='topicChanged(document.getElementById("twitterTopics").value, document.getElementById("twitterAccounts1").value,
                            this.value)'>
                        <?php showOptionsDrop($twitterAccounts2, null, true); ?>
                    </select>

                    <div style="line-height:125%; color:black; text-align:center;">
                        <?php
                            Display::candidateTwitterAccounts($twitterUser2);
                        ?>
                    </div>

                </span>

            </div>

            <div class="tweetsContainer">

                <table>
                    <tr>

                    <?php

                        print "<tr style='height:20px;'></tr>";

                        $isAUser1Tweet = FALSE;
                        $isAUser2Tweet = FALSE;
                        $foundAStopWord = FALSE;
                        $leftWentLast = TRUE;
                        $counter = 0;
                        $user1Accounts = User::getAccounts($twitterUser1);
                        $user2Accounts = User::getAccounts($twitterUser2);
                        $allUserAccounts = array_merge($user1Accounts, $user2Accounts);

                        $results1 = json_decode(file_get_contents("tweets/" . Archive::getCandidateFolderName($twitterUser1) . "/" . $twitterTopic . ".json"));
                        $results2 = json_decode(file_get_contents("tweets/" . Archive::getCandidateFolderName($twitterUser2) . "/" . $twitterTopic . ".json"));

                        $isAUser1Tweet=TRUE;
                        $isAUser2Tweet=FALSE;
                        usort($results1, "Timeline::sortByScoreGenerate");
                        $isAUser1Tweet=FALSE;
                        $isAUser2Tweet=TRUE;
                        usort($results2, "Timeline::sortByScoreGenerate");
                        $isAUser1Tweet=FALSE;
                        $isAUser2Tweet=FALSE;

                        $user1Names = array_merge($user1Accounts,Archive::getCandidateProperNames($twitterUser1));
                        $user2Names = array_merge($user2Accounts,Archive::getCandidateProperNames($twitterUser2));
                        $user1NOTOpponentNames = array_diff(Archive::getOtherNames($twitterUser1), $user2Names);
                        $user2NOTOpponentNames = array_diff(Archive::getOtherNames($twitterUser2), $user1Names);

                        $excludeArray = $excludeArray2;

                        if (empty($_GET['more'])) {
                            $newLeftArr = array();
                            $newRightArr = array();
                            $results = Array();
                            $cntLeftTweets = 0;
                            $cntRightTweets = 0;

                            foreach ($results1 as $tweet) {
                                $foundAsStopWord = StringUtility::searchStringWithArray($tweet->text,$excludeArray);
                                if (!$foundAsStopWord) {
                                    array_push($newLeftArr, $tweet);
                                    $cntLeftTweets++;
                                    if ($cntLeftTweets >= 10) {
                                        break;
                                    }
                                }
                            }

                            foreach ($results2 as $tweet) {
                                $foundAStopWord = StringUtility::searchStringWithArray($tweet->text,$excludeArray);
                                if (!$foundAsStopWord) {
                                    array_push($newRightArr, $tweet);
                                    $cntRightTweets++;
                                    if ($cntRightTweets >= 10) {
                                        break;
                                    }
                                }
                            }
                            $leftPresentKeywords = Archive::getPresentKeywords($newLeftArr,$searchArray);
                            $rightPresentKeywords = Archive::getPresentKeywords($newRightArr,$searchArray);
                            $usePresentKeywords = array();
                            if(count($leftPresentKeywords) > count($rightPresentKeywords))
                            {
                                $usePresentKeywords = $rightPresentKeywords;
                            }
                            else
                            {
                                $usePresentKeywords = $leftPresentKeywords;
                            }
                            //print "<br><b>";
                            //print "Intersection: ";
                            //foreach ($usePresentKeywords as &$term)
                            //{
                            //    print $term . ", ";
                            //}
                            //print "<b>";
                            //print_r($usePresentKeywords);

                            $oldLeftArr = $newLeftArr;
                            $oldRightArr = $newRightArr;
                            $cntLeftTweets = 0;
                            $cntRightTweets = 0;
                            $collectingArray = array();
                            foreach ($newLeftArr as $tweet)
                            {
                                foreach($usePresentKeywords as &$term)
                                {
                                    if(stripos($tweet->text,$term) !== FALSE)
                                    {
                                            array_push($collectingArray,$tweet);
                                            $cntLeftTweets++;
                                            break;
                                    }
                                }
                            }
                            $newLeftArr = $collectingArray;
                            $collectingArray = array();
                            foreach ($newRightArr as $tweet)
                            {
                                foreach($usePresentKeywords as &$term)
                                {
                                    if(stripos($tweet->text,$term) !== FALSE)
                                    {
                                            array_push($collectingArray,$tweet);
                                            $cntRightTweets++;
                                            break;
                                    }
                                }
                            }
                            $newRightArr = $collectingArray;
                            //echo "<br>";
                            //echo "Restricted tweets- ";
                            //echo "Left arr length: " . count($newLeftArr) . "; ";
                            //echo "Right arr legnth: " . count($newRightArr);
                            //echo "<br>";
                            $collectingArray = array();
                            if(count($newLeftArr) <= 1)
                            {
                                $newLeftArr = $oldLeftArr;
                                $cntLeftTweets = count($newLeftArr);
                            }
                            if(count($newRightArr) <= 1)
                            {
                                $newRightArr = $oldRightArr;
                                $cntRightTweets = count($newRightArr);
                            }
                            //echo "<br>";
                            //echo "Relaxed restrictions on tweets- ";
                            //echo "Left arr length: " . count($newLeftArr) . "; ";
                            //echo "Right arr legnth: " . count($newRightArr);
                            //echo "<br>";
                            if(count($newLeftArr) <= 1)
                            {
                                $newLeftArr = $results1;
                                $cntLeftTweets = count($newLeftArr);
                            }
                            if(count($newRightArr) <= 1)
                            {
                                $newRightArr = $results2;
                                $cntRightTweets = count($newRightArr);
                            }
                            //echo "<br>";
                            //echo "More relaxed restrictions on tweets- ";
                            //echo "Left arr length: " . count($newLeftArr) . "; ";
                            //echo "Right arr legnth: " . count($newRightArr);
                            //echo "<br>";

                            if ($cntRightTweets > 0 && $cntLeftTweets > 0) {
                                if ($newLeftArr[0]->score > $newRightArr[0]->score) {
                                    $results[0] = $newLeftArr[0];
                                    $results[1] = $newRightArr[0];
                                    if ($cntLeftTweets > 1) {
                                        $results[2] = $newLeftArr[1];
                                    }

                                } else {
                                    $results[0] = $newRightArr[0];
                                    $results[1] = $newLeftArr[0];
                                    if ($cntRightTweets > 1) {
                                        $results[2] = $newRightArr[1];
                                    }
                                }

                            } else if ($cntLeftTweets > 0) {
                                array_merge($results, $newLeftArr);

                            } else if ($cntRightTweets > 0) {
                                array_merge($results, $newRightArr);
                            }
                            //echo "Length of results: " . count($results);

                            foreach ($results as &$tweet)
                            {
                                $isAUser1Tweet = in_array($tweet->name,$user1Accounts);
                                $isAUser2Tweet = in_array($tweet->name,$user2Accounts);

                                if ($isAUser1Tweet)
                                {
                                    User::responseCheck($counter, $leftWentLast, TRUE);
                                    $leftWentLast = TRUE;
                                }
                                elseif ($isAUser2Tweet)
                                {
                                    User::responseCheck($counter, $leftWentLast, FALSE);
                                    $leftWentLast = FALSE;
                                }

                                print "<tr>";
                                if ($isAUser1Tweet)
                                {
                                    Display::candidateImage($tweet->name);
                                    print "<td class='leftCell'>";
                                    print StringUtility::searchStringBold($tweet->boldText,array_merge($user2Names,$user1NOTOpponentNames));
                                }
                                elseif ($isAUser2Tweet)
                                {
                                    print '<td></td>';
                                    print '<td></td>';
                                    print "<td class='rightCell'>";
                                    print StringUtility::searchStringBold($tweet->boldText,array_merge($user1Names,$user2NOTOpponentNames));
                                }
                                //print $tweet->boldText;
                                //print StringUtility::searchStringBold($tweet->text,$searchArray);
                                print "<br><i>";
                                print "Score: ";
                                print Archive::scoreTweet($tweet) . " = ";
                                print Archive::processRetweetCount($tweet) . " retweets";
                                print " + ". $keywordScoreCoefficient . "*" . $tweet->numberOfKeywords . " keywords";
                               if ($isAUser1Tweet)
                               {
                                    print " + " . $opCandidateMentionCoef . "*" . Archive::countKeywords($tweet->text,$user2Names) . " candidate-mentions";
                                    print " + " . $notOpCandidateMentionCoef . "*" . Archive::countKeywords($tweet->text,$user1NOTOpponentNames) . " other-candidate-mentions.";
                                }
                                elseif ($isAUser2Tweet)
                                {
                                    print " + " . $opCandidateMentionCoef . "*" . Archive::countKeywords($tweet->text,$user1Names) . " candidate-mentions";
                                    print " + " . $notOpCandidateMentionCoef . "*" . Archive::countKeywords($tweet->text,$user2NOTOpponentNames) . " other-candidate-mentions.";
                                }
                                print "<i><br>";
                                print "<font size=1>@" . $tweet->name . "</font>";
                                print " ";
                                $dateTemp = new DateTime($tweet->created_at);
                                print "<font size=1>" . date_format($dateTemp, 'D M j H:i:s') . "</font>";
                                print "</td>";
                                if ($isAUser1Tweet)
                                {
                                    print "<td></td>";
                                    print '<td></td>';
                                }
                                elseif ($isAUser2Tweet)
                                {
                                    Display::candidateImage($tweet->name);
                                }

                                $isAUser1Tweet = FALSE;
                                $isAUser2Tweet = FALSE;
                            }

                            print "</td></tr>";
                            print "<tr id='moreLinkRow'>";
                            print "<td></td>";
                            print "<td></td>";
                            print "<td onclick='moreLinkClick()' class='moreLink'>More Tweets</td>";
                            print "<td></td>";
                            print "</tr>";

                        } else {

                            $results = array_merge($results1, $results2);
                            usort($results, "Timeline::sortByScoreRetrieve");

                            $excludeArray = $excludeArray2;
                            foreach ($results as &$tweet)
                            {
                                $foundAStopWord = StringUtility::searchStringWithArray($tweet->text,$excludeArray);
                                $isAUser1Tweet = in_array($tweet->name,$user1Accounts);
                                $isAUser2Tweet = in_array($tweet->name,$user2Accounts);

                                if (!$foundAStopWord && $isAUser1Tweet)
                                {
                                    User::responseCheck($counter, $leftWentLast, TRUE);
                                    $leftWentLast = TRUE;
                                }
                                elseif (!$foundAStopWord && $isAUser2Tweet)
                                {
                                    User::responseCheck($counter, $leftWentLast, FALSE);
                                    $leftWentLast = FALSE;
                                }

                                if (($counter < $maxResponses) && ($foundAStopWord == FALSE))
                                {
                                    print "<tr>";
                                    if ($isAUser1Tweet)
                                    {
                                        Display::candidateImage($tweet->name);
                                        print "<td class='leftCell'>";
                                        print StringUtility::searchStringBold($tweet->boldText,array_merge($user2Names,$user1NOTOpponentNames));
                                    }
                                    elseif ($isAUser2Tweet)
                                    {
                                        print '<td></td>';
                                        print '<td></td>';
                                        print "<td class='rightCell'>";
                                        print StringUtility::searchStringBold($tweet->boldText,array_merge($user1Names,$user2NOTOpponentNames));
                                    }
                                    //print $tweet->boldText;
                                    //print StringUtility::searchStringBold($tweet->text,$searchArray);
                                    print "<br><i>";
                                    print "Score: ";
                                    print Archive::scoreTweet($tweet) . " = ";
                                    print Archive::processRetweetCount($tweet) . " retweets";
                                    print " + ". $keywordScoreCoefficient . "*" . $tweet->numberOfKeywords . " keywords";
                                    if ($isAUser1Tweet)
                                    {
                                        print " + " . $opCandidateMentionCoef . "*" . Archive::countKeywords($tweet->text,$user2Names) . " candidate-mentions";
                                        print " + " . $notOpCandidateMentionCoef . "*" . Archive::countKeywords($tweet->text,$user1NOTOpponentNames) . " other-candidate-mentions.";
                                    }
                                    elseif ($isAUser2Tweet)
                                    {
                                        print " + " . $opCandidateMentionCoef . "*" . Archive::countKeywords($tweet->text,$user1Names) . " candidate-mentions";
                                        print " + " . $notOpCandidateMentionCoef . "*" . Archive::countKeywords($tweet->text,$user2NOTOpponentNames) . " other-candidate-mentions.";
                                    }
                                    print "<i><br>";
                                    print "<font size=1>@" . $tweet->name . "</font>";
                                    print " ";
                                    $dateTemp = new DateTime($tweet->created_at);
                                    print "<font size=1>" . date_format($dateTemp, 'D M j H:i:s') . "</font>";
                                    print "</td>";
                                    if ($isAUser1Tweet)
                                    {
                                        print "<td></td>";
                                        print '<td></td>';
                                    }
                                    elseif ($isAUser2Tweet)
                                    {
                                        Display::candidateImage($tweet->name);
                                    }
                                }
                                $isAUser1Tweet = FALSE;
                                $isAUser2Tweet = FALSE;
                            }

                            print "</td></tr>";
                        }
                    ?>

                </table>
                </span>

                <script type="text/javascript">
                    function topicChanged (topicValue, user1, user2) {
                        window.location = "index.php?topic=" +
                                        topicValue + "&user1=" + user1 + "&user2=" + user2;
                        document.getElementById("twitterAccounts1").value = user1;
                        document.getElementById("twitterAccounts2").value = user2;
                    }

                    function gup( name )
                    {
                      name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
                      var regexS = "[\\?&]"+name+"=([^&#]*)";
                      var regex = new RegExp( regexS );
                      var results = regex.exec( window.location.href );
                      if( results == null )
                        return "";
                      else
                        return results[1];
                    }

                    var isTopic = gup('topic');
                    if (isTopic) {
                        document.getElementById("twitterAccounts1").value = gup('user1');
                        document.getElementById("twitterAccounts2").value = gup('user2');
                        document.getElementById("twitterTopics").value = isTopic;

                    } else {
                        document.getElementById("twitterAccounts1").value = "MittRomney";
                        document.getElementById("twitterAccounts2").value = "BarackObama";
                        document.getElementById("twitterTopics").value = "Economy";
                    }

                    function moreLinkClick () {

                        if (window.location.href.indexOf("?") == -1) {
                            window.location = window.location + "?more=1";

                        } else {
                            window.location = window.location + "&more=1";
                        }
                    }

                </script>

            </div>
        </div>

        <!--
        <div class="titleImgContainer">
            <img class="titleImg" src="images/TitleBarackObama.jpg" alt="Barack Obama"/>
            <img class="titleImg" src="images/TitleHermanCain.jpg" alt="Herman Cain"/>
            <img class="titleImg" src="images/TitleMittRomney.jpg" alt="Mitt Romney"/>
            <img class="titleImg" src="images/TitleRonPaul.jpg" alt="Ron Paul"/>
            <img class="titleImg" src="images/TitleRickSantorum.jpg" alt="Rick Santorum"/>
            <img class="titleImg" src="images/TitleMichelleBachmann.jpg" alt="Michelle Bachmann"/>
            <img class="titleImg" src="images/TitleNewtGingrich.jpg" alt="Newt Gingrich"/>
            <img class="titleImg" src="images/TitleGaryJohnson.jpg" alt="Gary Johnson"/>
            <img class="titleImg" src="images/TitleRickPerry.jpg" alt="Rick Perry"/>
            <img class="titleImg" src="images/TitleJonHuntsman.jpg" alt="Jon Huntsman"/>
        </div>
        -->

    </body>
</html>