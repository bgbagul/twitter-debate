<?php
class Display
{
    static function candidateImage ($candidate)
    {
        if ($candidate == "MittRomney")
        {
            print '<td><img src="images/romney.jpg" alt="@mittromney" /></td>';
        }
        elseif ($candidate == "BarackObama")
        {
            print '<td><img src="images/obama.jpg" alt="@barackobama" /></td>'; 
        }
        elseif ($candidate == "THEHermanCain")
        {
            print '<td><img src="images/cain.jpg" alt="@THEHermanCain" /></td>'; 
        }
        elseif ($candidate == "RonPaul")
        {
            print '<td><img src="images/paul.jpg" alt="@RonPaul" /></td>'; 
        }
        elseif ($candidate == "RickSantorum")
        {
            print '<td><img src="images/perry.jpg" alt="@RickSantorum" /></td>'; 
        }
        elseif ($candidate == "MicheleBachmann")
        {
            print '<td><img src="images/bachmann.jpg" alt="@MicheleBachmann" /></td>'; 
        }
        elseif ($candidate == "NewtGingrich")
        {
            print '<td><img src="images/gingrich.jpg" alt="@NewtGingrich" /></td>'; 
        }
        elseif ($candidate == "GovGaryJohnson")
        {
            print '<td><img src="images/johnson.jpg" alt="@GovGaryJohnson" /></td>'; 
        }
        elseif ($candidate == "GovernorPerry")
        {
            print '<td><img src="images/perry.jpg" alt="@GovernorPerry" /></td>'; 
        }
        elseif ($candidate == "JonHuntsman")
        {
            print '<td><img src="images/huntsman.jpg" alt="@JonHuntsman" /></td>'; 
        }
    }
}
?>