function ajaxRequest() {
    var request = false;
    try { request = new XMLHttpRequest() } catch (e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") } catch (e2) {
            try { request = new ActiveXObject("Microsoft.XMLHTTP") } catch (e3) {
                request = false
            }
        }
    }
    return request
}

function listaSale(str) {

	xhr = new ajaxRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
			document.getElementById("sala").innerHTML=xhr.responseText;
		}
	}
	
	xhr.open("GET", "backend/lista_sale.php?q="+str, true);
	
	xhr.send();
			
}

function capienzaSala(str) {
	
	xhr = new ajaxRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
			document.getElementById("capienza").innerHTML=xhr.responseText;
		}
	}
	
	xhr.open("GET", "backend/capienza_sala.php?q="+str, true);
	
	xhr.send();
	
}



