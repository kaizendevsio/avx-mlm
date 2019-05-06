<!--SIDEBAR PAGE-->
<div id="pages_sidebar" class="sidebar-off animated slideInLeft w3-col m4 l3" style="overflow:hidden; -webkit-animation-duration:.3s; z-index:1999;">

    <div class="page_menu" style="transition:.5s ">
        <img src="dependencies/images/logo.png" class="sidebaLogo" />
        <h5 class="page_menu_title" style="margin-left:auto; position: absolute; margin-right:auto; color:white; text-align:center; width:100%; font-size:20px; font-weight:600"></h5>

        <div class="page_menu_btns" style=" position:absolute ; width:100%; left:0; padding-right:15px;padding-left:15px">
            <i class="fa fa-chevron-left" onclick="closeSidebar();" style=" font-size: 24px; float: left; margin-top: 5px; "></i>
            <!--<i class="fa fa-user" onclick="showProfile();" style="color: white; font-size: 24px; float: right; margin-top: 5px; "></i>-->

        </div>

        <div id="profile_block" onclick="showProfile();" style="width: 100%; height: 260px; overflow:hidden; background-color: #b71c1c; padding-top: 40px; transition: .5s!important">

            <div class="w3-center">
                <img src="assets/images/avatar2.png" id="prof_photo" class="w3-circle w3-border w3-border-white" style="height: 128px; width: 128px; border-width:5px!important; transition:.5s" alt="">

                <h3 id="full_name" style="color: white; transition: .5s"><b>Full Name</b></h3>
                <p id="userId" style="color: rgba(255, 255, 255, 0.57); margin-top: -10px;">@<span id="views_sidebar_username">username</span></p>

                <p id="" style="color: rgba(255, 255, 255, 0.57); margin-top: 40px;"><span id="views_sidebar_fn"></span></p>
                <p id="" style="color: rgba(255, 255, 255, 0.57); margin-top: 20px;"><span id="views_sidebar_email"></span></p>
                <p id="" style="color: rgba(255, 255, 255, 0.57); margin-top: 20px;"><span id="views_sidebar_dtJoined"></span></p>
            </div>


        </div>

    </div>



   

    <div style="padding-left: 35px; padding-right: 35px; width: 100%; height: 100vh; padding-top: 325px; padding-bottom:30px; background-color:white; overflow:auto">


        <!--<div onclick="views.show('pages_geneology');" class="sidebar_menu_item w3-ripple">
        <div class="w3-col s1 sidebar_menu_item_icon">
            <i class="fa fa-universal-access" onclick="" style="color: #b71c1c; font-size: 24px; float: left"></i>
        </div>

        <div class="w3-col s9" style="display: inline-block;  margin-top:4px; margin-left:15px">
            <h6 style="display: inline; color: #b71c1c;  font-size: 17px"><b>My Refferals</b></h6>
        </div>
    </div>-->

        <div onclick="closeSidebar(); views.showCard('views_account_upgrade');" class="sidebar_menu_item w3-ripple">
            <div class="w3-col s1 sidebar_menu_item_icon">
                <i class="fa fa-upload" onclick="" style="color: #b71c1c; font-size: 24px; float: left"></i>
            </div>

            <div class="w3-col s9" style="display: inline-block;  margin-top:4px; margin-left:15px">
                <h6 style="display: inline; color: #b71c1c;  font-size: 17px"><b>Upgrade</b></h6>
            </div>
        </div>

         <div onclick="closeSidebar(); views.showCard('views_account_cupons');" class="sidebar_menu_item w3-ripple">
            <div class="w3-col s1 sidebar_menu_item_icon">
                <i class="fas fa-ticket-alt" onclick="" style="color: #b71c1c; font-size: 24px; float: left"></i>
            </div>

            <div class="w3-col s9" style="display: inline-block;  margin-top:4px; margin-left:15px">
                <h6 style="display: inline; color: #b71c1c;  font-size: 17px"><b>Coupons</b></h6>
            </div>
        </div>

        <div onclick="" class="sidebar_menu_item w3-ripple">
            <div class="w3-col s1 sidebar_menu_item_icon">
                <i class="fa fa-asterisk" onclick="" style="color: #b71c1c;  font-size: 24px; float: left"></i>
            </div>

            <div class="w3-col s9" onclick="closeSidebar(); views.showOnTop('views_signup'); " style="display: inline-block;  margin-top:4px; margin-left:15px">
                <h6 style="display: inline; color: #b71c1c;  font-size: 17px"><b>New Account</b></h6>
            </div>
        </div>

         <div onclick="" class="sidebar_menu_item w3-ripple">
            <div class="w3-col s1 sidebar_menu_item_icon">
                <i class="fa fa-shopping-cart" onclick="" style="color: #b71c1c;  font-size: 24px; float: left"></i>
            </div>

            <div class="w3-col s9" onclick="closeSidebar(); views.showCard('views_products'); " style="display: inline-block;  margin-top:4px; margin-left:15px">
                <h6 style="display: inline; color: #b71c1c;  font-size: 17px"><b>Products</b></h6>
            </div>
        </div>

        <div onclick="closeSidebar(); views.showCard('pages_faqs');" class="sidebar_menu_item w3-ripple">
            <div class="w3-col s1 sidebar_menu_item_icon">
                <i class="fa fa-info-circle" onclick="" style="color: #b71c1c; font-size: 24px; float: left"></i>
            </div>

            <div class="w3-col s9" style="display: inline-block;  margin-top:4px; margin-left:15px">
                <h6 style="display: inline; color: #b71c1c;  font-size: 17px"><b>About D Herbs</b></h6>
            </div>
        </div>

        <div onclick="account.logout();" class="sidebar_menu_item w3-ripple">
            <div class="w3-col s1 sidebar_menu_item_icon">
                <i class="fas fa-sign-out-alt" onclick="" style="color: #b71c1c; font-size: 24px; float: left"></i>
            </div>

            <div class="w3-col s9" style="display: inline-block;  margin-top:4px; margin-left:15px">
                <h6 style="display: inline; color: #b71c1c;  font-size: 17px"><b>Logout</b></h6>
            </div>
        </div>




        <!--<div onclick="show_view('pages_advertise');" class="sidebar_menu_item w3-ripple">
        <i class="fa fa-ravelry" onclick="" style="color: #FFA000; font-size: 24px; float: left"></i>
        <div style="display: inline-block;  margin-top:4px; margin-left:15px">
            <h6 style="display: inline; color: #FFA000; font-size: 17px"><b>Advertise</b></h6>
        </div>
    </div>

    <div onclick="show_view('pages_services');" class="sidebar_menu_item w3-ripple">
        <i class="fa fa-magic" onclick="" style="color: #FFA000; font-size: 24px; float: left"></i>
        <div style="display: inline-block;  margin-top:4px; margin-left:15px">
            <h6 style="display: inline; color: #FFA000; font-size: 17px"><b>Services</b></h6>
        </div>
    </div>-->

    </div>
</div>