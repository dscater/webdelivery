-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-05-2023 a las 15:33:14
-- Versión del servidor: 8.0.30
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webdelivery_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cel` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `dir`, `email`, `fono`, `cel`, `user_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'JUAN', 'QUISPE', '', '555', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', 'JUAN@GMAIL.COM', '21314568', '78945612', 8, '2021-07-19', '2021-07-19 16:02:29', '2021-07-19 16:02:29'),
(2, 'CARLOS', 'MARTINES', '', '666', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', 'CARLOS@GMAIL.COM', '21314568', '78945612', 9, '2021-07-19', '2021-07-19 16:06:08', '2021-07-19 16:06:08'),
(3, 'CLEMENTE', 'GONZALES', '', '999', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', 'CLEMENTE@GMAIL.COM', '21314568', '78945612', 10, '2021-07-19', '2021-07-19 16:07:04', '2021-07-19 16:07:04'),
(4, 'JOSE', 'MARTINEZ', '', '6666', 'LP', 'LOS OLIVOS', 'JOSE@GMAIL.COM', '222222', '7777777', 11, '2023-05-13', '2023-05-13 14:28:28', '2023-05-13 14:28:28'),
(5, 'MARCELO', 'PORTUGUES', 'SOLIZ', '7777', 'LP', 'LOS OLIVOS', 'MARCELO@GMAIL.COM', '22222', '77777777', 12, '2023-05-13', '2023-05-13 14:51:11', '2023-05-13 14:51:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono_referencia` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_id` bigint UNSIGNED DEFAULT NULL,
  `distribuidor_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `dir`, `email`, `fono`, `cel`, `fono_referencia`, `empresa_id`, `distribuidor_id`, `user_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'JUAN', 'PERES', '', '111', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', '', '21314568', '78945612', '6666666', NULL, NULL, 2, '2021-07-19', '2021-07-19 16:00:38', '2021-07-19 16:00:38'),
(2, 'FERNANDO', 'CHOQUE', '', '222', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', '', '21314568', '78945612', '6666666', 1, NULL, 3, '2021-07-19', '2021-07-19 16:00:54', '2021-07-19 16:00:54'),
(3, 'MARIA', 'QUISPE', '', '333', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', '', '21314568', '78945612', '6666666', NULL, 1, 4, '2021-07-19', '2021-07-19 16:01:11', '2021-07-19 16:01:11'),
(4, 'ALBERTO', 'MACHACA', '', '123', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', '', '21314568', '78945612', '6666666', 2, NULL, 5, '2021-07-19', '2021-07-19 16:01:31', '2021-07-19 16:01:31'),
(5, 'MARIO', 'CHURQUI', '', '1234', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', '', '21314567', '78945612', '6666666', 4, NULL, 6, '2021-07-19', '2021-07-19 16:01:51', '2021-07-19 16:01:51'),
(6, 'FERNANDO', 'CONDORI', '', '12345', 'LP', 'ZONA LOS OLIVOS CALLE 3 #333', '', '21314568', '78945612', '6666666', NULL, 2, 7, '2021-07-19', '2021-07-19 16:02:08', '2021-07-19 16:02:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidors`
--

CREATE TABLE `distribuidors` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `distribuidors`
--

INSERT INTO `distribuidors` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'DISTRIBUIDOR 1', '', '2021-07-13 15:06:14', '2021-07-13 15:06:14'),
(2, 'DISTRIBUIDOR 2', '', '2021-07-13 15:06:18', '2021-07-13 15:06:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'EMPRESA 1', '', '2021-07-13 14:36:21', '2021-07-13 14:36:26'),
(2, 'EMPRESA 2', '', '2021-07-13 14:36:30', '2021-07-13 14:36:30'),
(4, 'EMPRESA 3', '', '2021-07-13 14:40:20', '2021-07-13 14:40:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `id` bigint UNSIGNED NOT NULL,
  `cliente_id` bigint UNSIGNED NOT NULL,
  `orden_id` bigint UNSIGNED NOT NULL,
  `qr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_entrega` date NOT NULL,
  `hora_entrega` time NOT NULL,
  `fecha_hora_entrega` datetime NOT NULL,
  `estado` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id`, `cliente_id`, `orden_id`, `qr`, `fecha_entrega`, `hora_entrega`, `fecha_hora_entrega`, `estado`, `fecha_registro`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'GONZALES1626711539.png', '2021-07-19', '12:18:00', '2021-07-19 12:18:00', 'ENTREGADO', '2021-07-19', 1, '2021-07-19 16:18:59', '2021-07-19 16:19:56'),
(2, 3, 2, 'GONZALES1683572364.png', '2023-05-08', '14:59:00', '2023-05-08 14:59:00', 'PENDIENTE', '2023-05-08', 1, '2023-05-08 18:59:24', '2023-05-08 18:59:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2020_11_11_164550_create_razon_socials_table', 1),
(13, '2020_11_11_164632_create_datos_usuarios_table', 1),
(14, '2021_07_09_104317_create_empresas_table', 1),
(15, '2021_07_09_104318_create_productos_table', 1),
(16, '2021_07_09_104337_create_distribuidors_table', 1),
(17, '2021_07_09_104338_create_clientes_table', 1),
(18, '2021_07_09_104339_create_ordens_table', 1),
(19, '2021_07_09_104626_create_entregas_table', 1),
(20, '2021_07_09_104707_create_pagos_table', 1),
(21, '2020_11_11_164631_create_empresas_table', 2),
(22, '2020_11_11_164630_create_distribuidors_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordens`
--

CREATE TABLE `ordens` (
  `id` bigint UNSIGNED NOT NULL,
  `nro_orden` bigint NOT NULL,
  `empresa_id` bigint UNSIGNED NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `cantidad` double(8,2) NOT NULL,
  `cliente_id` bigint UNSIGNED NOT NULL,
  `distribuidor_id` bigint UNSIGNED NOT NULL,
  `fecha_pedido` date NOT NULL,
  `hora_pedido` time NOT NULL,
  `fecha_hora_pedido` datetime NOT NULL,
  `fecha_entrega` date NOT NULL,
  `hora_entrega` time NOT NULL,
  `fecha_hora_entrega` datetime NOT NULL,
  `estado` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ordens`
--

INSERT INTO `ordens` (`id`, `nro_orden`, `empresa_id`, `producto_id`, `cantidad`, `cliente_id`, `distribuidor_id`, `fecha_pedido`, `hora_pedido`, `fecha_hora_pedido`, `fecha_entrega`, `hora_entrega`, `fecha_hora_entrega`, `estado`, `fecha_registro`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 5.00, 3, 7, '2021-07-19', '12:17:00', '2021-07-19 12:17:00', '2021-07-19', '12:17:00', '2021-07-19 12:17:00', 'ENTREGADO', '2021-07-19', 1, '2021-07-19 16:17:39', '2021-07-19 16:19:56'),
(2, 2, 1, 1, 5.00, 3, 4, '2023-05-08', '14:47:00', '2023-05-08 14:47:00', '2023-05-08', '15:30:00', '2023-05-08 15:30:00', 'ENVIO PENDIENTE', '2023-05-08', 1, '2023-05-08 18:48:19', '2023-05-08 18:59:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` bigint UNSIGNED NOT NULL,
  `entrega_id` bigint UNSIGNED NOT NULL,
  `metodo_pago` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_pago` date NOT NULL,
  `hora_pago` time NOT NULL,
  `fecha_hora_pago` datetime NOT NULL,
  `total_pago` decimal(24,2) NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `entrega_id`, `metodo_pago`, `fecha_pago`, `hora_pago`, `fecha_hora_pago`, `total_pago`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, 'EFECTIVO', '2021-07-19', '12:19:00', '2021-07-19 12:19:00', 75.00, '2021-07-19', '2021-07-19 16:19:52', '2021-07-19 16:19:52'),
(2, 2, 'EFECTIVO', '2023-05-08', '15:02:00', '2023-05-08 15:02:00', 75.00, '2023-05-08', '2023-05-08 19:02:30', '2023-05-08 19:02:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint UNSIGNED NOT NULL,
  `empresa_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(24,2) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `empresa_id`, `nombre`, `descripcion`, `precio`, `foto`, `fecha_registro`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'PRODUCTO 1', 'DESCRIPCION PRODUCTO', 15.00, NULL, '2021-07-13', 1, '2021-07-13 14:42:58', '2021-07-14 20:21:33'),
(2, 1, 'PRODUCTO 2', 'DESCRIPCION PRODUCTO', 20.00, NULL, '2021-07-13', 1, '2021-07-13 15:21:22', '2021-07-13 15:21:22'),
(3, 2, 'PRODUCTO EMPRESA 2', 'DESCRIPCION PRODUCTO', 15.00, NULL, '2021-07-13', 1, '2021-07-13 15:21:35', '2021-07-13 15:21:35'),
(4, 4, 'PRODUCTO EMPRESA 3', 'DESCRIPCION PRODUCTO', 17.50, NULL, '2021-07-13', 1, '2021-07-13 15:21:46', '2021-07-13 15:21:46'),
(5, 1, 'PRODUCTO 3', 'DESCRIPCION PRODUCTO', 25.00, NULL, '2021-07-13', 1, '2021-07-13 19:59:40', '2021-07-13 19:59:40'),
(6, 2, 'PROD EMP 2', 'DESC. PRODUCTO', 15.60, NULL, '2021-07-14', 1, '2021-07-14 21:18:41', '2021-07-14 21:18:55'),
(7, 1, 'PRODUCTO 4', 'PRODUCTO CON FOTOGRAFÍA', 90.00, '16839917157.png', '2023-05-13', 1, '2023-05-13 15:28:35', '2023-05-13 15:28:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razon_socials`
--

CREATE TABLE `razon_socials` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_aut` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `casilla` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actividad_economica` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `razon_socials`
--

INSERT INTO `razon_socials` (`id`, `nombre`, `alias`, `ciudad`, `dir`, `nit`, `nro_aut`, `fono`, `cel`, `casilla`, `correo`, `web`, `logo`, `actividad_economica`, `created_at`, `updated_at`) VALUES
(1, 'EMPRESA PRUEBA', 'EP', 'LA PAZ', 'ZONA LOS OLIVOS CALLE 3 #3232', '111111111', '2212222222', '21134568', '78945612', 'CASILLA', 'EMPRESAPRUEBA@GMAIL.COM', 'WEB', 'logo1626738162.jpg', 'ACTIVIDAD ECONOMICA', '2021-07-09 15:01:31', '2021-07-19 23:42:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('ADMINISTRADOR','EMPRESA','DISTRIBUIDOR','CLIENTE') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_usuario` bigint NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `tipo`, `foto`, `nro_usuario`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$8gPtNQeeRWRrM7aBbXoNhelmWKRngzkTOT7j1GKoVarmibPGCVrD.', 'ADMINISTRADOR', 'user_default.png', 0, 1, '2021-07-09 15:01:31', '2021-07-09 15:01:31'),
(2, '1001JP', '$2y$10$g0jCtwRFzUrcqxaMAaiSmehIzToJp62DJYr4gh.eTYf00DBPNLP3C', 'ADMINISTRADOR', 'JUAN1626710438.jpg', 1001, 1, '2021-07-19 16:00:38', '2021-07-19 16:00:38'),
(3, '2001FC', '$2y$10$JzHF2lLWwZewtnjx7u.RO.6/gQXc78.GpSPsg.PKveZH.3rWjl.u2', 'EMPRESA', 'FERNANDO1626710454.jpg', 2001, 1, '2021-07-19 16:00:54', '2021-07-19 16:00:54'),
(4, '3001MQ', '$2y$10$wLf5aj/0HjsHOPCvzTobr.DmLcfHzXODTkwBcfXH15eRk5f1KlPey', 'DISTRIBUIDOR', 'MARIA1626710471.jpg', 3001, 1, '2021-07-19 16:01:11', '2021-07-19 16:01:11'),
(5, '2002AM', '$2y$10$4dLJrjrvpUIZkTawjLcXd.SDQo.ePOAehQLQpWc6UwhCBfeGdnuzi', 'EMPRESA', 'ALBERTO1626710491.jpg', 2002, 1, '2021-07-19 16:01:31', '2023-05-13 15:15:25'),
(6, '2003MC', '$2y$10$khj8tNq40otR5DNTbf.R4.ganf1IGPuL3ef.mmldx8GQzyPfoBNgC', 'EMPRESA', 'MARIO1626710511.jpg', 2003, 1, '2021-07-19 16:01:51', '2021-07-19 16:01:51'),
(7, '3002FC', '$2y$10$3AbQZxMrShB7.wvr0FnzPeWsV7iGIHGksjM3FpVs4nbS6WHszZHTS', 'DISTRIBUIDOR', 'FERNANDO1626710528.jpg', 3002, 1, '2021-07-19 16:02:08', '2021-07-19 16:02:08'),
(8, '4001JQ', '$2y$10$vZzucnACgQS95aIijW4sweW94s5Tpfft9r42KxsEYR/yLs4lfsgZS', 'CLIENTE', 'user_default.png', 4001, 1, '2021-07-19 16:02:29', '2021-07-19 16:02:29'),
(9, '4002CM', '$2y$10$vV6ehgTUQRjC5rMI0zXPp.3ZHFdEHz/nsJZWFPXtxeFE53MpxQOrq', 'CLIENTE', 'user_default.png', 4002, 1, '2021-07-19 16:06:08', '2023-05-13 15:11:31'),
(10, '4003CG', '$2y$10$WHlSO/CjTs8YY95qI6NR1.FXC4TE8dgqHGkMwOa4OssybOAQMuFhC', 'CLIENTE', 'user_default.png', 4003, 1, '2021-07-19 16:07:04', '2021-07-19 16:07:04'),
(11, 'jose@gmail.com', '$2y$10$8YzSMneGzf2D4T6JXSDYCuWP6lW8Mpca4eS68wtUPLoi/8xZAF.ay', 'CLIENTE', 'user_default.png', 0, 1, '2023-05-13 14:28:28', '2023-05-13 14:28:28'),
(12, 'marcelo@gmail.com', '$2y$10$cB2xsJrk3nnEKBbiR2JYiuwo/2.K/SqRmJjaXoMMDVWSf4Ni21tCu', 'CLIENTE', 'user_default.png', 0, 1, '2023-05-13 14:51:11', '2023-05-13 14:51:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_usuarios_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `distribuidors`
--
ALTER TABLE `distribuidors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entregas_cliente_id_foreign` (`cliente_id`),
  ADD KEY `entregas_orden_id_foreign` (`orden_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordens`
--
ALTER TABLE `ordens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordens_empresa_id_foreign` (`empresa_id`),
  ADD KEY `ordens_producto_id_foreign` (`producto_id`),
  ADD KEY `ordens_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_entrega_id_foreign` (`entrega_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `distribuidors`
--
ALTER TABLE `distribuidors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `ordens`
--
ALTER TABLE `ordens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD CONSTRAINT `datos_usuarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `entregas_orden_id_foreign` FOREIGN KEY (`orden_id`) REFERENCES `ordens` (`id`);

--
-- Filtros para la tabla `ordens`
--
ALTER TABLE `ordens`
  ADD CONSTRAINT `ordens_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ordens_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_entrega_id_foreign` FOREIGN KEY (`entrega_id`) REFERENCES `entregas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
