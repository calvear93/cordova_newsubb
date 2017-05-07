function addNews( listID, id, thumbnail, tags, date, title, description ) {
	$("#" + listID).append('<li class="wow slideInUp" id="' + id + '"><a href="#"><img class="ui-thumbnail ui-thumbnail-circular" src="' + thumbnail + '"/><div align="left"><sub><i class="zmdi zmdi-tag-more"></i> Tags: ' + tags + '</sub></div><p align="right"><i class="zmdi zmdi-calendar"></i> ' + date + '&nbsp&nbsp&nbsp</p><div align="left"><i class="zmdi zmdi-open-in-new"></i> ' + title + '<br/><p>' + description + '</p></div></a></li>').listview('refresh');
}

function addMore( listID, id ) {
	$("#" + listID).append('<a href="#" id="' + id + '" class="ui-btn ui-btn-raised clr-primary wow slideInRight" data-wow-delay="0.4s"><i class="zmdi zmdi-plus"></i> Más noticias</a>').listview('refresh');
}