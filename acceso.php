<?php
require_once "db.php";
$conn->set_charset("utf8mb4");

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];
    $id   = $_POST['id_persona'];

    if (isset($_POST['entrada'])) {
        $sql = "INSERT INTO accesos (tipo, id_persona) VALUES ('$tipo', '$id')";
        if ($conn->query($sql) === TRUE) {
            $msg = "✅ Entrada registrada correctamente.";
        } else {
            $msg = "❌ Error: " . $conn->error;
        }
    }

    if (isset($_POST['salida'])) {
        $sql = "UPDATE accesos 
                SET fecha_hora_salida = NOW() 
                WHERE id_persona='$id' AND tipo='$tipo' AND fecha_hora_salida IS NULL 
                ORDER BY id_acceso DESC LIMIT 1";
        if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
            $msg = "🚪 Salida registrada correctamente.";
        } else {
            $msg = "⚠️ No se encontró una entrada activa para cerrar.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registrar Acceso</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:system-ui,Arial;background:#f4f6f9;margin:0;padding:0}
.header{background:#111;color:#fff;padding:20px;text-align:center}
.container{max-width:600px;margin:40px auto;background:#fff;padding:20px;border-radius:12px;box-shadow:0 6px 20px rgba(0,0,0,.08)}
h2{text-align:center;margin-bottom:20px}
form{display:flex;flex-direction:column;gap:16px}
select,input,button{padding:12px;font-size:16px;border-radius:10px;border:1px solid #ccc;width: auto}
button{cursor:pointer;background:#111;color:#fff;border:none;transition:.3s}
button:hover{background:#444}
.buttons{display:block;gap:12px;margin-left: 150px}
.msg{padding:12px;border-radius:10px;margin-bottom:16px}
.ok{background:#e6f8ed;border:1px solid #b4e1c0}
.err{background:#fdeaea;border:1px solid #f5b1b1}
a{color:#0a58ca;text-decoration:none}
</style>
</head>
<body>
  <div class="header">
    <h1>Control de Accesos - Editorial</h1>
  </div>

  <div class="container">
    <h2>Registrar Entrada / Salida</h2>

    <?php if($msg): ?>
      <div class="msg <?= strpos($msg,'Error')!==false||strpos($msg,'No se')!==false ? 'err':'ok' ?>">
        <?= htmlspecialchars($msg) ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <label>Tipo de persona</label>
      <select name="tipo" required>
        <option value="empleado">Empleado</option>
        <option value="visitante">Visitante</option>
      </select>

      <label>ID de Persona</label>
      <input type="number" name="id_persona" placeholder="Ej. 1" required>

      <div class="buttons">
        <button type="submit" name="entrada">Registrar Entrada</button>
        <button type="submit" name="salida">Registrar Salida</button>
      </div>
    </form>

    <p style="margin-top:16px;text-align:center">
      <a href="listar_accesos.php">📋 Ver lista de accesos</a>
    </p>
  </div>
</body>
</html>
