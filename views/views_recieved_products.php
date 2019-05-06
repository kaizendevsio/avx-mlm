<!--PRODUCTS PAGE-->
<div id="views_received_products" class="page animated slideInUp w3-col m8 l9" style=" z-index:1200">
    <div class="page_bkg" style="background-color: #FFA000">
        <div class="page_menu">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:20px; font-weight:600; margin-top:3px;">My Products</h5>

            <div style=" position:absolute ; width:100%; left:0; padding-right:15px">
                <i class="fa fa-times" onclick="close_view_card('views_received_products');" style="color: white; font-size: 24px; float:right"></i>
                <!--<i class="fa fa-user" onclick="showProfile();" style="color: white; font-size: 24px; float: right; margin-top: 5px; "></i>-->
            </div>

        </div>

        <div id="feed_body" class="feed_body" style="padding-left:25px; padding-right:25px">
            <div class="w3-row">

                <div onclick="views.switch('views_cashouts', 4);" class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:white; color:#b71c1c">
                    <div class="w3-row">
                        <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                            <i class="fas fa-shopping-cart" onclick="" style="color:#b71c1c"></i>
                        </div>
                        <div class="w3-col s7 l7 m7">
                            <h3>My Products</h3>
                            <p><span id="views_dashboard_totalEarnings">0</span> Items</p>
                        </div>
                    </div>


                    <hr />
                   <div class="w3-row w3-container" style="padding-bottom:15px;">
                        <h5 class="w3-round" onclick="show_view('views_wallet_send');" style="margin:0px; padding:5px 0px; color:#b71c1c;">  <i class="fas fa-align-left" onclick="" style="font-size:12px"></i> View All</h5>
                    </div>
                </div>

                <!--STOCKIST MENU-->
                <div onclick="views.switch('views_cashouts', 4);" class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:white; color:rgb(255,152,0)">
                    <div class="w3-row">
                        <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                            <i class="fas fa-suitcase" onclick="" style="color:rgb(255,152,0)"></i>
                        </div>
                        <div class="w3-col s7 l7 m7">
                            <h3>My Stocks</h3>
                            <p><span id="views_dashboard_totalEarnings">0</span> Items</p>
                        </div>
                    </div>


                    <hr />
                   <div class="w3-row w3-container" style="padding-bottom:15px;">
                        <h5 class="w3-round" onclick="show_view('views_wallet_send');" style="margin:0px; padding:5px 0px; color:rgb(255,152,0);">  <i class="fas fa-align-left" onclick="" style="font-size:12px"></i> View All</h5>
                    </div>
                </div>
            </div>


            <div class="w3-row animated fadeInUpBig" style="animation-delay:.1s">
                <h3 style="color:#333333; margin-top:15px;"><b>Manna  <br />Products</b></h3>

                <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12">
                    <div class="w3-row">
                        <h5 style="color:#b71c1c; font-weight:600">Product Name</h5>
                        <p style="color:#777; font-size:10px;">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.</p>

                        <h3><span id="">0.00</span> Php</h3>
                    </div>
                    <hr />
                    <div class="w3-row">
                        <h5 class="w3-round" onclick="show_view('views_wallet_send');" style="margin:0px; padding:5px 0px; color:#b71c1c;">  <i class="fas fa-shopping-cart" onclick="" style="font-size:12px"></i> Purchase</h5>
                    </div>
                </div>

                 <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12">
                    <div class="w3-row">
                        <div class="w3-col s8 m8 l8">
                            <h5 style="color:#b71c1c; font-weight:600">Product Name</h5>
                            <p style="color:#777; font-size:10px;">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.</p>

                            <h3><span id="">0.00</span> Php</h3>
                        </div>
                        <div class="w3-col s4 m4 l4">
                            <img src="assets/images/bkg.jpg" style="width:100%; margin-top:15px; " alt="Alternate Text" />
                        </div>
                       
                    </div>
                    <hr />
                    <div class="w3-row">
                        <h5 class="w3-round" onclick="show_view('views_wallet_send');" style="margin:0px; padding:5px 0px; color:#b71c1c;">  <i class="fas fa-shopping-cart" onclick="" style="font-size:12px"></i> Purchase</h5>
                    </div>
                </div>
            </div>


            <!--
    <div class="geneology_card_blank" onclick="views.showCard('views_cupons_new');">
        <h3><strong>New Cupon</strong></h3>
        <p>Tap to buy new cupon</p>
    </div>-->
            <!--<h3 style="font-weight:600; color:#b71c1c">Coming Soon..</h3>
    <br />
    <h5 style="color:#999; font-weight:100">You will be able to purchase products straight from the app soon.</h5>-->


        </div>
    </div>
</div>