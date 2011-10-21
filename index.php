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
        <div class="title">
            <div style="margin-left:25px">
                Twitter Debate
            </div>
        </div>

        <?php
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
        ?>


        <div class="container">

            <div class="choiceContainer">
                <!-- Patrick's code for 3 columns-->

                <div id = "containerChoose">
                    <span>
                        <select id="twitterAccounts1" name="twitterAccounts1[]" style="margin-left:150px;">
                            <?php showOptionsDrop($twitterAccounts1, null, true); ?>
                        </select>
                    </span>

                    <span>
                        <select id="twitterAccounts2" name="twitterAccounts2[]" style="margin-left:600px">
                            <?php showOptionsDrop($twitterAccounts2, null, true); ?>
                        </select>
                    </span>
                </div>

                <div>
                    <select id="twitterTopics" name="twitterTopics[]" style="margin-left:500px"
                        onchange='topicChanged(this.value, document.getElementById("twitterAccounts1").value,
                            document.getElementById("twitterAccounts2").value)'>
                        <?php showOptionsDrop($twitterTopics, null, true); ?>
                    </select>
                </div>

            </div>



            <div class="tweetsContainer">

                <span class="imagesLeft">
                    <!-- Images column for twitter account 1 -->
                </span>

                <span class="tweetsLeft">
                    <!-- Tweets column for twitter account 1 -->
                </span>

                <span class="tweetsRight">
                    <!-- Tweets column for twitter account 2 -->
                </span>

                <span class="imagesRight">
                    <!-- Images column for twitter account 2 -->
                </span>

                <table>
                    <tr>

                    <?php

                        if (!empty($_GET['topic']))
                        {
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
                            }

                        }
                        else {
                            $twitterTopic = "Economy";
                            $twitterUser1 = "MittRomney";
                            $twitterUser2 = "BarackObama";
                            $searchArray = $searchArray1;

                            $searchArray = $searchArray1;
                        }

                        print "<th class='accountTitle'>@" . $twitterUser1 . "</th>";
                        print "<th></th><th></th>";
                        print "<th class='accountTitle'>@" . $twitterUser2 . "</th>";

                        // Makes a search for tweets
                        $results = Timeline::getMultiUserTimeline(array((string)$twitterUser1, (string)$twitterUser2));
        
                        foreach ($results as &$tweet)
                        {
                            if (StringUtility::searchStringWithArray($tweet->text,$searchArray))
                            {
                                print "<tr>";
                                print "<td></td>";
                                if ($tweet->name == $twitterUser1)
                                {
                                    Display::candidateImage($tweet->name);
                                    print "<td class='leftCell'>";
                                }
                                elseif ($tweet->name == $twitterUser2)
                                {
                                    print '<td></td>';
                                    print "<td class='rightCell'>";
                                }
                                print $tweet->text;
                                print "<br>";
                                print $tweet->name;
                                print "<br>";
                                print $tweet->created_at;
                                print "</td>";
                                if ($tweet->name == $twitterUser1)
                                {
                                    print "<td></td>";
                                }
                                elseif ($tweet->name == $twitterUser2)
                                {
                                    Display::candidateImage($tweet->name); 
                                }
                            }
                        }

                        print "</td>"
                    ?>

                    </tr>
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

                </script>

            </div>
        </div>
    </body>
</html>
