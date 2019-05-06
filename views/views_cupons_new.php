<!--FAQS PAGE-->
<div id="views_cupons_new" class="page animated slideInUp w3-col m8 l9" style=" z-index:1200">
    <div class="page_bkg" style="background-color: #FFA000">
        <div class="page_menu">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:20px; font-weight:600; margin-top:3px;">Buy New Cupon</h5>

            <div style=" position:absolute ; width:100%; left:0; padding-right:15px">
                <i class="fa fa-times" onclick="close_view_card('views_cupons_new');" style="color: white; font-size: 24px; float:right"></i>
                <!--<i class="fa fa-user" onclick="showProfile();" style="color: white; font-size: 24px; float: right; margin-top: 5px; "></i>-->
            </div>

        </div>

        <div id="feed_body" class="feed_body">
            <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12 animated fadeInUpBig" style="border-bottom: solid 3px #b71c1c;">
                <h5 style="color:#b71c1c; font-weight:600">Choose Payment Method</h5>
                <p style="color:#777; font-size:12px;"><strong>Select your payment outlet</strong></p>
                <select id="tx_pay_method" class="w3-select" style="margin-bottom:15px; border-bottom:solid 1px #f44336 !important">
                    <option value="BITCOIN">Crypto Currency - Bitcoin</option>
                    <option value="BANK_BDO">BDO Bank Transfer</option>
                    <option value="BANK_BPI">BPI Bank Transfer</option>
                    <option value="CEBUANA">Cebuana Lhuillier</option>
                    <option value="LBC">LBC PesoPack</option>
                </select>

                <p style="color:#777; font-size:12px;"><strong>Select cupon type</strong></p>
                <select id="tx_pay_ctype" class="w3-select" style="margin-bottom:15px; border-bottom:solid 1px #f44336 !important">
                    <option value="SILVER">SILVER</option>
                    <option value="GOLD">GOLD</option>
                </select>

                <p style="color:#777; font-size:12px;"><strong>Total number you want to buy</strong></p>
                <input id="tx_pay_count" class="w3-input w3-border-bottom w3-border-red" type="number" name="name" placeholder="Number of cupons" value="1" />

                <p onclick="payment.new()" class="w3-hover-shadow" style="border-radius: 3px;color: white;margin-top: 15px; outline:none!important; outline-color:white!important; padding-left: 15px;padding-top: 10px;padding-bottom: 10px;background-color: #b71c1c;width: max-content; padding-right:15px;"><b>Proceed Payment</b></p>


            </div>


        </div>
    </div>
</div>