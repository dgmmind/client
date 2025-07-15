<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>
<body>
<h2>Usuarios registrados</h2>
<ul id="userList"></ul>
<button onclick="logout()">Cerrar sesión</button>
<p id="msg"></p>

<script>
    const msg = document.getElementById('msg');
    const token = localStorage.getItem('token');

    if (!token) {
        msg.textContent = "No estás autenticado. Redirigiendo...";
        setTimeout(() => window.location.href = 'index.php', 1500);
    } else {
        fetch('http://localhost/dgmmind/ca/public/users', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(res => res.json())
            .then(data => {
                const ul = document.getElementById('userList');
                if (Array.isArray(data)) {
                    data.forEach(u => {
                        const li = document.createElement('li');
                        li.textContent = `${u.user_name} (${u.user_email})`;
                        ul.appendChild(li);
                    });
                } else {
                    msg.textContent = data.error || "Error al cargar usuarios";
                }
            });
    }

    function logout() {
        localStorage.removeItem('token');
        window.location.href = 'index.php';
    }
</script>
</body>
</html>
