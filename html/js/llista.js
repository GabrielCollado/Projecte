function loadFileList() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                var fileList = document.getElementById('llista');
                fileList.innerHTML = ''; // Limpiar la lista de archivos

                var selectArxiu = document.getElementById('selectArxiu');
                selectArxiu.innerHTML = ''; // Limpiar el select

                var response = JSON.parse(xhr.responseText);
                var files = response.files;
                
                if (Array.isArray(files)) {
                    files.forEach(function(file) {
                        // Crear elemento <li> para la lista de archivos
                        var li = document.createElement('li');
                        li.textContent = file;
                        fileList.appendChild(li);

                        // Crear elemento <option> para el select
                        var option = document.createElement('option');
                        option.textContent = file;
                        option.value = file; // Establecer el valor del option como el nombre del archivo
                        selectArxiu.appendChild(option);
                    });
                } else {
                    console.error("El campo 'files' no es un array en la respuesta.");
                }
                
            } else {
                console.error('Error al cargar la lista de archivos.');
            }
        }
    };
    xhr.open('GET', '../php/llistarArxius.php', true);
    xhr.send();
}
loadFileList();