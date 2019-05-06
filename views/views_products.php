<!--PRODUCTS PAGE-->
<div id="views_products" class="page animated slideInUp w3-col m8 l9" style=" z-index:1200">
    <div class="page_bkg" style="background-color: #FFA000">
        <div class="page_menu">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:20px; font-weight:600; margin-top:3px;">Products</h5>

            <div style=" position:absolute ; width:100%; left:0; padding-right:15px">
                <i class="fa fa-times" onclick="close_view_card('views_products');" style="color: white; font-size: 24px; float:right"></i>
                <!--<i class="fa fa-user" onclick="showProfile();" style="color: white; font-size: 24px; float: right; margin-top: 5px; "></i>-->
            </div>

        </div>

        <div id="feed_body" class="feed_body" style="padding-left:25px; padding-right:25px">
            <div class="w3-row">

                <div onclick="//views.showCard('views_received_products');" class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:white; color:#b71c1c">
                    <div class="w3-row">
                        <div class="w3-col s4 l4 m4" style="text-align:center;  padding-top:25px;">
                            <i class="fas fa-shopping-cart" onclick="" style="color:#b71c1c"></i>
                        </div>
                        <div class="w3-col s7 l7 m7">
                            <h3>My Products</h3>
                            <p><span id="views_products_confirmed_products">0</span> Items</p>
                        </div>
                    </div>


                    
                   <div id="unconfirmed_products" class="w3-row w3-container" style="padding-bottom:15px;">
                       <hr />
                       <div>
                           <h6 style="color:#999; margin-bottom:5px; margin-top:0px">You have pending <span id="pending_products">0</span> products</h6>
                           <!--<h5 class="w3-round" onclick="views.showCard('views_received_products');" style="margin:0px; padding:5px 0px; color:#b71c1c;">  <i class="fas fa-align-left" onclick="" style="font-size:12px"></i> View All</h5>-->
                           <h5 id="pending_products_exec" class="w3-round" onclick="account.confirmProducts();" style="margin:0px; padding:5px 0px; color:#b71c1c;">  <i class="fas fa-align-left" onclick="" style="font-size:12px"></i> Confirm Purchase</h5>
                       </div>
                       
                    </div>
                </div>

                <!--STOCKIST MENU-->
                <div id="stockist_menu" onclick="views.switch('views_cashouts', 4);" class="dash_cards w3-card-2 w3-round w3-col s12 m11 l3 animated fadeInUpBig" style="background-color:white; color:rgb(255,152,0); display:none">
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
                <h3 style="color:#333333; margin-top:15px;"><b>dherbs  <br />Products</b></h3>

                <!--<div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12">
                    <div class="w3-row">
                        <h5 style="color:#b71c1c; font-weight:600">Product Name</h5>
                        <p style="color:black; font-size:10px;">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.</p>

                        <h3><span id="">0.00</span> Php</h3>
                    </div>
                    <hr />
                    <div class="w3-row">
                        <h5 class="w3-round" onclick="show_view('views_wallet_send');" style="margin:0px; padding:5px 0px; color:#b71c1c;">  <i class="fas fa-shopping-cart" onclick="" style="font-size:12px"></i> Purchase</h5>
                    </div>
                </div>-->

                 <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12">
                    <div class="w3-row">
                        <div class="w3-col s8 m8 l8">
                            <h5 style="color:#b71c1c; font-weight:600">Magnesium Oil Spray <br /> with MSM (100 ml)</h5>
                            <p style="color:black; font-size:14px;">QUALITY (PHARMACEUTICAL) GRADE” – naturally sourced from the Great Salt Lake, purified and tested to be free from contaminants and contain no heavy metals.  Magnesium Oil with MSM is so pure it’s used as one of the electrolytes in dialysis solutions for kidney patients. </p>
                            
                              <p style="color:black; font-size:14px;">BEST WAY TO BOOST MAGNESIUM LEVELS – the best way to regularly increase levels of magnesium is by applying it transdermally (topically applied to skin)  👉 The skin is the largest organ of the body and anything put ON the skin is absorbed IN the body! (sprayer included) A 20 to 30 minute foot soak in two to four ounces of  Magnesium Oil with MSM will begin delivering Magnesium to every cell in the body INSTANTLY! </p>
                              <p style="color:black; font-size:14px;">WITH OptiMSM  👉 has long been revered as a superior form of sulfur supplementation, but as a topical it enhances cell membrane permeability and may facilitate more efficient uptake of magnesium ions. </p>
                              <p style="color:black; font-size:14px;">QUICKLY ABSORBS 👉 IDEAL FOR SENSITIVE SKIN 👉NO GREASY RESIDUE – Apply or spray your entire body.  </p>
                              <p style="color:black; font-size:14px;">Apply before or after bathing! Let air dry for best results.  Magnesium oil  with MSM may be applied full strength or diluted. Some itching is normal. </p>
 <p style="color:black; font-size:14px;">FAST ACTING RELIEF –  magnesium most notably has been credited with decreasing stress, sustaining a sense of well-being and improving sleep. Lately, studies have shown that magnesium can also boost performance levels, improve skin quality, and even help with headaches, aches and pains, muscle spasms, cramps and restless legs.</p>



                            <h3><span id="">800.00</span> Srp</h3>
                        </div>
                        <div class="w3-col s4 m4 l4">
                            <img src="assets/images/56171749_335525480428182_2538871326056120320_n.jpg" style="width:100%; margin-top:15px; " alt="Alternate Text" />
                        </div>
                       
                    </div>
                    <hr />
                    <div class="w3-row">
                        <h5 class="w3-round" style="margin:0px; padding:5px 0px; color:#b71c1c;">  <i class="fas fa-shopping-cart" onclick="" style="font-size:12px"></i> Purchase</h5>
                    </div>
                </div>

                <div class="dash_cards w3-card-2 w3-round w3-container w3-padding-12">
                    <div class="w3-row">
                        <div class="w3-col s8 m8 l8">
                            <h5 style="color:#b71c1c; font-weight:600">Magnesium Oil Spray <br /> with MSM (125 ml)</h5>
                            <p style="color:black; font-size:14px;">QUALITY (PHARMACEUTICAL) GRADE” – naturally sourced from the Great Salt Lake, purified and tested to be free from contaminants and contain no heavy metals.  Magnesium Oil with MSM is so pure it’s used as one of the electrolytes in dialysis solutions for kidney patients. </p>
                            
                              <p style="color:black; font-size:14px;">BEST WAY TO BOOST MAGNESIUM LEVELS – the best way to regularly increase levels of magnesium is by applying it transdermally (topically applied to skin)  👉 The skin is the largest organ of the body and anything put ON the skin is absorbed IN the body! (sprayer included) A 20 to 30 minute foot soak in two to four ounces of  Magnesium Oil with MSM will begin delivering Magnesium to every cell in the body INSTANTLY! </p>
                              <p style="color:black; font-size:14px;">WITH OptiMSM  👉 has long been revered as a superior form of sulfur supplementation, but as a topical it enhances cell membrane permeability and may facilitate more efficient uptake of magnesium ions. </p>
                              <p style="color:black; font-size:14px;">QUICKLY ABSORBS 👉 IDEAL FOR SENSITIVE SKIN 👉NO GREASY RESIDUE – Apply or spray your entire body.  </p>
                              <p style="color:black; font-size:14px;">Apply before or after bathing! Let air dry for best results.  Magnesium oil  with MSM may be applied full strength or diluted. Some itching is normal. </p>
 <p style="color:black; font-size:14px;">FAST ACTING RELIEF –  magnesium most notably has been credited with decreasing stress, sustaining a sense of well-being and improving sleep. Lately, studies have shown that magnesium can also boost performance levels, improve skin quality, and even help with headaches, aches and pains, muscle spasms, cramps and restless legs.</p>



                            <h3><span id="">950.00</span> Srp</h3>
                        </div>
                        <div class="w3-col s4 m4 l4">
                            <img src="assets/images/56567366_2699441993430632_7062340743448231936_n.jpg" style="width:100%; margin-top:15px; " alt="Alternate Text" />
                        </div>
                       
                    </div>
                    <hr />
                    <div class="w3-row">
                        <h5 class="w3-round" style="margin:0px; padding:5px 0px; color:#b71c1c;">  <i class="fas fa-shopping-cart" onclick="" style="font-size:12px"></i> Purchase</h5>
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