document.addEventListener('DOMContentLoaded', function() {
    const url = '../php/llistarCarpetes.php';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const selectCarpeta = document.getElementById('selectCarpeta');
            for (const carpeta in data) {
                const option = document.createElement('option');
                option.textContent = carpeta;
                option.value = carpeta; // Puedes establecer el valor según tus necesidades
                selectCarpeta.appendChild(option);
            }
        })
        .catch(error => {
            console.error('Error al obtener los datos de las carpetas:', error);
        });
});