function generate_table(table_data){
	var table = document.createElement('table');
	for (var r = 0; r < table_data.length; r++){
	    var tr = document.createElement('tr'); 
	    row_data = table_data[r]
	    for (var key in row_data) {
			var column_data = row_data[key];
			var td = document.createElement('td');
			var content = document.createTextNode(column_data);
			td.appendChild(content)
			tr.appendChild(td)
		};
		table.appendChild(tr)
	};
	document.body.appendChild(table);
};

function sort_by_song(a,b){
	return a[1] > b[1]
};
