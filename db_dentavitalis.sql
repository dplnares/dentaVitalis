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

 Date: 04/08/2023 17:26:30
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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_centrocostos
-- ----------------------------
INSERT INTO `tba_centrocostos` VALUES (1, 'Servicios Generales', '2023-07-31 11:49:50', '2023-07-31 11:49:50');
INSERT INTO `tba_centrocostos` VALUES (3, 'Costos de laboratorio', '2023-07-31 13:22:06', '2023-07-31 13:22:06');
INSERT INTO `tba_centrocostos` VALUES (4, 'Costos de Personal', '2023-08-02 14:19:56', '2023-08-02 14:19:56');
INSERT INTO `tba_centrocostos` VALUES (5, 'Costos de Insumos', '2023-08-02 14:20:10', '2023-08-02 14:20:10');

-- ----------------------------
-- Table structure for tba_costo
-- ----------------------------
DROP TABLE IF EXISTS `tba_costo`;
CREATE TABLE `tba_costo`  (
  `IdCosto` int NOT NULL AUTO_INCREMENT,
  `IdCentroCostos` int NOT NULL,
  `MesCosto` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TotalCosto` decimal(10, 2) NOT NULL,
  `EstadoCosto` int NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCosto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_costo
-- ----------------------------
INSERT INTO `tba_costo` VALUES (7, 1, '2023-07', 145.14, 1, 1, 1, '2023-07-26 11:13:44', '2023-07-26 11:30:17');
INSERT INTO `tba_costo` VALUES (9, 3, '2023-09', 5555.00, 2, 1, 1, '2023-07-26 11:21:59', '2023-07-26 11:21:59');
INSERT INTO `tba_costo` VALUES (11, 1, '2023-08', 1431.34, 2, 1, 1, '2023-07-26 12:15:44', '2023-07-26 12:26:14');
INSERT INTO `tba_costo` VALUES (12, 1, '2023-08', 4444.00, 1, 1, 1, '2023-08-01 11:47:08', '2023-08-01 13:32:40');
INSERT INTO `tba_costo` VALUES (13, 3, '2023-08', 55.00, 1, 1, 1, '2023-08-01 17:21:53', '2023-08-01 17:22:28');
INSERT INTO `tba_costo` VALUES (14, 1, '2023-12', 246.00, 1, 1, 1, '2023-08-02 09:35:00', '2023-08-02 09:35:00');
INSERT INTO `tba_costo` VALUES (15, 1, '2023-08', 330.00, 1, 1, 1, '2023-08-02 10:07:57', '2023-08-02 10:07:57');
INSERT INTO `tba_costo` VALUES (18, 4, '2023-08', 4354.00, 1, 1, 1, '2023-08-02 14:25:58', '2023-08-02 14:26:58');
INSERT INTO `tba_costo` VALUES (19, 5, '2023-10', 888.00, 1, 1, 1, '2023-08-02 14:27:43', '2023-08-02 14:27:43');
INSERT INTO `tba_costo` VALUES (20, 5, '2023-07', 88.00, 1, 1, 1, '2023-08-02 14:28:24', '2023-08-02 14:28:24');
INSERT INTO `tba_costo` VALUES (22, 4, '2023-08', 3.00, 1, 1, 1, '2023-08-02 14:37:57', '2023-08-02 14:37:57');
INSERT INTO `tba_costo` VALUES (23, 4, '2023-10', 3464.00, 1, 1, 1, '2023-08-02 14:43:18', '2023-08-02 14:43:18');
INSERT INTO `tba_costo` VALUES (24, 4, '2023-08', 366.00, 1, 1, 1, '2023-08-02 15:10:23', '2023-08-02 15:10:23');
INSERT INTO `tba_costo` VALUES (26, 4, '2023-08', 111.00, 1, 1, 1, '2023-08-02 15:16:20', '2023-08-02 15:16:20');
INSERT INTO `tba_costo` VALUES (27, 4, '2023-07', 123.00, 1, 1, 1, '2023-08-02 15:24:22', '2023-08-02 15:24:22');
INSERT INTO `tba_costo` VALUES (29, 4, '2023-07', 4.00, 1, 1, 1, '2023-08-02 17:30:04', '2023-08-02 17:30:04');
INSERT INTO `tba_costo` VALUES (30, 3, '2023-11', 1321.00, 2, 1, 1, '2023-08-03 10:07:53', '2023-08-03 10:15:58');
INSERT INTO `tba_costo` VALUES (33, 1, '2023-01', 444.00, 1, 1, 1, '2023-08-03 10:15:11', '2023-08-03 10:15:11');
INSERT INTO `tba_costo` VALUES (34, 1, '2023-01', 444.00, 1, 1, 1, '2023-08-03 10:15:11', '2023-08-03 10:15:11');

-- ----------------------------
-- Table structure for tba_detallecosto
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallecosto`;
CREATE TABLE `tba_detallecosto`  (
  `IdDetalleCosto` int NOT NULL AUTO_INCREMENT,
  `IdCosto` int NOT NULL,
  `IdGasto` int NOT NULL,
  `IdSocio` int NOT NULL,
  `NumeroDocumento` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ObservacionGasto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FechaCosto` date NOT NULL,
  `PrecioGasto` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`IdDetalleCosto`) USING BTREE,
  INDEX `tba_movimiento_fkMovimiento`(`IdCosto`) USING BTREE,
  INDEX `tba_movimiento_fkGasto`(`IdGasto`) USING BTREE,
  INDEX `tba_detallecosto_fkSocio`(`IdSocio`) USING BTREE,
  CONSTRAINT `tba_detallecosto_fkCosto` FOREIGN KEY (`IdCosto`) REFERENCES `tba_costo` (`IdCosto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_detallecosto_fkGasto` FOREIGN KEY (`IdGasto`) REFERENCES `tba_gasto` (`IdGasto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_detallecosto_fkSocio` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_detallecosto
-- ----------------------------
INSERT INTO `tba_detallecosto` VALUES (31, 12, 1, 3, '001-00015', 'nuevo1231', '2023-08-01', 4444.00);
INSERT INTO `tba_detallecosto` VALUES (34, 13, 1, 4, '001-123123', '6566', '2023-07-31', 55.00);
INSERT INTO `tba_detallecosto` VALUES (35, 14, 4, 1, '123', '12311231', '2023-08-10', 123.00);
INSERT INTO `tba_detallecosto` VALUES (36, 14, 5, 1, '123', '123123', '2023-09-02', 123.00);
INSERT INTO `tba_detallecosto` VALUES (37, 15, 4, 1, '123', '456', '2023-08-02', 66.00);
INSERT INTO `tba_detallecosto` VALUES (38, 15, 4, 1, '456', '456', '2023-08-03', 77.00);
INSERT INTO `tba_detallecosto` VALUES (39, 15, 5, 1, '789', '456', '2023-08-04', 88.00);
INSERT INTO `tba_detallecosto` VALUES (40, 15, 6, 1, '999', '456', '2023-08-05', 99.00);
INSERT INTO `tba_detallecosto` VALUES (41, 18, 7, 3, '123', 'PERSONAL X', '2023-08-10', 1231.00);
INSERT INTO `tba_detallecosto` VALUES (42, 18, 7, 2, '123', 'PERSONA Y', '2023-08-09', 3123.00);
INSERT INTO `tba_detallecosto` VALUES (43, 19, 8, 4, '123', 'Guantes', '2023-11-03', 333.00);
INSERT INTO `tba_detallecosto` VALUES (44, 19, 8, 4, '321', 'Gasas', '2023-10-20', 555.00);
INSERT INTO `tba_detallecosto` VALUES (45, 23, 7, 1, '321', 'Persona T', '2023-10-13', 232.00);
INSERT INTO `tba_detallecosto` VALUES (46, 23, 7, 1, '321', 'Persona X', '2023-10-27', 3232.00);
INSERT INTO `tba_detallecosto` VALUES (47, 27, 1, 1, '321', '321', '2023-08-16', 123.00);
INSERT INTO `tba_detallecosto` VALUES (48, 30, 1, 1, '321', '123', '2023-08-08', 1321.00);
INSERT INTO `tba_detallecosto` VALUES (49, 33, 5, 1, '321', '321', '2023-08-10', 321.00);
INSERT INTO `tba_detallecosto` VALUES (50, 33, 6, 1, '212', '321', '2023-08-17', 123.00);
INSERT INTO `tba_detallecosto` VALUES (51, 34, 5, 1, '321', '321', '2023-08-10', 321.00);
INSERT INTO `tba_detallecosto` VALUES (52, 34, 6, 1, '212', '321', '2023-08-17', 123.00);

-- ----------------------------
-- Table structure for tba_detallehistoriaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallehistoriaclinica`;
CREATE TABLE `tba_detallehistoriaclinica`  (
  `IdDetalleHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdHistoriaClinica` int NOT NULL,
  `IdTratamiento` int NOT NULL,
  `PresionArterial` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Pulso` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Temperatura` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaCardiaca` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaRespiratoria` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ExamenOdonto` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `DiagnosticoPresuntivo` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `DiagnosticoDefinitivo` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Pronostico` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `TratamientoPaciente` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `InformacionAlta` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  PRIMARY KEY (`IdDetalleHistoriaClinica`) USING BTREE,
  INDEX `tba_detallehistoriaclinica_fkHistoriaClinica`(`IdHistoriaClinica`) USING BTREE,
  INDEX `tba_detallehistoriaclinica_fkTratamiento`(`IdTratamiento`) USING BTREE,
  CONSTRAINT `tba_detallehistoriaclinica_fkHistoriaClinica` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_detallehistoriaclinica
-- ----------------------------
INSERT INTO `tba_detallehistoriaclinica` VALUES (3, 7, 1, '55', '33', '56', '33', '23', NULL, '', '', '', NULL, NULL, '2023-08-04 11:32:26', '2023-08-04 11:32:26', 1, 1);
INSERT INTO `tba_detallehistoriaclinica` VALUES (4, 8, 2, '55', '33', '56', '33', '23', NULL, '', '', '', NULL, NULL, '2023-08-04 11:33:27', '2023-08-04 11:33:27', 1, 1);
INSERT INTO `tba_detallehistoriaclinica` VALUES (5, 9, 3, '55', '33', '56', '33', '23', NULL, '', '', '', NULL, NULL, '2023-08-04 11:33:55', '2023-08-04 11:33:55', 1, 1);
INSERT INTO `tba_detallehistoriaclinica` VALUES (6, 10, 4, '', '', '', '', '', NULL, '', '', '', NULL, NULL, '2023-08-04 11:38:12', '2023-08-04 11:38:12', 1, 1);
INSERT INTO `tba_detallehistoriaclinica` VALUES (7, 11, 5, '', '', '', '', '', NULL, '', '', '', NULL, NULL, '2023-08-04 14:54:21', '2023-08-04 14:54:21', 1, 1);
INSERT INTO `tba_detallehistoriaclinica` VALUES (8, 12, 6, '', '', '', '', '', '', '', '', '', '', '', '2023-08-04 14:56:34', '2023-08-04 14:56:34', 1, 1);

-- ----------------------------
-- Table structure for tba_detalletratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_detalletratamiento`;
CREATE TABLE `tba_detalletratamiento`  (
  `IdDetalleTratamiento` int NOT NULL AUTO_INCREMENT,
  `IdTratamiento` int NOT NULL,
  `IdProcedimiento` int NOT NULL,
  `EstadoTratamiento` int NOT NULL,
  `ObservacionProcedimiento` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `PrecioProcedimiento` decimal(10, 2) NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  PRIMARY KEY (`IdDetalleTratamiento`) USING BTREE,
  INDEX `tba_detalletratamiento_fkDetalleTratamiento`(`IdTratamiento`) USING BTREE,
  INDEX `tba_detalletratamiento_fkProcedimiento`(`IdProcedimiento`) USING BTREE,
  CONSTRAINT `tba_detalletratamiento_fkDetalleTratamiento` FOREIGN KEY (`IdTratamiento`) REFERENCES `tba_tratamiento` (`IdTratamiento`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_detalletratamiento_fkProcedimiento` FOREIGN KEY (`IdProcedimiento`) REFERENCES `tba_procedimiento` (`IdProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_detalletratamiento
-- ----------------------------
INSERT INTO `tba_detalletratamiento` VALUES (1, 1, 1, 1, NULL, 3333.00, '2023-08-04 11:33:27', '2023-08-04 11:33:27', 1, 1);
INSERT INTO `tba_detalletratamiento` VALUES (2, 1, 1, 1, NULL, 1500.00, '2023-08-04 11:33:27', '2023-08-04 11:33:27', 1, 1);
INSERT INTO `tba_detalletratamiento` VALUES (3, 1, 1, 1, NULL, 3333.00, '2023-08-04 11:33:55', '2023-08-04 11:33:55', 1, 1);
INSERT INTO `tba_detalletratamiento` VALUES (4, 1, 1, 1, NULL, 1500.00, '2023-08-04 11:33:55', '2023-08-04 11:33:55', 1, 1);
INSERT INTO `tba_detalletratamiento` VALUES (5, 4, 1, 1, NULL, 1500.00, '2023-08-04 11:38:12', '2023-08-04 11:38:12', 1, 1);
INSERT INTO `tba_detalletratamiento` VALUES (6, 4, 1, 1, NULL, 4000.00, '2023-08-04 14:54:21', '2023-08-04 14:54:21', 1, 1);
INSERT INTO `tba_detalletratamiento` VALUES (7, 4, 1, 1, NULL, 5000.00, '2023-08-04 14:54:21', '2023-08-04 14:54:21', 1, 1);
INSERT INTO `tba_detalletratamiento` VALUES (8, 4, 1, 1, NULL, 6666.00, '2023-08-04 14:56:34', '2023-08-04 14:56:34', 1, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_gasto
-- ----------------------------
INSERT INTO `tba_gasto` VALUES (1, 3, 'Servicio de Laboratorio', '2023-07-21 00:00:00', '2023-07-21 00:00:00');
INSERT INTO `tba_gasto` VALUES (4, 1, 'Servicio de Agua', '2023-07-21 21:54:09', '2023-07-21 21:54:09');
INSERT INTO `tba_gasto` VALUES (5, 1, 'Pago de servicio de luz', '2023-07-21 14:55:32', '2023-07-21 14:55:32');
INSERT INTO `tba_gasto` VALUES (6, 1, 'Gastos Energía Eléctrica', '2023-07-31 12:10:47', '2023-07-31 12:14:14');
INSERT INTO `tba_gasto` VALUES (7, 4, 'Pago de Planillas', '2023-08-02 14:20:44', '2023-08-02 14:20:44');
INSERT INTO `tba_gasto` VALUES (8, 5, 'Compra de materiales quirurgicos', '2023-08-02 14:20:58', '2023-08-02 14:20:58');

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_historiaclinica
-- ----------------------------
INSERT INTO `tba_historiaclinica` VALUES (3, 1, 1, 'no', 'nosi', 'si', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 11:28:06', '2023-08-04 11:28:06');
INSERT INTO `tba_historiaclinica` VALUES (4, 1, 1, 'no', 'nosi', 'si', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 11:28:51', '2023-08-04 11:28:51');
INSERT INTO `tba_historiaclinica` VALUES (5, 1, 1, 'no', 'nosi', 'si', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 11:31:14', '2023-08-04 11:31:14');
INSERT INTO `tba_historiaclinica` VALUES (6, 1, 1, 'no', 'nosi', 'si', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 11:31:46', '2023-08-04 11:31:46');
INSERT INTO `tba_historiaclinica` VALUES (7, 1, 1, 'no', 'nosi', 'si', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 11:32:26', '2023-08-04 11:32:26');
INSERT INTO `tba_historiaclinica` VALUES (8, 1, 1, 'no', 'nosi', 'si', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 11:33:27', '2023-08-04 11:33:27');
INSERT INTO `tba_historiaclinica` VALUES (9, 1, 1, 'no', 'nosi', 'si', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 11:33:55', '2023-08-04 11:33:55');
INSERT INTO `tba_historiaclinica` VALUES (10, 2, 1, '', '', '', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 11:38:12', '2023-08-04 11:38:12');
INSERT INTO `tba_historiaclinica` VALUES (11, 2, 1, '', '', '', '', '', NULL, '', NULL, NULL, 1, 1, '2023-08-04 14:54:21', '2023-08-04 14:54:21');
INSERT INTO `tba_historiaclinica` VALUES (12, 2, 1, '', '', '', '', '', NULL, '', '123', '321', 1, 1, '2023-08-04 14:56:34', '2023-08-04 14:56:34');

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
  `CelularPaciente` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DomicilioPaciente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `LugarProcedencia` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `LugarNacimiento` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `GradoInstruccion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `RazaPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `OcupacionPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ReligionPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `EstadoCivil` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `NumeroContactoPaciente` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
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
INSERT INTO `tba_paciente` VALUES (1, 'Juan Jose', 'Perez Perez', 123456789, 'M', 25, '1995-12-08', '0', 'asd', '', 'aqp', 'un', 'asd', 'trab', 'das', 'asd', '0', '', 1, 0, '2023-07-21 00:00:00', '2023-08-04 11:33:55');
INSERT INTO `tba_paciente` VALUES (2, 'Juan Miguel', 'Jimenez Jimenez', 12345678, '', 0, '0000-00-00', '987654321', '', '', '', '', '', '', '', '', '', '', 1, 0, '2023-07-21 00:00:00', '2023-08-04 14:56:34');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_tipoidentificacion
-- ----------------------------
INSERT INTO `tba_tipoidentificacion` VALUES (1, 'DNI');
INSERT INTO `tba_tipoidentificacion` VALUES (2, 'RUC');
INSERT INTO `tba_tipoidentificacion` VALUES (3, 'OTROS');

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
  `TotalTratamiento` decimal(10, 2) NULL DEFAULT NULL,
  `TotalPagado` decimal(10, 2) NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdTratamiento`) USING BTREE,
  INDEX `tba_tratamiento_fkHistoriaClinica`(`IdHistoriaClinica`) USING BTREE,
  CONSTRAINT `tba_tratamiento_fkHistoriaClinica` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_tratamiento
-- ----------------------------
INSERT INTO `tba_tratamiento` VALUES (1, 7, 1, 4833.00, 4833.00, 1, 1, '2023-08-04 11:32:26', '2023-08-04 11:32:26');
INSERT INTO `tba_tratamiento` VALUES (2, 8, 1, NULL, NULL, 1, 1, '2023-08-04 11:33:27', '2023-08-04 11:33:27');
INSERT INTO `tba_tratamiento` VALUES (3, 9, 1, NULL, NULL, 1, 1, '2023-08-04 11:33:55', '2023-08-04 11:33:55');
INSERT INTO `tba_tratamiento` VALUES (4, 10, 2, 6666.00, 500.00, 1, 1, '2023-08-04 11:38:12', '2023-08-04 11:38:12');
INSERT INTO `tba_tratamiento` VALUES (5, 11, 2, NULL, NULL, 1, 1, '2023-08-04 14:54:21', '2023-08-04 14:54:21');
INSERT INTO `tba_tratamiento` VALUES (6, 12, 2, NULL, NULL, 1, 1, '2023-08-04 14:56:34', '2023-08-04 14:56:34');

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
INSERT INTO `tba_usuario` VALUES (1, 1, 'Administrador', 'admin@gmail.com', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 987654321, '2023-07-19 00:00:00', '2023-07-19 00:00:00', '2023-08-04 10:54:04');

SET FOREIGN_KEY_CHECKS = 1;
