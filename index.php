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

    <h1> </br>

        <font size="35px" color="black">twitter</font>
        <font size="35px" color="red">debate</font>
    </h1>

    <body>

        <style type="text/css">

            div.containermittstweets {
                background-color: #fff;
                height: 95px;
                float:left;
            }

            div.mittstweets
            {
                float:left;
                width:75%;
                background-color: #99ED9C;
                color: black;
                border-bottom: 1px solid lightGrey;
                margin-bottom: 5px;
                padding: 10px;
                -moz-border-radius: 25px;
            }

            div.containerbarackstweets {
                background-color: #fff;
                height: 95px;
                float:right;
            }

            div.barackstweets
            {
                float:right;
                width:75%;
                background-color: #B8B8B8;
                color: black;
                border-bottom: 1px solid lightGrey;
                margin-bottom: 5px;
                padding: 10px;
                -moz-border-radius: 25px;
            }

            div.account
            {
                color:black;
                font:normal 10px/1.8em Arial, Helvetica, sans-serif;
            }
            div.date
            {
                color:black;
                font:normal 10px/1.8em Arial, Helvetica, sans-serif;
                text-align:right;
            }
            div.img
            {
              margin: 2px;
              border: 0px solid #0000ff;
              height: 125px;
              width: 125px;
              float: left;
              text-align: center;
            }
            div.img img
            {
              display: inline;
              margin: 3px;
              border: 1px solid #ffffff;
            }
            div.img a:hover img {
                border: 0px solid #0000ff;
            }
            div.desc
            {
              text-align: center;
              font-weight: normal;
              width: 120px;
              margin: 2px;
            }

        </style>


        <div style="width:100%;height:175px; border-bottom:2px solid lightgrey">
            <div class="img">
                <img src="images/NewtGingrich.jpg" alt="Newt Gingrich" width="125" height="125" />
                <div class="desc">Newt Gingrich</div></div>
            <div class="img">
                <img src="images/TeamBachmann.jpg" alt="Team Bachman" width="125" height="125" />
                <div class="desc">Michelle Bachmann</div></div>
            <div class="img">
                <img src="images/CainStaff.jpg" alt="Cain Staff" width="125" height="125" />
                <div class="desc">Herman Cain</div></div>
            <div class="img">
                <img src="images/MittRomney.jpg" alt="Mitt Romney" width="125" height="125" />
                <div class="desc">Mitt Romney</div></div>
            <div class="img">
                <img src="images/GovGaryJohnson.jpg" alt="Gary Johnson" width="125" height="125" />
                <div class="desc">Gary Johnson</div></div>
            <div class="img">
                <img src="images/GovernorPerry.jpg" alt="Rick Perry" width="125" height="125" />
                <div class="desc">Rick Perry</div></div>
            <div class="img">
                <img src="images/RickSantorum.jpg" alt="Rick Santorum" width="125" height="125" />
                <div class="desc">Rick Santorum</div></div>
            <div class="img">
                <img src="images/JonHuntsman.jpg" alt="Jon Huntsman" width="125" height="125" />
                <div class="desc">Jon Huntsman</div></div>
            <div class="img">
                <img src="images/RonPaul.jpg" alt="Ron Paul" width="125" height="125" />
                <div class="desc">Ron Paul</div></div>
            <div class="img">
                <img src="images/BarackObama.jpg" alt="Barack Obama" width="125" height="125" />
                <div class="desc">Barack Obama
                </div>
            </div>
        </div>

        <div style="font-size:35px;text-align:center;height:85px;line-height:35px;margin-top:10px;">
            <span style="float:left; margin-left:150px;">
                Debating Now:
                </br>
                Romney vs. Obama on JOBS
            </span>
            <span style="float:right; color:black; margin-right:50px">
                <div onClick="window.location = 'indexDebate.php'" style="cursor:pointer; background-color:lightGrey; color:red;">More Debates</div>
            </span>
        </div>



        <div class ="containerbarackstweets">
            <table>
                <tr>
            <td>
            <div class="barackstweets">
                President Obama urges Congress to pass the infrastructure section of the American Jobs Act now. Listen live: http://t.co/HXttOyjM
            <table style="width:100%">
            <tr>
                <td>
                   <div class="account"> @BarackObama </div>
                </td>
                <td>
                   <div class="date">  Wed Nov 2 15:16:11  </div>
                </td>
            </tr>
        </table>
            </div>
            </td>
                    <td>
            <img src="images/BarackObama.jpg" alt="BarackObama" width="73px" height="73px" align="middle" />

                    </td>
        </tr>
        </table>
        </div>

        <div class ="containermittstweets">
            <table>
                <tr>
                    <td>
            <img src="images/MittRomney.jpg" alt="Mitt Romney" width="73px" height="73px" align="middle" />
                    </td>
                    <td>
            <div class="mittstweets">
        "Three years later, over 16 million Americans are out of work or have just quit looking. Millions more are underemployed." ~ Mitt Romney

        </br>

        <table style="width:100%">
            <tr>
                <td>
                   <div class="account"> @Mittisms </div>
                </td>
                <td>
                   <div class="date"> Wed Nov 2 13:02:32  </div>
                </td>
            </tr>
        </table>
        </div>
            </div>
                    </td>
                    </tr>

        </table>
        </div>




        <div class ="containerbarackstweets">
                <table>
                    <tr>
                <td>
                <div class="barackstweets">
                    What a Jobs Plan Looks Like: As we continue to climb out of the worst recession since the Great Depression and... http://t.co/fy6KVhSD
                <table style="width:100%">
                <tr>
                    <td>
                       <div class="account"> @BarackObama </div>
                    </td>
                    <td>
                       <div class="date"> Wed Nov 2 10:19:14  </div>
                    </td>
                </tr>
            </table>
                </div>
                </td>

                        <td>
                <img src="images/BarackObama.jpg" alt="BarackObama" width="73px" height="73px" align="middle" />

                        </td>
            </tr>
            </table>
            </div>

            <div class ="containermittstweets">
                <table>
                    <tr>
                        <td>
                <img src="images/MittRomney.jpg" alt="Mitt Romney" width="73px" height="73px" align="middle" />
                        </td>
                        <td>
                <div class="mittstweets">
                "The White House has still not crafted any discernible plan to put Americans back to work." ~ Mitt Romney #tcot #gop #teaparty #tlot #p2
                <table style="width:100%">
                <tr>
                    <td>
                       <div class="account"> @Mittisms </div>
                    </td>
                    <td>
                       <div class="date"> Wed Nov 2 04:06:10  </div>
                    </td>
                </tr>
            </table>

                </div>
                </td>
            </tr>
            </table>
        </div>

    </body>

</html>