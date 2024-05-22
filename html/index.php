<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <link rel="stylesheet" href="/css/styles_index.css">
</head>
<body>
    <div class="center-box">
        <div class="content">
            <h1>Benvingut</h1>
            <p>Tria una opció:</p>
            <button type="button" id="creausu">Crear Usuari</button>
            <button type="button" id="login">Entrar</button>
        </div>
    </div>

    <script>
        var botonLogin = document.getElementById("login");
        botonLogin.addEventListener("click", function() {
            window.location.href = "login.html";
        });
        
        var botonCrea = document.getElementById("creausu");
        botonCrea.addEventListener("click", function() {
            window.location.href = "creausu.html";
        });
    </script>
</body>
</html>