function soundcloud_fields(){
	var show_list = ["song_row", "url_row", "content_row", "instruments_row", "uploader_row","comments_row", "soundcloud_row"];
	show_these(show_list);
};
function default_fields(){
	show_list = ["song_row", "url_row", "content_row", "instruments_row", "uploader_row", "comments_row"];
	show_these(show_list);
};
var show_list
var all_ids = [
	"song_row",
	"url_row",
	"content_row",
	"instruments_row",
	"uploader_row",
	"comments_row",
	"soundcloud_row"];
	
function show_these(list_of_ids){
	//console.log(list_of_ids)
	for (var i=0; i<list_of_ids.length; i++){
		var id = list_of_ids[i]
		//console.log(id)
		document.getElementById(id).style.display = "";
	};
	for (var j=0; j<all_ids.length; j++){
		var id = all_ids[j]
		//console.log(id);
		//console.log(id in list_of_ids);
		if (list_of_ids.indexOf(id) == -1){
			// Hide it
	 		document.getElementById(id).style.display = "None";
		};
	};
};
		
