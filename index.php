<!--
    Twitter Debate, v0.0
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
            Twitter Debate
        </div>

        <table>
            <tr>

                <?php
                    require "tDebate.php";

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

                    $twitterAccounts1 = array('BarackObama'=>'Barack Obama', 'THEHermanCain'=>'Herman Cain',
                        'MittRomney'=>'Mitt Romney', 'RonPaul'=>'Ron Paul', 'RickSantorum'=>'Rick Santorum',
                        'MicheleBachmann'=>'Michele Bachman', 'NewtGingrich'=>'Newt Gingrich',
                        'GovGaryJohnson'=>'Gary Johnson', 'GovernorPerry'=>'Rick Perry', 'JonHuntsman'=>'Jon Huntsman');
                    $twitterAccounts2 = array('BarackObama'=>'Barack Obama', 'THEHermanCain'=>'Herman Cain',
                        'MittRomney'=>'Mitt Romney', 'RonPaul'=>'Ron Paul', 'RickSantorum'=>'Rick Santorum',
                        'MicheleBachmann'=>'Michele Bachman', 'NewtGingrich'=>'Newt Gingrich',
                        'GovGaryJohnson'=>'Gary Johnson', 'GovernorPerry'=>'Rick Perry', 'JonHuntsman'=>'Jon Huntsman');
                    $twitterTopics = array("economy"=>"Economy", "immigration"=>"Immigration", "healthcare"=>"Health Care", "socialsecurity"=>"Social Security");

                    $searchArray1 = array("Economy", "Jobs", "Unemployment", "Spend", "Stimulus",
                        "Taxes", "Worker", "Labor", "Fed ", "Econ", "AmericanJobsAct", "WallStreet",
                        "EconDebate", "Companies", "Company", "Salary", "Salaries", "Audit", "Money",
                        "Wage", "Consumer", "Work", "Prosperity", "FairTax", "Tax", "Capital",
                        "FederalReserve", "Deficit", "Business", "Investment", "Bailout", "Funds",
                        "Rich", "Poor", "Outsource", "Poverty");
                    $searchArray2 = array("Immigration", "Citizenship", "DreamAct", "Border", "Fence", 
                        "E-verify", "Everify", "Arizona", "Alabama", "deportation", "USCIS",
                        "naturalization", "resident", "customs", "security");
                    $searchArray3 = array("Healthcare", "Health", "care", "Obamacare", "Insured",
                        "uninsured", "access", "socialized", "medicine", "doctor", "physician",
                        "medical", "benefits", "insurance", "Medicaid", "Medicare",
                        "universal", "M.D.", "MD", "drugs", "sick");
                    $searchArray4 = array("SocialSecurity", "Benefits", "disability", "SS", "retirement");
            ?>

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

            <?php

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

                    $searchArray = $searchArray1;
                }

                print "<th class='accountTitle'>@" . $twitterUser1 . "</th><th class='accountTitle'>@" . $twitterUser2 . "</th><tr/><tr><td>";

                // Makes a search for tweets
                $results = Timeline::getUserTimeline($twitterUser1);

                // This loop prints the search results nicely with the
                // following info: from_user(who posted it),
                // created_at(the time), and text(the tweet itself).
                // First while for first twitter account
                while($tweet = next($results)) {

                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray)) {

                        print "<div class='tweetCell'><b>";
                        echo $tweet->created_at;
                        print "</b><br>";
                        echo $tweet->text;
                        echo "<br></div>";
                    }
                }

                print "</td><td>";

                // Makes a search for tweets
                $results = Timeline::getUserTimeline($twitterUser2);

                // This loop prints the search results nicely with the
                // following info: from_user(who posted it),
                // created_at(the time), and text(the tweet itself).
                // First while for first twitter account
                while($tweet = next($results)) {

                    if (StringUtility::searchStringWithArray($tweet->text,$searchArray)) {

                        print "<div class='tweetCell'><b>";
                        echo $tweet->created_at;
                        print "</b><br>";
                        echo $tweet->text;
                        echo "<br></div>";
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
    </body>
</html>
