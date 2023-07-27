<?php

require_once "conexion.php";

class ModelHistorias
{
  //  Mostrar todas las historias clinicas
  public static function mdlMostrarAllHistorias($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_historiaclinica.IdHistoriaClinica, tba_historiaclinica.IdPaciente, tba_historiaclinica.IdSocio, tba_historiaclinica.FechaActualiza, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_socio.NombreSocio FROM $tabla INNER JOIN tba_paciente ON tba_historiaclinica.IdPaciente = tba_paciente.IdPaciente INNER JOIN tba_socio ON tba_historiaclinica.IdSocio = tba_socio.IdSocio ORDER BY IdHistoriaClinica ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear una nueva historia
  public static function mdlCrearHistoriaClinica($tabla, $datosCreateHistoria)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdSocio, AlergiasEncontradas, DatosInformante, MotivoConsulta, TiempoEnfermedad, SignosSintomas, RelatoCronologico, FuncionesBiologicas, AntecedentesFamiliares, AntecedentesPersonales, UsuarioCreado, UsuarioActualizado, FechaCreado, FechaActualiza) VALUES(:IdPaciente, :IdSocio, :AlergiasEncontradas, :DatosInformante, :MotivoConsulta, :TiempoEnfermedad, :SignosSintomas, :RelatoCronologico, :FuncionesBiologicas, :AntecedentesFamiliares, :AntecedentesPersonales, :UsuarioCreado, :UsuarioActualizado, :FechaCreado, :FechaActualiza)");
    $statement -> bindParam(":IdPaciente", $datosCreateHistoria["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":IdSocio", $datosCreateHistoria["IdSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":AlergiasEncontradas", $datosCreateHistoria["AlergiasEncontradas"], PDO::PARAM_STR);
    $statement -> bindParam(":DatosInformante", $datosCreateHistoria["DatosInformante"], PDO::PARAM_STR);
    $statement -> bindParam(":MotivoConsulta", $datosCreateHistoria["MotivoConsulta"], PDO::PARAM_STR);
    $statement -> bindParam(":TiempoEnfermedad", $datosCreateHistoria["TiempoEnfermedad"], PDO::PARAM_STR);
    $statement -> bindParam(":SignosSintomas", $datosCreateHistoria["SignosSintomas"], PDO::PARAM_STR);
    $statement -> bindParam(":RelatoCronologico", $datosCreateHistoria["RelatoCronologico"], PDO::PARAM_STR);
    $statement -> bindParam(":FuncionesBiologicas", $datosCreateHistoria["FuncionesBiologicas"], PDO::PARAM_STR);
    $statement -> bindParam(":AntecedentesFamiliares", $datosCreateHistoria["AntecedentesFamiliares"], PDO::PARAM_STR);
    $statement -> bindParam(":AntecedentesPersonales", $datosCreateHistoria["AntecedentesPersonales"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCreateHistoria["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualizado", $datosCreateHistoria["UsuarioActualizado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreado", $datosCreateHistoria["FechaCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualiza", $datosCreateHistoria["FechaActualiza"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }
}