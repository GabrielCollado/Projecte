document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('baixarCarpeta');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const selectedFolder = document.getElementById('selectCarpeta').value;

        
        fetch('../php/baixarCarpeta.php?carpeta=' + encodeURIComponent(selectedFolder))
            .then(response => response.blob())
            .then(blob => {
                
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = selectedFolder + '.zip'; 
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
            })
            .catch(error => {
                console.error('Error al descargar la carpeta:', error);
            });
    });
});