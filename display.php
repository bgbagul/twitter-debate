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
            print '<td><img src="images/obama.jpg" alt="@barackobama" /></td>'; 
            
        }
        elseif (in_array($candidate,$candidateAccounts2))
        {
            print '<td><img src="images/cain.jpg" alt="@THEHermanCain" /></td>'; 
        }
        elseif (in_array($candidate,$candidateAccounts3))
        {
            print '<td><img src="images/romney.jpg" alt="@mittromney" /></td>';
        }
        elseif (in_array($candidate,$candidateAccounts4))
        {
            print '<td><img src="images/paul.jpg" alt="@RonPaul" /></td>'; 
        }
        elseif (in_array($candidate,$candidateAccounts5))
        {
            print '<td><img src="images/perry.jpg" alt="@RickSantorum" /></td>'; 
        }
        elseif (in_array($candidate,$candidateAccounts6))
        {
            print '<td><img src="images/bachmann.jpg" alt="@MicheleBachmann" /></td>'; 
        }
        elseif (in_array($candidate,$candidateAccounts7))
        {
            print '<td><img src="images/gingrich.jpg" alt="@NewtGingrich" /></td>'; 
        }
        elseif (in_array($candidate,$candidateAccounts8))
        {
            print '<td><img src="images/johnson.jpg" alt="@GovGaryJohnson" /></td>'; 
        }
        elseif (in_array($candidate,$candidateAccounts9))
        {
            print '<td><img src="images/perry.jpg" alt="@GovernorPerry" /></td>'; 
        }
        elseif (in_array($candidate,$candidateAccounts10))
        {
            print '<td><img src="images/huntsman.jpg" alt="@JonHuntsman" /></td>'; 
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