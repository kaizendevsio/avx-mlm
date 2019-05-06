<!--FEED PAGE-->
<div id="views_main" class="animated slideInRight w3-col m8 l9" style="display: none; float:right">
    <div class="page_menu" style="">
        <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:17px; font-weight:bold; margin-top:3px; margin-top:3px; margin-top:0px;">Dashboard</h5>
        <p style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; margin-top:22px; font-size:10px;">D Herbs</p>

        <div style=" position:absolute ; width:100%; left:0; padding-right:15px;padding-left:15px">
            <i class="fa fa-align-left" onclick="showSidebar();" style="font-size: 24px; float: left; margin-top: 5px; "></i>
            <i class="far fa-bell" onclick="views.show('views_notifications');" style="font-size: 24px; float: right; margin-top: 5px; "></i>

        </div>
    </div>

    <!--FEED BODY-->
    <div id="feed_body" class="feed_body w3-centered w3-center" style="overflow-x:hidden">
        <!--<h6 style="text-align: center; color: #BDBDBD; margin-top:15px">No threads available</h6>-->
        <div id="" class="w3-center w3-centered dash_temp" style=" display: block;height: 100%; width:100%; margin: 0 auto;">

            <div onclick="views.switch('views_cashouts', 4);" class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:rgb(103,58,183); color:white">
                <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                    <i class="fab fa-google-wallet" onclick="" style=""></i>
                </div>
                <div class="w3-col s7 l7 m7">
                    <h3>Total Earnings</h3>
                    <p><span id="views_dashboard_totalEarnings">0.0</span> PHP</p>
                </div>

            </div>

            <div onclick="views.showCard('views_geneology_directs'); account.listMembers(true, 'directs');" class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:rgb(255,152,0); color:white; animation-delay:.1s">
                <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                    <i class="fas fa-users" onclick="" style=""></i>
                </div>
                <div class="w3-col s7 l7 m7">
                    <h3>Directs Referrals</h3>
                    <p><span id="views_dashboard_directs">0</span> People</p>
                </div>

            </div>

            <div onclick="views.showCard(''); //account.listMembers(true, 'directs');" class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:#E91E63; color:white; animation-delay:.2s">
                <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                    <i class="fas fa-network-wired" onclick="" style=""></i>
                </div>
                <div class="w3-col s7 l7 m7">
                    <h3>Pairing Bonus</h3>
                    <p><span id="views_dashboard_pairs">0</span> Total Pairs</p>
                </div>

            </div>

            <div onclick="listUsers(null,'downline'); views.switch('views_geneology', 3);" class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:rgb(33,150,243); color:white; animation-delay:.3s">
                <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                    <i class="fas fa-tags" onclick="" style=""></i>
                </div>
                <div class="w3-col s7 l7 m7">
                    <h3>My Networks</h3>
                    <p>You have <span id="views_dashboard_dl">0</span> people under you</p>
                </div>
            </div>

            <div class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:#b71c1c; color:white; animation-delay:.4s">
                <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                    <i class="far fa-clock" onclick="" style=""></i>
                </div>
                <div class="w3-col s7 l7 m7">
                    <h3><span id="views_dashboad_accountPackage">STANDARD</span></h3>
                    <p>This is your account package</p>
                </div>

            </div>

            <div class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" onclick="copyToClipboard('views_dashboard_reflink')" style="background-color:rgb(76,175,80); color:white; animation-delay:.5s">
                <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                    <i class="fas fa-link" onclick="" style=""></i>
                </div>
                <div class="w3-col s7 l7 m7">
                    <h3>Referral Link</h3>
                    <input class="w3-input w3-white" style="border:none!important; padding:0px; color:rgb(76,175,80)!important" id="views_dashboard_reflink" value="Loading referral Link.." />
                    <p style="border-radius: 3px;color: #4daf51;margin-top: 9px; outline:none!important; outline-color:white!important; padding-left: 15px;padding-top: 5px;padding-bottom: 5px;background-color: white;width: 105px;">Tap to copy</p>
                </div>

            </div>




        </div>

    </div>

</div>