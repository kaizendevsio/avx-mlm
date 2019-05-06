const views = {
    showGuard: function () {
        app.vars.viewindex = app.vars.viewindex + 1;
        document.getElementById('screenguard').style.zIndex = app.vars.viewindex;
        document.getElementById('screenguard').style.display = 'block';

    },
    hideGuard: function () {
        document.getElementById('screenguard').style.display = 'none';
    },
    show: function (viewName) {
        if (app.vars.prev_view != '') {
            // document.getElementById(app.vars.prev_view).classList.remove('blur');
        }
        app.vars.prev_view = app.vars.curr_view;
        try {
            // window.setTimeout(function () { document.getElementById(app.vars.prev_view).classList.add('blur'); }, 600);

        } catch (e) {
            //console.log('error bluring view');
        }

        if (document.getElementById(viewName).style.display == 'block') {
            document.getElementById(viewName).style.display = 'none';

            window.setTimeout(function () {
                app.vars.viewindex = app.vars.viewindex + 1;
                document.getElementById(viewName).style.zIndex = app.vars.viewindex;
                // showScreenGuard();
                document.getElementById(viewName).style.display = 'block';
                app.vars.curr_view = viewName;
            }, 30);

        }
        else {
            app.vars.viewindex = app.vars.viewindex + 1;
            document.getElementById(viewName).style.zIndex = app.vars.viewindex;
            // showScreenGuard();
            document.getElementById(viewName).style.display = 'block';
            app.vars.curr_view = viewName;
        }



    },
    showCard: function (viewName) {
      
        if (document.getElementById(viewName).style.display == 'block') {
            document.getElementById(viewName).style.display = 'none';

            window.setTimeout(function () {
                app.vars.viewindex = app.vars.viewindex + 1;
                document.getElementById(viewName).style.zIndex = app.vars.viewindex;
                // showScreenGuard();
                document.getElementById(viewName).style.display = 'block';
                //app.vars.curr_view = viewName;
            }, 30);

        }
        else {
            app.vars.viewindex = app.vars.viewindex + 1;
            document.getElementById(viewName).style.zIndex = app.vars.viewindex;
            // showScreenGuard();
            document.getElementById(viewName).style.display = 'block';
           // app.vars.curr_view = viewName;
        }



    },
    showOnTop: function (viewName) {
        if (app.vars.prev_view != '') {
            // document.getElementById(app.vars.prev_view).classList.remove('blur');
        }
        app.vars.prev_view = app.vars.curr_view;
        try {
            // window.setTimeout(function () { document.getElementById(app.vars.prev_view).classList.add('blur'); }, 600);

        } catch (e) {
            //console.log('error bluring view');
        }

        if (document.getElementById(viewName).style.display == 'block') {
            document.getElementById(viewName).style.display = 'none';

            window.setTimeout(function () {
               // app.vars.viewindex = app.vars.viewindex + 1;
             //   document.getElementById(viewName).style.zIndex = app.vars.viewindex;
                // showScreenGuard();
                document.getElementById(viewName).style.display = 'block';
                app.vars.curr_view = viewName;
            }, 30);

        }
        else {
            //app.vars.viewindex = app.vars.viewindex + 1;
           // document.getElementById(viewName).style.zIndex = app.vars.viewindex;
            // showScreenGuard();
            document.getElementById(viewName).style.display = 'block';
            app.vars.curr_view = viewName;
        }



    },
    hide: function (viewName) {
        try {
            // document.getElementById(app.vars.prev_view).className = 'views_popup rem_blur';
        } catch (e) {
            //console.log('error removing blur view');
        }
        //hideScreenGuard();


        document.getElementById(viewName).className = 'page animated slideOutRight w3-col m8 l9';
        window.setTimeout(function () {
            document.getElementById(viewName).style.display = 'none';
            document.getElementById(viewName).className = 'page animated slideInRight w3-col m8 l9';
            // document.getElementById(app.vars.prev_view).className = 'views_popup';
            app.vars.curr_view = app.vars.prev_view;
            app.vars.prev_view = ''
        }, 500);

    },
    hide_card: function (viewName) {
        try {
            //     document.getElementById(app.vars.prev_view).className = 'views_popup rem_blur';
        } catch (e) {
            //console.log('error removing blur view');
        }

        //  hideScreenGuard();
        document.getElementById(viewName).className = 'page animated slideOutDown w3-col m8 l9';
        window.setTimeout(function () {
            document.getElementById(viewName).style.display = 'none';
            document.getElementById(viewName).className = 'page animated slideInUp w3-col m8 l9';
            // document.getElementById(app.vars.prev_view).className = 'views_popup';
            app.vars.curr_view = app.vars.prev_view;
            app.vars.prev_view = ''
        }, 500);

    },
    hide_unlock: function (viewName) {
        try {
            //document.getElementById(app.vars.prev_view).classList.remove('blur');
        } catch (e) {
            //console.log('error removing blur view');
        }
        //hideScreenGuard();
        document.getElementById(viewName).className = 'views_popup animated slideOutUp';
        window.setTimeout(function () {
            document.getElementById(viewName).style.display = 'none';
            document.getElementById(viewName).className = 'views_popup animated slideInUp';
        }, 500);

    },
    hide_fade: function (viewName) {
        //hideScreenGuard();
        try {
            document.getElementById(app.vars.prev_view).classList.remove('blur');
        } catch (e) {
            //console.log('error removing blur view');
        }
        document.getElementById(viewName).className = 'page animated fadeOut w3-col m8 l9';
        window.setTimeout(function () {
            document.getElementById(viewName).style.display = 'none';
            document.getElementById(viewName).className = 'page animated fadeIn w3-col m8 l9';
        }, 500);

    },
    hide_card_popup: function (viewName) {
        views.hideGuard();
        document.getElementById(viewName).className = 'views_popup_float animated bounceOut';
        window.setTimeout(function () {
            document.getElementById(viewName).style.display = 'none';
            document.getElementById(viewName).className = 'views_popup_float animated slideInUp';
            // document.getElementById(app.vars.prev_view).className = 'views_popup';
            app.vars.curr_view = app.vars.prev_view;
            app.vars.prev_view = ''
        }, 500);

    },
    closeAllVeiws: function () {

    },
    switch: function (viewName, order) {
      //console.log(viewName);
        app.vars.viewindex = app.vars.viewindex + 1;
        // ---------- FOR MAIN TABS ------------ 
        document.getElementById('overlays_mainTabs').style.zIndex = app.vars.viewindex + 1;

        document.getElementById(viewName).style.zIndex = app.vars.viewindex;
            
        // showScreenGuard();
        // showScreenGuard();

        if (viewName != app.vars.curr_view) {
            if (order > app.vars.curr_view_order) {
                document.getElementById(app.vars.curr_view).className = 'page animated slideOutLeft w3-col m8 l9';
                document.getElementById(viewName).className = 'page animated slideInRight w3-col m8 l9';
                document.getElementById(viewName).style.display = 'block';

                window.setTimeout(function () {
                    document.getElementById(app.vars.curr_view).style.display = 'none';
                    app.vars.curr_view = viewName;
                    app.vars.curr_view_order = order;
                }, 500);

            }
            else {
                document.getElementById(app.vars.curr_view).className = 'page animated slideOutRight w3-col m8 l9';
                document.getElementById(viewName).className = 'page animated slideInLeft w3-col m8 l9';
                document.getElementById(viewName).style.display = 'block';
                window.setTimeout(function () {
                    document.getElementById(app.vars.curr_view).style.display = 'none';
                    app.vars.curr_view = viewName;
                    app.vars.curr_view_order = order;
                }, 500);

            }
        }

       
    }
}

const tabs = {
    switch: function (tab) {
        app.vars.curr_tab.className = 'w3-col s3 m3 l3 button';

        tab.className = 'w3-col s3 m3 l3 button active';
        app.vars.curr_tab = tab;
    }
}