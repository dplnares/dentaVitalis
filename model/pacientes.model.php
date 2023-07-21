<?php

require_once "conexion.php";

class ModelPacientes
{
  //  Mostrar todos los pacientes modulo pacientes
  public static function mdlMostrarPacientes($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.CelularPaciente FROM $tabla ORDER BY IdPaciente ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear un nuevo paciente por modulo de pacientes
  public static function mdlCrearPaciente($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombrePaciente, ApellidoPaciente, DNIPaciente, CelularPaciente, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:NombrePaciente, :ApellidoPaciente, :DNIPaciente, :CelularPaciente, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":NombrePaciente", $datosCreate["NombrePaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":ApellidoPaciente", $datosCreate["ApellidoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":DNIPaciente", $datosCreate["DNIPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":CelularPaciente", $datosCreate["CelularPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCreate["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCreate["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreacion", $datosCreate["FechaCreacion"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar los datos para editar un paciente
  public static function mdlMostrarDatosEditar($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Actualizar datos del paciente en modulo pacientes
  public static function mdlUpdatePaciente($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombrePaciente=:NombrePaciente, ApellidoPaciente=:ApellidoPaciente, DNIPaciente=:DNIPaciente, CelularPaciente=:CelularPaciente, FechaActualizacion=:FechaActualizacion WHERE IdPaciente=:IdPaciente");
    $statement -> bindParam(":NombrePaciente", $datosUpdate["NombrePaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":ApellidoPaciente", $datosUpdate["ApellidoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":DNIPaciente", $datosUpdate["DNIPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":CelularPaciente", $datosUpdate["CelularPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdPaciente", $datosUpdate["IdPaciente"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar un paciente
  public static function mdlEliminarPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdPaciente = $codPaciente");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }
}