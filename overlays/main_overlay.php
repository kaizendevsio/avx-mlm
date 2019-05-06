<div id="overlays_main" class="views_header" style="display:none; position:absolute; background-color:transparent; width:43%; right:0; z-index:10000">
    <div class="wow slideInRight" onclick="views.hide('views_lucky_spin');">
        <!-- <i class="fa fa-arrow-left" aria-hidden="true"></i>-->
        <span></span>
       <!-- <img class="w3-circle w3-card-4" style="width:32px; float:right; margin-right:10px; margin-left:10px;" src="assets/images/avatar2.png" />-->
        <i class="far fa-envelope" style="float:right; margin-left:10px; margin-right:10px; margin-top:3px " aria-hidden="true"></i>
        <i class="far fa-bell" style="float:right; margin-left:10px; margin-right:10px; margin-top:3px" aria-hidden="true"></i>

        <div class=" w3-round-xxlarge" style="width: 250px;background-color: #ccc; float: right;height: 32px;margin-top: 3px; margin-right:10px; overflow:hidden">
            <input class="w3-input" style="background-color: #ccc; height:100%; width:215px; border: none; display:inline-block" placeholder="Search" type="text">
            <i class="fas fa-search" style="display: inline-block;float: right;margin: 0px;font-size: 20px;margin-right: 8px;margin-top: 6px;color: #909090!important;" aria-hidden="true"></i>

        </div>

    </div>

</div> 


<div id="overlays_mainTabs" class="animated fadeIn bottomBar w3-col m8 l9" style="display:none; ">

    <div id="tabs_0" class="w3-col s3 m3 l3 button active" style=""  onclick="views.switch('views_main', 2); tabs.switch(this);">
        <i class="fas fa-info-circle" onclick="" style=""></i>
        <p>DASHBOARD</p>
    </div>

    <div id="tabs_1" class="w3-col s3 m3 l3 button" style="" onclick="account.listMembers(null,'downline'); views.switch('views_geneology', 3); tabs.switch(this);">
        <i class="fas fa-network-wired" onclick="" style=""></i>
        <p>GENEOLOGY</p>
    </div>

    <div id="tabs_2" class="w3-col s3 m3 l3 button" style="" onclick="views.switch('views_cashouts', 4); tabs.switch(this);">
        <i class="fab fa-google-wallet" onclick="" style=""></i>
        <p>WALLET</p>
    </div>

    <div id="tabs_3" class="w3-col s3 m3 l3 button" onclick="views.switch('views_myprofile', 5); tabs.switch(this);" style="">
        <i class="far fa-user" onclick="" style=""></i>
        <p>PROFILE</p>
    </div>

</div>

<div id="overlays_mainModal_upgrade" class="w3-modal w3-col m8 l9" style="right:0; left:unset; padding:25px; z-index:10000">
    <div class="w3-modal-content w3-padding-12 w3-card-4 w3-round-large animated zoomInUp  w3-col m11 l11" style="max-width:660px; display:block; margin-left:auto; margin-right:auto">
      <header class="w3-container w3-white w3-round-large" style="overflow:hidden"> 
        <span onclick="document.getElementById('overlays_mainModal_upgrade').style.display='none'" 
        class="w3-button w3-display-topright w3-round-large">&times;</span>
        <h2>Upgrade Package</h2>
      </header>
      <div class="w3-container">
        <h4><b>Select Package</b></h4>
        <p>Choose from the dropdown below the package you want to upgrade to</p>
       
        <select class="w3-select">
            <option value="value">BASIC</option>
            <option value="value">STANDARD</option>
            <option value="value">PREMIUM</option>
        </select>
      </div>
      <footer class="w3-container w3-white">
          <div class="w3-row">
              <button class="w3-button w3-round-large w3-col s3 m4 l4 w3-red w3-margin-top">Cancel</button>
              <button class="w3-button w3-round-large w3-col s5 m5 l4 w3-green w3-margin-top w3-margin-left">Continue to payment</button>
          </div>
      </footer>
    </div>
  </div>