-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 04:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solegood`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `session_id`, `user_id`) VALUES
(9, 'jv37r65tq9khob47e0m8r7pd2v', 3),
(15, 'fqg27qco6ridrfficc055h1i8f', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `size_id`, `quantity`) VALUES
(85, 9, 71, 2),
(96, 15, 86, 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `product_id`, `image_url`) VALUES
(1, 1, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/0c947911-ed90-49c6-a1fd-f6de3798114f/NIKE+LEGEND+ESSENTIAL+2.png'),
(2, 1, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/1693eda6-6808-4d66-a855-94e83fe8ff64/NIKE+LEGEND+ESSENTIAL+2.png'),
(3, 1, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/2482c899-aa71-42e5-8861-7604fdcd0b60/NIKE+LEGEND+ESSENTIAL+2.png'),
(4, 1, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/fd2c284c-613a-4e3a-b4b9-a74005f59511/NIKE+LEGEND+ESSENTIAL+2.png'),
(5, 2, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/7db556e8-e9e8-4a30-a577-099be6e215e5/AIR+FORCE+1+%2707+LV8.png'),
(6, 2, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/ff3c2df3-476d-4054-bbea-0ab07db6c771/AIR+FORCE+1+%2707+LV8.png'),
(7, 2, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/a7d721f4-f65f-418f-bd27-865b96c4c4f7/AIR+FORCE+1+%2707+LV8.png'),
(8, 2, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/6251aea6-6c0d-4cc3-bfe3-319c886e54e6/AIR+FORCE+1+%2707+LV8.png'),
(9, 3, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/de7f0b98-d4ba-44ee-9373-6b9d086b4843/AIR+ZM+PEGASUS+41+GTX.png'),
(10, 3, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/da3d88f3-c9d2-41f8-a0e2-b887c7833f30/AIR+ZM+PEGASUS+41+GTX.png'),
(11, 3, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/71bc4d61-e0ea-4d4a-a955-a24b0457d757/AIR+ZM+PEGASUS+41+GTX.png'),
(12, 3, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/5a9b4ba7-823d-437f-a0af-bbb2ef7664a9/AIR+ZM+PEGASUS+41+GTX.png'),
(13, 4, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/a0f44d90-7581-4ada-b7e7-44c57cc3f0d8/NIKE+RUN+SWIFT+3.png'),
(14, 4, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/c5036d4d-2773-4236-86d4-d96a3deead84/NIKE+RUN+SWIFT+3.png'),
(15, 4, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/bb19616e-aed1-4720-8778-3ef2bbb13836/NIKE+RUN+SWIFT+3.png'),
(16, 4, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/be3dddc9-e6e4-43c6-abfb-af172c49b95e/NIKE+RUN+SWIFT+3.png'),
(17, 5, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/a5b8115e-03ff-4319-af5e-26ad829598c1/JORDAN+POST+SLIDE.png'),
(18, 5, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3b1236be-5e8a-409b-bbf5-49f4c8c23a2d/JORDAN+POST+SLIDE.png'),
(19, 5, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3038d2f9-fb85-49dc-9271-fe94d93deaae/JORDAN+POST+SLIDE.png'),
(20, 5, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/80cdfe40-4ed8-403b-beeb-447796d44715/JORDAN+POST+SLIDE.png'),
(21, 6, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/482d00c9-54c9-477c-a568-af731014e6a4/AIR+MORE+UPTEMPO+SLIDE.png'),
(22, 6, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/46416e01-fe20-4701-a4a1-0442f720d7c3/AIR+MORE+UPTEMPO+SLIDE.png'),
(23, 6, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/b3ae099f-6f33-4f53-a765-ad09acbbb361/AIR+MORE+UPTEMPO+SLIDE.png'),
(24, 6, 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/4f6ba847-871d-4f2c-9432-76d576220f05/AIR+MORE+UPTEMPO+SLIDE.png'),
(25, 7, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/672c5f9f-224e-4a26-bd9d-8ea6b8e45c95/NIKE+FLEX+PLUS+2+%28GS%29.png'),
(26, 7, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/9b175e0d-c12b-43e5-adaf-6ee0b8c16914/NIKE+FLEX+PLUS+2+%28GS%29.png'),
(27, 7, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/7e556783-342f-42b4-bfe3-dd56605ae2a1/NIKE+FLEX+PLUS+2+%28GS%29.png'),
(28, 7, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/acef041e-5b60-4655-b301-bc8ae0f127f4/NIKE+FLEX+PLUS+2+%28GS%29.png'),
(29, 8, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/855743e7-1dfe-403b-a8bd-a1dc904fe712/NIKE+STAR+RUNNER+4+NN+%28GS%29.png'),
(30, 8, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/ae51ce99-786f-4a83-8a66-ba640557794e/NIKE+STAR+RUNNER+4+NN+%28GS%29.png'),
(31, 8, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/da86289d-7f1d-4cd3-9b3c-39de2efd6548/NIKE+STAR+RUNNER+4+NN+%28GS%29.png'),
(32, 8, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/9c004a28-aeee-431f-b4d5-7c734a3bdf78/NIKE+STAR+RUNNER+4+NN+%28GS%29.png'),
(33, 9, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/06c16e6e-3da4-42b7-bccd-7b6b64bc5649/JORDAN+POST+SLIDE+%28GS%29.png'),
(34, 9, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/2e38a3a0-0941-48a3-a4b3-26967f3959e9/JORDAN+POST+SLIDE+%28GS%29.png'),
(35, 9, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/7210cd9c-8e66-46c4-ac64-6d3167411fc9/JORDAN+POST+SLIDE+%28GS%29.png'),
(36, 9, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/8f3a2bce-3a11-46a6-80d9-d3037ff0910c/JORDAN+POST+SLIDE+%28GS%29.png'),
(37, 10, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/2763f228-7b6b-418e-ac11-4ec0392e789d/JORDAN+JUMPMAN+SLIDE+%28GS%29.png'),
(38, 10, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/83cf8e03-6f2a-47b0-a16a-e6f4973ee6e4/JORDAN+JUMPMAN+SLIDE+%28GS%29.png'),
(39, 10, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/2b23696c-58c5-40b7-ba65-635d20c8fdb1/JORDAN+JUMPMAN+SLIDE+%28GS%29.png'),
(40, 10, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/45df4da4-dd9f-4e3a-901a-b5ad4551fda5/JORDAN+JUMPMAN+SLIDE+%28GS%29.png'),
(41, 11, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/d03f0b1e-eeb0-4af1-a5e1-2fcef69c8049/FORCE+1+LOW+EASYON+LV8+1+%28PS%29.png'),
(42, 11, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c5da007d-cab9-4eeb-8cdb-452a43df59ef/FORCE+1+LOW+EASYON+LV8+1+%28PS%29.png'),
(43, 11, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/6676d5da-5f8f-4b9c-bcbb-a6ca20cda368/FORCE+1+LOW+EASYON+LV8+1+%28PS%29.png'),
(44, 11, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/5d6e9f0a-b0f8-41c5-9c74-5dbfaa55d2e0/FORCE+1+LOW+EASYON+LV8+1+%28PS%29.png'),
(45, 12, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/aa9f1ebd-0135-4660-b507-93167a05e8c1/NIKE+DUNK+LOW+%28GS%29.png'),
(46, 12, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/b17597bf-5679-445f-b1e0-177400082939/NIKE+DUNK+LOW+%28GS%29.png'),
(47, 12, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/8e3367ed-69cf-49f9-8715-1aaefaef07cf/NIKE+DUNK+LOW+%28GS%29.png'),
(48, 12, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c807e5e9-e725-465f-a3d4-8740623f1446/NIKE+DUNK+LOW+%28GS%29.png'),
(49, 13, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/5ca19746-d188-4c41-b27d-c9e1251b4348/W+AIR+ZOOM+PEGASUS+41+PRM.png'),
(50, 13, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/e861147a-e929-4e31-bc07-1dd2b20dd80b/W+AIR+ZOOM+PEGASUS+41+PRM.png'),
(51, 13, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/5d221775-d393-48a4-90a8-08422368494d/W+AIR+ZOOM+PEGASUS+41+PRM.png'),
(52, 13, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/48878208-9a81-41f8-9b4d-0a6aefc13bda/W+AIR+ZOOM+PEGASUS+41+PRM.png'),
(53, 14, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/284609b3-6330-4420-89d3-f84d2f8f5b63/W+NIKE+INTERACT+RUN.png'),
(54, 14, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c6b30418-63f3-4552-9bb1-dc886cbced7f/W+NIKE+INTERACT+RUN.png'),
(55, 14, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/2c63f91b-c977-4fe4-88df-00f563fd6f74/W+NIKE+INTERACT+RUN.png'),
(56, 14, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/4e44a697-ee9a-418d-a9b7-307655a87a70/W+NIKE+INTERACT+RUN.png'),
(57, 15, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/2d795820-6ae9-406f-9668-aaa8464d640b/W+NIKE+CALM+SLIDE.png'),
(58, 15, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/dacd3529-b17b-441c-a199-83140fefae34/W+NIKE+CALM+SLIDE.png'),
(59, 15, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/48eca49e-d739-44a5-8f8c-fcf01ec117b4/W+NIKE+CALM+SLIDE.png'),
(60, 15, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/6711ecc9-5400-4cce-b138-5ec1ca9b504d/W+NIKE+CALM+SLIDE.png'),
(61, 16, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/770ad226-1b1d-474c-b1ca-9afff63f5567/WMNS+JORDAN+SOPHIA+SLIDE+SS.png'),
(62, 16, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/c67da43f-d3a3-49b7-8cfa-fb770e6b40ef/WMNS+JORDAN+SOPHIA+SLIDE+SS.png'),
(63, 16, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1c56c5fd-9f42-4891-89b5-32d68faff940/WMNS+JORDAN+SOPHIA+SLIDE+SS.png'),
(64, 16, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/57bf127c-d15a-49de-8bd2-4dddb263f2e2/WMNS+JORDAN+SOPHIA+SLIDE+SS.png'),
(65, 17, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/a5b4fbc1-38ef-4bef-8284-79cdc800c535/W+NIKE+TC+7900+PRM.png'),
(66, 17, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/d5e868aa-773a-41bb-b15f-2d5b72e70171/W+NIKE+TC+7900+PRM.png'),
(67, 17, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/a1f62477-2bbb-4645-bbbf-9d31c2de737b/W+NIKE+TC+7900+PRM.png'),
(68, 17, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/20e392c3-e26a-4607-9d6d-4aafc38bec90/W+NIKE+TC+7900+PRM.png'),
(69, 18, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/94711ac2-b2b9-4432-908a-4d5b8d9bf564/WMNS+NIKE+GAMMA+FORCE.png'),
(70, 18, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/852358d4-3329-44b2-af07-2f8132d7f51b/WMNS+NIKE+GAMMA+FORCE.png'),
(71, 18, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/ccd1a564-08d3-4058-af13-71c04669d4d9/WMNS+NIKE+GAMMA+FORCE.png'),
(72, 18, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/ab2e4ce8-eca2-4f2d-9e29-564dbcd0db4d/WMNS+NIKE+GAMMA+FORCE.png'),
(73, 19, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/49f0723a-abfe-4e31-b5a5-26c09ee0afe9/NIKE+ZOOMX+VAPORFLY+NEXT%25+3.png'),
(74, 19, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/2ab87548-2105-48f6-9ad3-e26a5b015e85/NIKE+ZOOMX+VAPORFLY+NEXT%25+3.png'),
(75, 19, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/b2564f9f-4e6d-4f0a-a021-df81fd905fb1/NIKE+ZOOMX+VAPORFLY+NEXT%25+3.png'),
(76, 19, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/f37c35b0-cd81-4113-a302-ab539cf82115/NIKE+ZOOMX+VAPORFLY+NEXT%25+3.png'),
(77, 20, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/20544254-305c-4ec6-8347-da1259be4bc6/NIKE+FREE+METCON+5.png'),
(78, 20, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/f9efd2d0-6c72-4666-869c-81e85ff2182c/NIKE+FREE+METCON+5.png'),
(79, 20, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/99706541-6f4e-435d-bb89-4dae2ca2ffb0/NIKE+FREE+METCON+5.png'),
(80, 20, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/31705639-f347-4634-b4b5-2ef272352861/NIKE+FREE+METCON+5.png'),
(81, 21, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/f535ed7c-6ccc-4dd5-8e78-07495b4892b1/W+NIKE+ZOOMX+ZEGAMA+TRAIL+2.png'),
(82, 21, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/136905cb-f040-4e33-a9d4-65d0c2b30fda/W+NIKE+ZOOMX+ZEGAMA+TRAIL+2.png'),
(83, 21, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/2c87439d-eda8-41c8-b4e6-7b502134edcd/W+NIKE+ZOOMX+ZEGAMA+TRAIL+2.png'),
(84, 21, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/54642879-2caf-485b-999d-37faf4c98e18/W+NIKE+ZOOMX+ZEGAMA+TRAIL+2.png'),
(85, 22, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/3baa2ee5-45c3-41cd-853f-6265f5fb01f8/W+AIR+MAX+97+FUTURA.png'),
(86, 22, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c099b5e1-cdd2-4dfa-ae0e-3292b7e7006f/W+AIR+MAX+97+FUTURA.png'),
(87, 22, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/ec575ec7-4847-49a3-8104-fcfa668a9bb8/W+AIR+MAX+97+FUTURA.png'),
(88, 22, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/9ddad2c6-c011-4a25-8157-edc7269b19a1/W+AIR+MAX+97+FUTURA.png'),
(89, 23, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/d80566eb-63ab-49d4-89b2-530a93b52075/NIKE+REVOLUTION+7+%28GS%29.png'),
(90, 23, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/64a8a41d-f592-4cb8-b9e4-7569b5f42c5a/NIKE+REVOLUTION+7+%28GS%29.png'),
(91, 23, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/75ed43cb-5320-4585-9d4b-29b70bb72cdc/NIKE+REVOLUTION+7+%28GS%29.png'),
(92, 23, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/7bfd7e5d-67ef-4133-a291-eeac89f6851c/NIKE+REVOLUTION+7+%28GS%29.png'),
(93, 24, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/e46ec572-fdef-42d6-812f-85b208ffd65a/NIKE+AIR+MAX+EXCEE+GS.png'),
(94, 24, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/cf037353-1065-4db1-8fea-d7dea0cff91f/NIKE+AIR+MAX+EXCEE+GS.png'),
(95, 24, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/3f3f6e22-581b-439f-9a3a-4f7c0582799b/NIKE+AIR+MAX+EXCEE+GS.png'),
(96, 24, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/34a051f6-fc30-4d84-b4ec-37b3da1dcae8/NIKE+AIR+MAX+EXCEE+GS.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_total`, `shipping_address`, `first_name`, `last_name`, `phone_number`, `postal_code`, `order_status`, `created_at`) VALUES
(1, 2, 1216.00, 'Blk 221 Hougang Ave 4', 'Hello', 'World', '+6598989', 123456, 'preparing', '2024-11-06 03:44:33'),
(2, 2, 304.00, 'Blk 221 Hougang Ave 4', 'Name', 'Teo', '999', 123456, 'preparing', '2024-11-06 03:44:33'),
(3, 3, 1349.00, 'Blk 301 Hougang 4243234', 'Jeremy', 'Lee', '+9873839', 345678, 'preparing', '2024-11-10 05:48:54'),
(4, 2, 75.00, 'Blk 221 Hougang Ave 4', 'Update', 'Update', '+65111111', 347271, 'preparing', '2024-11-06 03:50:18'),
(5, 2, 85.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Yeo', '+65111111', 347271, 'preparing', '2024-11-06 03:57:02'),
(6, 2, 85.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Yeo', '+650000', 123343, 'preparing', '2024-11-06 04:01:15'),
(7, 2, 85.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Yeo', '+60000', 347271, 'preparing', '2024-11-06 04:01:51'),
(8, 2, 99.00, 'Blk 221 Hougang Ave 4', 'Update', 'Update', '+65111111', 347271, 'preparing', '2024-11-06 04:03:01'),
(9, 2, 85.00, 'Blk 221 Hougang Ave 4', 'Update', 'Update', '+65111111', 347271, 'preparing', '2024-11-06 04:04:21'),
(10, 2, 85.00, 'Blk 221 Hougang Ave 4', 'Update', 'Update', '+65111111', 323423, 'preparing', '2024-11-06 04:04:41'),
(12, 2, 158.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Lance', '+65111111', 347271, 'preparing', '2024-11-09 09:57:01'),
(13, 2, 99.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Lance', '+65111111', 347271, 'preparing', '2024-11-09 13:39:43'),
(14, 2, 229.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Lance', '+65111111', 347271, 'preparing', '2024-11-09 13:40:27'),
(15, 2, 154.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Lance', '+65111111', 347271, 'preparing', '2024-11-09 14:05:15'),
(16, 2, 280.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Lance', '+65111111', 347271, 'preparing', '2024-11-09 14:14:58'),
(18, 2, 268.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Lance', '+65111111', 347271, 'preparing', '2024-11-09 14:33:01'),
(19, 2, 393.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Lance', '+65111111', 347271, 'preparing', '2024-11-09 14:38:08'),
(20, 2, 747.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Yeo', '+65111111', 347271, 'preparing', '2024-11-09 14:40:44'),
(21, 2, 443.00, 'Blk 221 Hougang Ave 4', 'Lance', 'Yeo', '+65111111', 347271, 'preparing', '2024-11-09 15:01:40'),
(22, 2, 304.00, 'Blk 221 Hougang Ave 5', 'Lance', 'Yeo', '+6592893193', 123456, 'preparing', '2024-11-09 15:09:40'),
(23, 2, 624.00, 'Blk 221 Hougang Ave 7', 'Lance', 'Yeo', '+6592893193', 123456, 'preparing', '2024-11-09 15:13:21'),
(24, 2, 135.00, 'Blk 221 Hougang Ave 7', 'Lance', 'Lance', '+6592893193', 123456, 'preparing', '2024-11-10 07:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `size_id`, `quantity`, `unit_price`) VALUES
(1, 1, 104, 4, 229.00),
(2, 1, 118, 3, 75.00),
(3, 1, 119, 1, 75.00),
(4, 2, 22, 1, 249.00),
(5, 2, 78, 1, 55.00),
(6, 3, 6, 1, 99.00),
(7, 3, 42, 1, 145.00),
(8, 3, 72, 1, 35.00),
(9, 3, 97, 1, 229.00),
(10, 3, 101, 1, 229.00),
(11, 3, 102, 1, 229.00),
(12, 3, 103, 1, 229.00),
(13, 3, 119, 1, 75.00),
(14, 3, 127, 1, 79.00),
(15, 4, 118, 1, 75.00),
(16, 5, 118, 1, 75.00),
(17, 7, 1, 1, 99.00),
(18, 8, 1, 1, 99.00),
(19, 9, 113, 1, 75.00),
(20, 10, 61, 1, 85.00),
(22, 12, 122, 2, 79.00),
(23, 13, 6, 1, 99.00),
(24, 14, 102, 1, 229.00),
(25, 15, 53, 1, 99.00),
(26, 15, 77, 1, 55.00),
(27, 16, 46, 1, 145.00),
(28, 16, 106, 1, 135.00),
(31, 18, 38, 1, 49.00),
(32, 18, 134, 1, 219.00),
(33, 19, 85, 1, 119.00),
(34, 19, 95, 1, 129.00),
(35, 19, 142, 1, 145.00),
(36, 20, 21, 1, 249.00),
(37, 20, 24, 1, 249.00),
(38, 20, 62, 2, 85.00),
(39, 20, 121, 1, 79.00),
(40, 21, 46, 1, 145.00),
(41, 21, 121, 1, 79.00),
(42, 21, 134, 1, 219.00),
(43, 22, 59, 1, 85.00),
(44, 22, 134, 1, 219.00),
(45, 23, 13, 1, 205.00),
(46, 23, 15, 1, 205.00),
(47, 23, 111, 1, 135.00),
(48, 23, 126, 1, 79.00),
(49, 24, 111, 1, 135.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `details` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `category` enum('Sneakers','Running','Slides') NOT NULL,
  `segment` enum('Men','Women','Kids') NOT NULL,
  `colour` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `details`, `price`, `sale_price`, `category`, `segment`, `colour`, `created_at`) VALUES
(1, 'Nike Legend Essential 2', 'The Nike Legend Essential 2 comes equipped with a flat, stable heel, flexibility under the toes and side-to-side support. With tons of grip, you are ready to lift, HIIT, conquer a class or get stronger on the machines.', 'Country/Region of Origin: Indonesia', 99.00, NULL, 'Sneakers', 'Men', 'Pure Platinum', '2024-11-02 07:01:43'),
(2, 'Nike Air Force 1 07 LV8', 'Comfortable, durable and timeless—it is number 1 for a reason. The classic 80s construction pairs with bold details for style that tracks whether you are on court or on the go.', 'Country/Region of Origin: Indonesia', 205.00, 129.00, 'Sneakers', 'Men', 'Pure Platinum', '2024-11-11 02:58:13'),
(3, 'Nike Pegasus 41 GORE-TEX', 'Responsive cushioning in the winterized Pegasus provides an energised ride for wet-weather road running. Experience lighter-weight energy return with dual Air Zoom units and a ReactX foam midsole. Plus, a waterproof GORE-TEX upper and reflective design details throughout help you comfortably take on the elements.', 'Waterproof GORE-TEX upper and technical mesh help keep water out so your feet dry.|ReactX foam midsole surrounds forefoot and heel Air Zoom units for an energised ride.|Storm Tread outsole provides traction in wet weather.|Heathered material around the collar helps keep your ankle warm.|All-new ReactX foam midsole is 13% more responsive than previous React technology.|Crafted for performance and planet, ReactX foam is engineered to reduce its carbon footprint by at least 43% in a pair of midsoles due to reduced manufacturing process energy compared with prior React foam. The carbon footprint of ReactX is based on cradle-to-gate assessment reviewed by PRé Sustainability B.V. and Intertek China. Other midsole components such as airbags, plates or other foam formulations were not considered.|Reflective design GORE-TEX logo and Swoosh logo|Reflective design graphics and overlays|Not intended for use as personal protective equipment (PPE)|Weight: approx. 297g (mens size 9)|Heel-to-toe drop: 10mm|MR-10 last—our best, most consistent fit (same as Pegasus 40)|Plush collar, tongue and sockliner|Country/Region of Origin: Vietnam', 249.00, NULL, 'Running', 'Men', 'Summit White', '2024-11-11 03:02:58'),
(4, 'Nike Run Swift 3', 'Whatever the run, the Swift 3 will be there with undying support and devotion. It can help you get out the door for an easy 3 at the end of the day or an intense 2-mile there-and-back with a modified design that iss supportive, durable and all-round comfortable. They will help you conquer short distances, sure, but also get you from point A to point B as you navigate the ever-changing rhythms of everyday life.', 'Foam cushioning delivers a soft underfoot feel. A higher foam height gives you a plush sensation with every step.|Flywire cables help secure your feet and provide support when you tighten the laces, so you can stay stable.|Heel overlay for added security|Mesh by the toe for breathability|Flex grooves on rugged rubber outsole for flexibility|Country/Region of Origin: Vietnam', 119.00, NULL, 'Running', 'Men', 'Black', '2024-11-03 11:10:14'),
(5, 'Jordan Post', 'Quick, comfy, cool. These slides are made from robust, flexible foam that will stay secure as you rack up those steps. Wide foot coverage holds your feet in place while the asymmetrical design gives you a distinct look.', 'Foam platform provides lightweight, durable cushioning.|Flexible, textured outsole gives you ample everyday traction.|Country/Region of Origin: Vietnam', 49.00, NULL, 'Slides', 'Men', 'Football Grey', '2024-11-03 11:11:24'),
(6, 'Nike Air More Uptempo', 'Keeping the graffiti-styled graphics from the original, your favourite hoops look gets transformed into slides. The Air More Uptempo combines Nike Air cushioning and a plush strap with airy perforations, providing breathable comfort you can slip on and go.', 'A padded strap with perforations feels plush and airy.|Visible Nike Air technology provides cushioning with every step.|The foam footbed is contoured to help keep your foot in place.|Durable rubber outsole features the grip pattern from the original Uptempo.|Foam midsole|Rubber outsole|Country/Region of Origin: Vietnam', 145.00, 89.00, 'Slides', 'Men', 'Flax', '2024-11-11 02:58:20'),
(7, 'Nike Flex Plus 2', 'The Nike Flex Plus 2 wastes no time so you can get out the door to run and play. We\'re talking break time, PE class and all of your favourite activities. The innovative elastic band system makes getting these shoes on a breeze. They\'re breathable and durable in all the right places. Best of all: Our designers made these super flexible so every move feels like your best and most natural.', 'Heel and tongue pull tabs|Reinforced rubber toe tip|Country/Region of Origin: Indonesia', 99.00, NULL, 'Running', 'Kids', 'Black', '2024-11-02 07:01:53'),
(8, 'Nike Star Runner 4', 'Because ice-cream vans, games of tig and races to the end of the street and back can only wait for so long, we made it easy for you to slip the Star Runner on and get going. Soft cushioning in the midsole provides a comfortable, springy feel so every skip, hop and stride you take is one closer to the finishing line. The tread grabs at pavement, grass and gravel to give you extra grip while a rubber-wrapped toe toughens up the construction so you can go further in the same pair of Star Runners.', 'Classic laces|Country/Region of Origin: Vietnam', 85.00, 55.00, 'Running', 'Kids', 'Blue', '2024-11-11 02:57:54'),
(9, 'Jordan Post Kids', 'Cool comfort, packaged in an asymmetrical design. These secure-fitting slides are made from one piece of foam, bringing sleek versatility to your everyday activities.', 'Country/Region of Origin: Vietnam', 35.00, NULL, 'Slides', 'Kids', 'Industrial Blue', '2024-11-02 07:01:53'),
(10, 'Jordan Jumpman', 'Easy, breezy, classic slides with hoops DNA. A Jumpman logo on the strap makes it clear—they\'re anything but average.', 'Country/Region of Origin: Vietnam', 55.00, 35.00, 'Slides', 'Kids', 'Black', '2024-11-11 02:58:55'),
(11, 'Nike Force 1 Low LV8 EasyOn', 'The look of laces without the struggle of having to tie them? Now, that\'s easy. The laces on these sneakers are just for show—the top lace loop is attached to a hook-and-loop strap so kids can fasten them fast while still enjoying the traditional look of the AF-1.', 'Elastic laces|Perforations on the toe|Country/Region of Origin: India', 129.00, NULL, 'Sneakers', 'Kids', 'White', '2024-11-11 03:02:49'),
(12, 'Nike Dunk Low Kids', 'Designed for basketball but adopted by skaters, the Nike Dunk Low helped define sneaker culture. Now this mid-80s icon is an easy score for your wardrobe. With ankle padding and durable rubber traction, these are a slam dunk whether you\'re learning to skate or getting ready for school.', 'Classic laces|Cupsole construction|Country/Region of Origin: Indonesia', 129.00, 69.00, 'Sneakers', 'Kids', 'White/Navy', '2024-11-11 02:58:26'),
(13, 'Nike Pegasus 41 Premium', 'Responsive cushioning in the Pegasus provides an energised ride for everyday road running. Experience lighter-weight energy return with dual Air Zoom units and a ReactX foam midsole. Plus, improved engineered mesh on the upper decreases weight and increases breathability.', 'Weight: approx. 251g (Women\'s size 5.5)|Heel-to-toe drop: 10mm|MR-10 last—our best, most consistent fit (same as Pegasus 40)|Reflective design details|Not intended for use as personal protective equipment (PPE)|Country/Region of Origin: China', 229.00, 189.00, 'Running', 'Women', 'Ivory', '2024-11-11 02:58:49'),
(14, 'Nike Interact Run', 'Can you see the future? Fast-forward your footsteps in the cutting-edge Nike Interact Run. It\'s set up with all the running goodness you need: a lightweight Flyknit upper, soft foam midsole and comfort where it counts. Scan the QR code on the tongue with your phone, and check out our online introduction to the Nike Interact Run\'s ins and outs.', 'Country/Region of Origin: Indonesia', 135.00, NULL, 'Running', 'Women', 'Pale Blue', '2024-11-11 03:02:44'),
(15, 'Nike Calm', 'Enjoy a calm, comfortable experience—wherever your day off takes you. Made from soft yet responsive foam, these lightweight slides are easy to style and easy to pack. While the water-friendly design makes them ideal for the beach or pool, the minimalist look is elevated enough to wear around the city. Time to slide in and check out.', 'Country/Region of Origin: Indonesia', 79.00, NULL, 'Slides', 'Women', 'Lime', '2024-11-11 03:02:36'),
(16, 'Jordan Sophia', 'What does stepping into luxury feel like? Well, a little like slipping on the Jordan Sophia. Premium leather, embroidered accents, plush foam and comfortable Air cushioning elevate these slides to a whole new level.', 'Country/Region of Origin: China', 139.00, 79.00, 'Slides', 'Women', 'Pale Brown', '2024-11-02 13:14:55'),
(17, 'Nike TC 7900 Premium', 'We\'ve taken the look of early 2000s running and made it durable for everyday wear. Webbing details and rubber accents on the heel add to a rugged look, while an exaggerated midsole and soft foam cushioning help keep you comfortable. By pairing durable materials with soft cushioning, the TC 7900 is ready for your journey.', 'Country/Region of Origin: Vietnam', 219.00, 149.00, 'Sneakers', 'Women', 'Ivory', '2024-11-11 02:58:04'),
(18, 'Nike Gamma Force', 'Layers upon layers of dimensional style—that\'s a force to be reckoned with. Offering both comfort and versatility, these kicks are rooted in heritage basketball culture. Collar materials pay homage to vintage sport while the subtle platform elevates your look, literally. The Gamma Force is forging its own legacy: court style that can be worn all day, wherever you go.', 'Rubber midsole|Rubber outsole|Country/Region of Origin: India', 145.00, NULL, 'Sneakers', 'Women', 'Off-White', '2024-11-02 07:01:59'),
(19, 'Nike Vaporfly 3', 'Catch \'em if you can. Giving you race-day speed to conquer any distance, the Nike Vaporfly 3 is made for the chasers, the racers and the elevated pacers who can\'t turn down the thrill of the pursuit. We reworked the leader of the super shoe pack and tuned the engine underneath to help you chase personal bests from a 10K to marathon. From elite runners to those new to racing, this versatile road-racing workhorse is for those who see speed as a gateway to more miles and more seemingly uncatchable highs.', 'Weight: Approx. 200g (men\'s size 9)|Heel-to-toe drop: 8mm|Wider toe area for a roomier fit|Internal foam pod on the heel for extra cushioning|Country/Region of Origin: China', 319.00, NULL, 'Running', 'Men', 'Black/Oatmeal/Metallic Gold Grain', '2024-11-11 02:53:31'),
(20, 'Nike Free Metcon 5', 'When your workouts wade into the nitty-gritty, the Nike Free Metcon 5 can meet you in the depths, help you dig deep to find that final ounce of force and come out of the other side on a high. It matches style with substance, forefoot flexibility with back-end stability, perfect for flying through a cardio day or enhancing your agility. A revamped upper offers easier entry with a collar made just for your ankle.', 'Not intended for use as personal protective equipment (PPE)|Country/Region of Origin: Vietnam', 205.00, NULL, 'Sneakers', 'Men', 'Smoke Grey', '2024-11-11 02:53:31'),
(21, 'Nike Zegama 2', 'Up the mountain, through the woods, to the top of the trail you can go. Equipped with an ultra-responsive ZoomX foam midsole, the Zegama 2 is designed to conquer steep ridges, jagged rocks and races from trailhead to tip. Optimal cushioning complements a rugged outsole made for your trail running journey.', 'Weight: 264g approx. (Women\'s UK 5.5)|Heel-to-toe drop: 4mm|Reflective design details|Not intended for use as personal protective equipment (PPE)|Country/Region of Origin: China', 269.00, NULL, 'Running', 'Women', 'Daybreak/Cosmic Clay/Sundial/White', '2024-11-11 02:53:31'),
(22, 'Nike Air Max 97 Futura', 'We saw into your future, and it\'s looking … cosy. This version of the AM97 mixes layers of leather, textile and fluffy suede—putting a crafty spin on the classic water-inspired design. Flowing with a Nike Air Max unit, this kind of comfort you have to feel to believe. Our prediction? You\'ve never looked better (or comfier).', 'Not intended for use as Personal Protective Equipment (PPE)|Country/Region of Origin: Vietnam', 279.00, NULL, 'Sneakers', 'Women', 'Glacier Blue/Crimson Tint/Guava Ice/Trace Blue', '2024-11-11 02:53:31'),
(23, 'Nike Revolution 7', 'Flash, dash and blast into every day with the help of these Revolution Running Shoes that are made especially for fun. No, they\'re not loaded with sugar or fireworks, but they do come in awesome colours and designs that\'ll have you reaching for them every day of the year.', 'Classic laces|Country/Region of Origin: Indonesia', 85.00, NULL, 'Running', 'Kids', 'Echo Pink', '2024-11-11 02:53:31'),
(24, 'Nike Air Max Excee', 'When you lace up the Air Max Excee, you\'re walking on Air. Delivering the support and grip you need to fly through the school year, it\'s the shoe you want on your feet when you\'re running to the swings or sitting down for school photograph day. We used a tight knit mesh on the uppers and switched up the Swoosh design to give this season\'s Excee an even cleaner look.', 'Classic laces|Flexible rubber sole|Country/Region of Origin: Vietnam', 125.00, NULL, 'Sneakers', 'Kids', 'Off-White', '2024-11-11 03:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `product_id`, `stock`, `size`) VALUES
(1, 1, 5, 4),
(2, 1, 10, 5),
(3, 1, 10, 6),
(4, 1, 10, 7),
(5, 1, 10, 8),
(6, 1, 9, 9),
(7, 1, 10, 10),
(8, 1, 10, 11),
(9, 2, 10, 4),
(10, 2, 10, 5),
(11, 2, 10, 6),
(12, 2, 10, 7),
(13, 2, 9, 8),
(14, 2, 10, 9),
(15, 2, 9, 10),
(16, 2, 10, 11),
(17, 3, 10, 4),
(18, 3, 10, 5),
(19, 3, 10, 6),
(20, 3, 10, 7),
(21, 3, 9, 8),
(22, 3, 10, 9),
(23, 3, 10, 10),
(24, 3, 9, 11),
(25, 4, 10, 4),
(26, 4, 10, 5),
(27, 4, 10, 6),
(28, 4, 10, 7),
(29, 4, 10, 8),
(30, 4, 9, 9),
(31, 4, 10, 10),
(32, 4, 10, 11),
(33, 5, 10, 4),
(34, 5, 10, 5),
(35, 5, 10, 6),
(36, 5, 10, 7),
(37, 5, 10, 8),
(38, 5, 9, 9),
(39, 5, 9, 10),
(40, 5, 10, 11),
(41, 6, 10, 4),
(42, 6, 10, 5),
(43, 6, 10, 6),
(44, 6, 10, 7),
(45, 6, 10, 8),
(46, 6, 8, 9),
(47, 6, 10, 10),
(48, 6, 10, 11),
(49, 7, 10, 4),
(50, 7, 10, 5),
(51, 7, 10, 6),
(52, 7, 10, 7),
(53, 7, 9, 8),
(54, 7, 10, 9),
(55, 7, 10, 10),
(56, 7, 10, 11),
(57, 8, 10, 4),
(58, 8, 10, 5),
(59, 8, 9, 6),
(60, 8, 10, 7),
(61, 8, 9, 8),
(62, 8, 8, 9),
(63, 8, 10, 10),
(64, 8, 10, 11),
(65, 9, 10, 4),
(66, 9, 10, 5),
(67, 9, 10, 6),
(68, 9, 10, 7),
(69, 9, 10, 8),
(70, 9, 7, 9),
(71, 9, 10, 10),
(72, 9, 10, 11),
(73, 10, 10, 4),
(74, 10, 10, 5),
(75, 10, 10, 6),
(76, 10, 10, 7),
(77, 10, 9, 8),
(78, 10, 10, 9),
(79, 10, 10, 10),
(80, 10, 10, 11),
(81, 11, 10, 4),
(82, 11, 10, 5),
(83, 11, 10, 6),
(84, 11, 10, 7),
(85, 11, 9, 8),
(86, 11, 10, 9),
(87, 11, 10, 10),
(88, 11, 10, 11),
(89, 12, 10, 4),
(90, 12, 10, 5),
(91, 12, 10, 6),
(92, 12, 10, 7),
(93, 12, 10, 8),
(94, 12, 10, 9),
(95, 12, 9, 10),
(96, 12, 10, 11),
(97, 13, 10, 4),
(98, 13, 10, 5),
(99, 13, 10, 6),
(100, 13, 10, 7),
(101, 13, 10, 8),
(102, 13, 9, 9),
(103, 13, 10, 10),
(104, 13, 10, 11),
(105, 14, 10, 4),
(106, 14, 9, 5),
(107, 14, 10, 6),
(108, 14, 10, 7),
(109, 14, 10, 8),
(110, 14, 10, 9),
(111, 14, 8, 10),
(112, 14, 10, 11),
(113, 15, 9, 4),
(114, 15, 10, 5),
(115, 15, 10, 6),
(116, 15, 10, 7),
(117, 15, 10, 8),
(118, 15, 10, 9),
(119, 15, 10, 10),
(120, 15, 10, 11),
(121, 16, 8, 4),
(122, 16, 8, 5),
(123, 16, 10, 6),
(124, 16, 3, 7),
(125, 16, 0, 8),
(126, 16, 9, 9),
(127, 16, 10, 10),
(128, 16, 10, 11),
(129, 17, 10, 4),
(130, 17, 10, 5),
(131, 17, 10, 6),
(132, 17, 10, 7),
(133, 17, 10, 8),
(134, 17, 6, 9),
(135, 17, 10, 10),
(136, 17, 10, 11),
(137, 18, 10, 4),
(138, 18, 10, 5),
(139, 18, 10, 6),
(140, 18, 10, 7),
(141, 18, 10, 8),
(142, 18, 9, 9),
(143, 18, 10, 10),
(144, 18, 10, 11),
(145, 19, 10, 4),
(146, 19, 10, 5),
(147, 19, 10, 6),
(148, 19, 10, 7),
(149, 19, 10, 8),
(150, 19, 10, 9),
(151, 19, 10, 10),
(152, 19, 10, 11),
(153, 20, 10, 4),
(154, 20, 10, 5),
(155, 20, 10, 6),
(156, 20, 10, 7),
(157, 20, 10, 8),
(158, 20, 10, 9),
(159, 20, 10, 10),
(160, 20, 10, 11),
(161, 21, 10, 4),
(162, 21, 10, 5),
(163, 21, 10, 6),
(164, 21, 10, 7),
(165, 21, 10, 8),
(166, 21, 10, 9),
(167, 21, 10, 10),
(168, 21, 10, 11),
(169, 22, 10, 4),
(170, 22, 10, 5),
(171, 22, 10, 6),
(172, 22, 10, 7),
(173, 22, 10, 8),
(174, 22, 10, 9),
(175, 22, 10, 10),
(176, 22, 10, 11),
(177, 23, 10, 4),
(178, 23, 10, 5),
(179, 23, 10, 6),
(180, 23, 10, 7),
(181, 23, 10, 8),
(182, 23, 10, 9),
(183, 23, 10, 10),
(184, 23, 10, 11),
(185, 24, 10, 4),
(186, 24, 10, 5),
(187, 24, 10, 6),
(188, 24, 10, 7),
(189, 24, 10, 8),
(190, 24, 10, 9),
(191, 24, 10, 10),
(192, 24, 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password_hash`, `phone_number`, `address`, `postal_code`, `gender`) VALUES
(2, 'Lance', 'Yeo', 'test@test1.com', '$2y$10$BLSGcvkKI8tijBYfqnJQV.B7iT6dQhQj9IS0xZ807B8HDeni4/M6C', '+6592893193', 'Blk 221 Hougang Ave 7', 123453, 1),
(3, 'Test', 'Two', 'test@test2.com', '$2y$10$2LiuM9Rlcihjar5VHl499u6JvoRA/ymwqrwGvynJvVH.v5TDLoEke', '1212212', 'Blk 301 Hougang', 192793, NULL),
(4, 'test', 'test', 'test@test3.com', '$2y$10$QnaZOtmlRRAI/FWhXeGe5OsGZ73mXY.obiCi8my4bOYxBC.zcGjZO', '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `session_id_2` (`session_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `user_id_cart` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id_cart_items` (`size_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id_images` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id_orders` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id_order_items` (`size_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `user_id_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_id` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `size_id` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `product_id_images` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_id_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `size_id_order_items` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
