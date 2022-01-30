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

function caricaRiunioni() {
    xhr = new ajaxRequest();

    url = "backend/check_riunioni.php"
    xhr.open("GET", url, true);

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (xhr.responseText != null) {
                risposta = JSON.parse(this.response);
                console.log(risposta);

                if (risposta.length > 0) {
                    document.getElementById('bell').innerHTML = risposta.length;
                }

                var item = document.getElementById('notifica');
                riunioni = document.createElement('ul');
                item.appendChild(riunioni);

                for (i = 0; i < risposta.length; i++) {
                    const li = document.createElement('li');
                    const tema = document.createElement('h6');
                    const dettagli = document.createElement('p');
                    tema.innerText = risposta[i].tema;
                    dettagli.innerText = risposta[i].Data + ' ' + risposta[i].Ora + ' ' + risposta[i].Salariunioni;
                    li.appendChild(tema);
                    li.appendChild(dettagli);
                    riunioni.appendChild(li);
                }
            }
            else alert("Ajax error: no data received");
        }
    }

    xhr.send();
}

window.addEventListener('DOMContentLoaded', caricaRiunioni());