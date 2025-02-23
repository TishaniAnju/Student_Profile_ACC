   function addRow(tableID) {
 
            var table = document.getElementById(tableID);
	 
	          var rowCount = table.rows.length;
	          var row = table.insertRow(rowCount);
	 
	            var cell1 = row.insertCell(0);
            var element1 = document.createElement("input");
            element1.type = "checkbox";
	            cell1.appendChild(element1);
 
	         //   var cell2 = row.insertCell(1);
	          //  cell2.innerHTML = rowCount + 1;
	 
        				
			var cell2 = row.insertCell(1);
	            var element2 = document.createElement("input");
	            element2.type = "text";
				element2.size = "20";
	            cell2.appendChild(element2);
				
			var cell3 = row.insertCell(2);
	            var element3 = document.createElement("input");
	            element3.type = "text";
				element3.size = "15";
	            cell3.appendChild(element3);
				
			document.getElementById("rowCount").value = rowCount;
 
	        }
	 
	        function deleteRow(tableID) {
	            try {
	            var table = document.getElementById(tableID);
	            var rowCount = table.rows.length;
	 										
	            for(var i=0; i<rowCount; i++) {
	                var row = table.rows[i];
	                var chkbox = row.cells[0].childNodes[0];
	                if(null != chkbox && true == chkbox.checked) {
						
						if(rowCount==1){
					var msg = "Cannot delete all rows !";
					alert(msg);
					}
					else{
	                    table.deleteRow(i);
	                    rowCount--;
	                    i--;
					}
	                }
	 			
	            }
			
	            }catch(e) {
	                alert(e);
	            }
				document.getElementById("rowCount").value = rowCount-1;
	        }
			
			
function cloneRow(tableID) {
       var table = document.getElementById(tableID);
	   var rowCount = table.rows.length;
       var row = table.insertRow(rowCount);
       var colCount = table.rows[0].cells.length;
       for(var i=0; i<colCount; i++) {
               var newcell        = row.insertCell(i);
               var newElement =  table.rows[1].cells[i].childNodes[0].cloneNode(true);
               newElement.name = newElement.id + '[' + (rowCount-1) + ']';
               newcell.appendChild(newElement);
       }
	   document.getElementById("rowCount").value = rowCount;
}
			
			
		