// LEGACY FUNCTIONS SUPPORT

function showSplash() {
    hidePreload();
    window.setTimeout(function () { views.show('views_splash'); }, 100);
    window.setTimeout(function () {      

        views.switch('views_login', 1);  
        particlesJS('particles_bg',

            {
                "particles": {
                    "number": {
                        "value": 50,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 5,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 6,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 200,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true,
                "config_demo": {
                    "hide_card": false,

                }
            }

        );
    }, 2000);

}

function showPreload() {
    app.showLoad();
}

function hidePreload() {
    app.hideLoad();
}

function show_view(view_name) {
    if (document.body.clientWidth > 599) {
      
        if (windowindex == 'TRUE') {
            closeAllViews(view_name);
            window.setTimeout(function () { document.getElementById(view_name).style.display = 'block'; windowindex = 'TRUE'; }, 600);
        }
        else { document.getElementById(view_name).style.display = 'block'; windowindex = 'TRUE'; }
        
    }
    else { document.getElementById(view_name).style.display = 'block';}
 
 if (pageb4 != '') {
     // document.getElementById(pageb4).classList.add('pageOutfocus');   
     pageb4 = view_name;
 }
 else { pageb4 = view_name; }
   
}

function close_view(view_name) {
    document.getElementById(view_name).className = 'page animated slideOutRight w3-col m8 l9';
    windowindex = '';
    //if (pageb4 != '') {
    //    document.getElementById(pageb4).classList.remove('pageOutfocus');
    //}
    setTimeout(function () {
        document.getElementById(view_name).style.display = 'none';
        document.getElementById(view_name).className = 'page animated slideInRight w3-col m8 l9';
    }, 550)
}

function close_view_fade(view_name) {
    document.getElementById(view_name).className = 'page animated fadeOut';
    document.getElementById("screenguard").style.display = 'none';
    windowindex = '';
    setTimeout(function () {
        document.getElementById(view_name).style.display = 'none';
        document.getElementById(view_name).className = 'page animated fadeIn';
    }, 550)
}

function close_view_card(view_name) {
    document.getElementById(view_name).className = 'page animated slideOutDown  w3-col m8 l9';
    document.getElementById("screenguard").style.display = 'none';
    windowindex = '';
    setTimeout(function () {
        document.getElementById(view_name).style.display = 'none';
        document.getElementById(view_name).className = 'page animated slideInUp w3-col m8 l9';
        
    }, 550)
}

function showSidebar() {
    document.getElementById("pages_sidebar").style.display = 'block';   
    //views.show("pages_sidebar");
}

function showSignup() {
    pageMenu_hide();
    document.getElementById("loginForm").style.display = 'none';
    document.getElementById("signupForm").style.display = 'block';
}

function hideSignup() {
    pageMenu_show();
    if (document.getElementById("pages_main").style.display == 'block') {
        close_view("pages_login");
    }
    else {
        document.getElementById("loginForm").style.display = 'block';
        document.getElementById("signupForm").style.display = 'none';
    }

}

function closeSidebar() {
    //document.getElementById('profile_block').style.height = '300px';
    //document.getElementById('prof_photo').style.height = '128px';
    //document.getElementById('prof_photo').style.width = '128px';
    //document.getElementById("full_name").style.marginTop = '15px';
    //document.getElementById("userId").style.marginTop = '-10px';
    hideProfile();

    if (document.body.clientWidth < 599) {
        document.getElementById("pages_sidebar").className = 'sidebar animated slideOutLeft w3-col m4 l3';
        setTimeout(function () {
            document.getElementById("pages_sidebar").style.display = '';
            document.getElementById("pages_sidebar").className = 'sidebar animated slideInLeft w3-col m4 l3';
        }, 550)
    }

  

}

function showProfile() {
    //showSidebar();
   // setTimeout(function () {

    if (document.getElementById('profile_block').style.height == '260px') {
        document.getElementById('profile_block').style.height = '95vh';
        //document.getElementById('change_photo').style.display = 'block';
        document.getElementById('prof_photo').style.height = '256px';
        document.getElementById('prof_photo').style.width = '256px';
        document.getElementById("full_name").style.marginTop = '75px';
        document.getElementById("profile_block").style.paddingTop = '75px';
    }
    else {
        hideProfile();
    }

     


   // }, 100)
}

function hideProfile() {
    //showSidebar();
    // setTimeout(function () {
    document.getElementById('profile_block').style.height = '260px';
    //document.getElementById('change_photo').style.display = 'block';
    document.getElementById('prof_photo').style.height = '128px';
    document.getElementById('prof_photo').style.width = '128px';
    document.getElementById("full_name").style.marginTop = '20px';
    document.getElementById("profile_block").style.paddingTop = '40px';


    // }, 100)
}

function pageMenu_hide() {
    document.getElementById("pageMenu_login").className = 'page_menu animated fadeOut';
    setTimeout(function () {
        document.getElementById("pageMenu_login").style.display = 'none';
        document.getElementById("pageMenu_login").className = 'page_menu animated fadeIn';
    }, 550)
}

function newAccount_main() {
    views.showOnTop('pages_login');
    showSignup();
}

function pageMenu_show() {
    document.getElementById("pageMenu_login").style.display = 'block';
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function trySignup() {
  
    // login();
    app.showLoad();
    $.post(app.config.ApiUrl + "api/interface/new_account", {
        fn: document.getElementById('views_signup_fname').value,
        mn: '',
        ln: document.getElementById('views_signup_lname').value,
        nn: '',
        email: document.getElementById('views_signup_email').value,
        phone: document.getElementById('views_signup_phone').value,
        gender: document.getElementById('views_signup_gender').value,
        data_pass: document.getElementById('views_signup_password').value,
        data_username: document.getElementById('views_signup_username').value,
        uplineID: document.getElementById('views_signup_ref').value,
        ticket_code: document.getElementById('views_signup_cupon').value,
        position: document.getElementById('views_signup_position').value,
        matrix_upline: document.getElementById('views_signup_binary_sponsor').value

      
    },

        function (data) {
            console.log(data);
            try {
                var result = JSON.parse(data);
                app.hideLoad();
                if (result.status == "200") {
                    gototop('signupForm_1');
                    window.setTimeout(function () { views.hide_card('views_signup'); }, 100);
                    app.showMessage('Signup successful. Please login to continue', 'Success');
                }

                else {
                    app.showMessage('There was an error submitting your request. Try changing your email address or username, or the cupon code may have been used. Please try again.', 'Error');
                }
            } catch (e) {
                app.showMessage('There was an error submitting your request. Try changing your email address or username, or the cupon code may have been used. Please try again.', 'Error');

            }
           

        })


    return false

}

function setSponsor(args) {
    document.getElementById("views_signup_ref").value = args;
    views.showOnTop('views_signup');
}

function check_address() {

    $.ajax({
        url: "https://blockchain.info/q/addressbalance/" + document.getElementById("signup_usn").value,
        async: true,
        type: 'GET',
        dataType: 'json',
        success: function (data) {

        },
        error: function (data) {
            alert("Invalid Wallet Address!");
            //showSnack("Invalid Wallet Address!");
            document.getElementById("signup_usn").value = "";
            document.getElementById("signup_usn").focus();
        }
    })

}

function initiate_newPost() {
    if (document.getElementById('postwin').style.height == "60vh") {
        document.getElementById('newpostbtn').style.display = "block"
        document.getElementById('newpostInterface').style.display = "none"
        //document.getElementById('postmodal').style.marginTop = "-30px"
        document.getElementById('postwin').style.height = "58px";
        document.getElementById('postwin').style.overflowY = "hidden";
    }
    else
    {
        document.getElementById('newpostbtn').style.display = "none"
        document.getElementById('newpostInterface').style.display = "block"
        //document.getElementById('postmodal').style.marginTop = "-30px"
        document.getElementById('postwin').style.height = "60vh";
        document.getElementById('postwin').style.overflowY = "auto";
        document.getElementById('post_data').focus();
    }
    
}

function sendPosts() {

    if (document.getElementById('post_data').innerHTML != "") {
        showMsg('Posting..');
        $.post("https://greatgreenday.cf/new/members-account/Pv-5KlRx0aS-Q-/Accounts-Secure-Login/2016-Auth-192621/send_posts", { usn: "", poster_name: binary_username, MSGDATA: document.getElementById('post_data').innerHTML },
    function (result) {
        //$("span").html(result);
        //console.log(result);
        if (result != "") {
           // alert(result);
            document.getElementById('post_data').innerHTML = '';
            //close_view('pages_advertise');
            initiate_newPost();
            getPosts();
            showMsg_close();
            showMsg('Post Successful');
            window.setTimeout(function () { showMsg_close(); }, 3000);
        }
    });
    }

  
}

function getPosts() {

    $.post("https://greatgreenday.cf/new/members-account/Pv-5KlRx0aS-Q-/Accounts-Secure-Login/2016-Auth-192621/get_posts", { usr: "" },
    function (result) {
        //$("span").html(result);
        //console.log(result);
        if (result != "") {

            if (pstres != result) {
                document.getElementById("newsfeed_body").innerHTML = result;
                pstres = result;
            }

        }
    });
    window.setTimeout(function () { if (asycn_posts == 'TRUE') { getPosts(); } }, 3000)
}

function toggleFullScreen() {
  
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
     (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        //if (document.cancelFullScreen) {
        //    document.cancelFullScreen();
        //} else if (document.mozCancelFullScreen) {
        //    document.mozCancelFullScreen();
        //} else if (document.webkitCancelFullScreen) {
        //    document.webkitCancelFullScreen();
        //}
    }
}

function gototop(divid) {
    document.getElementById(divid).scrollIntoView({ behavior: "smooth", block: "start", inline: "start" });}

function copyToClipboard(elemtname) {
    console.log(elemtname);
    /* Get the text field */
    var copyText = document.getElementById(elemtname);

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("Copy");

    /* Alert the copied text */
    showMsg("Text copied to clipboard", 'Information', 'Got It');
}

function showMsg(message_string,tilemsg,btnname) {
    document.getElementById('msg_text').innerHTML = message_string;
    document.getElementById('win_Msgpopup').style.display = "block";

    if (tilemsg != null) {
        document.getElementById('msgTitle').innerHTML = tilemsg;
    }
    if (btnname != null) {
        document.getElementById('msgbtnname').innerHTML = btnname;
    }
}

function showMsg_close() {

    document.getElementById('popupmsgWin').className = "popup zoomout w3-center";
    document.getElementById('win_Msgpopup').className = "page animated fadeOut";
   
    window.setTimeout(function () { document.getElementById('win_Msgpopup').style.display = "none"; document.getElementById('win_Msgpopup').className = "page animated fadeIn"; document.getElementById('popupmsgWin').className = "popup zoomin w3-center"; }, 500);

   
}