document.addEventListener('DOMContentLoaded', function() {
    var selectArxiu = document.getElementById('selectArxiu');

    document.getElementById('baixar').addEventListener('submit', function(event) {
        event.preventDefault(); 

        
        var selectedFile = selectArxiu.value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../php/baixar.php?archivo=' + encodeURIComponent(selectedFile), true);
        xhr.responseType = 'blob';

        xhr.onload = function() {
            if (xhr.status === 200) {
                var url = window.URL.createObjectURL(xhr.response);
                var a = document.createElement('a');
                a.href = url;
                a.download = selectedFile;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
            } else {
                console.error('Error al descargar el archivo:', xhr.statusText);
            }
        };

        xhr.onerror = function() {
            console.error('Error de red al intentar descargar el archivo.');
        };

        xhr.send();
    });
});