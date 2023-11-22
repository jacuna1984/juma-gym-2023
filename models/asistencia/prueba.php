<?php
class Asistencias {
    
    public function compruebaAsistenciaCliente($id_cliente) {
    $fila = [];

    $sql = "SELECT
            id
            FROM
                asistencias_clientes
            WHERE
            DATE(fecha_registro) = DATE(NOW()) AND 
            cliente_id = ?;
            ";

    if ($consulta = $conexion->prepare($sql)) {
        $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);

        if ($consulta->execute()) {
            $fila = $consulta->fetch(PDO::FETCH_ASSOC);
        }
    }

    return !empty($fila); // Devuelve true si se encontró asistencia registrada para este cliente hoy, de lo contrario false
}

}
?>
