const services = {
    backgroundRefresh: function () {
        window.setTimeout(function () {
            account.loadWallet();
            account.loadAccountData();
            account.listMembers(true,'downline');
            services.backgroundRefresh();
        }, 5000);
    }

}