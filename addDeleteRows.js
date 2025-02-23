function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	var colCount = table.rows[0].cells.length;
	for(var i=0; i<colCount; i++) {
		var newcell	= row.insertCell(i);
		newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		//alert(newcell.childNodes);
		switch(newcell.childNodes[0].type) {
			case "text":
					newcell.childNodes[0].value = "";
					break;
			case "checkbox":
					newcell.childNodes[0].checked = false;
					break;
			case "select-one":
					newcell.childNodes[0].selectedIndex = 0;
					break;
		}
	}
}

function deleteRow(tableID) {
	try {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			/*if(rowCount <= 1) {
				alert("Cannot delete all the rows.");
				break;
			}*/
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
	if (rowCount==0) document.getElementById('pnlSubjects').innerHTML = "<input type='button' id='btnAddRow' onclick='addSubjects();' value='Add Subject' class='button' />";
	}catch(e) {
		alert(e);
	}
}

function cloneRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	var colCount = table.rows[0].cells.length;
	for(var i=0; i<colCount; i++) {
		var newcell	= row.insertCell(i);
		var newElement =  table.rows[0].cells[i].childNodes[0].cloneNode(true);
		newElement.name = newElement.id + '[' + (rowCount) + ']';
		newcell.appendChild(newElement);
	}
}