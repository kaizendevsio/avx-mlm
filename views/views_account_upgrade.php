<!--FAQS PAGE-->
<div id="views_account_upgrade" class="page animated slideInUp w3-col m8 l9" style=" z-index:1200">
    <div class="page_bkg" style="background-color: #FFA000">
        <div class="page_menu">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:20px; font-weight:600; margin-top:3px;">Account Upgrade</h5>

            <div style=" position:absolute ; width:100%; left:0; padding-right:15px">
                <i class="fa fa-times" onclick="close_view_card('views_account_upgrade');" style="color: white; font-size: 24px; float:right"></i>
                <!--<i class="fa fa-user" onclick="showProfile();" style="color: white; font-size: 24px; float: right; margin-top: 5px; "></i>-->
            </div>

        </div>

        <div id="feed_body" class="feed_body">
            <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12 animated fadeInUpBig" style="border-bottom: solid 3px #b71c1c;">
                <h5 style="color:#b71c1c; font-weight:600">Upgrade Package</h5>


                <p id="" style="color:#777; font-size:12px;"><strong>Please type in your cupon code</strong></p>

                <input id="views_account_upgrade_cupon" oninput="account.checkTicket()" style="margin-bottom:15px;" class="w3-input w3-border-bottom w3-border-red" type="text" name="name" placeholder="Cupon Code.." value="" />

                <p style="color:#777; font-size:12px;"><strong>Cupon corresponding package</strong></p>
                <select id="views_account_upgrade_select" class="w3-select" style="border-bottom:solid 1px #f44336 !important" disabled="disabled">
                    <option value="CUPONINVALID">CUPON INVALID</option>
                    <option value="BASIC">BASIC</option>
                    <option value="STANDARD">STANDARD</option>
                    <option value="PREMIUM">PREMIUM</option>

                </select>

                <p style="color:#777; font-size:12px; margin-top:15px;"><strong>Total package amount</strong></p>
                <h3 style="color:#777; margin:0px"><b><span id="views_account_upgrade_pckAmt">0.00</span> PHP</b></h3>

                <p onclick="account.upgrade()" class="w3-hover-shadow" style="border-radius: 3px;color: white;margin-top: 25px; outline:none!important; outline-color:white!important; padding-left: 15px;padding-top: 10px;padding-bottom: 10px;background-color: #b71c1c;width: max-content; padding-right:15px;"><b>Upgrade Acount</b></p>


            </div>


        </div>
    </div>
</div>