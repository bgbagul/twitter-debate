<!--
    Twitter Debate, v0.2
    By Christopher Blair, Patrick McAuliffe, Balasaheb Bagul, Jane Janeczko, and Michael Madaus
    EECS 338 Practicum in Intelligent Information Systems (Fall 2011)
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Twitter Debate</title>
    </head>

    <body>

        <?php
            require "terms.php";
            require "tDebate.php";
            require "display.php";

            set_time_limit(60000);

            //BUILDS A TWEET ARCHIVE OF ALL OUR CANDIDATES.
            //IT USUALLY TAKES ABOUT 5 MINUTES FOR ME.
            Archive::buildEntireArchive();
            
            
            //BUILDS AN INDIVIDUAL CANDIDATE ARCHIVE OF JSON FILES
            Archive::buildCandidateArchive($candidateAccounts5);
            
            //SAMPLE CALLS TO RETRIEVE THE TWEETS IN THE JSON FILES
            //$economySave = json_decode(file_get_contents("tweets/obama/economy.json"));
            //$immigrationSave = json_decode(file_get_contents("tweets/obama/immigration.json"));
            //$healthcareSave = json_decode(file_get_contents("tweets/obama/healthcare.json"));
            //$socialSecuritySave = json_decode(file_get_contents("tweets/obama/socialsecurity.json"));
            //
            //$jobsSave = json_decode(file_get_contents("tweets/obama/jobs.json"));
            //$taxesSave = json_decode(file_get_contents("tweets/obama/taxes.json"));
            //$deficitSave = json_decode(file_get_contents("tweets/obama/deficit.json"));
            //$environmentSave = json_decode(file_get_contents("tweets/obama/environment.json"));
            //
            
            //TWEETS CAN NOW BE PROCESED NORMALLY
            //echo "Economy Tweets";
            //echo "<BR>";
            //foreach($economySave as &$tweet)
            //{
            //    echo $tweet->boldText;
            //    echo "<BR>";
            //    echo $tweet->name;
            //    echo "<BR>";
            //}
            //echo "<BR>";
            //echo "Immigration Tweets";
            //echo "<BR>";
            //foreach($immigrationSave as &$tweet)
            //{
            //    echo $tweet->boldText;
            //    echo "<BR>";
            //    echo $tweet->name;
            //    echo "<BR>";
            //}
            //echo "<BR>";
            //echo "Healthcare Tweets";
            //echo "<BR>";
            //foreach($healthcareSave as &$tweet)
            //{
            //    echo $tweet->boldText;
            //    echo "<BR>";
            //    echo $tweet->name;
            //    echo "<BR>";
            //}
            //echo "<BR>";
            //echo "Social Security Tweets";
            //echo "<BR>";
            //foreach($socialSecuritySave as &$tweet)
            //{
            //    echo $tweet->boldText;
            //    echo "<BR>";
            //    echo $tweet->name;
            //    echo "<BR>";
            //}
            ////aaaaaaaaaaaagggggggggghhhhhhhhhhhhhhhh
            //echo "<BR>";
            //echo "Jobs Tweets";
            //echo "<BR>";
            //foreach($jobsSave as &$tweet)
            //{
            //    echo $tweet->boldText;
            //    echo "<BR>";
            //    echo $tweet->name;
            //    echo "<BR>";
            //}
            //echo "<BR>";
            //echo "Taxes Tweets";
            //echo "<BR>";
            //foreach($taxesSave as &$tweet)
            //{
            //    echo $tweet->boldText;
            //    echo "<BR>";
            //    echo $tweet->name;
            //    echo "<BR>";
            //}
            //echo "<BR>";
            //echo "Deficit Tweets";
            //echo "<BR>";
            //foreach($deficitSave as &$tweet)
            //{
            //    echo $tweet->boldText;
            //    echo "<BR>";
            //    echo $tweet->name;
            //    echo "<BR>";
            //}
            //echo "<BR>";
            //echo "Environment Tweets";
            //echo "<BR>";
            //foreach($environmentSave as &$tweet)
            //{
            //    echo $tweet->boldText;
            //    echo "<BR>";
            //    echo $tweet->name;
            //    echo "<BR>";
            //}
        ?>
        
    </body>
</html>