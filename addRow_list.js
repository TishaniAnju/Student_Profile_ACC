function addRowList(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[0].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[1].cells[i].innerHTML;
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
	                    table.deleteRow(i);
	                    rowCount--;
	                    i--;
											
	                }
	 			
	            }
	            }catch(e) {
	                alert(e);
	            }
				document.getElementById("rowCount").value = rowCount-1;
	        }
			
		
		function tableReset(tableID) {
			
		 document.getElementById('txtCode').value ="";	
		 document.getElementById('txtSubject').value ="";
		}


