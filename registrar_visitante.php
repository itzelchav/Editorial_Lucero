<?php
require_once "db.php";
$conn->set_charset("utf8mb4");

$ok = $err = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre  = trim($_POST["nombre"] ?? "");
    $motivo  = trim($_POST["motivo"] ?? "");
    $persona = trim($_POST["persona"] ?? "");
    $empresa = trim($_POST["empresa"] ?? "");
    $tel     = trim($_POST["telefono"] ?? "");

    if ($nombre === "") {
        $err = "El nombre es obligatorio.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO visitantes (nombre, motivo, persona_a_visitar, empresa, telefono)
             VALUES (?,?,?,?,?)"
        );
        $stmt->bind_param("sssss", $nombre, $motivo, $persona, $empresa, $tel);
        if ($stmt->execute()) {
            $ok = "Visitante registrado (ID: " . $stmt->insert_id . ").";
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
<title>Registrar Visitante</title>
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
  <h2>Registrar Visitante</h2>

  <?php if($ok): ?><div class="alert ok"><?= htmlspecialchars($ok) ?></div><?php endif; ?>
  <?php if($err): ?><div class="alert err"><?= htmlspecialchars($err) ?></div><?php endif; ?>

  <form method="post" autocomplete="off">
    <label>Nombre *</label>
    <input type="text" name="nombre" required>

    <label>Motivo</label>
    <input type="text" name="motivo" placeholder="Entrega, reunión, entrevista...">

    <label>Persona a Visitar</label>
    <input type="text" name="persona" placeholder="Ej. Juan Pérez (Editorial)">

    <label>Empresa (opcional)</label>
    <input type="text" name="empresa">

    <label>Teléfono (opcional)</label>
    <input type="text" name="telefono">

    <button type="submit">Guardar</button>
  </form>

  <p style="margin-top:14px"><a href="listar_accesos.php">Ver accesos</a></p>
</body>
</html>

