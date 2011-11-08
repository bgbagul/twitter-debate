<?php
    $maxResponses = 3;
    $onlyGetOneAccount = FALSE;

    $twitterAccounts1 = array('BarackObama'=>'Barack Obama', 'THEHermanCain'=>'Herman Cain',
        'MittRomney'=>'Mitt Romney', 'RonPaul'=>'Ron Paul', 'RickSantorum'=>'Rick Santorum',
        'MicheleBachmann'=>'Michele Bachman', 'NewtGingrich'=>'Newt Gingrich',
        'GovGaryJohnson'=>'Gary Johnson', 'GovernorPerry'=>'Rick Perry', 'JonHuntsman'=>'Jon Huntsman');
    $twitterAccounts2 = array('BarackObama'=>'Barack Obama', 'THEHermanCain'=>'Herman Cain',
        'MittRomney'=>'Mitt Romney', 'RonPaul'=>'Ron Paul', 'RickSantorum'=>'Rick Santorum',
        'MicheleBachmann'=>'Michele Bachman', 'NewtGingrich'=>'Newt Gingrich',
        'GovGaryJohnson'=>'Gary Johnson', 'GovernorPerry'=>'Rick Perry', 'JonHuntsman'=>'Jon Huntsman');
    $twitterTopics = array("economy"=>"Economy", "immigration"=>"Immigration", "healthcare"=>"Health Care",
        "socialsecurity"=>"Social Security", "jobs"=>"Jobs", "taxes"=>"Taxes", "deficit"=>"Deficit", "environment"=>"Environment");

    $searchArray1 = array(" Economy", "Economy ", " Spend", "Spend ", " Stimulus", "Stimulus ", " Taxes", "Taxes ", " Fed", "Fed ", " Econ", "Econ ",
        "Wall Street", "EconDebate", " Audit", "Audit ", "Money", "Consumer", "Prosperity", "Capital", "Deficit",
        "Business", "Investment", "Bailout", "Funds", "Rich", "Poor");
    $searchArray2 = array("Immigration", "Citizenship", "DreamAct", "Border", " Fence", "Fence ", "E-verify", "Arizona",
        "Alabama", "deportation", "USCIS", "naturalization", " resident", "resident ", "customs", "security");
    $searchArray3 = array("Healthcare", "Obamacare", "Insured", "uninsured", " access", "access ", "socialized", "medicine", "doctor",
        "physician", "medical", "benefits", "insurance", "Medicaid", "Medicare", "universal");
    $searchArray4 = array("SocialSecurity", "Benefits", "disability", " SS ", "retirement");
    $searchArray5 = array("Jobs", "Unemployment", "Employment", "Taxes", "Worker", "Labor",
        "American Jobs Act", "Wall Street", "Companies", "Company", "Salary", "Salaries", "Wage",
        "Work", "Deficit", "Outsource", "Poverty", "Hire", "Union");
    $searchArray6 = array("Taxes", "Wall Street", " Fed", "Fed ", "Audit", "Payroll Tax", "FairTax", "Capital gains tax",
        "Federal Reserve", "Flat Tax");
    $searchArray7 = array("Deficit", "Bailout", "Spending", "Cut", "Investment", "Bank", "Economic",
        "Growth", "Funds", "Consumer", "Recovery");
    $searchArray8 = array("Environment", "Green", "Gulf", "Drilling", "Global Warming", "Clean energy",
        "Climate", "Renewable Energy", "Carbon footprint");

    $excludeArray = array("steve jobs", "on my way", "on way", "taping", "visit", "appearance", "dates",
                          "check it out", "t-shirt", "website", "straw poll", "ad", "poll", "press conference",
                          "appearance", "donate", "endorsement", "facebook", "livestream", "http", "mi.tt", "bit.ly", "twurl",
                          "youtu.be", "ow.ly", "whitehouse.gov", "usa.gov", "tinyurl", "mi.tt", "4sq.com", "#FF", "FollowFriday",
                          "pic.twitter", "yfrog.com");
    $excludeArray2 = array("steve jobs", "on my way", "on way", "taping", "visit", "appearance", "dates",
                          "check it out", "t-shirt", "website", "straw poll", "ad", "poll", "press conference",
                          "appearance", "donate", "endorsement", "facebook", "livestream");
    $excludeArray3 = array();

    $toggleArray = array("One Sided Cap", "Remove Press Appearances", "Remove Links", "Remove Twitpics");

    if ($onlyGetOneAccount==true)
    {
        $candidateAccounts1 = array("BarackObama");
        $candidateAccounts2 = array("THEHermanCain");
        $candidateAccounts3 = array("MittRomney");
        $candidateAccounts4 = array("RonPaul");
        $candidateAccounts5 = array("RickSantorum");
        $candidateAccounts6 = array("MicheleBachmann");
        $candidateAccounts7 = array("NewtGingrich");
        $candidateAccounts8 = array("GovGaryJohnson");
        $candidateAccounts9 = array("GovernorPerry");
        $candidateAccounts10 = array("JonHuntsman");
    }
    else
    {
        $candidateAccounts1 = array("BarackObama", "whitehouse", "ObamaNews", "TheDemocrats", "BarackObamaUSA", "ObamaPalooza");
        $candidateAccounts2 = array("THEHermanCain", "CainStaff", "Citizens4Cain");
        $candidateAccounts3 = array("MittRomney", "Mittisms", "RomneyCentral", "PlanetRomney");
        $candidateAccounts4 = array("RonPaul", "RepRonPaul", "RonPaul_2012", "RonPaulForums", "RonPaulNews", "RonPaul4Liberty");
        $candidateAccounts5 = array("RickSantorum");
        $candidateAccounts6 = array("MicheleBachmann", "TeamBachmann");
        $candidateAccounts7 = array("NewtGingrich", "Newt2012HQ", "NewtG_News");
        $candidateAccounts8 = array("GovGaryJohnson");
        $candidateAccounts9 = array("GovernorPerry", "TeamRickPerry", "PerryTruthTeam", "TexGov");
        $candidateAccounts10 = array("JonHuntsman", "Jon2012HQ", "JonHuntsman12");
    }

    class User
    {
        static function responseCheck (&$theCount, $theLeftSide, $theWant)
        {
            if ($theLeftSide == TRUE && $theWant == FALSE)
            {
                $theCount = 0;
            }
            elseif ($theLeftSide == FALSE && $theWant == TRUE)
            {
                $theCount = 0;
            }
            else
            {
                $theCount += 1;
            }
        }

        static function getAccounts ($candidate)
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

            if ($candidate == "BarackObama")
            {
                return $candidateAccounts1;
            }
            elseif ($candidate == "THEHermanCain")
            {
                return $candidateAccounts2;
            }
            elseif ($candidate == "MittRomney")
            {
                return $candidateAccounts3;
            }
            elseif ($candidate == "RonPaul")
            {
                return $candidateAccounts4;
            }
            elseif ($candidate == "RickSantorum")
            {
                return $candidateAccounts5;
            }
            elseif ($candidate == "MicheleBachmann")
            {
                return $candidateAccounts6;
            }
            elseif ($candidate == "NewtGingrich")
            {
                return $candidateAccounts7;
            }
            elseif ($candidate == "GovGaryJohnson")
            {
                return $candidateAccounts8;
            }
            elseif ($candidate == "GovernorPerry")
            {
                return $candidateAccounts9;
            }
            elseif ($candidate == "JonHuntsman")
            {
                return $candidateAccounts10;
            }
        }
    }
?>
