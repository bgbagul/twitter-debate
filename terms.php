<?php
    $maxResponses = 50;
    $onlyGetOneAccount = FALSE;
    $keywordScoreCoefficient = 20;
    $opCandidateMentionCoef= 80;
    $notOpCandidateMentionCoef = -25;

    $twitterAccounts1 = array('BarackObama'=>'Barack Obama', 'THEHermanCain'=>'Herman Cain',
        'MittRomney'=>'Mitt Romney', 'RonPaul'=>'Ron Paul', 'RickSantorum'=>'Rick Santorum',
        'MicheleBachmann'=>'Michele Bachmann', 'NewtGingrich'=>'Newt Gingrich',
        'GovGaryJohnson'=>'Gary Johnson', 'GovernorPerry'=>'Rick Perry', 'JonHuntsman'=>'Jon Huntsman');
    $twitterAccounts2 = array('BarackObama'=>'Barack Obama', 'THEHermanCain'=>'Herman Cain',
        'MittRomney'=>'Mitt Romney', 'RonPaul'=>'Ron Paul', 'RickSantorum'=>'Rick Santorum',
        'MicheleBachmann'=>'Michele Bachmann', 'NewtGingrich'=>'Newt Gingrich',
        'GovGaryJohnson'=>'Gary Johnson', 'GovernorPerry'=>'Rick Perry', 'JonHuntsman'=>'Jon Huntsman');
    $twitterTopics = array("economy"=>"Economy", "immigration"=>"Immigration", "healthcare"=>"Health Care",
        "socialsecurity"=>"Social Security", "jobs"=>"Jobs", "taxes"=>"Taxes", "deficit"=>"Deficit", "foreignpolicy"=>"Foreign Policy");

    $searchArray1 = array(" Econ", " Spend ", " Stimulus ", " Taxes ", " Fed", "Wall Street", "EconDebate", " Audit ", " Money", "Consumer",
                          "Prosperity", "Capital", "Deficit", "Business", "Investment", "Bailout", "Funds", "class warfare");
    $searchArray2 = array("Immigration", "Citizenship", "DreamAct", "Border", " Fence ", "E-verify", "deportation", "USCIS", "naturalization",
                          " resident ", "customs", "border security", "patrol");
    $searchArray5 = array("Jobs", "Unemployment", "Employment", "Worker", "Labor", "American Jobs Act", "Wall Street", "Salary", "Salaries", "Wage",
                          "back to Work", "workforce", "Deficit", "Outsource", "Poverty", " Hire", "Union");
    $searchArray6 = array("Taxes", "Audit", "Payroll Tax", "FairTax", "Capital gains tax", "Federal Reserve", "Flat Tax", "federal spending", "tax",
                          "tariff", "write off", "big government", "hike", "tax increase", "tax decrease", "writeoff", "tax cut", "income", "tax evader",
                          "deduction");
    $searchArray7 = array("Deficit", "Bailout", "Spending", " Cut ", "Investment", "Growth", "Funds", "Consumer", "Recovery", "fiscal gap", "debt",
                          "inflation", "expenditure", "revenue");
    $searchArray8 = array("ForeignPolicy", "Israel", "foreign policy", "international relations", "globalization", "trans-national", "foreign",
                          "peaceful cooperation", "Prime Minister", "Iraq", "Afghanistan", "Libya", "drone", "military", "Middle East", "Mid East",
                          "European Union", " EU ", " Arab", "Arab Spring", "Foreign aid", " UN ", " NATO ", "Venezuela", "defense", "military spending",
                          "inter-governmental", "alliance", "Islamist", " war ", "Syria", "Bahrain", "Tunisia", "Egypt", "Al Qaeda", "terrorist",
                          "terrorism", "Iran", "diplomat", "emissary", "diplomat", "emissaries", "embassy", "palestine");
    
    //GOING TO REMOVE
    //$searchArray8 = array("Environment", "Green", "Gulf", "Drilling", "Global Warming", "Clean energy",
    //    "Climate", "Renewable Energy", "Carbon footprint");
    $searchArray3 = array("Healthcare", "Obamacare", "Insured", "uninsured", " access to health", "access to health ", "socialized", "medicine", "doctor",
        "physician", "medical", "insurance", "Medicaid", "Medicare", "universal");
    $searchArray4 = array("SocialSecurity", "Social Security", "Benefits", "disability", " SS ", "retirement", "baby boomer", "veteran", " fica ",
                          "pension", "senior citizen", "old age", "allowance");

    $excludeArray = array("steve jobs", "on my way", "on way", "taping", "visit", "appearance", "dates",
                          "check it out", "t-shirt", "website", "straw poll", "ad", "poll", "press conference",
                          "appearance", "donate", "endorsement", "facebook", "livestream", "http", "mi.tt", "bit.ly", "twurl",
                          "youtu.be", "ow.ly", "whitehouse.gov", "usa.gov", "tinyurl", "mi.tt", "4sq.com", "#FF", "FollowFriday",
                          "pic.twitter", "yfrog.com", "occupy wall street");
    $excludeArray2 = array("steve jobs", "on my way", "on way", "taping", "visit", "appearance", "dates",
                          "check it out", "t-shirt", "website", "straw poll", "ad", "poll", "press conference",
                          "appearance", "donate", "endorsement", "facebook", "livestream", "blog", "@cnn", "@cbs", "@fox", "read my", "rolling out", "video",
                          "statement by", "speaks about", "Wall Street Journal", "new column", "Palin", "RT @", "RT@");
    $excludeArray4 = array("steve jobs", "will address", "today");
    $excludeArray3 = array("steve jobs");
 
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
        $candidateAccounts1 = array("BarackObama", "whitehouse", "ObamaNews", "TheDemocrats", "BarackObamaUSA");
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
    
    $candidateProper1 = array("obama");
    $candidateProper2 = array("cain");
    $candidateProper3 = array("romney");
    $candidateProper4 = array("paul");
    $candidateProper5 = array("santorum");
    $candidateProper6 = array("bachmann");
    $candidateProper7 = array("gingrich");
    $candidateProper8 = array("johnson");
    $candidateProper9 = array("perry");
    $candidateProper10 = array("huntsman");

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
