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

        <!-- 1. drop down 1 - first group
        // 2. drop down 2 - second group
        // 3. text box - search
        -->
        <table>
            <tr>

                <?php

                // Allows use of Search API
                require "TwitterSearch.php";

                // Instantiates new TwitterSearch class
                $search = new TwitterSearch();

                // Queries are made anonymously, but this tells Twitter who we are
                $search->user_agent = 'phptwittersearch:t.debate36@gmail.com';

                // Makes a search for tweets by Romney or Obama
                $search->generalFrom('from:MittRomney');

                // This can search for keywords, but is currently commented out
                //$search->contains('immigration');

                // Limits results to 50 tweets
                $results = $search->rpp(50)->results();

                // This loop prints the search results nicely with the
                // following info: from_user(who posted it),
                // created_at(the time), and text(the tweet itself).

                print "<th class='accountTitle'>@MittRomney</th><th class='accountTitle'>@BarackObama</th><tr/><tr><td>";

                // first while for first twitter account
                while($tweet = next($results))
                {
                    print "<div class='tweetCell'><b>";
                    //echo $tweet->from_user;
                    //print "<br>";
                    echo $tweet->created_at;
                    print "</b><br>";
                    echo $tweet->text;
                    echo "<br></div>";
                }

                // Makes a search for tweets by Romney or Obama
                $search->generalFrom('from:BarackObama');

                // This can search for keywords, but is currently commented out
                //$search->contains('immigration');

                // Limits results to 50 tweets
                $results = $search->rpp(50)->results();

                print "</td><td>";
                // second while for second twitter account
                while($tweet = next($results))
                {
                    print "<div class='tweetCell'><b>";
                    //echo $tweet->from_user;
                    //print "<br>";
                    echo $tweet->created_at;
                    print "</b><br>";
                    echo $tweet->text;
                    echo "<br></div>";
                }

                print "</td>"
                ?>

            </tr>
        </table>
        </span>
    </body>
</html>
