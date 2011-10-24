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
                }

            } else {
                $twitterTopic = "Economy";
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
//                        print "<th></th>";
//                        print "<th class='accountTitle'>@" . $twitterUser1 . "</th>";
//                       print "<th class='accountTitle'>@" . $twitterUser2 . "</th>";
//                        print "<th></th>";

                        // Makes a search for tweets
                        // $results = Timeline::getMultiUserTimeline(array((string)$twitterUser1, (string)$twitterUser2));
                        $user1Accounts = User::getAccounts($twitterUser1);
                        $user2Accounts = User::getAccounts($twitterUser2);
                        $allUserAccounts = array_merge($user1Accounts, $user2Accounts);
                        $results = Timeline::getMultiUserTimeline($allUserAccounts);

                        foreach ($results as &$tweet)
                        {
                            if (StringUtility::searchStringWithArray($tweet->text,$searchArray))
                            {
                                print "<tr>";
                                if (in_array($tweet->name,$user1Accounts))
                                {
                                    Display::candidateImage($tweet->name);
                                    print "<td class='leftCell'>";
                                }
                                elseif (in_array($tweet->name,$user2Accounts))
                                {
                                    print '<td></td>';
                                    print '<td></td>';
                                    print "<td class='rightCell'>";
                                }
                                print $tweet->text;
                                print "<br>";
                                print "<font size=1>@" . $tweet->name . "</font>";
                                print "<br>";
                                $dateTemp = new DateTime($tweet->created_at);
                                print "<font size=1>" . date_format($dateTemp, 'D M j H:i:s') . "</font>";
                                print "</td>";
                                if (in_array($tweet->name,$user1Accounts))
                                {
                                    print "<td></td>";
                                    print '<td></td>';
                                }
                                elseif (in_array($tweet->name,$user2Accounts))
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
