const account = {
    login: function () {
        var user = document.getElementById('views_login_username').value;
        var pss = document.getElementById('views_login_password').value;
        app.showLoad();
        // login();
        $.post(app.config.ApiUrl + "api/interface/auth/authenticate", {        
            user: user,
            data_pass: pss
        },
            function (data) {
                //console.log(data);
                var response = JSON.parse(data);

                if (response.status == "200") {
                    app.showLoad();
                    close_view("views_login");
                    close_view("views_splash");

                    window.setTimeout(function () {
                        views.show("views_main");
                        views.show('overlays_mainTabs');
                        app.vars.curr_view = 'views_main';
                        app.vars.curr_tab = document.getElementById('tabs_0');

                        app.hideLoad();
                        //console.log(document.body.clientWidth);
                        document.getElementById("pages_sidebar").className = 'sidebar animated slideInLeft w3-col m4 l3';
                        windowindex = '';
                        if (document.body.clientWidth > 599) {
                            //showSidebar();
                            //document.getElementById('pages_main').style.paddingLeft = "32%";
                        }
                    }, 500);

                    tokenid = response.userid;
                    binary_username = user;
                    app.hideLoad();
                    account.loadWallet();
                    account.loadAccountData();

                    //START BACKGROUND DATA REFRESH SERVICE
                    services.backgroundRefresh();
                }

                else {
                    app.hideLoad();
                    app.showMessage('Incorrect username or password', 'Error');

                }

            })


        return false
    },
    logout: function () {
        if (document.body.clientWidth < 599) { closeSidebar(); }
        else { document.getElementById("pages_sidebar").className = 'sidebar-off animated slideInLeft w3-col m4 l3'; closeAllViews(); }
        //show_view("pages_login");
        views.switch('views_main', 2);

        show_view("views_login");
        views.hide("views_main");
        document.getElementById('overlays_mainTabs').style.display = 'none';

        tokenid = '';

    },
    loadWallet: function () {
        $.post(app.config.ApiUrl + "api/interface/wallet_data", {
            userid: tokenid
        },
            function (data) {
                //console.log(data);
                var response = JSON.parse(data);

                if (response.status == "200") {
                    document.getElementById('views_dashboard_totalEarnings').innerHTML = numberWithCommas(response.main_balance);
                    document.getElementById('views_wallet_mainBalance').innerHTML = numberWithCommas(response.main_balance);
                    document.getElementById('views_wallet_drBalance').innerHTML = numberWithCommas(response.dr_balance);
                    document.getElementById('views_wallet_prbBalance').innerHTML = numberWithCommas(response.binary_pair_balance);
                    document.getElementById('views_wallet_5h_prbBalance').innerHTML = numberWithCommas(response.binary_5thpair_balance);
                    document.getElementById('views_dashboard_pairs').innerHTML = numberWithCommas(response.PR_COUNTER);

                    //document.getElementById('views_wallet_shBalance').innerHTML = numberWithCommas(response.sh_balance);
                    //document.getElementById('views_wallet_poolBalance').innerHTML = numberWithCommas(response.bp_balance);
                    //document.getElementById('views_wallet_unilevelBalance').innerHTML = numberWithCommas(response.ul_balance);
                    //document.getElementById('views_wallet_poolPremiumBalance').innerHTML = numberWithCommas(response.bp_prem_balance);
                    document.getElementById('views_dashboard_dl').innerHTML = numberWithCommas(response.dl_count);
                    document.getElementById('views_wallet_pendingBalance').innerHTML = numberWithCommas(response.pending_balance);
                    document.getElementById('views_wallet_cashoutBalance').innerHTML = numberWithCommas(response.cashout_balance);
                    document.getElementById('views_products_confirmed_products').innerHTML = numberWithCommas(response.PRD_ITMS_TLT);

                    if (parseFloat(response.PRD_ITMS_UN) > 0) {
                        document.getElementById('unconfirmed_products').style.display = 'block';
                        document.getElementById('pending_products_exec').style.display = 'block';
                        document.getElementById('pending_products').innerHTML = parseFloat(response.PRD_ITMS_UN) + parseFloat(response.PRD_ITMS);
                        app.vars.userProductsPending = parseFloat(response.PRD_ITMS_UN);
                    }
                    else {
                        document.getElementById('unconfirmed_products').style.display = 'none';
                        document.getElementById('pending_products').innerHTML = '0';
                        app.vars.userProductsPending = 0;

                        if (parseFloat(response.PRD_ITMS) > 0) {
                            document.getElementById('pending_products_exec').style.display = 'none';
                            document.getElementById('unconfirmed_products').style.display = 'block';
                            document.getElementById('pending_products').innerHTML = parseFloat(response.PRD_ITMS);
                            app.vars.userProductsPending = parseFloat(response.PRD_ITMS);
                        }

                    }

                    
                }

                else {
                    app.hideLoad();
                   // app.showMessage('Incorrect username or password', 'Error');
                }

            })
    },
    listMembers: function (silent, intent) {
        if (silent == null) {
            //app.showLoad();
        }
        var HTMLelement = 'views_geneology_clients';

        if (intent == 'directs') {
            HTMLelement = 'views_geneology_list_directs';

            $.post(app.config.ApiUrl + "api/interface/get_all_users", {
                account_code: tokenid,
                intent: intent //'downline'
            },
                function (data) {
                    //console.log(data);
                    var response = JSON.parse(data);
                    var users = response.users;
                    var tmpHTML = '';
                    var classTemplate = "";

                    if (response.status == "200") {

                        if (response.users != null) {

                            if (intent == "directs") {
                                classTemplate = "geneology_card_occupied_orange";
                            }
                            else {
                                classTemplate = "geneology_card_occupied";
                            }

                            //console.log(users.length);
                            for (var i = 0; i < users.length; i++) {
                                tmpHTML = tmpHTML + ' <div class="' + classTemplate + '"><h3><strong>' + users[i] + '</strong></h3></div>';
                            }
                            tmpHTML = tmpHTML + ' <div onclick="views.showOnTop(' + "'views_signup'" + '); " class="geneology_card_blank"><h3><strong>EMPTY SLOT</strong></h3><p>Tap to create new account</p></div>';
                            document.getElementById(HTMLelement).innerHTML = tmpHTML;
                        }


                    }
                    else {
                        app.showMessage('There was an error while loading the geneology. Please try again later', 'Error');
                    }
                    app.hideLoad();

                })
        }

        else {

            $.post(app.config.ApiUrl + "api/interface/get_all_maps_matrix", {
                account_code: tokenid,
                intent: intent //'downline'
            },
                function (data) {
                    console.log(data);
                    var response = data;// JSON.parse(data);
                    var users = response.users;
                    var tmpHTML = '';
                    var classTemplate = "";


                    OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.ana);
                    OrgChart.templates.myTemplate.size = [200, 200];
                    OrgChart.templates.myTemplate.node = '<circle cx="100" cy="100" r="100" fill="rgb(33,150,243)" stroke-width="1" stroke="#1C1C1C"></circle>';


                    OrgChart.templates.myTemplate.ripple = {
                        radius: 100,
                        color: "#0890D3",
                        rect: null
                    };

                    OrgChart.templates.myTemplate.field_0 = '<text style="font-size: 24px;" fill="#ffffff" x="100" y="90" text-anchor="middle">{val}</text>';
                    OrgChart.templates.myTemplate.field_1 = '<text style="font-size: 16px;" fill="#ffffff" x="100" y="60" text-anchor="middle">{val}</text>';

                    OrgChart.templates.myTemplate.img_0 = '<clipPath id="ulaImg"><circle cx="100" cy="150" r="40"></circle></clipPath><image preserveAspectRatio="xMidYMid slice" clip-path="url(#ulaImg)" xlink:href="{val}" x="60" y="110"  width="80" height="80"></image>';

                    OrgChart.templates.myTemplate.edge = '<path  stroke="#686868" stroke-width="1px" fill="none" edge-id="[{id}][{child-id}]" d="M{xa},{ya} C{xb},{yb} {xc},{yc} {xd},{yd}"/>';

                    OrgChart.templates.myTemplate.plus =
                        '<rect x="0" y="0" width="36" height="36" rx="12" ry="12" fill="#2E2E2E" stroke="#aeaeae" stroke-width="1"></rect>'
                        + '<line x1="4" y1="18" x2="32" y2="18" stroke-width="1" stroke="#aeaeae"></line>'
                        + '<line x1="18" y1="4" x2="18" y2="32" stroke-width="1" stroke="#aeaeae"></line>';

                    OrgChart.templates.myTemplate.minus =
                        '<rect x="0" y="0" width="36" height="36" rx="12" ry="12" fill="#2E2E2E" stroke="#aeaeae" stroke-width="1"></rect>'
                        + '<line x1="4" y1="18" x2="32" y2="18" stroke-width="1" stroke="#aeaeae"></line>';

                    OrgChart.templates.myTemplate.expandCollapseSize = 36;

                    OrgChart.templates.myTemplate.nodeMenuButton = '<g style="cursor:pointer;" transform="matrix(1,0,0,1,93,15)" control-node-menu-id="{id}"><rect x="-4" y="-10" fill="#000000" fill-opacity="0" width="22" height="22"></rect><line x1="0" y1="0" x2="0" y2="10" stroke-width="2" stroke="#0890D3" /><line x1="7" y1="0" x2="7" y2="10" stroke-width="2" stroke="#0890D3" /><line x1="14" y1="0" x2="14" y2="10" stroke-width="2" stroke="#0890D3" /></g>';

                    OrgChart.templates.myTemplate.exportMenuButton = '<div style="position:absolute;right:{p}px;top:{p}px; width:40px;height:50px;cursor:pointer;" control-export-menu=""><hr style="background-color: #0890D3; height: 3px; border: none;"><hr style="background-color: #0890D3; height: 3px; border: none;"><hr style="background-color: #0890D3; height: 3px; border: none;"></div>';

                    OrgChart.templates.myTemplate.pointer = '<g data-pointer="pointer" transform="matrix(0,0,0,0,100,100)"><g transform="matrix(0.3,0,0,0.3,-17,-17)"><polygon fill="#0890D3" points="53.004,173.004 53.004,66.996 0,120"/><polygon fill="#0890D3" points="186.996,66.996 186.996,173.004 240,120"/><polygon fill="#0890D3" points="66.996,53.004 173.004,53.004 120,0"/><polygon fill="#0890D3" points="120,240 173.004,186.996 66.996,186.996"/><circle fill="#0890D3" cx="120" cy="120" r="30"/></g></g>';

                    if (response.status == "200") {

                        if (prevNodeData !== JSON.stringify(response.result)) {

                            setTimeout(function () {
                                var chart = new OrgChart(document.getElementById("views_geneology_clients"), {
                                    template: "myTemplate",
                                    enableSearch: false,
                                    nodeMenu: {
                                        //details: { text: "Details" },
                                        //add: { text: "Add" }
                                    },
                                    nodeBinding: {
                                        field_0: "name"
                                    },
                                    nodes: response.result
                                });
                            }, 500);
                           
                            prevNodeData = JSON.stringify(response.result);
                        }




                    }
                    else {
                        app.showMessage('There was an error while loading the geneology. Please try again later', 'Error');
                    }
                    app.hideLoad();

                })
        }
    },
    loadAccountData: function () {
        $.post(app.config.ApiUrl + "api/interface/account_data", {
           // $.post("http://localhost/gwb/api/interface/account_data", {
            userid: tokenid
        },
            function (data) {
                //console.log(data);
                var response = JSON.parse(data);

                if (response.status == "200") {
                    document.getElementById('views_dashboard_directs').innerHTML = numberWithCommas(response.account_directs);
                    document.getElementById('views_dashboad_accountPackage').innerHTML = numberWithCommas(response.account_package);
                    document.getElementById('views_profile_username').innerHTML = binary_username;
                    document.getElementById('views_sidebar_username').innerHTML = binary_username;
                    document.getElementById('views_sidebar_fn').innerHTML = response.account_fullname;
                    document.getElementById('views_sidebar_email').innerHTML = response.account_email;
                    document.getElementById('views_verify_account_emailtxt').innerHTML = response.account_email;
                    document.getElementById('views_sidebar_dtJoined').innerHTML = 'Joined ' + response.account_created;
                    document.getElementById('views_dashboard_reflink').value = 'https://dherbsph.com/?link=' + binary_username;

                    app.vars.account_email = response.account_email;
                    app.vars.account_nn = response.nname;
                    app.vars.account_code = response.account_code;
                    binary_username = response.account_username;

                    if (response.account_type != 'USER') {
                        document.getElementById('stockist_menu').style.display = 'block';
                    }
                    else {
                        document.getElementById('stockist_menu').style.display = 'none';
                    }

                    if (response.account_token == null) {
                        if (document.getElementById('views_verify_account').style.display != "block") {
                            views.showOnTop('views_verify_account');
                        }
                    }
                    else {
                        if (document.getElementById('views_verify_account').style.display == "block") {
                            views.hide_card('views_verify_account');
                        }
                    }
                }

                else {
                    app.hideLoad();

                }

            })
    },
    resetPassword: function () {
        var account_username_tmp = '';
        if (tokenid != '') {
            account_username_tmp = binary_username;
        }
        else {
            account_username_tmp = document.getElementById('views_pswd_reset_username').value;
        }

        app.showLoad();
        $.post(app.config.ApiUrl + "api/interface/reset_account_password", {
            account_username: account_username_tmp
        },
            function (data) {
                console.log(data);
                var response = JSON.parse(data);

                if (response.status == "200") {
                    app.showMessage('Password reset email has been sent. Check your mail', 'Success');
                }
                else if (response.status == "404") {
                    app.showMessage('That account does not exist', 'Error');
                }
                else {
                    app.showMessage('There was an error while sending the reset mail. Please try again later', 'Error');
                }
                app.hideLoad();
            })
        return false
    },
    sendVerification: function () {
        app.showLoad();
        $.post(app.config.ApiUrl + "api/interface/resend_verify_account", {
            account_code: account_code,
            email: app.vars.account_email
        },
            function (data) {
                console.log(data);
                var response = JSON.parse(data);

                if (response.status == "200") {
                    app.showMessage('Verification email has been sent. Check your email', 'Success');
                }

                else {
                    app.showMessage('There was an error while sending the verification. Please try again later', 'Error');
                }
                app.hideLoad();
            })
    },
    editInfo: function () {
        app.showLoad();
        $.post(app.config.ApiUrl + "api/interface/account_edit_info", {
            userid: account_code,
            intent: app.vars.dialogIntent,
            args: document.getElementById('views_popup_input_data').value
        },
            function (data) {
                console.log(data);
                var response = JSON.parse(data);

                if (response.status == "200") {
                    app.showMessage('Manna Account Successfully Updated!', 'Success');
                    app.hideMessage();
                }

                else {
                    app.showMessage('There was an error while sending the changes. Please try again later', 'Error');
                }
                app.hideLoad();
            })
    },
    checkTicket: function () {
        $.post(app.config.ApiUrl + "api/interface/get_all_ticket", {
            intent: "getPackage",
            ticket_code: document.getElementById('views_account_upgrade_cupon').value,
        },

            function (data) {
                //console.log(data);
                var result = JSON.parse(data);
                app.hideLoad();
                if (result.status == "200") {
                    document.getElementById('views_account_upgrade_select').value = result.result.name;
                    document.getElementById('views_account_upgrade_pckAmt').innerHTML = result.result.value;
                }

                else {
                    document.getElementById('views_account_upgrade_select').value = "CUPONINVALID";
                    document.getElementById('views_account_upgrade_pckAmt').innerHTML = "0.00"
                  //  app.showMessage('There was an error submitting your request. Try changing your email address or username, or the cupon code may have been used. Please try again.', 'Error');
                }

            })

    },
    upgrade: function () {
        $.post(app.config.ApiUrl + "api/interface/upgrade_account", {
            account_code: tokenid,
            ticket_code: document.getElementById('views_account_upgrade_cupon').value,
        },

            function (data) {
                //console.log(data);
                var result = JSON.parse(data);
                app.hideLoad();
                if (result.status == "200") {
                    close_view_card('views_account_upgrade');
                    app.showMessage('Your Manna account has been successfully upgraded!', 'Success');
                }

                else {                  
                    app.showMessage('There was an error submitting your request. The cupon code may have been used. Please try again.', 'Error');
                }

            })

    },
    cashout: function () {
        app.showLoad();
        $.post(app.config.ApiUrl + "api/interface/wallet_payout", {
            account_code: tokenid,
            payout_amount: document.getElementById('views_wallet_send_amount').value,
            payout_mode: document.getElementById('views_wallet_send_mode').value,
            payout_detail: document.getElementById('views_wallet_send_detail').value,
        },

            function (data) {
                //console.log(data);
                var result = JSON.parse(data);
                app.hideLoad();
                if (result.status == "200") {
                    close_view_card('views_wallet_send');
                    app.showMessage('Your cashout is now pending for proccess!', 'Success');
                }

                else {
                    app.showMessage('Wallet not enough balance', 'Error');
                }

            })

    },
    updatevAvatar: function () {

        var files = document.getElementById('avt_fileToUpload').files[0];
        var formData = new FormData();

        var form = new FormData();
        form.append('image', files);

        var settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://www.blackoutfxtournament.com/api/v1/avatar/upload",
            "method": "POST",
            "headers": {
                //"Authorization": "Bearer " + userAuthToken
            },
            "Accept": "application/json",
            "cache-control": "no-cache",
            "processData": false,
            "contentType": false,
            "mimeType": "multipart/form-data",
            "data": form
        }

        app.showLoad();

        $.ajax(settings).done(function (response) {
            // var resp = JSON.parse(response);
            variables.getAccountSettings();

            app.showMessage('Avatart Updated!', '');
            window.setTimeout(function () {
                app.hideMessage();
                // views.show('views_inventory');
            }, 1500);

            //console.log(response);
            app.hideLoad();
            client.getUserData();




        });
    },
    confirmProducts: function () {
        var form = new FormData();
        form.append("product_id", "0");
        form.append("amount", parseFloat(app.vars.userProductsPending));
        form.append("account_code", app.vars.account_code);
        app.showLoad();
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": app.config.ApiUrl + "api/interface/buy_product_confirm",
            "method": "POST",
            "headers": {
                "Accept": "application/json",
                "cache-control": "no-cache",
                "Postman-Token": "ec33f549-fd4e-41ef-a140-d54d742b16ef"
            },
            "processData": false,
            "contentType": false,
            "mimeType": "multipart/form-data",
            "data": form
        }

        $.ajax(settings).done(function (response) {
            app.hideLoad();
            response = JSON.parse(response);
            if (response.status == '200') {
               account.loadWallet();
               app.showMessage('Your received products has been confirmed, check your wallet for earnings', 'Success', 'Got it');
            }
        });
    }

}