<!--WALLET PAGE-->
<div id="views_cashouts" class="page animated slideInRight w3-col m8 l9">
    <div class="page_bkg" style="">
        <div class="page_menu" style="background-color:rgb(103,58,183);">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:17px; font-weight:bold; margin-top:3px; margin-top:3px; margin-top:0px;">Wallet</h5>
            <p style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; margin-top:22px; font-size:10px;">Manage your transactions</p>

            <div style="  position:absolute ; width:100%; left:0; padding-right:15px;padding-left:15px">
                <i class="fa fa-align-left" onclick="showSidebar();" style="font-size: 24px; float: left; margin-top: 5px; "></i>
                <i class="far fa-bell" onclick="views.show('views_notifications');" style="font-size: 24px; float: right; margin-top: 5px; "></i>
            </div>
        </div>

        <div id="feed_body" class="feed_body" style="overflow-x:hidden; padding-bottom:100px">
            <p></p>
            <div id="" class="w3-center w3-centered dash_temp" style=" display: block;height: max-content; margin: 0 auto; ">


                <div class="dash_cards color red w3-card-2 w3-round w3-container w3-padding-12" style="background-color:#f44336; color:white">
                    <h5 style="color:white; font-weight:600">Available Balance</h5>
                    <p style="color:white; font-size:10px;">Total amount you can cashout</p>

                    <h3><span id="views_wallet_mainBalance">0.00</span> PHP</h3>
                    <hr />
                    <div class="w3-round w3-padding w3-center animated fadeInUp" style="height: max-content; background-color:#ff6a5f !important; animation-delay:.4s">
                    <h5 class="w3-round" onclick="show_view('views_wallet_send');" style="margin:0px; padding:15px 0px">Cashout</h5>
                </div>

                </div>


                <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12" style="background-color:#1E88E5; color:white">
                    <h5 style="color:white; font-weight:600">Direct Referal Bonus</h5>
                    <p style="color:white; font-size:10px;">Total amount you earned from directs</p>

                    <h3><span id="views_wallet_drBalance">0.00</span> PHP</h3>

                </div>

                <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12" style="background-color:#FFB300; color:white">
                    <h5 style="color:white; font-weight:600">Pairing Bonus</h5>
                    <p style="color:white; font-size:10px;">Total amount you earned from matches</p>

                    <h3><span id="views_wallet_prbBalance">0.00</span> PHP</h3>

                </div>

                <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12" style="background-color:#4CAF50; color:white">
                    <h5 style="color:white; font-weight:600">5th Pair Bonus</h5>
                    <p style="color:white; font-size:10px;">Total amount you earned from passive</p>

                    <h3><span id="views_wallet_5h_prbBalance">0.00</span> PHP</h3>

                </div>

                <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12" style="background-color:#3D5AFE; color:white">
                    <h5 style="color:white; font-weight:600">Total Cashouts</h5>
                    <p style="color:white; font-size:10px;">Total amount you already withdrawn</p>

                    <h3><span id="views_wallet_cashoutBalance">0.00</span> PHP</h3>

                </div>


                <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12" style="background-color:#C0CA33; color:white">
                    <h5 style="color:white; font-weight:600">Pending for withdrawal</h5>
                    <p style="color:white; font-size:10px;">Amount on proccess for withdraw</p>

                    <h3><span id="views_wallet_pendingBalance">0.00</span> PHP</h3>

                </div>

                <!--<div class="w3-round w3-padding w3-center animated fadeInUp" style="height: max-content; background-color: white !important; animation-delay:.4s">
                    <h5 class="w3-hover-light-gray w3-round" onclick="show_view('views_wallet_send');" style="margin:0px; padding:15px 0px">Cashout</h5>
                </div>-->

                

            </div>



            <!--<i class="fa fa-google-wallet w3-display-topmiddle" style="color: gray; font-size: 92px; z-index: 1300; color: rgba(255, 255, 255, 0.21)"></i>-->

        </div>
    </div>
</div>