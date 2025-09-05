<?php
require_once "db.php";
$conn->set_charset("utf8mb4");

$ok = $err = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $puesto = trim($_POST["puesto"] ?? "");
    $depto  = trim($_POST["departamento"] ?? "");

    if ($nombre === "") {
        $err = "El nombre es obligatorio.";
    } else {
        $stmt = $conn->prepare("INSERT INTO empleados (nombre, puesto, departamento) VALUES (?,?,?)");
        $stmt->bind_param("sss", $nombre, $puesto, $depto);
        if ($stmt->execute()) {
            $ok = "Empleado registrado (ID: " . $stmt->insert_id . ").";
        } else {
            $err = "Error al guardar: " . $conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registrar Empleado</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:system-ui,Arial;padding:20px;background:#f7f7f8}
form{background:#fff;padding:16px;border-radius:12px;max-width:540px;box-shadow:0 6px 20px rgba(0,0,0,.06)}
input,button{font-size:16px;padding:10px;border-radius:10px;border:1px solid #ddd;width:520px}
label{display:block;margin:10px 0 6px}
button{background:#111;color:#fff;border:none;cursor:pointer;margin-top:10px}
.alert{padding:10px;border-radius:10px;margin-bottom:12px}
.ok{background:#e7f8ed;border:1px solid #bfe6cd}
.err{background:#fde8e8;border:1px solid #f5b1b1}
a{color:#0a58ca;text-decoration:none}
</style>
</head>
<body>
  <h2>Registrar Empleado</h2>

  <?php if($ok): ?><div class="alert ok"><?= htmlspecialchars($ok) ?></div><?php endif; ?>
  <?php if($err): ?><div class="alert err"><?= htmlspecialchars($err) ?></div><?php endif; ?>

  <form method="post" autocomplete="off">
    <label>Nombre *</label>
    <input type="text" name="nombre" required>

    <label>Puesto</label>
    <input type="text" name="puesto">

    <label>Departamento</label>
    <input type="text" name="departamento">

    <button type="submit">Guardar</button>
  </form>

  <p style="margin-top:14px"><a href="listar_accesos.php">Ver accesos</a></p>
</body>
</html>
