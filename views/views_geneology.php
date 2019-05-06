<!--GENEOLOGY PAGE-->
<div id="views_geneology" class="page animated slideInRight w3-col m8 l9">
    <div class="page_bkg" style="background-color:rgb(33,150,243);">
        <div class="page_menu" style="background-color:rgb(33,150,243)">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:17px; font-weight:bold; margin-top:3px; margin-top:3px; margin-top:0px;">Geneology</h5>
            <p style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; margin-top:22px; font-size:10px;">You have 0 people under you</p>

            <div style="  position:absolute ; width:100%; left:0; padding-right:15px;padding-left:15px; padding-left:15px">
                <i class="fa fa-align-left" onclick="showSidebar();" style="font-size: 24px; float: left; margin-top: 5px; "></i>
                <i class="far fa-bell" onclick="views.show('views_notifications');" style="font-size: 24px; float: right; margin-top: 5px; "></i>

            </div>
        </div>

        <div id="feed_body" class="feed_body">
            <div id="mypeople_details" style="padding-bottom:100px;">
                <h4 style="font-weight:600; color:rgb(33,150,243); margin-bottom: 15px;">Your Structure</h4>
                <h5 style="color:#777; margin-bottom:15px;">Showing all members under you</h5>
                
                <p onclick="views.showCard('views_geneology_directs'); account.listMembers(true, 'directs');" class="w3-hover-shadow" style="border-radius: 3px;color: white;margin-top: 9px; outline:none!important; outline-color:white!important; padding-left: 15px;padding-top: 5px;padding-bottom: 5px;background-color: rgb(33,150,243);width: max-content; padding-right:15px;"><b>Show My Directs</b></p>

   <!--             <img src="dependencies/images/sample_chart.png" style="width:100%" />

    <hr />

    <h4 style="font-weight:600; color:#b71c1c; margin-bottom: 15px;">Phase 1</h4>
    <h5 style="color:#777; margin-bottom:15px;">4 Slots remaining to complete the cycle</h5>-->
                <div id="views_geneology_clients" class="w3-padding-24 w3-container" style="max-width:100%; height:70vh">

                    

                </div>



                <!--<img src="dependencies/images/sample_chart_2.png" style="width:60%; display:block; margin-left:auto; margin-right:auto" />-->
            </div>



        </div>
    </div>
</div>