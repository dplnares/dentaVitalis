<?php

require_once "conexion.php";

class ModelPacientes
{
  //  Mostrar todos los pacientes modulo pacientes
  public static function mdlMostrarPacientes($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.CelularPaciente FROM $tabla ORDER BY IdPaciente DESC");
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

  //  Mostrar los pacientes para la historia clinica
  public static function mdlMostrarPacientesHistoria($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar los datos de un paciente al momento de seleccionarlo en la historia
  public static function mdlMostrarDatosPacienteHistoria($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.FechaNacimiento, tba_paciente.CelularPaciente, tba_paciente.DomicilioPaciente, tba_paciente.LugarNacimiento, tba_paciente.GradoInstruccion, tba_paciente.RazaPaciente, tba_paciente.OcupacionPaciente, tba_paciente.ReligionPaciente, tba_paciente.EstadoCivil, tba_paciente.NumeroContactopaciente, tba_paciente.NombreContactoPaciente FROM $tabla WHERE idPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }
  
  //  Update de los datos del paciente en la historia clínica
  public static function mdlUpdateDatospaciente($tabla, $datosUpdatePaciente)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET DNIPaciente=:DNIPaciente, SexoPaciente=:SexoPaciente, EdadPaciente=:EdadPaciente, FechaNacimiento=:FechaNacimiento, CelularPaciente=:CelularPaciente, DomicilioPaciente=:DomicilioPaciente, LugarProcedencia=:LugarProcedencia, LugarNacimiento=:LugarNacimiento, GradoInstruccion=:GradoInstruccion, RazaPaciente=:RazaPaciente, OcupacionPaciente=:OcupacionPaciente, ReligionPaciente=:ReligionPaciente, EstadoCivil=:EstadoCivil, NumeroContactoPaciente=:NumeroContactoPaciente, NombreContactoPaciente=:NombreContactoPaciente, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE IdPaciente=:IdPaciente");
    $statement -> bindParam(":EdadPaciente", $datosUpdatePaciente["EdadPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":SexoPaciente", $datosUpdatePaciente["SexoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":DNIPaciente", $datosUpdatePaciente["DNIPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaNacimiento", $datosUpdatePaciente["FechaNacimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":CelularPaciente", $datosUpdatePaciente["CelularPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":DomicilioPaciente", $datosUpdatePaciente["DomicilioPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":LugarProcedencia", $datosUpdatePaciente["LugarProcedencia"], PDO::PARAM_STR);
    $statement -> bindParam(":LugarNacimiento", $datosUpdatePaciente["LugarNacimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":GradoInstruccion", $datosUpdatePaciente["GradoInstruccion"], PDO::PARAM_STR);
    $statement -> bindParam(":RazaPaciente", $datosUpdatePaciente["RazaPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":OcupacionPaciente", $datosUpdatePaciente["OcupacionPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":ReligionPaciente", $datosUpdatePaciente["ReligionPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":EstadoCivil", $datosUpdatePaciente["EstadoCivil"], PDO::PARAM_STR);
    $statement -> bindParam(":NumeroContactoPaciente", $datosUpdatePaciente["NumeroContactoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":NombreContactoPaciente", $datosUpdatePaciente["NombreContactoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosUpdatePaciente["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdatePaciente["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdPaciente", $datosUpdatePaciente["IdPaciente"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar los datos del paciente para la historia clínica
  public static function mdlMostrarDatosHistoria($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.SexoPaciente, tba_paciente.EdadPaciente, tba_paciente.FechaNacimiento, tba_paciente.CelularPaciente, tba_paciente.DomicilioPaciente, tba_paciente.LugarProcedencia, tba_paciente.LugarNacimiento, tba_paciente.GradoInstruccion, tba_paciente.RazaPaciente, tba_paciente.OcupacionPaciente, tba_paciente.ReligionPaciente, tba_paciente.EstadoCivil, tba_paciente.NumeroContactoPaciente, tba_paciente.NombreContactoPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Modificar los datos del paciente al editar la historia clínica
  public static function mdlUpdateDatosPacienteEditar($tabla, $datosUpdatePaciente)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET SexoPaciente=:SexoPaciente, EdadPaciente=:EdadPaciente, FechaNacimiento=:FechaNacimiento, CelularPaciente=:CelularPaciente, DomicilioPaciente=:DomicilioPaciente, LugarProcedencia=:LugarProcedencia, LugarNacimiento=:LugarNacimiento, GradoInstruccion=:GradoInstruccion, RazaPaciente=:RazaPaciente, OcupacionPaciente=:OcupacionPaciente, ReligionPaciente=:ReligionPaciente, EstadoCivil=:EstadoCivil, NumeroContactoPaciente=:NumeroContactoPaciente, NombreContactoPaciente=:NombreContactoPaciente, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE IdPaciente=:IdPaciente");
    $statement -> bindParam(":EdadPaciente", $datosUpdatePaciente["EdadPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":SexoPaciente", $datosUpdatePaciente["SexoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaNacimiento", $datosUpdatePaciente["FechaNacimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":CelularPaciente", $datosUpdatePaciente["CelularPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":DomicilioPaciente", $datosUpdatePaciente["DomicilioPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":LugarProcedencia", $datosUpdatePaciente["LugarProcedencia"], PDO::PARAM_STR);
    $statement -> bindParam(":LugarNacimiento", $datosUpdatePaciente["LugarNacimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":GradoInstruccion", $datosUpdatePaciente["GradoInstruccion"], PDO::PARAM_STR);
    $statement -> bindParam(":RazaPaciente", $datosUpdatePaciente["RazaPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":OcupacionPaciente", $datosUpdatePaciente["OcupacionPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":ReligionPaciente", $datosUpdatePaciente["ReligionPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":EstadoCivil", $datosUpdatePaciente["EstadoCivil"], PDO::PARAM_STR);
    $statement -> bindParam(":NumeroContactoPaciente", $datosUpdatePaciente["NumeroContactoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":NombreContactoPaciente", $datosUpdatePaciente["NombreContactoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosUpdatePaciente["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdatePaciente["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdPaciente", $datosUpdatePaciente["IdPaciente"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }
  
  //  Mostrar los datos del paciente al ver el plan de tratamiento
  public static function mdlMostrarDatosTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.EdadPaciente, tba_paciente.CelularPaciente, tba_paciente.NumeroContactoPaciente, tba_paciente.NombreContactoPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Buscar al paciente por el número de DNI
  public static function mdlBuscarPacienteDNI($tabla, $numeroDNI)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente FROM $tabla WHERE tba_paciente.DNIPaciente = $numeroDNI");
    $statement -> execute();
    return $statement -> fetch();
  }
}