<?php
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
    
    $candidateAccounts1 = array("BarackObama", "whitehouse", "ObamaNews", "TheDemocrats", "BarackObamaUSA", "ObamaPalooza");
    $candidateAccounts2 = array("THEHermanCain", "CainStaff", "Citizens4Cain");
    $candidateAccounts3 = array("MittRomney", "Mittisms", "RomneyCentral", "PlanetRomney", "AmericaNeedsMR");
    $candidateAccounts4 = array("RonPaul", "RepRonPaul", "RonPaul_2012", "RonPaulForums", "RonPaulNews", "RonPaul4Liberty");
    $candidateAccounts5 = array("RickSantorum");
    $candidateAccounts6 = array("MicheleBachmann", "TeamBachmann");
    $candidateAccounts7 = array("NewtGingrich", "Newt2012HQ", "NewtG_News");
    $candidateAccounts8 = array("GovGaryJohnson");
    $candidateAccounts9 = array("GovernorPerry", "TeamRickPerry", "PerryTruthTeam", "TexGov");
    $candidateAccounts10 = array("JonHuntsman", "Jon2012HQ", "JonHuntsman12");
    
    class User
    {   
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