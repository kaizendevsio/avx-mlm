const app = {
    config: config,
    initialize: function () {
        // views.hide('views_splash');
        //views.show('views_splash');
               
      

        //try {
        //    if (app.vars.tokenid != '') {

        //        app.vars.userAuthToken = app.vars.tokenid;
        //        api.client.login();

        //    }
        //} catch (e) {

        //}

        //var md = new MobileDetect(window.navigator.userAgent);

        ////detect app.vars.device

        //var str = md.ua;
        //var dev = str.search("Windows");

        //if (dev < 0) {
        //    var dev = str.search("Android");
        //    if (dev < 0) { app.vars.device = 'APPLE'; }
        //    else { app.vars.device = 'ANDROID'; }
        //}
        //else { app.vars.device = 'WINDOWS'; }

        if (app.config.IsDebug == true) {
            app.config.ApiUrl = app.config.DebugApiUrl;
        }
        else {
            app.config.ApiUrl = app.config.LiveApiUrl;
        }

    },
    showMsg: function (msg) {
        try {
            Website2APK.showToast(msg);
        } catch (e) {
            alert(msg);
        }
    },
    showMessage: function (message_string, title, btnname,isInput = false) {
        if (isInput == true) {
            document.getElementById('views_popup_input_description').innerHTML = message_string;
            document.getElementById('views_popup_input_title').innerHTML = title;
            document.getElementById('views_popup_input_btn').innerHTML = btnname;
            document.getElementById('views_popup_input').style.display = "block";
        }
        else {
            document.getElementById('msg_text').innerHTML = message_string;
            document.getElementById('win_Msgpopup').style.display = "block";

            if (title != null) {
                document.getElementById('msgTitle').innerHTML = title;
            }
            if (btnname != null) {
                document.getElementById('msgbtnname').innerHTML = btnname;
            }
        }

      

    },
    showConfirm: function (msg, title) {
        document.getElementById('popup_confirm_title').innerHTML = title;
        document.getElementById('popup_confirm_text').innerHTML = msg;

        views.showGuard();
        views.show('views_popup_confirm');

    },
    hideConfirm: function (msg) {
        views.hideGuard();
        document.getElementById('views_popup_confirm').className = 'views_popup_float animated bounceOut';

        window.setTimeout(function () {
            document.getElementById('views_popup_confirm').style.display = 'none';
            document.getElementById('views_popup_confirm').className = 'views_popup_float animated bounceIn';
        }, 500);
    },
    hideMessage: function (msg) {
       
        views.hide_fade('views_popup_input');
        //views.hideGuard();
        //document.getElementById('views_popup_message').className = 'views_popup_float animated bounceOut';      
        //window.setTimeout(function () {
        //    document.getElementById('views_popup_message').style.display = 'none';
        //    document.getElementById('views_popup_message').className = 'views_popup_float animated bounceIn';
        //}, 500);

    },
    showLoad: function () {
        document.getElementById('view_loader').style.display = "block";
    },
    hideLoad: function () {
        document.getElementById('view_loader').className = 'page animated fadeOut';

        window.setTimeout(function () {
            document.getElementById('view_loader').style.display = 'none';
            document.getElementById('view_loader').className = 'page animated fadeIn';
        }, 500);

    },
    views: views,
    vars: vars
}

$(document).ready(function () {
    app.initialize();
    showSplash();

});