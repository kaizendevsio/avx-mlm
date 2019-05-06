class apCore {
    constructor(userAccounts) {
        this.userAccounts() = userAccounts;
    }

    initialize() {
        for (var i = 0; i < 10; i++) {
            var tmpData = userAccount;
            tmpData.parentID = i;
            tmpData.userID = (i + 1);


            this.userAccounts(i) = tmpData;
        }
    }
}

class linearMatrix {
    constructor(length, dtCreated, dtModified) {

    }
}

class userAccount {
    constructor(parentID, userID, userName, directs, wallet, history, dtCreated, dtLastLogon, matrixPos) {
        this.parentID = parentID;
        this.userID = userID;
        this.userName = userName;
        this.directs = directs;
        this.wallet = wallet;
        this.history = history;
        this.dtCreated = dtCreated;
        this.dtLastLogon = dtLastLogon;
        this.matrixPos = matrixPos;

    }
}

class walletData {
    constructor(stats_directRef, stats_matching, stats_shp, wallets_main, history) {
        this.stats_directRef = stats_directRef;
        this.stats_matching = stats_matching;
        this.stats_shp = stats_shp;
        this.wallets_main = wallets_main;
        this.history = history;
    }
}

class history {
    constructor(userID, recordType, message, dateData, amountData) {
        this.userID = userID;
        this.recordType = recordType;
        this.message = message;
        this.dateData = dateData;
        this.amountData = amountData;
    }
}