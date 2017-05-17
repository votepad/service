module.exports = function (ws) {

    var cookies = ws.upgradeReq.headers.cookie;

    var get = function (name) {

        if (!cookies) return undefined;

        var match = cookies.match(new RegExp('\\b'+name+'=([^;]*)'));

        return match ? decodeURIComponent(match[1]).split('~')[1] : undefined;

    };

    /** TODO: add set and update remove response cookies methods **/

    return {
        get: get
    };

};