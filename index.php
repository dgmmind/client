<!-- login.html -->
<form id="loginForm">
    <input type="text" id="identifier" placeholder="Usuario o Email" required>
    <input type="password" id="password" placeholder="Contraseña" required>
    <button type="submit">Ingresar</button>
</form>

<script>
    document.getElementById('loginForm').addEventListener('submit', async e => {
        e.preventDefault();
        const identifier = document.getElementById('identifier').value;
        const user_password = document.getElementById('password').value;

        try {
            const res = await fetch('http://localhost/dgmmind/ca/public/login', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ identifier, user_password })
            });

            const data = await res.json();

            if (res.ok) {
                // Guardamos el token
                localStorage.setItem('token', data.token);
                // Redirigimos a users.php
                window.location.href = 'users.php';
            } else {
                alert(data.error || 'Error en login');
            }
        } catch (error) {
            alert('Error en la conexión');
        }
    });
</script>
