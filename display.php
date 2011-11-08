<?php
class Display
{
    static function candidateImage ($candidate)
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

        if (in_array($candidate,$candidateAccounts1))
        {
            if($candidate=="BarackObama"){
                print '<td><img src="images/BarackObama.jpg" alt="@barackobama" /></td>';   
            }
            else if($candidate=="whitehouse"){
                print '<td><img src="images/whitehouse.jpg" alt="@whitehouse" /></td>';   
            }
            else if($candidate=="ObamaNews"){
                print '<td><img src="images/ObamaNews.jpg" alt="@ObamaNews" /></td>';   
            }
            else if($candidate=="TheDemocrats"){
                print '<td><img src="images/TheDemocrats.png" alt="@TheDemocrats" /></td>';
            }
            else if($candidate=="BarackObamaUSA"){
                print '<td><img src="images/BarackObamaUSA.jpg" alt="@BarackObamaUSA" /></td>';   
            }
            else if($candidate=="ObamaPalooza"){
                print '<td><img src="images/ObamaPalooza.jpg" alt="@ObamaPalooza" /></td>';   
            }
            else {
                print '<td><img src="images/BarackObama.jpg" alt="@barackobama" /></td>';   
            }
        }
        
        elseif (in_array($candidate,$candidateAccounts2))
        {
            if($candidate=="THEHermanCain"){
                print '<td><img src="images/THEHermanCain.jpg" alt="@THEHermanCain" /></td>';   
            }
            else if($candidate=="CainStaff"){
                print '<td><img src="images/CainStaff.jpg" alt="@CainStaff" /></td>';   
            }
            else if($candidate=="Citizens4Cain"){
                print '<td><img src="images/Citizens4Cain.jpg" alt="@Citizens4Cain" /></td>';   
            }
            else {
                print '<td><img src="images/THEHermanCain.jpg" alt="@TheHermanCain" /></td>';   
            }
        }
        elseif (in_array($candidate,$candidateAccounts3))
        {
            if($candidate=="MittRomney"){
                print '<td><img src="images/MittRomney.jpg" alt="@MittRomney" /></td>';   
            }
            else if($candidate=="Mittisms"){
                print '<td><img src="images/Mittisms.jpg" alt="@Mittisms" /></td>';   
            }
            else if($candidate=="RomneyCentral"){
                print '<td><img src="images/RomneyCentral.jpg" alt="@RomneyCentral" /></td>';   
            }
            else if($candidate=="PlanetRomney"){
                print '<td><img src="images/PlanetRomney.jpg" alt="@PlanetRomney" /></td>';   
            }
            else {
                print '<td><img src="images/MittRomney.jpg" alt="@MittRomnney" /></td>';   
            }
        }
        elseif (in_array($candidate,$candidateAccounts4))
        {
            if($candidate=="RonPaul"){
                print '<td><img src="images/RonPaul.jpg" alt="@RonPaul" /></td>';   
            }
            else if($candidate=="RepRonPaul"){
                print '<td><img src="images/RepRonPaul.jpg" alt="RepRonPaul" /></td>';   
            }
            else if($candidate=="RonPaul_2012"){
                print '<td><img src="images/RonPaul_2012.jpg" alt="@RonPaul_2012" /></td>';   
            }
            else if($candidate=="RonPaulForums"){
                print '<td><img src="images/RonPaulForums.jpg" alt="@RonPaulForums" /></td>';   
            }
            else if($candidate=="RonPaulNews"){
                print '<td><img src="images/RonPaulNews.jpg" alt="@RonPaulNews" /></td>';   
            }
            else if($candidate=="RonPaul4Liberty"){
                print '<td><img src="images/RonPaul4Liberty.jpg" alt="@RonPaul4Liberty" /></td>';   
            }
            else {
                print '<td><img src="images/RonPaul.jpg" alt="@ronpaul" /></td>';   
            }
        }
        elseif (in_array($candidate,$candidateAccounts5))
        {
            print '<td><img src="images/RickSantorum.jpg" alt="@RickSantorum" /></td>';
        }
        elseif (in_array($candidate,$candidateAccounts6))
        {
            if($candidate=="MicheleBachmann"){
                print '<td><img src="images/MicheleBachmann.jpg" alt="@MicheleBachmann" /></td>';   
            }
            else if($candidate=="TeamBachmann"){
                print '<td><img src="images/TeamBachmann.jpg" alt="TeamBachmann" /></td>';   
            }
            else {
                print '<td><img src="images/MicheleBachmann.jpg" alt="@michelebachmann" /></td>';   
            }
        }
        elseif (in_array($candidate,$candidateAccounts7))
        {
            if($candidate=="NewtGingrich"){
                print '<td><img src="images/NewtGingrich.jpg" alt="@NewtGingrich" /></td>';   
            }
            else if($candidate=="Newt2012HQ"){
                print '<td><img src="images/Newt2012HQ.jpg" alt="@Newt2012HQ" /></td>';   
            }
            else if($candidate=="NewtG_News"){
                print '<td><img src="images/NewtG_News.jpg" alt="@NewtG_News" /></td>';   
            }
            else {
                print '<td><img src="images/NewtGingrich.jpg" alt="@NewtGingrich" /></td>';   
            }
        }
        elseif (in_array($candidate,$candidateAccounts8))
        {
            print '<td><img src="images/GovGaryJohnson.jpg" alt="@GovGaryJohnson" /></td>';
        }
        elseif (in_array($candidate,$candidateAccounts9))
        {
            if($candidate=="GovernorPerry"){
                print '<td><img src="images/GovernorPerry.jpg" alt="@GovernorPerry" /></td>';   
            }
            else if($candidate=="TeamRickPerry"){
                print '<td><img src="images/TeamRickPerry.jpg" alt="@TeamRickPerry" /></td>';   
            }
            else if($candidate=="PerryTruthTeam"){
                print '<td><img src="images/PerryTruthTeam.jpg" alt="@PerryTruthTeam" /></td>';   
            }
            else if($candidate=="TexGov"){
                print '<td><img src="images/TexGov.jpg" alt="@TexGov" /></td>';   
            }
            else {
                print '<td><img src="images/MittRomney.jpg" alt="@MittRomnney" /></td>';   
            }
        }
        elseif (in_array($candidate,$candidateAccounts10))
        {
            if($candidate=="JonHuntsman"){
                print '<td><img src="images/JonHuntsman.jpg" alt="@JonHuntsman" /></td>';   
            }
            else if($candidate=="Jon2012HQ"){
                print '<td><img src="images/Jon2012HQ.jpg" alt="@Jon2012HQ" /></td>';   
            }
            else if($candidate=="JonHuntsman12"){
                print '<td><img src="images/JonHuntsman12.jpg" alt="@JonHuntsman12" /></td>';   
            }           
            else {
                print '<td><img src="images/JonHuntsman.jpg" alt="@JonHuntsman" /></td>';   
            }
        }
    }

    static function candidateTwitterAccounts ($candidate) {

        if ($candidate == "BarackObama") {
            print '@BarackObama<br/>@TheDemocrats<br/>@BarackObamaUSA<br/>@ObamaPalooza';

        } elseif ($candidate == "THEHermanCain") {
            print '@THEHermanCain<br/>@CainStaff<br/>@Citizens4Cain';

        } elseif ($candidate == "MittRomney") {
            print '@MittRomney<br/>@RomneyCentral<br/>@PlanetRomney<br/>@AmericaNeedsMR<br/>@Mittisms';

        } elseif ($candidate == "RonPaul") {
            print '@RonPaul<br/>@RepRonPaul<br/>@RonPaul_2012<br/>@RonPaulForums<br/>@RonPaulNews<br/>@RonPaul4Liberty';

        } elseif ($candidate == "MicheleBachmann") {
            print '@MicheleBachmann<br/>@TeamBachmann';

        } elseif ($candidate == "NewtGingrich") {
            print '@NewtGingrich<br/>@Newt2012HQ<br/>@NewtG_News';

        } elseif ($candidate == "GovGaryJohnson") {
            print '@GovGaryJohnson';

        } elseif ($candidate == "GovernorPerry") {
            print '@GovernorPerry<br/>@TeamRickPerry<br/>@PerryTruthTeam<br/>@TexGov';

        } elseif ($candidate == "JonHuntsman") {
            print '@JonHuntsman<br/>@Jon2012HQ<br/>@JonHuntsman12';

        } elseif ($candidate == "RickSantorum") {
            print '@RickSantorum';
        }
    }
}
?>
