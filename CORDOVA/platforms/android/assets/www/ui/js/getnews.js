function requestNewsList(frm, quantity, tags = null) {
	if (tags != null) {
    	$.getJSON("http://colvin.chillan.ubiobio.cl:8070/crialvea/newsubb/news.php?from=" + frm + "&quantity=" + quantity + "&tags=" + tags, "", OnGetMemberSuccess);
    }
    else {
    	$.getJSON("http://colvin.chillan.ubiobio.cl:8070/crialvea/newsubb/news.php?from=" + frm + "&quantity=" + quantity, OnGetMemberSuccess);
    }
}

function OnGetMemberSuccess(data, status) {
    var news = JSON.parse(JSON.stringify(data));
    var mode = news.mode;
    news = news.list;

    news.forEach(function(item, index) {
        item.thumbnail = decodeURIComponent(item.thumbnail);
        item.url = decodeURIComponent(item.url);
    });
    OnReceiveList(news, mode);
    // console.log(news);
    // console.log(status);
}