-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.14


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema sis_pana
--

CREATE DATABASE IF NOT EXISTS sis_pana;
USE sis_pana;

--
-- Definition of table `bas_depar`
--

DROP TABLE IF EXISTS `bas_depar`;
CREATE TABLE `bas_depar` (
  `COD_DEPT` varchar(20) NOT NULL,
  `DES_LARG` varchar(100) DEFAULT NULL,
  `DES_CORT` varchar(100) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_DEPT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bas_depar`
--

/*!40000 ALTER TABLE `bas_depar` DISABLE KEYS */;
/*!40000 ALTER TABLE `bas_depar` ENABLE KEYS */;


--
-- Definition of table `bas_distr`
--

DROP TABLE IF EXISTS `bas_distr`;
CREATE TABLE `bas_distr` (
  `COD_DIST` varchar(20) NOT NULL,
  `COD_PROV` varchar(20) NOT NULL,
  `COD_DEPT` varchar(20) NOT NULL,
  `DES_LARG` varchar(100) DEFAULT NULL,
  `DES_CORT` varchar(100) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_DIST`,`COD_PROV`,`COD_DEPT`),
  KEY `BAS_DISTR_FKIndex1` (`COD_DEPT`,`COD_PROV`),
  CONSTRAINT `BAS_DISTR_ibfk_1` FOREIGN KEY (`COD_DEPT`, `COD_PROV`) REFERENCES `bas_provi` (`COD_DEPT`, `COD_PROV`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bas_distr`
--

/*!40000 ALTER TABLE `bas_distr` DISABLE KEYS */;
/*!40000 ALTER TABLE `bas_distr` ENABLE KEYS */;


--
-- Definition of table `bas_motiv_trasl`
--

DROP TABLE IF EXISTS `bas_motiv_trasl`;
CREATE TABLE `bas_motiv_trasl` (
  `COD_TRAS` varchar(2) NOT NULL,
  `DES_TRAS` varchar(50) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_TRAS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bas_motiv_trasl`
--

/*!40000 ALTER TABLE `bas_motiv_trasl` DISABLE KEYS */;
/*!40000 ALTER TABLE `bas_motiv_trasl` ENABLE KEYS */;


--
-- Definition of table `bas_param`
--

DROP TABLE IF EXISTS `bas_param`;
CREATE TABLE `bas_param` (
  `COD_PARA` varchar(2) NOT NULL,
  `VAL_PARA` varchar(100) DEFAULT NULL,
  `DES_PARA` varchar(100) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_PARA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bas_param`
--

/*!40000 ALTER TABLE `bas_param` DISABLE KEYS */;
INSERT INTO `bas_param` (`COD_PARA`,`VAL_PARA`,`DES_PARA`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`) VALUES 
 ('01','18','IGV','ADMIN','2016-06-21 00:00:00','admin','2016-10-31 10:40:55'),
 ('06','CALLE AYABACA 173','PUNTO DE PARTIDA','ADMIN','2016-06-21 00:00:00','admin','2016-10-31 10:41:03');
/*!40000 ALTER TABLE `bas_param` ENABLE KEYS */;


--
-- Definition of table `bas_provi`
--

DROP TABLE IF EXISTS `bas_provi`;
CREATE TABLE `bas_provi` (
  `COD_DEPT` varchar(20) NOT NULL,
  `COD_PROV` varchar(20) NOT NULL,
  `DES_LARG` varchar(100) DEFAULT NULL,
  `DES_CORT` varchar(100) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_PROV`),
  KEY `BAS_PROVI_FKIndex1` (`COD_DEPT`),
  CONSTRAINT `BAS_PROVI_ibfk_1` FOREIGN KEY (`COD_DEPT`) REFERENCES `bas_depar` (`COD_DEPT`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bas_provi`
--

/*!40000 ALTER TABLE `bas_provi` DISABLE KEYS */;
/*!40000 ALTER TABLE `bas_provi` ENABLE KEYS */;


--
-- Definition of table `cro_opera_tiend`
--

DROP TABLE IF EXISTS `cro_opera_tiend`;
CREATE TABLE `cro_opera_tiend` (
  `COD_TIEN` varchar(6) NOT NULL,
  `COD_CLIE` varchar(6) NOT NULL,
  `FEC_FACT` datetime DEFAULT NULL,
  `DIA_REPA` int(1) DEFAULT NULL,
  `HOR_ATEN_DESD` varchar(6) DEFAULT NULL,
  `HOR_ATEN_HAST` varchar(6) DEFAULT NULL,
  `COD_ESTA_OPER` varchar(1) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  KEY `CRO_OPERA_TIEND_FKIndex1` (`COD_CLIE`,`COD_TIEN`),
  CONSTRAINT `CRO_OPERA_TIEND_ibfk_1` FOREIGN KEY (`COD_CLIE`, `COD_TIEN`) REFERENCES `mae_tiend` (`COD_CLIE`, `COD_TIEN`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cro_opera_tiend`
--

/*!40000 ALTER TABLE `cro_opera_tiend` DISABLE KEYS */;
/*!40000 ALTER TABLE `cro_opera_tiend` ENABLE KEYS */;


--
-- Definition of table `fac_detal_factu`
--

DROP TABLE IF EXISTS `fac_detal_factu`;
CREATE TABLE `fac_detal_factu` (
  `COD_FACT` varchar(12) NOT NULL DEFAULT '',
  `COD_PROD` varchar(12) NOT NULL,
  `VAL_PROD` decimal(12,2) DEFAULT NULL,
  `IMP_PROD` decimal(12,2) DEFAULT NULL,
  `IGV_PROD` decimal(12,2) DEFAULT NULL,
  `IMP_TOTA_PROD` decimal(12,2) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  `FACT_DET` int(10) DEFAULT NULL,
  `COD_TIEN` varchar(6) DEFAULT NULL,
  `COD_CLIE` varchar(6) DEFAULT NULL,
  `UNI_SOLI` decimal(12,2) DEFAULT NULL,
  KEY `FAC_DETAL_FACTU_FKIndex1` (`COD_FACT`),
  KEY `FAC_DETAL_FACTU_FKIndex2` (`COD_PROD`),
  CONSTRAINT `FAC_DETAL_FACTU_ibfk_1` FOREIGN KEY (`COD_FACT`) REFERENCES `fac_factu` (`COD_FACT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FAC_DETAL_FACTU_ibfk_2` FOREIGN KEY (`COD_PROD`) REFERENCES `mae_produ` (`COD_PROD`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac_detal_factu`
--

/*!40000 ALTER TABLE `fac_detal_factu` DISABLE KEYS */;
/*!40000 ALTER TABLE `fac_detal_factu` ENABLE KEYS */;


--
-- Definition of table `fac_detal_guia_remis`
--

DROP TABLE IF EXISTS `fac_detal_guia_remis`;
CREATE TABLE `fac_detal_guia_remis` (
  `COD_GUIA` varchar(12) NOT NULL DEFAULT '',
  `COD_PROD` varchar(12) NOT NULL,
  `PES_PROD` decimal(12,2) DEFAULT NULL,
  `UNI_SOLI` decimal(12,2) DEFAULT NULL,
  `VAL_PROD` decimal(12,2) DEFAULT NULL,
  `IMP_PROD` decimal(12,2) DEFAULT NULL,
  `IGV_PROD` decimal(12,2) DEFAULT NULL,
  `IMP_TOTA_PROD` decimal(12,2) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  `GUIA_DET` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`GUIA_DET`),
  KEY `FAC_DETAL_GUIA_REMIS_FKIndex1` (`COD_GUIA`),
  KEY `FAC_DETAL_GUIA_REMIS_FKIndex2` (`COD_PROD`),
  CONSTRAINT `FAC_DETAL_GUIA_REMIS_ibfk_1` FOREIGN KEY (`COD_GUIA`) REFERENCES `fac_guia_remis` (`COD_GUIA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FAC_DETAL_GUIA_REMIS_ibfk_2` FOREIGN KEY (`COD_PROD`) REFERENCES `mae_produ` (`COD_PROD`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac_detal_guia_remis`
--

/*!40000 ALTER TABLE `fac_detal_guia_remis` DISABLE KEYS */;
/*!40000 ALTER TABLE `fac_detal_guia_remis` ENABLE KEYS */;


--
-- Definition of table `fac_detal_orden_compr`
--

DROP TABLE IF EXISTS `fac_detal_orden_compr`;
CREATE TABLE `fac_detal_orden_compr` (
  `COD_CLIE` varchar(6) NOT NULL DEFAULT '',
  `COD_TIEN` varchar(6) NOT NULL,
  `COD_ORDE` int(20) NOT NULL,
  `COD_PROD` varchar(12) NOT NULL,
  `NRO_UNID` int(12) DEFAULT NULL,
  `VAL_PREC` decimal(10,2) DEFAULT NULL,
  `VAL_IGV` decimal(5,2) DEFAULT NULL,
  `VAL_MONT_UNID` decimal(10,2) DEFAULT NULL,
  `VAL_MONT_IGV` decimal(10,2) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  `VAL_TOTAL` decimal(10,2) DEFAULT NULL,
  `ORD_COR` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ORD_COR`),
  KEY `FAC_DETAL_ORDEN_COMPR_FKIndex1` (`COD_CLIE`,`COD_TIEN`,`COD_ORDE`),
  KEY `FAC_DETAL_ORDEN_COMPR_FKIndex2` (`COD_PROD`),
  CONSTRAINT `FAC_DETAL_ORDEN_COMPR_ibfk_2` FOREIGN KEY (`COD_PROD`) REFERENCES `mae_produ` (`COD_PROD`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac_detal_orden_compr`
--

/*!40000 ALTER TABLE `fac_detal_orden_compr` DISABLE KEYS */;
INSERT INTO `fac_detal_orden_compr` (`COD_CLIE`,`COD_TIEN`,`COD_ORDE`,`COD_PROD`,`NRO_UNID`,`VAL_PREC`,`VAL_IGV`,`VAL_MONT_UNID`,`VAL_MONT_IGV`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`,`VAL_TOTAL`,`ORD_COR`) VALUES 
 ('003','003',1,'1',3,'20.00','18.00','60.00','10.80','admin','2018-04-20 06:37:42',NULL,NULL,'70.80',1);
/*!40000 ALTER TABLE `fac_detal_orden_compr` ENABLE KEYS */;


--
-- Definition of table `fac_factu`
--

DROP TABLE IF EXISTS `fac_factu`;
CREATE TABLE `fac_factu` (
  `COD_FACT` varchar(12) NOT NULL DEFAULT '',
  `COD_CLIE` varchar(6) NOT NULL,
  `COD_GUIA` varchar(12) DEFAULT NULL,
  `FEC_FACT` date DEFAULT NULL,
  `FEC_PAGO` date DEFAULT NULL,
  `IND_ESTA` varchar(1) DEFAULT NULL,
  `VAL_IGV` decimal(5,2) DEFAULT NULL,
  `TOT_FACT_SIN_IGV` decimal(12,2) DEFAULT NULL,
  `TOT_IGV` decimal(12,2) DEFAULT NULL,
  `TOT_FACT` decimal(12,2) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  `COD_TIEN` varchar(6) DEFAULT NULL,
  `TOT_UNID_FACT` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`COD_FACT`),
  KEY `FAC_FACTU_FKIndex1` (`COD_GUIA`),
  KEY `FAC_FACTU_FKIndex2` (`COD_CLIE`),
  CONSTRAINT `FAC_FACTU_ibfk_1` FOREIGN KEY (`COD_GUIA`) REFERENCES `fac_guia_remis` (`COD_GUIA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FAC_FACTU_ibfk_2` FOREIGN KEY (`COD_CLIE`) REFERENCES `mae_clien` (`COD_CLIE`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac_factu`
--

/*!40000 ALTER TABLE `fac_factu` DISABLE KEYS */;
/*!40000 ALTER TABLE `fac_factu` ENABLE KEYS */;


--
-- Definition of table `fac_guia_remis`
--

DROP TABLE IF EXISTS `fac_guia_remis`;
CREATE TABLE `fac_guia_remis` (
  `COD_GUIA` varchar(12) NOT NULL DEFAULT '',
  `COD_ORDE` int(20) DEFAULT NULL,
  `COD_TIEN` varchar(6) NOT NULL,
  `COD_CLIE` varchar(6) NOT NULL,
  `FEC_EMIS` date DEFAULT NULL,
  `DIR_PART` varchar(100) DEFAULT NULL,
  `FEC_TRAS` date DEFAULT NULL,
  `COS_FLET` decimal(10,2) DEFAULT NULL,
  `COD_EMPR_TRAN` varchar(2) DEFAULT NULL,
  `COD_UNID_TRAN` varchar(2) DEFAULT NULL,
  `COD_MOTI_TRAS` varchar(2) DEFAULT NULL,
  `IND_ESTA` varchar(1) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_GUIA`),
  KEY `FAC_GUIA_REMIS_FKIndex1` (`COD_CLIE`,`COD_TIEN`,`COD_ORDE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac_guia_remis`
--

/*!40000 ALTER TABLE `fac_guia_remis` DISABLE KEYS */;
/*!40000 ALTER TABLE `fac_guia_remis` ENABLE KEYS */;


--
-- Definition of table `fac_orden_compr`
--

DROP TABLE IF EXISTS `fac_orden_compr`;
CREATE TABLE `fac_orden_compr` (
  `COD_CLIE` varchar(6) NOT NULL DEFAULT '',
  `COD_TIEN` varchar(6) NOT NULL,
  `COD_ORDE` int(20) NOT NULL,
  `NUM_ORDE` varchar(12) DEFAULT NULL,
  `IND_TIPO` varchar(1) DEFAULT NULL,
  `TIP_MONE` varchar(1) DEFAULT NULL,
  `TOT_UNID_SOLI` decimal(10,2) DEFAULT NULL,
  `TOT_MONT_ORDE` decimal(10,2) DEFAULT NULL,
  `TOT_MONT_IGV` decimal(10,2) DEFAULT NULL,
  `TOT_FACT` decimal(10,2) DEFAULT NULL,
  `FEC_PAGO` datetime DEFAULT NULL,
  `IND_ESTA` varchar(1) NOT NULL DEFAULT '0' COMMENT 'Estado Creado',
  `FEC_INGR` date DEFAULT NULL,
  `FEC_ENVI` date DEFAULT NULL,
  `FEC_ANUL` datetime DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` timestamp NULL DEFAULT NULL COMMENT 'Fecha Actual',
  PRIMARY KEY (`COD_ORDE`),
  KEY `FAC_ORDEN_COMPR_FKIndex1` (`COD_CLIE`,`COD_TIEN`),
  CONSTRAINT `FAC_ORDEN_COMPR_ibfk_1` FOREIGN KEY (`COD_CLIE`, `COD_TIEN`) REFERENCES `mae_tiend` (`COD_CLIE`, `COD_TIEN`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac_orden_compr`
--

/*!40000 ALTER TABLE `fac_orden_compr` DISABLE KEYS */;
INSERT INTO `fac_orden_compr` (`COD_CLIE`,`COD_TIEN`,`COD_ORDE`,`NUM_ORDE`,`IND_TIPO`,`TIP_MONE`,`TOT_UNID_SOLI`,`TOT_MONT_ORDE`,`TOT_MONT_IGV`,`TOT_FACT`,`FEC_PAGO`,`IND_ESTA`,`FEC_INGR`,`FEC_ENVI`,`FEC_ANUL`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`) VALUES 
 ('003','003',1,'1',NULL,'1',NULL,'60.00','10.80','70.80',NULL,'0','2018-04-07','2018-04-28',NULL,'admin','2018-04-20 06:37:42',NULL,NULL);
/*!40000 ALTER TABLE `fac_orden_compr` ENABLE KEYS */;


--
-- Definition of table `folio`
--

DROP TABLE IF EXISTS `folio`;
CREATE TABLE `folio` (
  `VAL_INI` int(99) NOT NULL DEFAULT '0',
  `VAL_FIN` int(99) NOT NULL,
  `VAL_ACTU` int(99) NOT NULL,
  `VAL_LLAVE` int(255) unsigned NOT NULL DEFAULT '0',
  `DESCRIPCION` varchar(100) DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL,
  `VALOR` varchar(1) DEFAULT NULL,
  `USUARIO` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`VAL_LLAVE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folio`
--

/*!40000 ALTER TABLE `folio` DISABLE KEYS */;
INSERT INTO `folio` (`VAL_INI`,`VAL_FIN`,`VAL_ACTU`,`VAL_LLAVE`,`DESCRIPCION`,`FECHA`,`VALOR`,`USUARIO`) VALUES 
 (1,9999999,200,0,'N° de Orden de Compra','2016-10-28 16:57:36','2','admin'),
 (1,9999999,602,1,'N° de Guia','2016-10-31 10:41:18','3','admin'),
 (1,9999999,551,2,'N° de Factura           ','2016-10-31 10:41:25','4','admin');
/*!40000 ALTER TABLE `folio` ENABLE KEYS */;


--
-- Definition of table `imp_folio_factu`
--

DROP TABLE IF EXISTS `imp_folio_factu`;
CREATE TABLE `imp_folio_factu` (
  `VAL_INIC` int(10) unsigned NOT NULL,
  `VAL_FIN` int(10) unsigned NOT NULL,
  `VAL_ACTUA` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imp_folio_factu`
--

/*!40000 ALTER TABLE `imp_folio_factu` DISABLE KEYS */;
/*!40000 ALTER TABLE `imp_folio_factu` ENABLE KEYS */;


--
-- Definition of table `imp_folio_guia`
--

DROP TABLE IF EXISTS `imp_folio_guia`;
CREATE TABLE `imp_folio_guia` (
  `VAL_INIC` int(10) unsigned NOT NULL,
  `VAL_FIN` int(10) unsigned NOT NULL,
  `VAL_ACTUA` int(10) unsigned NOT NULL,
  PRIMARY KEY (`VAL_INIC`,`VAL_FIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imp_folio_guia`
--

/*!40000 ALTER TABLE `imp_folio_guia` DISABLE KEYS */;
INSERT INTO `imp_folio_guia` (`VAL_INIC`,`VAL_FIN`,`VAL_ACTUA`) VALUES 
 (7000,9999,7231);
/*!40000 ALTER TABLE `imp_folio_guia` ENABLE KEYS */;


--
-- Definition of table `mae_clien`
--

DROP TABLE IF EXISTS `mae_clien`;
CREATE TABLE `mae_clien` (
  `COD_CLIE` varchar(6) NOT NULL,
  `DES_CLIE` varchar(100) DEFAULT NULL,
  `COD_ESTA` varchar(1) DEFAULT NULL,
  `DIR_FISC` varchar(100) DEFAULT NULL,
  `NRO_RUC` varchar(50) DEFAULT NULL,
  `COD_DEPT` varchar(2) DEFAULT NULL,
  `COD_PROV` varchar(2) DEFAULT NULL,
  `COD_DIST` varchar(2) DEFAULT NULL,
  `NRO_TEL1` varchar(20) DEFAULT NULL,
  `NRO_TEL2` varchar(20) DEFAULT NULL,
  `NRO_TEL3` varchar(20) DEFAULT NULL,
  `DIR_WEB` varchar(100) DEFAULT NULL,
  `DIR_EMA1` varchar(100) DEFAULT NULL,
  `DIR_EMA2` varchar(100) DEFAULT NULL,
  `DIR_EMA3` varchar(100) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_CLIE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mae_clien`
--

/*!40000 ALTER TABLE `mae_clien` DISABLE KEYS */;
INSERT INTO `mae_clien` (`COD_CLIE`,`DES_CLIE`,`COD_ESTA`,`DIR_FISC`,`NRO_RUC`,`COD_DEPT`,`COD_PROV`,`COD_DIST`,`NRO_TEL1`,`NRO_TEL2`,`NRO_TEL3`,`DIR_WEB`,`DIR_EMA1`,`DIR_EMA2`,`DIR_EMA3`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`) VALUES 
 ('001','Arias Velarde María Luisa Cristina','1','Psaje. Dammert Muelle 128- Tienda 4 - Surquillo','10411369299',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('002','Armando Aranda Levy','1','Simón Salguero 507 - Surco','10079295634',NULL,NULL,NULL,'2738264',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('003','Asociación C.P.A.P.E Alexander Von Humboldt','1','Av. Benavides N° 3081 - Miraflores','20118393717',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('004','Autorex Peruana S.A.C','1','Av. Republica de Panama Nro. 4045 - Surquillo','20100154138',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('005','Camara de Comercio e Industria Peruano - Alemana','1','Camino Real 348 - 1502 - San Isidro - Lima','20147720573',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('006','Colegio Trenner S.A','1','Cll. Las Limas 130 - Surco','20269300141',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('007','Deutsch Peruana S.A.C','1','','20510747934',NULL,NULL,NULL,'7174795',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('008','Edgar Flores','1','','',NULL,NULL,NULL,'989104260',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('009','Eventos Alemanes S.A.C','1','Cll. Sullana 197 - Surco','20554408754',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('010','Eventos Supalsa S.A','1','Av. Comunidad industrial n°240 La villa - Chirrillos - Lima','20304390078',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('011','Gianmart S.A.C','1','Cll. Bellavista N° 370 - Miraflores','20492401049',NULL,NULL,NULL,'981407075',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('012','Gordon Ingenieros Maquinaria S.A','1','Cll. Tnte Alfredo Franco 282 - Surco','20102108958',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('013','Grupo AVA S.A.C','1','Mar del Sur 103 - Dpto 201 - Surco','20522092348',NULL,NULL,NULL,'940241182',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('014','Hipermercados Tottus S.A','1','Av. Angamos Este Nro. 1805 Int. P-10 (Piso 10 Of.5 y Piso 11 Of.6a)','20508565934',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('015','La Suisse S.A.C','1','Cll. General Cordova N° 1155 - Miraflores','20550361109',NULL,NULL,NULL,'4218549',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('016','Nutrición y Bienestar XOL S.A.C.','1','Av. El derby 210 - Monterrico - Surco','20566310466',NULL,NULL,NULL,'997326511',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('017','Quimica Suiza Industrial del Peru S.A','1','Av. Republica de Panama Nro. 2577','20546357377',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('018','Sociedad Suizo Peruana de Embutidos S.A.','1','Car. Panamericana Norte K84 Lima','20136974697',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('019','Universidad Ricardo Palma','1','Av. Benavides N° 5440 - Urb las Gardenias - Surco','20147883952',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL),
 ('020','Westphalia Alimentos S.A.C.','1','Av.las jojobas Mza. B. Lote 12.z.i. Villa el Salvador','20546793517',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'ADMIN','2016-08-19 14:41:23',NULL,NULL);
/*!40000 ALTER TABLE `mae_clien` ENABLE KEYS */;


--
-- Definition of table `mae_empre`
--

DROP TABLE IF EXISTS `mae_empre`;
CREATE TABLE `mae_empre` (
  `COD_EMPR` varchar(6) NOT NULL,
  `DES_EMPR` varchar(100) DEFAULT NULL,
  `DIR_FISC` varchar(100) DEFAULT NULL,
  `NRO_RUC` varchar(50) DEFAULT NULL,
  `COD_DEPT` varchar(2) DEFAULT NULL,
  `COD_PROV` varchar(2) DEFAULT NULL,
  `COD_DIST` varchar(2) DEFAULT NULL,
  `NRO_TEL1` varchar(20) DEFAULT NULL,
  `NRO_TEL2` varchar(20) DEFAULT NULL,
  `NRO_TEL3` varchar(20) DEFAULT NULL,
  `DIR_WEB` varchar(100) DEFAULT NULL,
  `DIR_EMA1` varchar(100) DEFAULT NULL,
  `DIR_EMA2` varchar(100) DEFAULT NULL,
  `DIR_EMA3` varchar(100) DEFAULT NULL,
  `COD_ESTA` varchar(1) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_EMPR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mae_empre`
--

/*!40000 ALTER TABLE `mae_empre` DISABLE KEYS */;
/*!40000 ALTER TABLE `mae_empre` ENABLE KEYS */;


--
-- Definition of table `mae_linea_produ`
--

DROP TABLE IF EXISTS `mae_linea_produ`;
CREATE TABLE `mae_linea_produ` (
  `COD_LINE` varchar(2) NOT NULL,
  `DES_LARG` varchar(100) DEFAULT NULL,
  `DES_CORT` varchar(100) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_LINE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mae_linea_produ`
--

/*!40000 ALTER TABLE `mae_linea_produ` DISABLE KEYS */;
INSERT INTO `mae_linea_produ` (`COD_LINE`,`DES_LARG`,`DES_CORT`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`) VALUES 
 ('1','Tarjetas',NULL,NULL,NULL,NULL,NULL),
 ('2','blocks',NULL,NULL,NULL,NULL,NULL),
 ('3','Talonario',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `mae_linea_produ` ENABLE KEYS */;


--
-- Definition of table `mae_produ`
--

DROP TABLE IF EXISTS `mae_produ`;
CREATE TABLE `mae_produ` (
  `COD_PROD` varchar(12) NOT NULL DEFAULT '',
  `COD_LINE` varchar(2) NOT NULL,
  `DES_LARG` varchar(100) DEFAULT NULL,
  `DES_CORT` varchar(100) DEFAULT NULL,
  `COD_ESTA` varchar(1) DEFAULT NULL,
  `COD_MEDI` varchar(4) DEFAULT NULL,
  `VAL_PESO` int(6) DEFAULT NULL,
  `VAL_PROD` decimal(12,2) DEFAULT NULL,
  `VAL_CONV` int(2) DEFAULT NULL,
  `VAL_PORC` decimal(12,2) DEFAULT NULL,
  `VAL_COST` decimal(12,2) DEFAULT NULL,
  `VAL_REPO` int(12) DEFAULT NULL,
  `COD_LOTE` int(6) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  `NRO_UNID` int(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`COD_PROD`),
  KEY `MAE_PRODU_FKIndex1` (`COD_LINE`),
  CONSTRAINT `MAE_PRODU_ibfk_1` FOREIGN KEY (`COD_LINE`) REFERENCES `mae_linea_produ` (`COD_LINE`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mae_produ`
--

/*!40000 ALTER TABLE `mae_produ` DISABLE KEYS */;
INSERT INTO `mae_produ` (`COD_PROD`,`COD_LINE`,`DES_LARG`,`DES_CORT`,`COD_ESTA`,`COD_MEDI`,`VAL_PESO`,`VAL_PROD`,`VAL_CONV`,`VAL_PORC`,`VAL_COST`,`VAL_REPO`,`COD_LOTE`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`,`NRO_UNID`) VALUES 
 ('1','1','Tarjetas de Presentacion',NULL,'',NULL,NULL,'20.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 ('2','2','Paquete de facturas de color amarillo',NULL,'',NULL,NULL,'20.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 ('3','3','Impresas con sistemaa Offseta',NULL,'',NULL,NULL,'5.00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `mae_produ` ENABLE KEYS */;


--
-- Definition of table `mae_produ_tiend`
--

DROP TABLE IF EXISTS `mae_produ_tiend`;
CREATE TABLE `mae_produ_tiend` (
  `COD_TIEN` varchar(6) NOT NULL,
  `COD_CLIE` varchar(6) NOT NULL,
  `COD_PROD` varchar(12) NOT NULL,
  `IND_TIPO` varchar(1) DEFAULT NULL,
  `VAL_PROD` decimal(12,2) DEFAULT NULL,
  `VAL_DESC` decimal(5,2) DEFAULT NULL,
  `VAL_PROD_DESC` decimal(12,2) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  KEY `MAE_PRODU_TIEND_FKIndex1` (`COD_CLIE`,`COD_TIEN`),
  KEY `MAE_PRODU_TIEND_FKIndex2` (`COD_PROD`),
  CONSTRAINT `MAE_PRODU_TIEND_ibfk_1` FOREIGN KEY (`COD_CLIE`, `COD_TIEN`) REFERENCES `mae_tiend` (`COD_CLIE`, `COD_TIEN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MAE_PRODU_TIEND_ibfk_2` FOREIGN KEY (`COD_PROD`) REFERENCES `mae_produ` (`COD_PROD`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mae_produ_tiend`
--

/*!40000 ALTER TABLE `mae_produ_tiend` DISABLE KEYS */;
INSERT INTO `mae_produ_tiend` (`COD_TIEN`,`COD_CLIE`,`COD_PROD`,`IND_TIPO`,`VAL_PROD`,`VAL_DESC`,`VAL_PROD_DESC`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`) VALUES 
 ('003','003','1','0','20.00','0.00','20.00','admin','2018-04-20 06:37:42',NULL,NULL);
/*!40000 ALTER TABLE `mae_produ_tiend` ENABLE KEYS */;


--
-- Definition of table `mae_tiend`
--

DROP TABLE IF EXISTS `mae_tiend`;
CREATE TABLE `mae_tiend` (
  `COD_TIEN` varchar(6) NOT NULL,
  `DES_TIEN` varchar(100) DEFAULT NULL,
  `COD_CLIE` varchar(6) NOT NULL,
  `COD_ESTA` varchar(1) DEFAULT NULL,
  `DIR_TIEN` varchar(100) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_TIEN`),
  KEY `MAE_TIEND_FKIndex1` (`COD_CLIE`),
  CONSTRAINT `MAE_TIEND_ibfk_1` FOREIGN KEY (`COD_CLIE`) REFERENCES `mae_clien` (`COD_CLIE`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mae_tiend`
--

/*!40000 ALTER TABLE `mae_tiend` DISABLE KEYS */;
INSERT INTO `mae_tiend` (`COD_TIEN`,`DES_TIEN`,`COD_CLIE`,`COD_ESTA`,`DIR_TIEN`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`) VALUES 
 ('001','Tienda','001','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('002','Tienda','002','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('003','Tienda','003','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('004','Tienda','004','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('005','Tienda','005','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('006','Tienda','006','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('007','Tienda','007','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('008','Tienda','008','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('009','Tienda','009','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('010','Tienda','010','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('011','Kulcafe','011','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('012','Tienda','012','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('013','H1','013','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('014','H2','013','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('015','MOLICENTRO','014','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('016','Tienda','015','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('017','Fuxion','016','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('018','Tienda','017','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('019','Tienda','018','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('020','Univ.','019','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('021','Tienda','020','1',NULL,'ADMIN','2016-08-19 14:50:57',NULL,NULL),
 ('022','LA FONTANA','014','1',NULL,'ADMIN','2016-08-20 09:49:55',NULL,NULL),
 ('023','JOCKEY PLAZA','014','1',NULL,'ADMIN','2016-08-20 09:49:55',NULL,NULL),
 ('024','MIRAFLORES','014','1',NULL,'ADMIN','2016-08-20 09:49:55',NULL,NULL),
 ('025','ANGAMOS','014','1',NULL,'ADMIN','2016-08-20 09:49:55',NULL,NULL),
 ('026','SAN LUIS','014','1',NULL,'ADMIN','2016-08-20 09:49:55',NULL,NULL),
 ('027','BEGONIAS','014','1',NULL,'ADMIN','2016-08-20 09:49:55',NULL,NULL),
 ('028','LIMA SUR','014','1',NULL,'ADMIN','2016-08-20 09:49:55',NULL,NULL);
/*!40000 ALTER TABLE `mae_tiend` ENABLE KEYS */;


--
-- Definition of table `mae_trans`
--

DROP TABLE IF EXISTS `mae_trans`;
CREATE TABLE `mae_trans` (
  `COD_TRAN` varchar(2) NOT NULL,
  `DES_TRAN` varchar(100) DEFAULT NULL,
  `DIR_FISC` varchar(100) DEFAULT NULL,
  `NRO_RUC` varchar(50) DEFAULT NULL,
  `COD_DEPT` varchar(2) DEFAULT NULL,
  `COD_PROV` varchar(2) DEFAULT NULL,
  `COD_DIST` varchar(2) DEFAULT NULL,
  `NRO_TEL1` varchar(20) DEFAULT NULL,
  `NRO_TEL2` varchar(20) DEFAULT NULL,
  `NRO_TEL3` varchar(20) DEFAULT NULL,
  `DIR_WEB` varchar(100) DEFAULT NULL,
  `DIR_EMAIL1` varchar(100) DEFAULT NULL,
  `DIR_EMAIL2` varchar(100) DEFAULT NULL,
  `DIR_EMAIL3` varchar(100) DEFAULT NULL,
  `COD_ESTA` varchar(1) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  PRIMARY KEY (`COD_TRAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mae_trans`
--

/*!40000 ALTER TABLE `mae_trans` DISABLE KEYS */;
/*!40000 ALTER TABLE `mae_trans` ENABLE KEYS */;


--
-- Definition of table `mae_unida_trans`
--

DROP TABLE IF EXISTS `mae_unida_trans`;
CREATE TABLE `mae_unida_trans` (
  `COD_EMPR` varchar(2) DEFAULT NULL,
  `COD_UNID_TRAN` varchar(2) DEFAULT NULL,
  `NOM_COND` varchar(100) DEFAULT NULL,
  `MAR_VEHI` varchar(50) DEFAULT NULL,
  `NUM_PLAC` varchar(20) DEFAULT NULL,
  `NUM_CONS_INSC` varchar(20) DEFAULT NULL,
  `NUM_LICE_COND` varchar(20) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mae_unida_trans`
--

/*!40000 ALTER TABLE `mae_unida_trans` DISABLE KEYS */;
/*!40000 ALTER TABLE `mae_unida_trans` ENABLE KEYS */;


--
-- Definition of table `ped_impre_masiv_factu`
--

DROP TABLE IF EXISTS `ped_impre_masiv_factu`;
CREATE TABLE `ped_impre_masiv_factu` (
  `COD_FACTU` varchar(12) NOT NULL,
  PRIMARY KEY (`COD_FACTU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ped_impre_masiv_factu`
--

/*!40000 ALTER TABLE `ped_impre_masiv_factu` DISABLE KEYS */;
INSERT INTO `ped_impre_masiv_factu` (`COD_FACTU`) VALUES 
 ('7011'),
 ('7012');
/*!40000 ALTER TABLE `ped_impre_masiv_factu` ENABLE KEYS */;


--
-- Definition of table `seg_usuar`
--

DROP TABLE IF EXISTS `seg_usuar`;
CREATE TABLE `seg_usuar` (
  `COD_USUA` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `COD_LOCA` varchar(2) DEFAULT NULL,
  `NOM_USUA` varchar(60) DEFAULT NULL,
  `APE_USUA` varchar(60) DEFAULT NULL,
  `USE_USUA` varchar(20) DEFAULT NULL,
  `PAS_USUA` varchar(50) DEFAULT NULL,
  `EMA_USUA` varchar(50) DEFAULT NULL,
  `EST_USUA` varchar(1) DEFAULT NULL,
  `FEC_ULTI_INGR` datetime DEFAULT NULL,
  `FEC_ULTI_MODI_PASS` datetime DEFAULT NULL,
  `VAL_INTE_FALL_PASS` varchar(1) DEFAULT NULL,
  `USU_DIGI` varchar(20) DEFAULT NULL,
  `FEC_DIGI` datetime DEFAULT NULL,
  `USU_MODI` varchar(20) DEFAULT NULL,
  `FEC_MODI` datetime DEFAULT NULL,
  `VAL_IP` varchar(15) DEFAULT NULL,
  `IND_ACCE` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`COD_USUA`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seg_usuar`
--

/*!40000 ALTER TABLE `seg_usuar` DISABLE KEYS */;
INSERT INTO `seg_usuar` (`COD_USUA`,`COD_LOCA`,`NOM_USUA`,`APE_USUA`,`USE_USUA`,`PAS_USUA`,`EMA_USUA`,`EST_USUA`,`FEC_ULTI_INGR`,`FEC_ULTI_MODI_PASS`,`VAL_INTE_FALL_PASS`,`USU_DIGI`,`FEC_DIGI`,`USU_MODI`,`FEC_MODI`,`VAL_IP`,`IND_ACCE`) VALUES 
 (7,NULL,NULL,NULL,'admin','21232f297a57a5a743894a0e4a801fc3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `seg_usuar` ENABLE KEYS */;


--
-- Definition of table `tmp_repor_venta`
--

DROP TABLE IF EXISTS `tmp_repor_venta`;
CREATE TABLE `tmp_repor_venta` (
  `COD_CLIE` varchar(6) NOT NULL,
  `DES_CLIE` varchar(100) NOT NULL,
  `DIR_TIEN` varchar(100) NOT NULL,
  `COD_TIEN` varchar(6) NOT NULL,
  `COD_PROD` varchar(12) NOT NULL,
  `DES_LARG` varchar(100) NOT NULL,
  `IMP_TOTA` decimal(12,2) NOT NULL,
  `USU_DIGI` varchar(20) NOT NULL,
  `UNI_SOLI` int(10) unsigned NOT NULL,
  KEY `Index_1` (`COD_CLIE`,`COD_TIEN`) USING BTREE,
  KEY `Index_2` (`USU_DIGI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_repor_venta`
--

/*!40000 ALTER TABLE `tmp_repor_venta` DISABLE KEYS */;
INSERT INTO `tmp_repor_venta` (`COD_CLIE`,`DES_CLIE`,`DIR_TIEN`,`COD_TIEN`,`COD_PROD`,`DES_LARG`,`IMP_TOTA`,`USU_DIGI`,`UNI_SOLI`) VALUES 
 ('2','METRO','LA FONTANA','2','000005','Pan de Semilla de Girasol','1151.68','root',122);
/*!40000 ALTER TABLE `tmp_repor_venta` ENABLE KEYS */;


--
-- Definition of function `GET_VALOR_PRODU`
--

DROP FUNCTION IF EXISTS `GET_VALOR_PRODU`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` FUNCTION `GET_VALOR_PRODU`(x_COD_PRODU varchar(12), x_COD_TIEN varchar(6),x_COD_CLIE varchar(6)) RETURNS decimal(12,2)
BEGIN







    declare precio decimal(10,2);







    set precio=0;























    SELECT val_prod into precio







    FROM mae_produ_tiend







    where cod_prod= x_COD_PRODU







          and cod_tien = x_COD_TIEN







          AND COD_CLIE= x_COD_CLIE;















    if precio is null or precio=0 then















      SELECT val_prod into precio







      FROM mae_produ







      where cod_prod= x_COD_PRODU;















    end if;























    RETURN precio;







  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `ACTUA_DETAL_FACTU`
--

DROP PROCEDURE IF EXISTS `ACTUA_DETAL_FACTU`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUA_DETAL_FACTU`(

  IN fila            INT,
  IN x_cod_factu     int(99),
  IN x_cod_factu_det int(99),
  IN x_cod_clien     int(99),
  IN x_NRO_UNID      INT(11),
  IN x_DES_LARG      VARCHAR(250),
  IN x_VAL_PREC      DECIMAL(10, 2),
  IN x_VAL_MONT_UNID DECIMAL(10, 2)
)
BEGIN

    IF fila = 0  THEN

      delete FROM detalle_factura
      WHERE COD_FACT = x_cod_factu;

    END IF;

    INSERT INTO  detalle_factura (
      COD_FACT,
      COD_FACT_DET,
      COD_PRODUC,
      CANTIDAD,
      DESCRIPCION,
      TOTAL,
      COD_CLIE,
      PRECIO
    )

    VALUES (
      x_cod_factu,
      x_cod_factu_det,
      1,
      x_NRO_UNID,
      x_DES_LARG,
      x_VAL_MONT_UNID,
      x_cod_clien,
      x_VAL_PREC
    );

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `ACTUA_DETAL_PRESU`
--

DROP PROCEDURE IF EXISTS `ACTUA_DETAL_PRESU`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUA_DETAL_PRESU`(

  IN fila            INT,
  IN x_cod_presu     int(99),
  IN x_cod_presu_det int(99),
  IN x_cod_clien     int(99),
  IN x_NRO_UNID      INT(11),
  IN x_DES_LARG      VARCHAR(250),
  IN x_VAL_PREC      DECIMAL(10, 2),
  IN x_VAL_MONT_UNID DECIMAL(10, 2)
)
BEGIN

    IF fila = 0  THEN

      delete FROM detalle_presupuesto
      WHERE COD_PRESU = x_cod_presu;

    END IF;

    INSERT INTO  detalle_presupuesto (
      COD_PRESU,
      COD_PRESU_DET,
      COD_PRODUC,
      CANTIDAD,
      DESCRIPCION,
      TOTAL,
      COD_CLIE,
      PRECIO
    )

    VALUES (
      x_cod_presu,
      x_cod_presu_det,
      1,
      x_NRO_UNID,
      x_DES_LARG,
      x_VAL_MONT_UNID,
      x_cod_clien,
      x_VAL_PREC
    );

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `AUDITORIA`
--

DROP PROCEDURE IF EXISTS `AUDITORIA`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AUDITORIA`(

  IN X_USUARIO VARCHAR(100),
  IN X_VALOR   INT
)
BEGIN

    CASE X_VALOR

      WHEN 01
      THEN
        UPDATE bas_param
        SET USU_MODI = X_USUARIO,
          FEC_MODI   = NOW();

      WHEN 02
      THEN
        UPDATE folio
        SET USUARIO = X_USUARIO,
          FECHA   = NOW()
        where VAL_LLAVE = 0;

      WHEN 03
      THEN
        UPDATE folio
        SET USUARIO = X_USUARIO,
          FECHA   = NOW()
        where VAL_LLAVE = 1;

      WHEN 04
      THEN
        UPDATE folio
        SET USUARIO = X_USUARIO,
          FECHA   = NOW()
        where VAL_LLAVE = 2;

    END CASE;
  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `CREAR_DETAL_FACTU`
--

DROP PROCEDURE IF EXISTS `CREAR_DETAL_FACTU`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CREAR_DETAL_FACTU`(

  IN fila            INT,
  IN x_cod_factu     int(99),
  IN x_cod_factu_det int(99),
  IN x_cod_clien     int(99),
  IN x_NRO_UNID      INT(11),
  IN x_DES_LARG      VARCHAR(250),
  IN x_VAL_PREC      DECIMAL(10, 2),
  IN x_VAL_MONT_UNID DECIMAL(10, 2)
)
BEGIN

    IF fila = 0  THEN

      delete from detalle_factura where COD_FACT = x_cod_factu and COD_CLIE = x_cod_clien;

      UPDATE folio
      SET VAL_ACTU = (VAL_ACTU+1)
      where VAL_LLAVE = 2;

      UPDATE factura
      SET FECHA = now()
      WHERE CLIENTE = x_cod_clien and COD_FACT = x_cod_factu;

    END IF;

    INSERT INTO  detalle_factura (
      COD_FACT,
      COD_FACT_DET,
      COD_PRODUC,
      CANTIDAD,
      DESCRIPCION,
      TOTAL,
      COD_CLIE,
      PRECIO
    )

    VALUES (
      x_cod_factu,
      x_cod_factu_det,
      1,
      x_NRO_UNID,
      x_DES_LARG,
      x_VAL_MONT_UNID,
      x_cod_clien,
      x_VAL_PREC
    );

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `CREAR_DETAL_PRESU`
--

DROP PROCEDURE IF EXISTS `CREAR_DETAL_PRESU`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CREAR_DETAL_PRESU`(

  IN fila            INT,
  IN x_cod_presu     int(99),
  IN x_cod_presu_det int(99),
  IN x_cod_clien     int(99),
  IN x_NRO_UNID      INT(11),
  IN x_DES_LARG      VARCHAR(250),
  IN x_VAL_PREC      DECIMAL(10, 2),
  IN x_VAL_MONT_UNID DECIMAL(10, 2)
)
BEGIN

    IF fila = 0  THEN

      delete from detalle_presupuesto where COD_PRESU = x_cod_presu and COD_CLIE= x_cod_clien;

      UPDATE folio
      SET VAL_ACTU = (VAL_ACTU+1)
      where VAL_LLAVE = 0;

    END IF;

    INSERT INTO  detalle_presupuesto (
      COD_PRESU,
      COD_PRESU_DET,
      COD_PRODUC,
      CANTIDAD,
      DESCRIPCION,
      TOTAL,
      COD_CLIE,
      PRECIO
    )

    VALUES (
      x_cod_presu,
      x_cod_presu_det,
      1,
      x_NRO_UNID,
      x_DES_LARG,
      x_VAL_MONT_UNID,
      x_cod_clien,
      x_VAL_PREC
    );

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_ACTUA_DETAL_FACT`
--

DROP PROCEDURE IF EXISTS `PED_ACTUA_DETAL_FACT`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_ACTUA_DETAL_FACT`(

  in fila int,
  in x_cod_fact varchar(12),
  in x_cod_tiend varchar(6),
  in x_cod_clien varchar(6),
  in x_COD_PROD VARCHAR(12),
  in x_NRO_UNID int(12),
  in x_VAL_PREC decimal(10,2),
  in x_VAL_MONT_UNID decimal(10,2),
  in x_DES_LARG varchar(60),
  in x_VAL_USU varchar(10),
  in x_VAL_PCIP varchar(60)
)
BEGIN

    declare igv decimal(10,2);
    declare igvCalcu decimal(10,2);

    SELECT cast(VAL_PARA as decimal(10,2))
    INTO igv
    FROM bas_param
    WHERE COD_PARA='01';

    IF igv is null THEN
      SET igv=18 ;
    END IF;

    set igvCalcu = (1+ igv/100);

    update fac_detal_factu
    set fec_modi = now()
    where COD_FACT = x_cod_fact;


    if NOT EXISTS(
        SELECT VAL_PROD
        FROM mae_produ_tiend AS C
        WHERE cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien
              and COD_PROD = x_COD_PROD
    )

    then

      insert into mae_produ_tiend(COD_TIEN,COD_CLIE,COD_PROD,IND_TIPO,VAL_PROD,VAL_DESC,VAL_PROD_DESC,USU_DIGI,FEC_DIGI)
      VALUES(x_cod_tiend,x_cod_clien,x_COD_PROD,'0',x_VAL_PREC,0,x_VAL_PREC,x_VAL_USU,NOW());

    ELSE

      UPDATE mae_produ_tiend
      SET VAL_PROD = x_VAL_PREC,
        VAL_PROD_DESC=x_VAL_PREC,
        fec_modi = now(),
        USU_MODI= x_VAL_USU
      WHERE cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien and COD_PROD = x_COD_PROD;

    end if;

    IF fila = 0  THEN
      delete from fac_detal_factu where COD_FACT = x_cod_fact and cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien;
    END IF;

    INSERT INTO fac_detal_factu (
      COD_CLIE,
      COD_TIEN,
      COD_FACT,
      COD_PROD,
      UNI_SOLI,
      VAL_PROD,
      IMP_PROD,
      IMP_TOTA_PROD,
      IGV_PROD,
      USU_DIGI,
      FEC_DIGI)

    VALUES (
      x_cod_clien,
      x_cod_tiend,
      x_cod_fact,
      x_COD_PROD,
      x_NRO_UNID,
      x_VAL_PREC,
      x_VAL_MONT_UNID,
      x_VAL_MONT_UNID * igvCalcu,
      x_VAL_MONT_UNID * (igv/100),
      x_VAL_USU,
      NOW());

    UPDATE fac_factu
    SET FEC_FACT = now(),
      VAL_IGV    = igv,
      FEC_DIGI   = now()
    WHERE COD_FACT = x_cod_fact;
  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_ACTUA_DETAL_OC`
--

DROP PROCEDURE IF EXISTS `PED_ACTUA_DETAL_OC`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_ACTUA_DETAL_OC`(















  in fila int,







  in x_cod_orden varchar(12),







  in x_cod_tiend varchar(6),







  in x_cod_clien varchar(6),







  in x_COD_PROD VARCHAR(12),







  in x_NRO_UNID int(12),







  in x_VAL_PREC decimal(10,2),







  in x_VAL_MONT_UNID decimal(10,2),







  in x_DES_LARG varchar(60),







  in x_VAL_USU varchar(10),







  in x_VAL_PCIP varchar(60))
BEGIN







    declare igv decimal(10,2);







    declare igvCalcu decimal(10,2);























    SELECT cast(VAL_PARA as decimal(10,2)) INTO igv







    FROM bas_param







    WHERE COD_PARA='01';























    IF igv is null THEN







      SET igv=18 ;







    END IF;







    set igvCalcu = (1+ igv/100);















    update fac_orden_compr







    set fec_modi = now()







    where cod_orde = x_cod_orden;























    if NOT EXISTS(







        SELECT VAL_PROD







        FROM mae_produ_tiend AS C







        WHERE cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien







              and COD_PROD = x_COD_PROD







    ) then















      insert into mae_produ_tiend(COD_TIEN,COD_CLIE,COD_PROD,IND_TIPO,VAL_PROD,VAL_DESC,VAL_PROD_DESC,USU_DIGI,FEC_DIGI)







      VALUES(x_cod_tiend,x_cod_clien,x_COD_PROD,'0',x_VAL_PREC,0,x_VAL_PREC,x_VAL_USU,NOW());















    ELSE















      UPDATE mae_produ_tiend







      SET VAL_PROD = x_VAL_PREC,







        VAL_PROD_DESC=x_VAL_PREC,







        fec_modi = now(),







        USU_MODI= x_VAL_USU







      WHERE cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien







            and COD_PROD = x_COD_PROD;















    end if;































    IF fila = 0  THEN







      delete from fac_detal_orden_compr where cod_orde=x_cod_orden and cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien;







    END IF;















    insert into fac_detal_orden_compr(COD_CLIE,COD_TIEN,COD_ORDE,COD_PROD,NRO_UNID,VAL_PREC,







                                      VAL_IGV,VAL_MONT_UNID,VAL_MONT_IGV,USU_DIGI,FEC_DIGI,VAL_TOTAL)















    VALUES(x_cod_clien,x_cod_tiend,x_cod_orden,x_COD_PROD,x_NRO_UNID,x_VAL_PREC,







                       igv,x_VAL_MONT_UNID,x_VAL_MONT_UNID*igv/100, x_VAL_USU,NOW(),x_VAL_MONT_UNID*igvCalcu);















  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_ANULA_FACTU`
--

DROP PROCEDURE IF EXISTS `PED_ANULA_FACTU`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_ANULA_FACTU`(IN X_COD_FACTU VARCHAR(12),in x_usu varchar(12))
BEGIN











    DECLARE CORDE      VARCHAR(12);



    DECLARE CGUIA      VARCHAR(12);







    SELECT COD_GUIA into CGUIA



    FROM FAC_FACTU



    where COD_FACT = X_COD_FACTU;







    SELECT COD_ORDE into CORDE



    FROM FAC_GUIA_REMIS



    where COD_GUIA = CGUIA;



















    UPDATE fac_factu



    SET IND_ESTA='9',



      TOT_UNID_FACT=0,



      TOT_FACT_SIN_IGV=0,



      TOT_IGV=0,



      TOT_FACT=0,



      USU_MODI = x_usu,



      FEC_MODI = NOW()



    WHERE COD_FACT= X_COD_FACTU;











    UPDATE fac_detal_factu



    SET IMP_PROD=0,



      IMP_TOTA_PROD=0,



      IGV_PROD=0,



      VAL_PROD=0,



      UNI_SOLI=0,



      USU_MODI = x_usu,



      FEC_MODI = NOW()



    WHERE COD_FACT= X_COD_FACTU;







    UPDATE fac_guia_remis



    SET IND_ESTA='0',



      USU_MODI = x_usu,



      FEC_MODI = NOW()



    WHERE COD_GUIA= CGUIA;



















    update fac_orden_compr



    set IND_ESTA ='1',



      usu_modi = x_usu,



      FEC_MODI= now()



    where COD_ORDE = CORDE;







  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_ANULA_GUIA`
--

DROP PROCEDURE IF EXISTS `PED_ANULA_GUIA`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_ANULA_GUIA`(IN X_COD_GUIA VARCHAR(12),in x_usu varchar(12))
BEGIN















    DECLARE X_COD_ORDE      VARCHAR(12);



    declare EST varchar(1);















    select IND_ESTA



    into EST



    from fac_guia_remis where COD_GUIA= X_COD_GUIA;















    if EST = '0' then











      SELECT COD_ORDE



      into X_COD_ORDE



      FROM fac_guia_remis



      where COD_GUIA = X_COD_GUIA;















      UPDATE fac_guia_remis



      SET IND_ESTA='9',



        USU_MODI = x_usu,



        FEC_MODI = NOW()



      WHERE COD_GUIA= X_COD_GUIA;







      UPDATE fac_detal_guia_remis



      SET



        IMP_TOTA_PROD=0,



        IMP_PROD=0,



        UNI_SOLI=0,



        USU_MODI = x_usu,



        FEC_MODI = NOW()



      WHERE COD_GUIA=X_COD_GUIA;















      update fac_orden_compr



      set IND_ESTA ='0',



        usu_modi = x_usu,



        FEC_MODI= now()



      where COD_ORDE = X_COD_ORDE;







    END if;







  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_ANULA_OC`
--

DROP PROCEDURE IF EXISTS `PED_ANULA_OC`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_ANULA_OC`(IN X_COD_ORDEN VARCHAR(12),in x_usu varchar(12))
BEGIN















    declare EST varchar(1);







    select IND_ESTA into EST



    from fac_orden_compr where COD_ORDE=X_COD_ORDEN;











    if EST = '0' then



















      update fac_orden_compr



      set IND_ESTA ='9',



        usu_modi = x_usu,



        fec_modi= now(),



        TOT_UNID_SOLI=0,



        TOT_MONT_ORDE=0,



        TOT_MONT_IGV=0,



        TOT_FACT=0



      where COD_ORDE=X_COD_ORDEN;







      UPDATE fac_detal_orden_compr



      SET NRO_UNID=0,



        VAL_MONT_UNID=0,



        VAL_MONT_IGV=0,



        USU_MODI = x_usu,



        FEC_MODI = NOW()



      WHERE COD_ORDE= X_COD_ORDEN;







    END if;







  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_CREAR_DETAL_FACT`
--

DROP PROCEDURE IF EXISTS `PED_CREAR_DETAL_FACT`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_CREAR_DETAL_FACT`(

  IN fila            INT,
  IN x_cod_fact      VARCHAR(12),
  IN x_cod_tiend     VARCHAR(6),
  IN x_cod_clien     VARCHAR(6),
  IN x_COD_PROD      VARCHAR(12),
  IN x_NRO_UNID      INT(12),
  IN x_VAL_PREC      DECIMAL(10, 2),
  IN x_VAL_MONT_UNID DECIMAL(10, 2),
  IN x_DES_LARG      VARCHAR(60),
  IN x_VAL_USU       VARCHAR(10),
  IN x_VAL_PCIP      VARCHAR(60)
)
BEGIN

    DECLARE igv DECIMAL(10, 2);
    DECLARE igvCalcu DECIMAL(10, 2);

    SELECT cast(VAL_PARA AS DECIMAL(10, 2))
    INTO igv
    FROM bas_param
    WHERE COD_PARA = '01';


    IF igv IS NULL
    THEN
      SET igv = 18;
    END IF;


    SET igvCalcu = (1 + igv / 100);


    UPDATE fac_detal_factu
    SET FEC_DIGI = now()
    WHERE COD_FACT = x_cod_fact;


    IF NOT EXISTS(
        SELECT VAL_PROD
        FROM mae_produ_tiend AS C
        WHERE cod_tien = x_cod_tiend AND COD_CLIE = x_cod_clien AND COD_PROD = x_COD_PROD
    )

    THEN

      INSERT INTO mae_produ_tiend (COD_TIEN, COD_CLIE, COD_PROD, IND_TIPO, VAL_PROD, VAL_DESC, VAL_PROD_DESC, USU_DIGI, FEC_DIGI)
      VALUES (x_cod_tiend, x_cod_clien, x_COD_PROD, '0', x_VAL_PREC, 0, x_VAL_PREC, x_VAL_USU, NOW());

    ELSE

      UPDATE mae_produ_tiend
      SET VAL_PROD    = x_VAL_PREC,
        VAL_PROD_DESC = x_VAL_PREC,
        fec_modi      = now(),
        USU_MODI      = x_VAL_USU
      WHERE cod_tien = x_cod_tiend AND COD_CLIE = x_cod_clien AND COD_PROD = x_COD_PROD;

    END IF;

    IF fila = 0
    THEN
      DELETE FROM fac_detal_factu
      WHERE COD_FACT = x_cod_fact AND cod_tien = x_cod_tiend AND COD_CLIE = x_cod_clien;

      UPDATE folio
      SET VAL_ACTU = (VAL_ACTU + 1)
      WHERE VAL_LLAVE = 2;

    END IF;

    INSERT INTO fac_detal_factu (
      COD_CLIE,
      COD_TIEN,
      COD_FACT,
      COD_PROD,
      UNI_SOLI,
      VAL_PROD,
      IMP_PROD,
      IMP_TOTA_PROD,
      IGV_PROD,
      USU_DIGI,
      FEC_DIGI)

    VALUES (
      x_cod_clien,
      x_cod_tiend,
      x_cod_fact,
      x_COD_PROD,
      x_NRO_UNID,
      x_VAL_PREC,
      x_VAL_MONT_UNID,
      x_VAL_MONT_UNID * igvCalcu,
      x_VAL_MONT_UNID * (igv/100),
      x_VAL_USU,
      NOW());

    UPDATE fac_factu
    SET FEC_FACT = now(),
      VAL_IGV    = igv,
      FEC_DIGI   = now()
    WHERE COD_FACT = x_cod_fact;

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_CREAR_DETAL_OC`
--

DROP PROCEDURE IF EXISTS `PED_CREAR_DETAL_OC`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_CREAR_DETAL_OC`(















  in fila int,







  in x_cod_orden varchar(12),







  in x_cod_tiend varchar(6),







  in x_cod_clien varchar(6),







  in x_COD_PROD VARCHAR(12),







  in x_NRO_UNID int(12),







  in x_VAL_PREC decimal(10,2),







  in x_VAL_MONT_UNID decimal(10,2),







  in x_DES_LARG varchar(60),







  in x_VAL_USU varchar(10),







  in x_VAL_PCIP varchar(60))
BEGIN















    declare igv decimal(10,2);







    declare igvCalcu decimal(10,2);























    SELECT cast(VAL_PARA as decimal(10,2)) INTO igv







    FROM bas_param







    WHERE COD_PARA='01';























    IF igv is null THEN







      SET igv=18 ;







    END IF;







    set igvCalcu = (1+ igv/100);























    update fac_orden_compr







    set fec_digi = now()







    where cod_orde = x_cod_orden;















    if NOT EXISTS(







        SELECT VAL_PROD







        FROM mae_produ_tiend AS C







        WHERE cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien







              and COD_PROD = x_COD_PROD







    ) then















      insert into mae_produ_tiend(COD_TIEN,COD_CLIE,COD_PROD,IND_TIPO,VAL_PROD,VAL_DESC,VAL_PROD_DESC,USU_DIGI,FEC_DIGI)







      VALUES(x_cod_tiend,x_cod_clien,x_COD_PROD,'0',x_VAL_PREC,0,x_VAL_PREC,x_VAL_USU,NOW());















    ELSE















      UPDATE mae_produ_tiend







      SET VAL_PROD = x_VAL_PREC,







        VAL_PROD_DESC=x_VAL_PREC,







        fec_modi = now(),







        USU_MODI= x_VAL_USU







      WHERE cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien







            and COD_PROD = x_COD_PROD;















    end if;























    IF fila = 0  THEN







      delete from fac_detal_orden_compr where cod_orde=x_cod_orden and cod_tien = x_cod_tiend and COD_CLIE= x_cod_clien;







    END IF;























    insert into fac_detal_orden_compr(COD_CLIE,COD_TIEN,COD_ORDE,COD_PROD,NRO_UNID,VAL_PREC,







                                      VAL_IGV,VAL_MONT_UNID,VAL_MONT_IGV,USU_DIGI,FEC_DIGI,VAL_TOTAL)







    VALUES(x_cod_clien,x_cod_tiend,x_cod_orden,x_COD_PROD,x_NRO_UNID,x_VAL_PREC,







                       igv,x_VAL_MONT_UNID,x_VAL_MONT_UNID*igv/100, x_VAL_USU,NOW(),x_VAL_MONT_UNID*igvCalcu);















  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_GENER_REPOR_VENTA`
--

DROP PROCEDURE IF EXISTS `PED_GENER_REPOR_VENTA`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_GENER_REPOR_VENTA`(IN X_FEC_INI VARCHAR(10),



                                                            IN X_FEC_FIN VARCHAR(10),



                                                            IN X_COD_CLIE VARCHAR(12),



                                                            IN X_COD_TIEN VARCHAR(12),



                                                            IN X_ESTADO varchar(1),



                                                            IN X_AGRUPA VARCHAR(1),



                                                            in x_usu varchar(20))
BEGIN







    DECLARE pscodclie VARCHAR(12);



    DECLARE psdesclie VARCHAR(100);



    DECLARE pscodtien VARCHAR(12);



    DECLARE psdestien VARCHAR(100);



    DECLARE pscodprod VARCHAR(12);



    DECLARE psdesprod VARCHAR(100);







    DECLARE unidades int;



    DECLARE total DECIMAL(10,2);



    DECLARE v_finished INTEGER DEFAULT 0;







    DECLARE cliente_cursor CURSOR FOR



      SELECT COD_CLIE,



        (select des_clie from mae_clien z  where z.cod_clie= Y.cod_clie) des_clie,



        SUM(TOT_FACT) total



      from fac_factu Y



      WHERE (X_COD_CLIE IS NULL OR X_COD_CLIE='' OR COD_CLIE = X_COD_CLIE)



            AND FEC_FACT >= STR_TO_DATE(X_FEC_INI, '%d/%m/%Y')



            AND FEC_FACT <= STR_TO_DATE(X_FEC_FIN, '%d/%m/%Y')



            and (X_ESTADO is null or X_ESTADO='' or ind_esta = X_ESTADO)



      GROUP BY COD_CLIE,2;







    DECLARE tienda_cursor CURSOR FOR



      SELECT Y.COD_CLIE,



        (select des_clie from mae_clien z  where z.cod_clie= Y.cod_clie) des_clie,



        A.COD_tien,



        Des_TIEN,



        SUM(TOT_FACT) total



      FROM fac_factu Y, fac_guia_remis f, mae_tiend A



      WHERE Y.COD_GUIA= F.COD_GUIA



            AND F.COD_TIEN = A.COD_TIEN



            and (X_COD_CLIE IS NULL OR X_COD_CLIE='' OR Y.COD_CLIE = X_COD_CLIE)



            AND FEC_FACT >= STR_TO_DATE(X_FEC_INI, '%d/%m/%Y')



            AND FEC_FACT <= STR_TO_DATE(X_FEC_FIN, '%d/%m/%Y')



            and (X_ESTADO is null or X_ESTADO='' or Y.ind_esta = X_ESTADO)



      GROUP BY Y.COD_CLIE,2,3,4;











    DECLARE producto_cursor CURSOR FOR



      SELECT Y.COD_CLIE,



        (select des_clie from mae_clien z  where z.cod_clie= Y.cod_clie) des_clie,



        A.COD_TIEN,



        Des_TIEN,



        w.cod_prod,



        sap.des_larg,



        sum(w.uni_soli) unidades,



        SUM(w.imp_tota_prod) total



      FROM fac_detal_factu w,fac_factu Y, fac_guia_remis f, mae_tiend A, mae_produ sap



      WHERE w.cod_fact=y.cod_fact



            and Y.COD_GUIA= F.COD_GUIA



            AND F.COD_TIEN = A.COD_TIEN



            and w.cod_prod= sap.cod_prod



            and (X_COD_CLIE IS NULL OR X_COD_CLIE='' OR Y.COD_CLIE = X_COD_CLIE)



            AND FEC_FACT >= STR_TO_DATE(X_FEC_INI, '%d/%m/%Y')



            AND FEC_FACT <= STR_TO_DATE(X_FEC_FIN, '%d/%m/%Y')



            and (X_ESTADO is null or X_ESTADO='' or Y.ind_esta = X_ESTADO)



      GROUP BY Y.COD_CLIE,2,3,4,5,6;









    DECLARE CONTINUE HANDLER



    FOR NOT FOUND SET v_finished = 1;











    DELETE FROM tmp_repor_venta WHERE USU_DIGI = x_usu;







    IF X_AGRUPA = '0' THEN









      OPEN cliente_cursor;









      loop1: LOOP









        FETCH cliente_cursor INTO pscodclie, psdesclie,total;











        IF v_finished = 1 THEN



          LEAVE loop1;



        END IF;







        insert into tmp_repor_venta(COD_CLIE,DES_CLIE,IMP_TOTA,USU_DIGI) values(pscodclie,psdesclie,total,x_usu);







      END LOOP loop1;









      CLOSE cliente_cursor;







    END IF;















    IF X_AGRUPA = '1' THEN









      OPEN tienda_cursor;









      loop1: LOOP









        FETCH tienda_cursor INTO pscodclie,psdesclie,pscodtien,psdestien,total;











        IF v_finished = 1 THEN



          LEAVE loop1;



        END IF;







        insert into tmp_repor_venta(COD_CLIE,DES_CLIE,COD_TIEN,DIR_TIEN,IMP_TOTA,USU_DIGI)



        values(pscodclie,psdesclie,pscodtien,psdestien,total,x_usu);











      END LOOP loop1;









      CLOSE tienda_cursor;







    END IF;











    IF X_AGRUPA = '2' THEN









      OPEN producto_cursor;









      loop1: LOOP









        FETCH producto_cursor INTO pscodclie,psdesclie,pscodtien,psdestien,pscodprod,psdesprod,unidades,total;











        IF v_finished = 1 THEN



          LEAVE loop1;



        END IF;







        insert into tmp_repor_venta(COD_CLIE,DES_CLIE,COD_TIEN,DIR_TIEN,COD_PROD,DES_LARG,UNI_SOLI,IMP_TOTA,USU_DIGI)



        values(pscodclie,psdesclie,pscodtien,psdestien,pscodprod,psdesprod,unidades,total,x_usu);







      END LOOP loop1;









      CLOSE producto_cursor;







    END IF;







  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_MIGRA_FACTU_TO_GUIA`
--

DROP PROCEDURE IF EXISTS `PED_MIGRA_FACTU_TO_GUIA`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_MIGRA_FACTU_TO_GUIA`(IN X_COD_FACTURA VARCHAR(12),
                                                              IN x_usu         VARCHAR(12))
BEGIN

    DECLARE NUM_GUIA INT;
    DECLARE NUM_FACTU INT;
    DECLARE CGUIA INT;
    DECLARE DIR_PARTIDA VARCHAR(100);
    DECLARE CORDER INT;
    DECLARE igv DECIMAL(10, 2);
    DECLARE igvCalcu DECIMAL(10, 2);

    SELECT COD_FACT
    INTO NUM_GUIA
    FROM fac_factu
    WHERE COD_FACT = X_COD_FACTURA AND IND_ESTA <> '9';


    SELECT cast(VAL_PARA AS DECIMAL(10, 2))
    INTO igv
    FROM bas_param
    WHERE COD_PARA = '01';

    IF igv IS NULL
    THEN
      SET igv = 18;
    END IF;

    SET igvCalcu = (1 + igv / 100);
    SET autocommit = 0;


    SELECT VAL_PARA
    INTO DIR_PARTIDA
    FROM bas_param
    WHERE COD_PARA = '06';

    SELECT VAL_ACTU
    INTO NUM_GUIA
    FROM folio
    WHERE VAL_LLAVE = 1 FOR UPDATE;

    SELECT COD_FACT
    INTO NUM_FACTU
    FROM fac_factu
    WHERE COD_FACT = X_COD_FACTURA AND IND_ESTA <> '9';

    SELECT COD_GUIA
    INTO CGUIA
    FROM fac_factu
    where COD_FACT =	X_COD_FACTURA;

    IF NUM_FACTU IS NOT NULL AND CGUIA IS NULL
    THEN

      INSERT fac_guia_remis (
        COD_GUIA,         COD_ORDE,         COD_TIEN,         COD_CLIE,         FEC_EMIS,         DIR_PART,         FEC_TRAS,         IND_ESTA,         USU_DIGI,         FEC_DIGI        )

        SELECT
          NUM_GUIA,
          NULL,
          COD_TIEN,
          COD_CLIE,
          DATE(now()),
          DIR_PARTIDA,
          NULL,
          1,
          x_usu,
          DATE(NOW())
        FROM fac_factu
        WHERE COD_FACT = X_COD_FACTURA;

      INSERT fac_detal_guia_remis (
        COD_GUIA,         COD_PROD,         UNI_SOLI,         VAL_PROD,         IMP_PROD,         IGV_PROD,         IMP_TOTA_PROD,         USU_DIGI,         FEC_DIGI
      )

        SELECT
          NUM_GUIA,
          COD_PROD,
          UNI_SOLI,
          VAL_PROD,
          IMP_PROD,
          IGV_PROD,
          IMP_TOTA_PROD,
          x_usu,
          DATE(now())
        FROM fac_detal_factu
        WHERE COD_FACT = X_COD_FACTURA;

      UPDATE folio
      SET VAL_ACTU = (NUM_GUIA + 1)
      WHERE VAL_LLAVE = 1;

      UPDATE fac_factu
      SET IND_ESTA = '1',
        COD_GUIA   = NUM_GUIA
      WHERE COD_FACT = X_COD_FACTURA;

      COMMIT;

    END IF;

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_MIGRA_GUIA_TO_FACTU`
--

DROP PROCEDURE IF EXISTS `PED_MIGRA_GUIA_TO_FACTU`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_MIGRA_GUIA_TO_FACTU`(IN X_COD_GUIA VARCHAR(12), IN x_usu VARCHAR(12))
BEGIN

    DECLARE NUM_FACTU INT;
    DECLARE CORDER INT;
    DECLARE CGUIA INT;
    DECLARE DIR_PARTIDA VARCHAR(100);
    DECLARE igv DECIMAL(10, 2);
    DECLARE igvCalcu DECIMAL(10, 2);

    SELECT COD_FACT
    INTO NUM_FACTU
    FROM fac_factu
    WHERE COD_GUIA = X_COD_GUIA AND IND_ESTA <> '9';

    SELECT
      COD_GUIA,
      COD_ORDE
    INTO CGUIA, CORDER
    FROM fac_guia_remis
    WHERE COD_GUIA = X_COD_GUIA;


    IF NUM_FACTU IS NULL AND CGUIA IS NOT NULL
    THEN
      SELECT cast(VAL_PARA AS DECIMAL(10, 2))
      INTO igv
      FROM bas_param
      WHERE COD_PARA = '01';
      IF igv IS NULL
      THEN
        SET igv = 18;
      END IF;

      SET igvCalcu = (1 + igv / 100);
      SET autocommit = 0;

            
            SELECT VAL_ACTU
      INTO NUM_FACTU
      FROM folio
      WHERE VAL_LLAVE = 2 FOR UPDATE;


      INSERT fac_factu (
        COD_FACT,
        COD_CLIE,
        COD_GUIA,
        FEC_FACT,
        IND_ESTA,
        VAL_IGV,
        TOT_UNID_FACT,
        TOT_FACT_SIN_IGV,
        TOT_IGV,
        TOT_FACT,
        USU_DIGI,
        FEC_DIGI,
        COD_TIEN)

        SELECT
          NUM_FACTU,
          COD_CLIE,
          COD_GUIA,
          DATE(NOW()),
          '1',
          igv,
          (SELECT TOT_UNID_SOLI
           FROM fac_orden_compr
           WHERE COD_ORDE = CORDER) TOT_UNID_FACT,

          (SELECT TOT_MONT_ORDE
           FROM fac_orden_compr
           WHERE COD_ORDE = CORDER) TOT_MONT_ORDE,

          (SELECT TOT_MONT_IGV
           FROM fac_orden_compr
           WHERE COD_ORDE = CORDER) TOT_MONT_IGV,

          (SELECT TOT_FACT
           FROM fac_orden_compr
           WHERE COD_ORDE = CORDER) TOT_FACT,

          x_usu,
          now(),
          COD_CLIE

        FROM fac_guia_remis
        WHERE COD_GUIA = X_COD_GUIA;


      INSERT fac_detal_factu (
        COD_FACT,
        COD_PROD,
        UNI_SOLI,
        VAL_PROD,
        IMP_PROD,
        IGV_PROD,
        IMP_TOTA_PROD,
        USU_DIGI,
        FEC_DIGI,
        COD_CLIE,
        COD_TIEN
      )

        SELECT
          NUM_FACTU,
          COD_PROD,
          UNI_SOLI,
          VAL_PROD,
          IMP_PROD,
          IGV_PROD,
          IMP_TOTA_PROD,
          x_usu,
          now(),
          (SELECT COD_CLIE
           FROM fac_factu
           WHERE COD_FACT = NUM_FACTU) COD_CLIE,
          (SELECT COD_TIEN
           FROM fac_factu
           WHERE COD_FACT = NUM_FACTU) COD_TIEN
        FROM fac_detal_guia_remis Y
        WHERE COD_GUIA = X_COD_GUIA;

                  
            UPDATE folio
      SET VAL_ACTU = NUM_FACTU + 1
      WHERE VAL_LLAVE = 2;

      UPDATE fac_guia_remis
      SET IND_ESTA = '1',
        usu_modi   = x_usu,
        fec_modi   = now()
      WHERE COD_GUIA = X_COD_GUIA;

      UPDATE fac_orden_compr
      SET IND_ESTA = '2',
        usu_modi   = x_usu,
        fec_modi   = now()
      WHERE COD_ORDE = CORDER;

      COMMIT;

      SET autocommit = 1;

    END IF;


  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PED_MIGRA_OC_TO_GUIA`
--

DROP PROCEDURE IF EXISTS `PED_MIGRA_OC_TO_GUIA`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PED_MIGRA_OC_TO_GUIA`(IN X_COD_ORDE VARCHAR(12),in x_usu varchar(12), OUT ind_detalle_oc int)
proc_label:BEGIN







    DECLARE NUM_GUIA INT;



    DECLARE CORDEN INT;



    DECLARE DIR_PARTIDA VARCHAR(100);

    declare detalleoc INT;





    declare igv decimal(10,2);



    declare igvCalcu decimal(10,2);







    select count(1) into detalleoc

    from fac_detal_orden_compr

    where cod_orde = X_COD_ORDE;

    set ind_detalle_oc=1;

    if detalleoc = 0 then

      set ind_detalle_oc=0;

      LEAVE proc_label;

    end if;









    select COD_GUIA into NUM_GUIA



    from fac_guia_remis



    where COD_ORDE = X_COD_ORDE and IND_ESTA <> '9';







    select COD_ORDE into CORDEN



    FROM fac_orden_compr



    WHERE COD_ORDE=X_COD_ORDE;







    if NUM_GUIA is null  AND CORDEN IS NOT NULL then







      SELECT cast(VAL_PARA as decimal(10,2)) INTO igv



      FROM bas_param



      WHERE COD_PARA='01';







      SELECT VAL_PARA INTO DIR_PARTIDA



      FROM bas_param



      WHERE COD_PARA='O2';







      IF igv is null THEN



        SET igv=18 ;



      END IF;



      set igvCalcu = (1+ igv/100);



      set autocommit =0 ;

            
            SELECT VAL_ACTU into num_guia from folio WHERE VAL_LLAVE = 1 FOR UPDATE ;





      INSERT fac_guia_remis (

        COD_GUIA ,

        COD_ORDE ,

        COD_TIEN ,

        COD_CLIE ,

        FEC_EMIS ,

        DIR_PART ,

        FEC_TRAS ,

        IND_ESTA ,

        USU_DIGI ,

        FEC_DIGI )

        SELECT NUM_GUIA,

          X_COD_ORDE,

          COD_TIEN,

          COD_CLIE,

          DATE(NOW()),

          DIR_PARTIDA,

          FEC_ENVI,

          '0',

          x_usu,

          now()

        FROM fac_orden_compr

        WHERE COD_ORDE=X_COD_ORDE;











      INSERT fac_detal_guia_remis (

        COD_GUIA,

        COD_PROD,

        PES_PROD,

        UNI_SOLI,

        VAL_PROD,

        IMP_PROD,

        IGV_PROD,

        IMP_TOTA_PROD ,

        USU_DIGI ,

        FEC_DIGI )

        SELECT NUM_GUIA,

          COD_PROD,

          (select VAL_PESO from mae_produ X WHERE X.COD_PROD = Y.COD_PROD) VAL_PESO,

          NRO_UNID,

          VAL_PREC,

          VAL_MONT_UNID,

          VAL_MONT_IGV,

          VAL_MONT_UNID + VAL_MONT_IGV,

          x_usu,

          now()

        FROM fac_detal_orden_compr Y

        WHERE COD_ORDE=X_COD_ORDE;




                  
            UPDATE folio
      SET VAL_ACTU = NUM_GUIA + 1
      where VAL_LLAVE = 1;












      update fac_orden_compr



      set IND_ESTA ='1',



        usu_modi = x_usu,



        fec_modi= now()



      where COD_ORDE=X_COD_ORDE;



      commit;

      set autocommit =1 ;

    end if;



  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
