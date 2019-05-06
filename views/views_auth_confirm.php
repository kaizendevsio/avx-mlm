<!--AUTH CONFIRM PAGE-->
<div id="win_popup" class="page animated fadeIn" style="z-index: 2100; background-color: rgba(0, 0, 0, 0.0);">
    <div class="page_bkg" style="background-color: rgba(0, 0, 0, 0.50); padding-top:35vh">
        <!--<div class="page_menu">
            <i class="fa fa-chevron-left" onclick="close_view('pages_geneology');" style="color: white; font-size: 24px"></i>
            <h5 style="margin-left:auto;margin-right:auto; color:white; text-align:center; display:inline-block; width:90%; font-size:20px; font-weight:600">Geneology</h5>
        </div>-->

        <div id="popupWin" class="popup zoomin w3-center">
            <h4 style=" color: #00a9ff; padding-top:15px">Authenticate Output</h4>

            <p>Please enter your password to continue</p>

            <input id="authpass" oninput="" class="w3-input w3-border w3-round w3-white" style="width:80%; font-size:12px; text-align:center; margin-left:auto; margin-right:auto; outline:none" type="password">
            <hr style="margin-bottom:10px; margin-top:10px" />

            <button class="w3-button w3-light-gray w3-round w3-ripple" onclick="cashOutAuth_Check();" style="width:40%; margin-bottom:10px; color:#00a9ff!important">Continue</button>
            <button class="w3-button w3-light-gray w3-round w3-ripple" onclick="cashOutAuthClose();" style="width:40%; margin-bottom:10px">Cancel</button>


        </div>

        <!--<div id="feed_body" class="feed_body" style="background-color:rgba(0, 0, 0, 0.00)">


        </div>-->
    </div>
</div>