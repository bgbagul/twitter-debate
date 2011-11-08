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
                } else if ($twitterTopic == "environment") {
                    $searchArray = $searchArray8;
                }

            } else {
                $twitterTopic = "economy";
                $twitterUser1 = "MittRomney";
                $twitterUser2 = "BarackObama";
                $searchArray = $searchArray1;
            }

        ?>

        <div class="container">

            <div class="choiceContainer">
                
                <span class="titleElement">
                    <select id="twitterAccounts1" name="twitterAccounts1[]" style="font-size:25px; color:Grey;">
                        <?php showOptionsDrop($twitterAccounts1, null, true); ?>
                    </select>

                    <div style="line-height:125%;">
                        <?php
                            Display::candidateTwitterAccounts($twitterUser1);
                        ?>
                    </div>

                </span>

                <span class="titleElement">
                    <div style="height:50px">
                        <font size="7" color="blue">Twitter</font>
                        <font size="6" color="red">Debate</font>
                    </div>

                    <span style="font-size:35px;">
                        On
                    </span>

                    <select id="twitterTopics" name="twitterTopics[]" style="font-size:25px; color:Grey;"
                        onchange='topicChanged(this.value, document.getElementById("twitterAccounts1").value,
                            document.getElementById("twitterAccounts2").value)'>
                        <?php showOptionsDrop($twitterTopics, null, true); ?>
                    </select>
                </span>

                <span class="titleElement">
                    <select id="twitterAccounts2" name="twitterAccounts2[]" style="font-size:25px; color:Grey;">
                        <?php showOptionsDrop($twitterAccounts2, null, true); ?>
                    </select>

                    <div style="line-height:125%;">
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

                        print "<th class='accountTitle'></th><th class='accountTitle'></th><th class='accountTitle'></th><th class='accountTitle'></th>";
                        print "</tr>";
                        print "<tr style='height:25px;'></tr>";

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

                        //$sizers1 = count($results1);
                        //$sizers2 = count($results2);

                        $results = array_merge($results1, $results2);
                        usort($results, "Timeline::sortByTime");
                        //$i = 0;
                        //while ($i < $sizers1 + $sizers2) {
                        //
                        //    $tweet_flag = false;
                        //    if (next($results1)) {
                        //        $results[$i] = current($results1);
                        //        $i++;
                        //        $tweet_flag = true;
                        //    }
                        //
                        //    if (next($results2)) {
                        //        $results[$i] = current($results2);
                        //        $i++;
                        //        $tweet_flag = true;
                        //    }
                        //
                        //    if (!$tweet_flag) {
                        //        break;
                        //    }
                        //}

                        //$results = array_merge((array)$results1, (array)$results2);

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
                                }
                                elseif ($isAUser2Tweet)
                                {
                                    print '<td></td>';
                                    print '<td></td>';
                                    print "<td class='rightCell'>";
                                }
                                print $tweet->boldText;
                                //print StringUtility::searchStringBold($tweet->text,$searchArray);
                                print "<br>";
                                print "<font size=1>@" . $tweet->name . "</font>";
                                print "<br>";
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

                        print "</td>"
                    ?>

                    </tr>
                </table>
                </span>

                <script type="text/javascript">
                    function topicChanged (topicValue, user1, user2) {
                        window.location = "indexDebate.php?topic=" +
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

                </script>

            </div>
        </div>
    </body>
</html>