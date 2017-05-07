function toast(msg, time) {
    new $.nd2Toast({
        message: msg,
        ttl: time
    });
}

function toastAction(msg, actionTitle, url, clr, time) {
    new $.nd2Toast({
        message: msg,
        action: {
            title: actionTitle,
            link: url,
            fn: function() {
                console.log("Action Button clicked'");
            },
            color: clr
        },
        ttl: time
    });
}