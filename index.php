<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Editorial Lucero - Control de Accesos</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:system-ui,Arial;margin:0;padding:0;background:#f4f6f9}
.header{background:#111;color:#fff;text-align:center;padding:30px 20px}
.header img{max-width:120px;margin-bottom:10px}
.container{max-width:800px;margin:40px auto;padding:20px;background:#fff;border-radius:16px;box-shadow:0 6px 20px rgba(0,0,0,.08);text-align:center}
h1{margin-bottom:10px}
p{font-size:18px;color:#333;line-height:1.5}
nav{margin-top:20px;display:flex;justify-content:center;gap:12px;flex-wrap:wrap}
a.btn{display:inline-block;padding:12px 20px;background:#111;color:#fff;text-decoration:none;border-radius:10px;transition:.3s}
a.btn:hover{background:#444}
</style>
</head>
<body>
  <div class="header">
    <!-- Cambia "logo.png" por tu logo real -->
    <img src="logolucero.png" alt="Logo Editorial">
    <h1>Sistema de Control de Accesos</h1>
  </div>

  <div class="container">
    <p>Bienvenido al sistema de control de accesos de la Editorial Lucero.  
       Aquí se registran las <strong>entradas y salidas</strong> de empleados y visitantes, 
       con el fin de garantizar seguridad y un mejor control en nuestras instalaciones.</p>

    <nav>
      <a class="btn" href="acceso.php">Registrar Acceso</a>
      <a class="btn" href="listar_accesos.php">Ver Accesos</a>
      <a class="btn" href="registrar_empleado.php">Registrar Empleado</a>
      <a class="btn" href="registrar_visitante.php">Registrar Visitante</a>
    </nav>
  </div>
</body>
</html>