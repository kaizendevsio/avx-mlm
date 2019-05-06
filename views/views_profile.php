<!--PROFILE PAGE-->
<div id="views_myprofile" class="page animated slideInRight">
    <div class="page_bkg" style="background-color: #FFA000; ">
        <div class="page_menu" style="background-color:rgb(76,175,80)">
            <h5 style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; font-size:17px; font-weight:bold; margin-top:3px; margin-top:3px; margin-top:0px;">Profile</h5>
            <p style="margin-left:auto; position: absolute; margin-right:auto; text-align:center; display:inline-block; width:100%; margin-top:22px; font-size:10px;">Manage profile settings</p>

            <div style="  position:absolute ; width:100%; left:0; padding-right:15px;padding-left:15px">
                <i class="fa fa-align-left" onclick="showSidebar();" style="font-size: 24px; float: left; margin-top: 5px; "></i>
                <i class="far fa-bell" onclick="views.show('views_notifications');" style="font-size: 24px; float: right; margin-top: 5px; "></i>
            </div>
        </div>

        <div id="feed_body" class="feed_body">
            <div class="w3-center animated zoomIn" style="animation-delay:.3s">
                <img src="assets/images/avatar2.png" id="" class="w3-circle w3-border w3-border-white" style="height: 256px; width: 256px; border-width: 5px !important; transition: .5s" alt="">

                <h3 id="" style="color: black; transition: .5s"><b>Full Name</b></h3>
                <p id="" style="color: black; margin-top: -10px;">@<span id="views_profile_username">username</span></p>

            </div>
            <br />

            <div class="w3-round w3-padding w3-center animated fadeInUp" style="height: max-content; background-color: white !important; animation-delay:.4s">
                <h5 onclick="app.showMessage('Type your desired username', 'Change Username', 'Save Changes', true); app.vars.dialogIntent = 'username'" class="w3-hover-light-gray w3-round" style="margin:0px; padding:15px 0px">Change Username</h5>
                <hr style="margin:5px 0px" />
                <h5 onclick="app.showMessage('Type your desired password', 'Reset Password', 'Save Changes', true); app.vars.dialogIntent = 'password'" class="w3-hover-light-gray w3-round" style="margin:0px; padding:15px 0px">Reset Password</h5>
                <hr style="margin:5px 0px" />
                <h5 class="w3-hover-light-gray w3-round" style="margin:0px; padding:15px 0px">Change Photo</h5>
                <hr style="margin:5px 0px" />
                <h5 onclick="app.showMessage('Type your desired email', 'Change Email', 'Save Changes', true); app.vars.dialogIntent = 'email'" class="w3-hover-light-gray w3-round" style="margin:0px; padding:15px 0px">Change Email</h5>
            </div>

            <h6 style="text-align: center; color: #BDBDBD; margin-top:15px"></h6>

              <form id="avatar_file_form" method="post" enctype="multipart/form-data">
                    <!--<input type="file" name="files[]" multiple>-->
                    <input type="file" id="avt_fileToUpload" name="fileToUpload" style="margin-top: 5px; display: none" />
                    
              </form>
               

        </div>
    </div>
</div>