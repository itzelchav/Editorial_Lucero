<?php
require_once "db.php";
$conn->set_charset("utf8mb4");

/* Marcar salida si llega POST */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cerrar"])) {
    $id = (int)$_POST["cerrar"];
    $stmt = $conn->prepare("UPDATE accesos SET fecha_hora_salida = NOW() WHERE id_acceso = ? AND fecha_hora_salida IS NULL");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

/* Filtro */
$solo_abiertos = (isset($_GET["estado"]) && $_GET["estado"] === "abiertos");

/* Query unificada (empleados + visitantes) */
$sql = "
SELECT a.id_acceso,
       a.tipo,
       a.id_persona,
       CASE 
         WHEN a.tipo='empleado'  THEN e.nombre
         WHEN a.tipo='visitante' THEN v.nombre
       END AS nombre,
       CASE 
         WHEN a.tipo='empleado'  THEN e.puesto
         WHEN a.tipo='visitante' THEN v.motivo
       END AS extra,
       a.fecha_hora_entrada,
       a.fecha_hora_salida
FROM accesos a
LEFT JOIN empleados e  ON a.tipo='empleado'  AND a.id_persona = e.id_empleado
LEFT JOIN visitantes v ON a.tipo='visitante' AND a.id_persona = v.id_visitante
";
if ($solo_abiertos) {
    $sql .= " WHERE a.fecha_hora_salida IS NULL ";
}
$sql .= " ORDER BY a.id_acceso DESC LIMIT 100";

$res = $conn->query($sql);
$rows = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Accesos</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:system-ui,Arial;padding:20px;background:#f7f7f8}
.controls{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:12px}
a.btn,button.btn{padding:8px 12px;border-radius:10px;border:1px solid #ddd;background:#fff;text-decoration:none;color:#111;cursor:pointer}
a.btn.active{background:#111;color:#fff;border-color:#111}
table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,.06)}
th,td{padding:10px;border-bottom:1px solid #eee;text-align:left;font-size:14px}
.badge{padding:4px 8px;border-radius:999px;font-size:12px;border:1px solid #ddd}
.in{background:#e7f8ed;border-color:#bfe6cd}
.out{background:#f5f5f5}
.empty{padding:10px;background:#fff;border-radius:12px;box-shadow:0 6px 20px rgba(0,0,0,.06)}
</style>
</head>
<body>
  <h2>Accesos</h2>

  <div class="controls">
    <a class="btn <?= !$solo_abiertos ? 'active':'' ?>" href="listar_accesos.php">Últimos</a>
    <a class="btn <?= $solo_abiertos ? 'active':'' ?>" href="listar_accesos.php?estado=abiertos">Dentro (abiertos)</a>
    <a class="btn" href="registrar_empleado.php">+ Empleado</a>
    <a class="btn" href="registrar_visitante.php">+ Visitante</a>
    <a class="btn" href="acceso.php">Registrar entrada/salida</a>
  </div>

  <?php if(empty($rows)): ?>
    <div class="empty">Sin registros.</div>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Nombre</th>
          <th>Detalle</th>
          <th>Entrada</th>
          <th>Salida</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($rows as $r): 
        $abierto = is_null($r["fecha_hora_salida"]);
      ?>
        <tr>
          <td><?= (int)$r["id_acceso"] ?></td>
          <td><span class="badge"><?= htmlspecialchars($r["tipo"]) ?></span></td>
          <td><?= htmlspecialchars($r["nombre"] ?? '(desconocido)') ?></td>
          <td><?= htmlspecialchars($r["extra"] ?? '') ?></td>
          <td><?= htmlspecialchars($r["fecha_hora_entrada"]) ?></td>
          <td>
            <?php if($abierto): ?>
              <span class="badge in">Dentro</span>
            <?php else: ?>
              <span class="badge out"><?= htmlspecialchars($r["fecha_hora_salida"]) ?></span>
            <?php endif; ?>
          </td>
          <td>
            <?php if($abierto): ?>
              <form method="post" style="margin:0">
                <input type="hidden" name="cerrar" value="<?= (int)$r["id_acceso"] ?>">
                <button class="btn" type="submit">Marcar salida</button>
              </form>
            <?php else: ?>
              —
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>
