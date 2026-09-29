-- SQL Database Schema for Cake Fantasy Project
-- Fully synchronized with the final DIT project report.
-- Database: `project`

CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project`;

-- --------------------------------------------------------

-- Drop existing tables to ensure schema modifications are applied
DROP TABLE IF EXISTS `tbl_order`;
DROP TABLE IF EXISTS `tbl_cakes`;
DROP TABLE IF EXISTS `tbl_catagory`;
DROP TABLE IF EXISTS `usr_admin`;
DROP TABLE IF EXISTS `tbl_users`;

-- --------------------------------------------------------

-- Table structure for table `tbl_users`
CREATE TABLE `tbl_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `user_name` VARCHAR(150) NOT NULL UNIQUE,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seeding customers from the project report (Default password for all accounts is 'password')
INSERT INTO `tbl_users` (`id`, `first_name`, `last_name`, `user_name`, `email`, `password`) VALUES
(8, 'chanaka', 'madush', 'chanaka01', 'devinu@gmail.com', '$2y$10$pmAZTQA2mUB3ZDlNpwpU3ONw24esHvznyMMFEk2GnlSXtNrzae8pG'),
(9, 'devinu', 'akelya', 'devinu01', 'rsandali253@gmail.com', '$2y$10$pmAZTQA2mUB3ZDlNpwpU3ONw24esHvznyMMFEk2GnlSXtNrzae8pG'),
(10, 'hansani', 'samarawikrama', 'hansani9275', 'buddhihansika@gmail.com', '$2y$10$pmAZTQA2mUB3ZDlNpwpU3ONw24esHvznyMMFEk2GnlSXtNrzae8pG'),
(11, 'sandali', 'rangika', 'sandali07', 'sandali07@gmail.com', '$2y$10$pmAZTQA2mUB3ZDlNpwpU3ONw24esHvznyMMFEk2GnlSXtNrzae8pG');

-- --------------------------------------------------------

-- Table structure for table `usr_admin`
CREATE TABLE `usr_admin` (
  `ADmin_id` INT AUTO_INCREMENT PRIMARY KEY,
  `A_FullName` VARCHAR(255) NOT NULL,
  `A_UserName` VARCHAR(150) NOT NULL UNIQUE,
  `A_Password` VARCHAR(255) NOT NULL,
  `A_status` TINYINT NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seeding administrator credentials from the project report
-- Note: 'Admin1' is seeded with password hash from the report ('562caa20c079d12a6e0d6cf73106de84')
-- 'ramesha' is seeded with password 'admin' ('21232f297a57a5a743894a0e4a801fc3') for easy access
INSERT INTO `usr_admin` (`ADmin_id`, `A_FullName`, `A_UserName`, `A_Password`, `A_status`) VALUES
(33, 'Admin01', 'Admin1', '562caa20c079d12a6e0d6cf73106de84', 1),
(34, 'Ramesha Sandali', 'ramesha', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

-- Table structure for table `tbl_catagory`
CREATE TABLE `tbl_catagory` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `image_name` VARCHAR(255) NOT NULL DEFAULT '',
  `featured` VARCHAR(10) NOT NULL DEFAULT 'No',
  `active` VARCHAR(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seeding cake categories matching the final report (hardcoded IDs 30-35)
INSERT INTO `tbl_catagory` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(30, 'Celebration Cakes', 'img_cake_b6.jpg', 'Yes', 'Yes'),
(31, 'Bento Cakes', 'bento_7.jpg', 'Yes', 'Yes'),
(32, 'Cup Cakes', 'cupcake_1.jpg', 'Yes', 'Yes'),
(33, 'Cake Packages', 'pack_1.jpg', 'Yes', 'Yes'),
(34, 'Wedding Cakes', 'wedding_cake_6.jpg', 'Yes', 'Yes'),
(35, 'Valentine Cake', '9.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

-- Table structure for table `tbl_cakes`
CREATE TABLE `tbl_cakes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `image_name` VARCHAR(255) NOT NULL DEFAULT '',
  `catagory_id` INT NOT NULL,
  `featured` VARCHAR(10) NOT NULL DEFAULT 'No',
  `active` VARCHAR(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seeding cake items matching the final report
INSERT INTO `tbl_cakes` (`id`, `title`, `description`, `price`, `image_name`, `catagory_id`, `featured`, `active`) VALUES
(1, 'Prettiest Pink Flower Cake', 'Delight in the elegance of our handcrafted 1kg vanilla flavoured floral cake, adorned with intricate edible flower designs and a soft pastel palette.', 3500.00, 'img_cake_b4.jpg', 30, 'Yes', 'Yes'),
(2, 'Flowery Garden Chocolate Cake', 'Celebrate in style with our Flowery Elegance Cake, a masterpiece of artistry and taste. Decorated with handcrafted chocolate flowers and a refined pastel design.', 4200.00, 'img_cake_b3.jpg', 30, 'Yes', 'Yes'),
(3, 'Flowery Ribbon Cake', 'The Flowery Ribbon Cake is an elegant and artistic creation beautifully adorned with delicate edible flowers and ribbon-like floral patterns.', 3800.00, 'img_cake_b2.jpg', 30, 'Yes', 'Yes'),
(4, 'Chocolate Supreme Chocolate Cake', 'This cake is a rich and indulgent treat, perfect for chocolate lovers. This stunning cake features a smooth, velvety chocolate base with a cascading chocolate ganache drip.', 4350.00, 'img_cake_b1.jpg', 30, 'Yes', 'Yes'),
(5, 'Blue Macaroon Cake', 'This cake is a delicate and stylish masterpiece, perfect for elegant celebrations. Featuring a smooth pastel blue buttercream finish.', 3800.00, 'img_cake_b5.jpg', 30, 'Yes', 'Yes'),
(6, 'Roses With Butterfly Cake', 'This cake is beautifully decorated with soft buttercream frosting and features a charming pink and white roses with gold butterfly.', 4100.00, 'img_cake_7.jpg', 30, 'Yes', 'Yes'),
(7, 'Pink Macaroon Shade Cake', 'This cake is a beautiful, decadent creation with a soft pink and white color scheme. The smooth cream frosting is painted in alternating pink and white bands.', 4150.00, 'img_cake_8.jpg', 30, 'Yes', 'Yes'),
(8, 'Simple Blue Theme Cake', 'This cake has a clean and elegant design with a smooth white fondant base. The lower half of the cake is decorated with beautiful hand-painted blue brushstrokes.', 3850.00, 'img_cake_9.jpg', 30, 'Yes', 'Yes'),
(9, 'Fresh Rose Graduation Cake', 'This cake has a charming, minimalist design with soft pink frosting and is decorated with vibrant pink roses.', 4200.00, 'img_cake_10.jpg', 30, 'Yes', 'Yes'),
(10, 'Buttercream Floral Cake', 'This is a simple and elegant birthday cake with a smooth white frosting. It\'s decorated with a ring of pastel-colored pink roses.', 3500.00, 'img_cake_17.jpg', 30, 'Yes', 'Yes'),
(11, 'Pink & Gold Marble Cake', 'This elegant cake features a smooth white base adorned with soft, dusty pink roses. The top is decorated with delicate sugar glass details.', 4500.00, 'img_cake_18.jpg', 30, 'Yes', 'Yes'),
(12, 'Black Safari Cake', 'This simple yet charming cake features smooth white buttercream frosting. The cake is decorated with a small safari animal toy.', 3700.00, 'img_cake_20.jpg', 30, 'Yes', 'Yes'),
(13, 'Pink Rose Bento Cake', 'This is a cute, small bento-style cake with a vibrant pink frosting. The top is decorated with a single, elegant pink rose.', 2000.00, 'bento_1.jpg', 31, 'Yes', 'Yes'),
(14, 'Romantic Love Bento Cake', 'This is a simple and charming bento-style cake with a smooth white frosting. The top is decorated with a small red heart.', 1800.00, 'bento_2.jpg', 31, 'Yes', 'Yes'),
(15, 'Abstract Love Bento Cake', 'This is a beautifully decorated bento cake, a small, personalized cake perfect for special occasions. It features a soft blue base.', 1800.00, 'bento_5.jpg', 31, 'Yes', 'Yes'),
(16, 'Mermaid Theme Cupcakes', 'This cupcakes perfect for a special occasion. The cupcakes feature a variety of ocean-inspired decorations.', 1600.00, 'cupcake_11.jpg', 32, 'Yes', 'Yes'),
(17, 'Pastel Color Theme Cupcakes', 'These are vibrant and whimsical cupcakes featuring a variety of colorful frosting swirls.', 1450.00, 'cupcake_12.jpg', 32, 'Yes', 'Yes'),
(18, 'Blueberry Cuppies With Buttercream Frosting', 'These are decadent cupcakes featuring a delightful combination of moist cake and rich frosting.', 1650.00, 'cupcake_10.jpg', 32, 'Yes', 'Yes'),
(19, 'Purple Frosting with Butter Cupcakes', 'This is a beautifully arranged selection of six cupcakes, each uniquely decorated with a variety of toppings.', 1450.00, 'cupcake_2.jpg', 32, 'Yes', 'Yes'),
(20, 'Pink Shaded Frosting Cupcakes', 'This is a delightful assortment of mini cupcakes, each decorated with a swirl of pink buttercream frosting.', 2400.00, 'cupcake_1.jpg', 32, 'Yes', 'Yes'),
(21, 'Floral Chocolate Bento Cake', 'This is a modern and minimalist bento cake, showcasing a smooth chocolate glaze finish.', 2000.00, 'bento_6.jpg', 31, 'Yes', 'Yes'),
(23, 'Pretty Swirl Bento Pack', 'This is a beautifully arranged assortment of cupcakes and a bento cake, presented in a gift box.', 3200.00, 'pack_2.jpg', 33, 'Yes', 'Yes'),
(24, 'Autumn White Bento Pack', 'This is a delightful assortment of cupcakes and a bento cake, featuring a soft pastel color palette.', 2900.00, 'pack_4.jpg', 33, 'Yes', 'Yes'),
(25, 'Sea Theme Bento Pack', 'This is a charming collection of beach-themed treats, including cupcakes decorated with seashells.', 3150.00, 'pack_8.jpg', 33, 'Yes', 'Yes'),
(26, 'Ice Cream Pastel Bento Pack', 'This is a delightful assortment of treats, featuring a variety of cupcakes and a small cake.', 3250.00, 'pack_6.jpg', 33, 'Yes', 'Yes'),
(27, 'Pastel Orange Bento Pack', 'This is an elegantly arranged collection of treats, including cupcakes decorated with delicate flowers.', 3300.00, 'pack_5.jpg', 33, 'Yes', 'Yes'),
(28, 'Floral Purple Theme Wedding Cake', 'This is an elegant wedding cake featuring a striking, multi-tiered design with a smooth white fondant base.', 12500.00, 'wedding_cake_1.jpg', 34, 'Yes', 'Yes'),
(29, 'Petals with Roses Wedding Cake', 'This is a classic three-tiered wedding cake with a clean, smooth white fondant finish.', 13000.00, 'wedding_cake_2.jpg', 34, 'Yes', 'Yes'),
(30, 'Luxury White Couple Wedding Cake', 'This is a modern and minimalist wedding cake, featuring a smooth white buttercream finish.', 14500.00, 'wedding_cake_3.jpg', 34, 'Yes', 'Yes'),
(31, 'Dusty Rose Theme Wedding Cake', 'The cake features a semi-naked design, with light layers of white buttercream frosting showing hints of cake.', 11500.00, 'wedding_cake_4.jpg', 34, 'Yes', 'Yes'),
(32, 'Lily With Gold Shake Wedding Cake', 'This is a delicate and elegant four-tiered wedding cake with a smooth white fondant finish.', 17500.00, 'wedding_cake_5.jpg', 34, 'Yes', 'Yes'),
(33, 'Sublime Summer WeddingCake', 'This is a whimsical three-tiered wedding cake bursting with vibrant colors.', 16800.00, 'wedding_cake_6.jpg', 34, 'Yes', 'Yes'),
(34, 'Classic Chicago Wedding Cake', 'This is an elegant and multi-tiered wedding cake with a smooth, pristine white fondant finish.', 14500.00, 'wedding_cake_7.jpg', 34, 'Yes', 'Yes'),
(35, 'Cherry Blossom Wedding Cake', 'This is a delicate and romantic two-tiered wedding cake with a smooth white buttercream finish.', 15500.00, 'wedding_cake_8.jpg', 34, 'Yes', 'Yes');

-- --------------------------------------------------------

-- Table structure for table `tbl_order`
CREATE TABLE `tbl_order` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product` VARCHAR(255) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `qty` INT NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  `order_date` DATETIME NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'Ordered',
  `customer_name` VARCHAR(255) NOT NULL,
  `customer_contact` VARCHAR(100) NOT NULL,
  `customer_email` VARCHAR(150) NOT NULL,
  `customer_address` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seeding orders from the project report
INSERT INTO `tbl_order` (`id`, `product`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Prettiest Pink Flower Cake', 3500.00, 1, 3500.00, '2025-02-15 12:00:29', 'Delivered', 'customer_name', 'customer_contact', 'customer_email', 'customer_address'),
(2, 'Flowery Garden Chocolate Cake', 4200.00, 1, 4200.00, '2025-02-15 12:02:27', 'Delivered', 'customer_name', 'customer_contact', 'customer_email', 'customer_address'),
(3, 'Flowery Ribbon Cake', 3800.00, 1, 3800.00, '2025-02-15 12:04:44', 'Delivered', 'customer_name', 'customer_contact', 'customer_email', 'customer_address'),
(4, 'Chocolate Supreme Chocolate Cake', 4350.00, 1, 4350.00, '2025-02-15 12:21:09', 'Delivered', 'customer_name', 'customer_contact', 'customer_email', 'customer_address'),
(5, 'Blue Macroon Cake', 3800.00, 1, 3800.00, '2025-02-15 12:23:47', 'Delivered', 'customer_name', 'customer_contact', 'customer_email', 'customer_address'),
(6, 'Prettiest Pink Flower Cake', 3500.00, 2, 7000.00, '2025-02-15 12:27:07', 'Ordered', 'Ramesha Sandali', '0763484016', 'rsandali25@gmail.com', 'Railway station road, arachchikattuwa, west'),
(7, 'Chocolate Supreme Chocolate Cake', 4350.00, 3, 13050.00, '2025-02-15 12:27:51', 'On Delivery', 'customer_name', 'customer_contact', 'customer_email', 'customer_address'),
(8, 'Simple Blue Theme Cake', 3850.00, 2, 7700.00, '2025-02-15 07:23:03', 'Delivered', 'customer_name', 'customer_contact', 'customer_email', 'customer_address'),
(9, 'Prettiest Pink Flower Cake', 3500.00, 1, 3500.00, '2025-02-22 08:26:17', 'Ordered', 'Ramesha Sandali', '0717238326', 'rsandali25@gmail.com', 'Railway station road, arachchikattuwa, west'),
(10, 'Prettiest Pink Flower Cake', 3500.00, 1, 3500.00, '2025-02-22 10:22:37', 'Ordered', 'damith', '0717238326', 'sandalarangika24@gmail.com', 'Railway station road, arachchikattuwa'),
(11, 'Prettiest Pink Flower Cake', 3500.00, 1, 3500.00, '2025-02-22 10:25:17', 'Ordered', 'abcd', '041257525', 'vhagyuefcuyvy@gmail.com', 'nh vsbyg eh bn');
