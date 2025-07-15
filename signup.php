<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
<h2>Registrar usuario</h2>
<form id="registerForm">
    <input type="text" name="user_name" placeholder="Nombre de usuario" required><br>
    <input type="email" name="user_email" placeholder="Correo electrónico" required><br>
    <input type="password" name="user_password" placeholder="Contraseña" required><br>
    <button type="submit">Registrarse</button>
</form>
<p id="msg"></p>

<script>
    const form = document.getElementById('registerForm');
    const msg = document.getElementById('msg');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(form));

        const res = await fetch('http://localhost/dgmmind/ca/public/users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const json = await res.json();
        if (json.token) {
            localStorage.setItem('token', json.token);
            msg.textContent = "¡Registro exitoso! Redirigiendo...";
            setTimeout(() => window.location.href = 'users.html', 1500);
        } else {
            msg.textContent = json.error || "Error al registrar";
        }
    });
</script>
</body>
</html>
