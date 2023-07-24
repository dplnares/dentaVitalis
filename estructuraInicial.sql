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

 Date: 24/07/2023 12:43:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tba_detallehistoriaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallehistoriaclinica`;
CREATE TABLE `tba_detallehistoriaclinica`  (
  `IdDetalleHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdHistoriaClinica` int NOT NULL,
  `IdTratamiento` int NULL DEFAULT NULL,
  `FechaAtencion` date NOT NULL,
  `DiagnosticoPresuntivo` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DiagnosticoDefinitivo` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Pronostico` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TratamientoPaciente` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RecomendacionesPaciente` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `InformacionAlta` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
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
-- Table structure for tba_detallemovimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallemovimiento`;
CREATE TABLE `tba_detallemovimiento`  (
  `IdDetalleMovimiento` int NOT NULL AUTO_INCREMENT,
  `IdMovimiento` int NOT NULL,
  `IdGasto` int NOT NULL,
  `PrecioGasto` decimal(10, 2) NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  PRIMARY KEY (`IdDetalleMovimiento`) USING BTREE,
  INDEX `tba_movimiento_fkMovimiento`(`IdMovimiento`) USING BTREE,
  INDEX `tba_movimiento_fkGasto`(`IdGasto`) USING BTREE,
  CONSTRAINT `tba_movimiento_fkGasto` FOREIGN KEY (`IdGasto`) REFERENCES `tba_gasto` (`IdGasto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_movimiento_fkMovimiento` FOREIGN KEY (`IdMovimiento`) REFERENCES `tba_movimiento` (`IdMovimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_detallemovimiento
-- ----------------------------

-- ----------------------------
-- Table structure for tba_detalletratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_detalletratamiento`;
CREATE TABLE `tba_detalletratamiento`  (
  `IdDetalleTratamiento` int NOT NULL AUTO_INCREMENT,
  `IdTratamiento` int NOT NULL,
  `IdProcedimiento` int NOT NULL,
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
  `IdTipoGasto` int NOT NULL,
  `NombreGasto` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdGasto`) USING BTREE,
  INDEX `fk_gasto_fkgasto`(`IdTipoGasto`) USING BTREE,
  CONSTRAINT `fk_gasto_fkgasto` FOREIGN KEY (`IdTipoGasto`) REFERENCES `tba_tipogasto` (`IdTipoGasto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_gasto
-- ----------------------------
INSERT INTO `tba_gasto` VALUES (1, 3, 'Servicio de Laboratorio', '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_gasto` VALUES (2, 2, 'Servicio de mantenimiento equipos informática', '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_gasto` VALUES (4, 3, 'Servicio de Agua', '2023-07-21 21:54:09', '2023-07-21 21:54:09');
INSERT INTO `tba_gasto` VALUES (5, 3, 'Pago de servicio de luz', '2023-07-21 14:55:32', '2023-07-21 14:55:32');

-- ----------------------------
-- Table structure for tba_historiaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_historiaclinica`;
CREATE TABLE `tba_historiaclinica`  (
  `IdHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `IdUsuario` int NOT NULL,
  `AlergiasEncontradas` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `AntecedentesFamiliares` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `AntecedentesPersonales` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `PrimeraEvaluacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PresionArterialPaciente` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `PulsoPaciente` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `TemperaturaPaciente` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaCardiacaPaciente` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ExamenOdontologico` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  PRIMARY KEY (`IdHistoriaClinica`) USING BTREE,
  INDEX `tba_historiaclinica_fkPaciente`(`IdPaciente`) USING BTREE,
  INDEX `tba_historiaclinica_fkUsuario`(`IdUsuario`) USING BTREE,
  CONSTRAINT `tba_historiaclinica_fkPaciente` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_historiaclinica_fkUsuario` FOREIGN KEY (`IdUsuario`) REFERENCES `tba_usuario` (`IdUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_historiaclinica
-- ----------------------------

-- ----------------------------
-- Table structure for tba_movimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_movimiento`;
CREATE TABLE `tba_movimiento`  (
  `IdMovimiento` int NOT NULL AUTO_INCREMENT,
  `IdSocio` int NOT NULL,
  `IdUsuario` int NOT NULL,
  `SubTotalMovimiento` decimal(10, 2) NOT NULL,
  `IGVMovimiento` decimal(10, 2) NOT NULL,
  `TotalMovimiento` decimal(10, 2) NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdMovimiento`) USING BTREE,
  INDEX `tba_movimiento_fkSocio`(`IdSocio`) USING BTREE,
  INDEX `tba_movimiento_fkUsuario`(`IdUsuario`) USING BTREE,
  CONSTRAINT `tba_movimiento_fkSocio` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_movimiento_fkUsuario` FOREIGN KEY (`IdUsuario`) REFERENCES `tba_usuario` (`IdUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_movimiento
-- ----------------------------

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
  `FechaNacimiento` date NULL DEFAULT NULL,
  `CelularPaciente` int NOT NULL,
  `DomicilioPaciente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `CorreoPaciente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `LugarNacimiento` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `GradoInstrucción` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
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
INSERT INTO `tba_paciente` VALUES (1, 'Juan Jose', 'Perez Perez', 987654321, NULL, NULL, 12345678, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_paciente` VALUES (2, 'Juan Miguel', 'Jimenez Jimenez', 12345678, NULL, NULL, 987654321, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-07-21 00:00:00', '2023-07-21 00:00:00');

-- ----------------------------
-- Table structure for tba_pago
-- ----------------------------
DROP TABLE IF EXISTS `tba_pago`;
CREATE TABLE `tba_pago`  (
  `IdPago` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `IdTratamiento` int NOT NULL,
  `TotalPago` decimal(10, 2) NOT NULL,
  `SubTotalPago` decimal(10, 2) NOT NULL,
  `IGVPago` decimal(10, 2) NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdPago`) USING BTREE,
  INDEX `tba_pago_fkPaciente`(`IdPaciente`) USING BTREE,
  INDEX `tba_pago_fkTratamiento`(`IdTratamiento`) USING BTREE,
  CONSTRAINT `tba_pago_fkPaciente` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_pago_fkTratamiento` FOREIGN KEY (`IdTratamiento`) REFERENCES `tba_tratamiento` (`IdTratamiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
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
  CONSTRAINT `tba_socio_fksocios` FOREIGN KEY (`IdTipoIdentificacion`) REFERENCES `tba_tipoidentificacion` (`IdTipoIdentificacion`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_socio
-- ----------------------------
INSERT INTO `tba_socio` VALUES (1, 'Proveedor ABC', 2, 1, '666666', '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_socio` VALUES (2, 'Proveedor y', 2, 1, '16516515', '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_socio` VALUES (3, 'Proveedor a', 2, 1, '12312312313', '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_socio` VALUES (4, 'Diego Jimenez', 1, 2, '66666666', '2023-07-24 10:18:04', '2023-07-24 10:18:04');

-- ----------------------------
-- Table structure for tba_tipogasto
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipogasto`;
CREATE TABLE `tba_tipogasto`  (
  `IdTipoGasto` int NOT NULL AUTO_INCREMENT,
  `NombreTipoGasto` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoGasto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_tipogasto
-- ----------------------------
INSERT INTO `tba_tipogasto` VALUES (1, 'Gasto Fijo');
INSERT INTO `tba_tipogasto` VALUES (2, 'Gasto Operacional');
INSERT INTO `tba_tipogasto` VALUES (3, 'Servicios Terceros');

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
INSERT INTO `tba_tiposocio` VALUES (1, 'Proveedor');
INSERT INTO `tba_tiposocio` VALUES (2, 'Medico');
INSERT INTO `tba_tiposocio` VALUES (3, 'Empleado');
INSERT INTO `tba_tiposocio` VALUES (4, 'Contratista');

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
INSERT INTO `tba_usuario` VALUES (1, 1, 'Administrador', 'admin@gmail.com', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 987654321, '2023-07-19 00:00:00', '2023-07-19 00:00:00', '2023-07-24 09:57:35');

SET FOREIGN_KEY_CHECKS = 1;
