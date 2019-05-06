const payment = {
    new: function () {
        // CHECK PAYMENT METHOD
        var tx_method = document.getElementById('tx_pay_method').value;
        
        switch (tx_method) {
            case 'BITCOIN':
                document.getElementById('payment_basic').style.display = 'none';
                document.getElementById('payment_crypto_confirm').style.display = 'block';

                document.getElementById('tx_pay_display_method').innerHTML = tx_method;
                document.getElementById('tx_pay_display_ctype').innerHTML = document.getElementById('tx_pay_ctype').value;
                document.getElementById('tx_pay_display_count').innerHTML = document.getElementById('tx_pay_count').value;

                // GET PACKAGE AMOUNT
                $.post(app.config.ApiUrl + "api/interface/get_all_packages", {
                    intent: 'single',
                    package_name: document.getElementById('tx_pay_ctype').value
                },
                    function (data) {
                        //console.log(data);
                        var response = JSON.parse(data);

                        if (response.status == "200") {
                            var totalPay = parseFloat(response.result) * parseFloat(document.getElementById('tx_pay_count').value);
                            document.getElementById('tx_pay_display_payAmount').innerHTML = numberWithCommas(totalPay);
                           
                        }

                        else {
                            //app.hideLoad();
                            app.showMessage('Error getting package information', 'Error');
                        }

                    })

                break;
            
            default:
                document.getElementById('payment_crypto_confirm').style.display = 'none';
                document.getElementById('payment_basic').style.display = 'block';
                break;
        }

        views.showCard('views_payment');
    },
    summary: function () {
       

        
    }

}