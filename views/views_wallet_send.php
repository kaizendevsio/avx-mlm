<!--FAQS PAGE-->
<div id="views_wallet_send" class="page animated slideInUp w3-col m8 l9" style=" z-index:1200">
    <div class="page_bkg" style="background-color: #FFA000">
        <div class="page_menu">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:20px; font-weight:600; margin-top:3px;">Withdraw</h5>

            <div style=" position:absolute ; width:100%; left:0; padding-right:15px">
                <i class="fa fa-times" onclick="close_view_card('views_wallet_send');" style="color: white; font-size: 24px; float:right"></i>
                <!--<i class="fa fa-user" onclick="showProfile();" style="color: white; font-size: 24px; float: right; margin-top: 5px; "></i>-->
            </div>

        </div>

        <div id="feed_body" class="feed_body">
            <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12 animated fadeInUpBig" style="border-bottom: solid 3px #b71c1c;">
                <h5 style="color:#b71c1c; font-weight:600">Cashout Balance</h5>
                <p style="color:#777; font-size:12px;"><strong>Select your withdrawal outlet</strong></p>
                <select id="views_wallet_send_mode" class="w3-select" style="margin-bottom:15px; border-bottom:solid 1px #f44336 !important">
                    <option value="BDO Bank Transfer">BDO Bank Transfer</option>
                    <option value="BPI Bank Transfer">BPI Bank Transfer</option>
                    <option value="Metro Bank Transfer">Metro Bank Transfer</option>
                    <option value="Security Bank Transfer">Security Bank Transfer</option>
                    <option value="East West Bank Transfer">East West Bank Transfer</option>
                    <option value="Cebuana Lhuillier">Cebuana Lhuillier</option>
                    <option value="LBC PesoPack">LBC PesoPack</option>
                    <option value="G Cash">G Cash</option>
                    <option value="Smart Padala">Smart Padala</option>

                </select>

                <p style="color:#777; font-size:12px;"><strong>Account Deteils</strong></p>
                <input id="views_wallet_send_detail" class="w3-input w3-border-bottom w3-border-red" type="text" name="name" placeholder="Ex. Bank Account #, full name, phone #" value="" />
                
                <p style="color:#777; margin-top:15px; font-size:12px;"><strong>Total amount you want to withdraw</strong></p>
                <input id="views_wallet_send_amount" class="w3-input w3-border-bottom w3-border-red" type="number" name="name" placeholder="Amount in PHP" value="" />

                <p onclick="account.cashout();" class="w3-hover-shadow" style="border-radius: 3px;color: white;margin-top: 15px; outline:none!important; outline-color:white!important; padding-left: 15px;padding-top: 10px;padding-bottom: 10px;background-color: #b71c1c;width: max-content; padding-right:15px;"><b>Request Withdrawal</b></p>


            </div>


        </div>
    </div>
</div>