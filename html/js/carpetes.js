document.addEventListener('DOMContentLoaded', () => {
    const url = '../php/llistarCarpetes.php';

    fetch(url)
        .then(response => response.json()) 
        .then(data => {
            
            const folderList = document.getElementById('carpetes');
            for (const folder in data) {
                
                const folderItem = document.createElement('li');
                folderItem.textContent = folder;

                const contentList = document.createElement('ul');
                data[folder].forEach(item => {
                    const contentItem = document.createElement('li');
                    contentItem.textContent = item;
                    contentList.appendChild(contentItem);
                });

                folderItem.appendChild(contentList);

                folderList.appendChild(folderItem);
            }
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
        });
});