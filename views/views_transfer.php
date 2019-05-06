<!--TRANSFER PAGE-->
<div id="pages_transfer" class="page animated slideInUp w3-col m8 l9" style="-webkit-animation-duration: .3s !important; z-index:1200">
    <div class="page_bkg" style="background-color: #FFA000">
        <div class="page_menu">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:20px; font-weight:600; margin-top:3px;">Transfer</h5>

            <div style="  position:absolute ; width:100%; left:0; padding-right:15px;padding-left:15px">
                <i class="fa fa-times" onclick="close_view_card('pages_transfer');" style=" color: white; font-size: 24px; margin-top: 4px; float: right;"></i>
                <!--<i class="fa fa-user" onclick="showProfile();" style="color: white; font-size: 24px; float: right; margin-top: 5px; "></i>-->
            </div>
        </div>

        <div id="feed_body" class="feed_body" style="-webkit-animation-duration: .8s !important">

            <h3>Send to other wallet</h3>
            <hr />

            <p>RECIPIENT BTC ADDRESS</p>
            <input id="walletSendRecp" oninput="" class="w3-input w3-border w3-round w3-white" style="width:90%; font-size:18px; text-align:left; outline:none" type="text">

            <br />
            <p>AMOUNT TO SEND</p>
            <input id="walletSendAmt" oninput="" class="w3-input w3-border w3-round w3-white" style="width: 50%; font-size: 18px; text-align: left; outline: none" type="number">

            <br />
            <button id="wallet_send_btn" class="w3-button w3-light-gray w3-round w3-padding-16 w3-ripple" onclick="cashOutAuth('sendBTC');" style="width:40%; margin-bottom:25px">SEND</button>

            <div class="loader" style="display: none; " id="loader_send"></div>

            <h6 style="text-align: center; color: #BDBDBD; margin-top:15px">CoinCrypt 2017</h6>

        </div>
    </div>
</div>