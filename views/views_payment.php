<!--FAQS PAGE-->
<div id="views_payment" class="page animated slideInUp w3-col m8 l9" style=" z-index:1200">
    <div class="page_bkg" style="background-color: #FFA000">
        <div class="page_menu">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:17px; font-weight:bold; margin-top:3px; margin-top:3px; margin-top:0px;">Payment</h5>
            <p style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; margin-top:22px; font-size:10px;">Secured Transaction</p>

            <div style=" position:absolute ; width:100%; left:0; padding-right:15px">
                <i class="fa fa-times" onclick="close_view_card('views_payment');" style="color: white; font-size: 24px; float:right"></i>
                <!--<i class="fa fa-user" onclick="showProfile();" style="color: white; font-size: 24px; float: right; margin-top: 5px; "></i>-->
            </div>

        </div>

        <div id="feed_body" class="feed_body">
            <div id="payment_basic" class="dash_cards w3-card-2 w3-round w3-container w3-padding-12 animated fadeInUpBig" style="border-bottom: solid 3px #b71c1c;">
                <h5 style="color:#b71c1c; font-weight:600">Payment Instruction</h5>
                <p style="color:#777; font-size:12px;">Take a photo of the receipt and attach the file here</p>

                <div class="geneology_card_blank" onclick="views.showCard('views_cupons_new');">
                    <h3><strong>+</strong></h3>
                    <p>Add Photo</p>
                </div>

                <p style="color:#777; font-size:12px;"><strong>Transaction / Receipt No.</strong></p>
                <input class="w3-input w3-border-bottom w3-border-red" style="margin-bottom:15px;" type="text" name="name" placeholder="Transaction / receipt no." value="" />

                <p style="color:#777; font-size:12px;"><strong>Transaction Remarks</strong></p>
                <textarea class="w3-input"></textarea>



                <p onclick="" class="w3-hover-shadow" style="border-radius: 3px;color: white;margin-top: 15px; outline:none!important; outline-color:white!important; padding-left: 15px;padding-top: 10px;padding-bottom: 10px;background-color: #b71c1c;width: max-content; padding-right:15px;"><b>Confirm Payment</b></p>


            </div>
            
            <div id="payment_crypto_confirm" class="dash_cards w3-card-2 w3-round w3-container w3-padding-12 animated fadeInUpBig" style="border-bottom: solid 3px #b71c1c;">
                <h5 style="color:#b71c1c; font-weight:600">Payment Summary</h5>
                <p style="color:#777; font-size:12px;">Check all the details before proceeding to payment</p>
                <hr />

                <p style="color:#777; font-size:12px;"><strong>Payment Method</strong></p>
                <h4><b><span id="tx_pay_display_method"></span></b></h4>
                
                <p style="color:#777; font-size:12px;"><strong>Coupon Type:</strong></p>
                <h4><b><span id="tx_pay_display_ctype"></span></b></h4>
                
                <p style="color:#777; font-size:12px;"><strong>Total Coupons to buy:</strong></p>
                <h4><b><span id="tx_pay_display_count">0</span></b> pcs</h4>
               
                <br />

                <p style="color:#777; font-size:14px;"><strong>Total amount to pay:</strong></p>
                <h3><b><span id="tx_pay_display_payAmount">0.00</span></b> PHP</h3>

                <br />  
                <p onclick="" class="w3-hover-shadow" style="border-radius: 3px;color: white;margin-top: 15px; outline:none!important; outline-color:white!important; padding-left: 15px;padding-top: 10px;padding-bottom: 10px;background-color: #b71c1c;width: max-content; padding-right:15px;"><b>Confirm Payment</b></p>


            </div>


        </div>
    </div>
</div>