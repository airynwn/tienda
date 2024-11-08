<?php
session_start();

use App\Tablas\Factura;

require_once '../src/auxiliar.php';

if (!($usuario = \App\Tablas\Usuario::logueado())) {
    return volver();
}

$id = obtener_get('id');

if (!isset($id)) {
    return volver();
}

$pdo = conectar();

$factura = Factura::obtener($id, $pdo);

if (!isset($factura)) {
    return volver();
}

if ($factura->getUsuarioId() != $usuario->id) {
    return volver();
}

$filas_tabla = '';
$total = 0;

foreach ($factura->getLineas($pdo) as $linea) {
    $articulo = $linea->getArticulo();
    $codigo = $articulo->getCodigo();
    $descripcion = $articulo->getDescripcion();
    $cantidad = $linea->getCantidad();
    $precio = $articulo->getPrecio();
    $importe = $cantidad * $precio;
    $total += $importe;
    $precio = dinero($precio);
    $importe = dinero($importe);

    // probar thead->tr->th
    $filas_tabla .= <<<EOF
        <tr>
            <td>$codigo</td>
            <td>$descripcion</td>
            <td>$cantidad</td>
            <td>$precio</td>
            <td>$importe</td>
        </tr>
    EOF;
}

$total = dinero($total);

$res = <<<EOT
<p>Factura número: {$factura->id}</p>
<table border="1">
    <tr>
        <th>Código</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Importe</th>
    </tr>
    <tbody>
        $filas_tabla
    </tbody>
</table>
<p>Total: $total</p>
EOT;

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
$mpdf->WriteHTML($res);

// Output a PDF file directly to the browser
$mpdf->Output();