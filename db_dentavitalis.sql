/*
 Navicat Premium Data Transfer

 Source Server         : MyDBSQL
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : db_dentavitalis

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 31/07/2023 17:27:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tba_centrocostos
-- ----------------------------
DROP TABLE IF EXISTS `tba_centrocostos`;
CREATE TABLE `tba_centrocostos`  (
  `IdCentroCostos` int NOT NULL AUTO_INCREMENT,
  `DescripcionCentro` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCentroCostos`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_centrocostos
-- ----------------------------
INSERT INTO `tba_centrocostos` VALUES (1, 'Servicios Generales', '2023-07-31 11:49:50', '2023-07-31 11:49:50');
INSERT INTO `tba_centrocostos` VALUES (3, 'Costos de laboratorio', '2023-07-31 13:22:06', '2023-07-31 13:22:06');

-- ----------------------------
-- Table structure for tba_costo
-- ----------------------------
DROP TABLE IF EXISTS `tba_costo`;
CREATE TABLE `tba_costo`  (
  `IdCosto` int NOT NULL AUTO_INCREMENT,
  `IdSocio` int NOT NULL,
  `IdCentroCostos` int NOT NULL,
  `NumeroDocumento` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FechaCosto` date NOT NULL,
  `TotalCosto` decimal(10, 2) NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCosto`) USING BTREE,
  INDEX `tba_costo_fksocio`(`IdSocio`) USING BTREE,
  CONSTRAINT `tba_costo_fksocio` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_costo
-- ----------------------------
INSERT INTO `tba_costo` VALUES (7, 1, 0, '001-5555', '2023-07-20', 145.14, 1, 1, '2023-07-26 11:13:44', '2023-07-26 11:30:17');
INSERT INTO `tba_costo` VALUES (9, 4, 0, '001-3333', '2023-08-01', 14528.16, 1, 1, '2023-07-26 11:21:59', '2023-07-26 11:21:59');
INSERT INTO `tba_costo` VALUES (10, 0, 0, '001-002', '2023-07-20', 1770.00, 1, 1, '2023-07-26 11:44:54', '2023-07-26 11:44:54');
INSERT INTO `tba_costo` VALUES (11, 0, 0, '001-787878722', '2023-08-10', 1431.34, 1, 1, '2023-07-26 12:15:44', '2023-07-26 12:26:14');

-- ----------------------------
-- Table structure for tba_detallecosto
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallecosto`;
CREATE TABLE `tba_detallecosto`  (
  `IdDetalleCosto` int NOT NULL AUTO_INCREMENT,
  `IdCosto` int NOT NULL,
  `IdGasto` int NOT NULL,
  `ObservacionGasto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PrecioGasto` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`IdDetalleCosto`) USING BTREE,
  INDEX `tba_movimiento_fkMovimiento`(`IdCosto`) USING BTREE,
  INDEX `tba_movimiento_fkGasto`(`IdGasto`) USING BTREE,
  CONSTRAINT `tba_movimiento_fkCosto` FOREIGN KEY (`IdCosto`) REFERENCES `tba_costo` (`IdCosto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_movimiento_fkGasto` FOREIGN KEY (`IdGasto`) REFERENCES `tba_gasto` (`IdGasto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_detallecosto
-- ----------------------------
INSERT INTO `tba_detallecosto` VALUES (16, 9, 5, '1231231', 12312.00);
INSERT INTO `tba_detallecosto` VALUES (17, 7, 5, '1231231', 123.00);
INSERT INTO `tba_detallecosto` VALUES (18, 10, 1, 'Por servicio de muestras', 1500.00);
INSERT INTO `tba_detallecosto` VALUES (23, 11, 1, '99999', 1000.00);
INSERT INTO `tba_detallecosto` VALUES (24, 11, 4, '', 213.00);

-- ----------------------------
-- Table structure for tba_detallehistoriaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallehistoriaclinica`;
CREATE TABLE `tba_detallehistoriaclinica`  (
  `IdDetalleHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdHistoriaClinica` int NOT NULL,
  `IdTratamiento` int NOT NULL,
  `FechaAtencion` date NOT NULL,
  `DiagnosticoPresuntivo` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `DiagnosticoDefinitivo` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Pronostico` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `TratamientoPaciente` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `PresionArterial` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Pulso` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Temperatura` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaCardiaca` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaRespiratoria` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ExamenOdonto` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `InformacionAlta` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `IdPersonal` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdDetalleHistoriaClinica`) USING BTREE,
  INDEX `tba_detallehistoriaclinica_fkHistoriaClinica`(`IdHistoriaClinica`) USING BTREE,
  INDEX `tba_detallehistoriaclinica_fkTratamiento`(`IdTratamiento`) USING BTREE,
  CONSTRAINT `tba_detallehistoriaclinica_fkHistoriaClinica` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_detallehistoriaclinica
-- ----------------------------

-- ----------------------------
-- Table structure for tba_detalletratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_detalletratamiento`;
CREATE TABLE `tba_detalletratamiento`  (
  `IdDetalleTratamiento` int NOT NULL AUTO_INCREMENT,
  `IdTratamiento` int NOT NULL,
  `IdProcedimiento` int NOT NULL,
  `EstadoTratamiento` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PrecioProcedimiento` decimal(10, 2) NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  PRIMARY KEY (`IdDetalleTratamiento`) USING BTREE,
  INDEX `tba_detalletratamiento_fkDetalleTratamiento`(`IdTratamiento`) USING BTREE,
  INDEX `tba_detalletratamiento_fkProcedimiento`(`IdProcedimiento`) USING BTREE,
  CONSTRAINT `tba_detalletratamiento_fkDetalleTratamiento` FOREIGN KEY (`IdTratamiento`) REFERENCES `tba_tratamiento` (`IdTratamiento`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_detalletratamiento_fkProcedimiento` FOREIGN KEY (`IdProcedimiento`) REFERENCES `tba_procedimiento` (`IdProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_detalletratamiento
-- ----------------------------

-- ----------------------------
-- Table structure for tba_gasto
-- ----------------------------
DROP TABLE IF EXISTS `tba_gasto`;
CREATE TABLE `tba_gasto`  (
  `IdGasto` int NOT NULL AUTO_INCREMENT,
  `IdCentroCostos` int NOT NULL,
  `NombreGasto` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdGasto`) USING BTREE,
  INDEX `tba_gasto_fkcentrocostos`(`IdCentroCostos`) USING BTREE,
  CONSTRAINT `tba_gasto_fkcentrocostos` FOREIGN KEY (`IdCentroCostos`) REFERENCES `tba_centrocostos` (`IdCentroCostos`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_gasto
-- ----------------------------
INSERT INTO `tba_gasto` VALUES (1, 3, 'Servicio de Laboratorio', '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_gasto` VALUES (4, 1, 'Servicio de Agua', '2023-07-21 21:54:09', '2023-07-21 21:54:09');
INSERT INTO `tba_gasto` VALUES (5, 1, 'Pago de servicio de luz', '2023-07-21 14:55:32', '2023-07-21 14:55:32');
INSERT INTO `tba_gasto` VALUES (6, 1, 'Gastos Energía Eléctrica', '2023-07-31 12:10:47', '2023-07-31 12:14:14');

-- ----------------------------
-- Table structure for tba_historiaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_historiaclinica`;
CREATE TABLE `tba_historiaclinica`  (
  `IdHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `IdSocio` int NOT NULL,
  `AlergiasEncontradas` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `MotivoConsulta` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `DatosInformante` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `TiempoEnfermedad` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `SignosSintomas` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `RelatoCronologico` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FuncionesBiologicas` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `AntecedentesFamiliares` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `AntecedentesPersonales` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  PRIMARY KEY (`IdHistoriaClinica`) USING BTREE,
  INDEX `tba_historiaclinica_fkPaciente`(`IdPaciente`) USING BTREE,
  INDEX `tba_historiaclinica_fksocio`(`IdSocio`) USING BTREE,
  CONSTRAINT `tba_historiaclinica_fkPaciente` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_historiaclinica_fksocio` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_historiaclinica
-- ----------------------------
INSERT INTO `tba_historiaclinica` VALUES (1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-07-26 12:39:30', '2023-07-26 12:39:34');
INSERT INTO `tba_historiaclinica` VALUES (2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-07-26 12:39:30', '2023-07-26 12:39:30');

-- ----------------------------
-- Table structure for tba_paciente
-- ----------------------------
DROP TABLE IF EXISTS `tba_paciente`;
CREATE TABLE `tba_paciente`  (
  `IdPaciente` int NOT NULL AUTO_INCREMENT,
  `NombrePaciente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ApellidoPaciente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DNIPaciente` int NOT NULL,
  `SexoPaciente` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `EdadPaciente` int NULL DEFAULT NULL,
  `FechaNacimiento` date NULL DEFAULT NULL,
  `CelularPaciente` int NOT NULL,
  `DomicilioPaciente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `LugarProcedencia` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `LugarNacimiento` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `GradoInstruccion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `RazaPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `OcupacionPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ReligionPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `EstadoCivil` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `NumeroContactoPaciente` int NULL DEFAULT NULL,
  `NombreContactoPaciente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdPaciente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_paciente
-- ----------------------------
INSERT INTO `tba_paciente` VALUES (1, 'Juan Jose', 'Perez Perez', 987654321, NULL, NULL, NULL, 12345678, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_paciente` VALUES (2, 'Juan Miguel', 'Jimenez Jimenez', 12345678, NULL, NULL, NULL, 987654321, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-07-21 00:00:00', '2023-07-21 00:00:00');

-- ----------------------------
-- Table structure for tba_pago
-- ----------------------------
DROP TABLE IF EXISTS `tba_pago`;
CREATE TABLE `tba_pago`  (
  `IdPago` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `TotalPago` decimal(10, 2) NOT NULL,
  `SubTotalPago` decimal(10, 2) NOT NULL,
  `IGVPago` decimal(10, 2) NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdPago`) USING BTREE,
  INDEX `tba_pago_fkPaciente`(`IdPaciente`) USING BTREE,
  CONSTRAINT `tba_pago_fkPaciente` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_pago
-- ----------------------------

-- ----------------------------
-- Table structure for tba_perfilusuario
-- ----------------------------
DROP TABLE IF EXISTS `tba_perfilusuario`;
CREATE TABLE `tba_perfilusuario`  (
  `IdPerfilUsuario` int NOT NULL AUTO_INCREMENT,
  `NombrePerfil` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdPerfilUsuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_perfilusuario
-- ----------------------------
INSERT INTO `tba_perfilusuario` VALUES (1, 'Administrador');
INSERT INTO `tba_perfilusuario` VALUES (2, 'Recepcionista');
INSERT INTO `tba_perfilusuario` VALUES (3, 'Medico');

-- ----------------------------
-- Table structure for tba_procedimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_procedimiento`;
CREATE TABLE `tba_procedimiento`  (
  `IdProcedimiento` int NOT NULL AUTO_INCREMENT,
  `NombreProcedimiento` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PrecioPromedio` decimal(10, 2) NOT NULL,
  `IdTipoProcedimiento` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdProcedimiento`) USING BTREE,
  INDEX `tba_procedimiento_fkTipoProcedimiento`(`IdTipoProcedimiento`) USING BTREE,
  CONSTRAINT `tba_procedimiento_fkTipoProcedimiento` FOREIGN KEY (`IdTipoProcedimiento`) REFERENCES `tba_tipoprocedimiento` (`IdTipoProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_procedimiento
-- ----------------------------
INSERT INTO `tba_procedimiento` VALUES (1, 'Cirugía de maxilar ', 1500.00, 1, '2023-07-21 00:00:00', '2023-07-21 00:00:00');

-- ----------------------------
-- Table structure for tba_socio
-- ----------------------------
DROP TABLE IF EXISTS `tba_socio`;
CREATE TABLE `tba_socio`  (
  `IdSocio` int NOT NULL AUTO_INCREMENT,
  `NombreSocio` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `IdTipoIdentificacion` int NULL DEFAULT NULL,
  `IdTipoSocio` int NOT NULL,
  `Identificacion` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdSocio`) USING BTREE,
  INDEX `tba_socio_fksocios`(`IdTipoIdentificacion`) USING BTREE,
  INDEX `tba_socio_fktiposocio`(`IdTipoSocio`) USING BTREE,
  CONSTRAINT `tba_socio_fksocios` FOREIGN KEY (`IdTipoIdentificacion`) REFERENCES `tba_tipoidentificacion` (`IdTipoIdentificacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_socio_fktiposocio` FOREIGN KEY (`IdTipoSocio`) REFERENCES `tba_tiposocio` (`IdTipoSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_socio
-- ----------------------------
INSERT INTO `tba_socio` VALUES (1, 'Medico X', 1, 1, '666666', '2023-07-21 00:00:00', '2023-07-25 08:48:36');
INSERT INTO `tba_socio` VALUES (2, 'Medico Y', 1, 1, '16516515', '2023-07-21 00:00:00', '2023-07-25 08:48:44');
INSERT INTO `tba_socio` VALUES (3, 'Medico Z', 1, 1, '12312312313', '2023-07-21 00:00:00', '2023-07-25 08:48:52');
INSERT INTO `tba_socio` VALUES (4, 'Diego Jimenez', 1, 2, '66666666', '2023-07-24 10:18:04', '2023-07-24 10:18:04');

-- ----------------------------
-- Table structure for tba_tipoidentificacion
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipoidentificacion`;
CREATE TABLE `tba_tipoidentificacion`  (
  `IdTipoIdentificacion` int NOT NULL AUTO_INCREMENT,
  `NombreTipoIdentificacion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoIdentificacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_tipoidentificacion
-- ----------------------------
INSERT INTO `tba_tipoidentificacion` VALUES (1, 'DNI');
INSERT INTO `tba_tipoidentificacion` VALUES (2, 'RUC');

-- ----------------------------
-- Table structure for tba_tipoprocedimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipoprocedimiento`;
CREATE TABLE `tba_tipoprocedimiento`  (
  `IdTipoProcedimiento` int NOT NULL AUTO_INCREMENT,
  `NombreTipoProcedimiento` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoProcedimiento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_tipoprocedimiento
-- ----------------------------
INSERT INTO `tba_tipoprocedimiento` VALUES (1, 'Cirugia');
INSERT INTO `tba_tipoprocedimiento` VALUES (2, 'Endodoncia');
INSERT INTO `tba_tipoprocedimiento` VALUES (3, 'Implantologia');

-- ----------------------------
-- Table structure for tba_tiposocio
-- ----------------------------
DROP TABLE IF EXISTS `tba_tiposocio`;
CREATE TABLE `tba_tiposocio`  (
  `IdTipoSocio` int NOT NULL AUTO_INCREMENT,
  `NombreTipoSocio` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdTipoSocio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_tiposocio
-- ----------------------------
INSERT INTO `tba_tiposocio` VALUES (1, 'Medico');
INSERT INTO `tba_tiposocio` VALUES (2, 'Empleado');
INSERT INTO `tba_tiposocio` VALUES (3, 'Contratista');

-- ----------------------------
-- Table structure for tba_tratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_tratamiento`;
CREATE TABLE `tba_tratamiento`  (
  `IdTratamiento` int NOT NULL AUTO_INCREMENT,
  `IdHistoriaClinica` int NOT NULL,
  `IdPaciente` int NOT NULL,
  `NombreTratamiento` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `SubTotalTratamiento` decimal(10, 2) NOT NULL,
  `IGVTratamiento` decimal(10, 2) NOT NULL,
  `TotalTratamiento` decimal(10, 2) NOT NULL,
  `TotalPagado` decimal(10, 0) NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdTratamiento`) USING BTREE,
  INDEX `tba_tratamiento_fkHistoriaClinica`(`IdHistoriaClinica`) USING BTREE,
  CONSTRAINT `tba_tratamiento_fkHistoriaClinica` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_tratamiento
-- ----------------------------

-- ----------------------------
-- Table structure for tba_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tba_usuario`;
CREATE TABLE `tba_usuario`  (
  `IdUsuario` int NOT NULL AUTO_INCREMENT,
  `IdPerfilUsuario` int NOT NULL,
  `NombreUsuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CorreoUsuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PasswordUsuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CelularUsuario` int NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  `UltimaConexion` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`) USING BTREE,
  INDEX `tba_usuario_fkPerfilUsuario`(`IdPerfilUsuario`) USING BTREE,
  CONSTRAINT `tba_usuario_fkPerfilUsuario` FOREIGN KEY (`IdPerfilUsuario`) REFERENCES `tba_perfilusuario` (`IdPerfilUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_usuario
-- ----------------------------
INSERT INTO `tba_usuario` VALUES (1, 1, 'Administrador', 'admin@gmail.com', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 987654321, '2023-07-19 00:00:00', '2023-07-19 00:00:00', '2023-07-31 15:03:47');

SET FOREIGN_KEY_CHECKS = 1;
