<!--NEWS FEED PAGE-->
<div id="pages_newsfeed" class="page animated slideInRight w3-col m8 l9" style="-webkit-animation-duration: .3s !important; z-index:1200">
    <div class="page_bkg" style="background-color: #FFA000">
        <div class="page_menu">
            <i class="fa fa-chevron-left" onclick="close_view('pages_newsfeed'); asycn_posts = 'FALSE';" style=" color: white; font-size: 24px; margin-top: 4px; float: left;"></i>
            <h5 style="margin-left:auto;margin-right:auto; color:white; text-align:center; display:inline-block; width:90%; font-size:20px; font-weight:600">Support</h5>
        </div>

        <div id="newsfeed_body" class="feed_body" style="-webkit-animation-duration: .8s !important; padding-bottom:50px">


            <h6 style="text-align: center; color: #BDBDBD; margin-top:15px">CoinCrypt 2017</h6>

        </div>

        <div id="postwin" class="w3-display-bottommiddle w3-white w3-center w3-padding" style=" height: 58px; width: 100%; transition: .5s; overflow-y:hidden">
            <button class="w3-button w3-round w3-ripple" id="newpostbtn" onclick="initiate_newPost();" style="width: 90%; background-color: #FFA000!important; color:white!important; margin-left:auto; margin-right: auto; margin-bottom: 25px"><i class="fa fa-plus" onclick="" style="color: white; font-size: 24px; float: left"></i>  New Post</button>

            <div id="postmodal" class="w3-center">
                <div id="newpostInterface" class="animated fadeIn" style="display:none; -webkit-animation-delay:.5s">

                    <h3>New Post</h3>
                    <p>Share your thoughts on post here</p>
                    <hr />
                    <p id="post_data" contenteditable="true" class="w3-border w3-padding"></p>

                    <div class="w3-center" style=" position: absolute; width: 90%; margin-top: 10vh;">
                        <button class="w3-button w3-round w3-ripple" onclick="sendPosts();" style="width: 100%; background-color: #FFA000!important; color:white!important; margin-left:auto; margin-right: auto; margin-bottom: 25px"><i class="fa fa-check" onclick="" style="color: white; font-size: 24px; float: left"></i>  Send</button>
                        <button class="w3-button w3-round w3-ripple w3-border" onclick="initiate_newPost();" style="width: 100%; background-color: white !important; border-color: #FFA000 !important; color: #FFA000 !important; margin-left: auto; margin-right: auto; margin-bottom: 25px; "><i class="fa fa-times" onclick="" style="color: #FFA000 !important; font-size: 24px; float: left"></i>  Cancel</button>

                    </div>
                </div>


            </div>

        </div>
    </div>
</div>