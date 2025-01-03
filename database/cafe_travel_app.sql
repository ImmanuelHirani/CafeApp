-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Jan 2025 pada 04.29
-- Versi server: 8.0.30
-- Versi PHP: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe_travel_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `customer_ID` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`customer_ID`, `username`, `phone`, `image`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Immanuel Hirani', '081314801945', 'customer_images/I5Yi2xQIg8vBMAymBhVXxj87M129s29vhyCmKkTg.jpg', 'el@gmail.com', '$2y$12$Kl1.X62F9LUpjd7PyzVWruBvGhiHgJ7C3mYhGzS1WjqKvcUIIDfg6', 1, '2024-12-23 20:28:43', '2024-12-23 20:28:43'),
(5, NULL, '085945034425', NULL, 'raf@gmail.com', '$2y$12$q.x8uE6CHQN0/073fHbqIu3LBRkC7xPqk2YrhlryBjRwlLqZ6muO.', 1, '2025-01-01 04:31:46', '2025-01-01 04:31:46'),
(6, NULL, '087788462255', NULL, 'yoana@gmail.com', '$2y$12$bP.h4lBTw09tVQnEa1w0P.HvW4H64H2NqiWJkbBuy79Zvnge/l8me', 1, '2025-01-03 02:33:23', '2025-01-03 02:33:23'),
(7, 'Desi', '081219029984', 'customer_images/qjFf1evFBs9BEVXcD8YrIkOpAZ2GhqS9wOB8Iohi.jpg', 'desi@gmail.com', '$2y$12$ZWGJtoWJnjSQowFxWPeBv.sASJ10hTvgPHr63gkqeD1.PRe89SnvS', 1, '2025-01-03 02:35:06', '2025-01-03 02:35:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers_location`
--

CREATE TABLE `customers_location` (
  `location_ID` bigint UNSIGNED NOT NULL,
  `customer_ID` bigint UNSIGNED NOT NULL,
  `location_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciver_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciver_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciver_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers_location`
--

INSERT INTO `customers_location` (`location_ID`, `customer_ID`, `location_label`, `reciver_address`, `reciver_number`, `reciver_name`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 1, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', 1, '2024-12-23 13:33:16', '2025-01-02 20:28:31'),
(9, 7, 'Apartment', 'UPH universitas pelita harapan benton juction jl hasid hakim 2899 15138', '081314801945', 'Kelvin tan', 1, '2025-01-02 19:40:36', '2025-01-02 20:21:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers_review`
--

CREATE TABLE `customers_review` (
  `review_ID` bigint UNSIGNED NOT NULL,
  `customer_ID` bigint UNSIGNED NOT NULL,
  `menu_ID` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `review_desc` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers_review`
--

INSERT INTO `customers_review` (`review_ID`, `customer_ID`, `menu_ID`, `rating`, `review_desc`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 3, 'Rasa nya manis pas dan tidak ada yang kurang', '2024-12-23 22:14:33', '2024-12-23 22:14:33'),
(36, 7, 1, 3, 'Enak banget', '2025-01-02 19:37:54', '2025-01-02 19:37:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `custom_categories_pizza`
--

CREATE TABLE `custom_categories_pizza` (
  `categories_ID` bigint UNSIGNED NOT NULL,
  `categories_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `custom_categories_pizza`
--

INSERT INTO `custom_categories_pizza` (`categories_ID`, `categories_type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Cheese', 1, '2024-12-23 13:17:46', '2025-01-01 00:57:27'),
(2, 'Meats', 1, '2024-12-23 13:19:41', '2024-12-31 05:09:27'),
(3, 'Vegetables', 1, '2024-12-23 13:20:29', '2024-12-31 05:08:55'),
(4, 'Fruits', 1, '2024-12-23 13:21:49', '2024-12-23 13:21:49'),
(5, 'Chocolate', 1, '2024-12-23 13:22:57', '2024-12-23 13:22:57'),
(6, 'Jam', 1, '2024-12-23 13:23:44', '2024-12-23 13:23:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `custom_categories_properties`
--

CREATE TABLE `custom_categories_properties` (
  `properties_ID` bigint UNSIGNED NOT NULL,
  `categories_ID` bigint UNSIGNED NOT NULL,
  `properties_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `custom_categories_properties`
--

INSERT INTO `custom_categories_properties` (`properties_ID`, `categories_ID`, `properties_name`, `price`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mozzarella Cheese', 6000.00, 1, '2024-12-23 13:17:46', '2025-01-02 19:54:50'),
(2, 1, 'Cheddar Cheese', 5000.00, 1, '2024-12-23 13:18:05', '2025-01-02 19:54:50'),
(3, 1, 'Parmesan Cheese', 5500.00, 1, '2024-12-23 13:18:58', '2025-01-02 19:54:50'),
(4, 1, 'Blue Cheese', 4000.00, 1, '2024-12-23 13:19:24', '2025-01-02 19:54:50'),
(5, 2, 'Grilled Chicken', 4000.00, 1, '2024-12-23 13:19:41', '2024-12-23 13:19:41'),
(6, 2, 'Pepperoni', 2500.00, 1, '2024-12-23 13:19:55', '2024-12-23 13:19:55'),
(7, 2, 'Spicy Sausage', 3000.00, 1, '2024-12-23 13:20:05', '2024-12-23 13:20:05'),
(8, 2, 'Smoked Ham', 4500.00, 1, '2024-12-23 13:20:13', '2024-12-23 13:20:13'),
(9, 2, 'Ground Beef', 5000.00, 1, '2024-12-23 13:20:20', '2024-12-23 13:20:20'),
(10, 3, 'Bell Peppers', 3000.00, 1, '2024-12-23 13:20:29', '2024-12-23 13:20:29'),
(11, 3, 'Red Onions', 2000.00, 1, '2024-12-23 13:20:37', '2024-12-23 13:20:37'),
(12, 3, 'Black Olives', 3500.00, 1, '2024-12-23 13:20:43', '2024-12-23 13:20:43'),
(13, 3, 'Mushrooms', 2500.00, 1, '2024-12-23 13:20:52', '2024-12-23 13:20:52'),
(14, 3, 'Fresh Spinach', 3000.00, 1, '2024-12-23 13:21:01', '2024-12-23 13:21:01'),
(15, 3, 'Cherry Tomatoes', 1500.00, 1, '2024-12-23 13:21:06', '2024-12-23 13:21:06'),
(16, 4, 'Pineapple', 2500.00, 1, '2024-12-23 13:21:49', '2024-12-23 13:21:59'),
(17, 4, 'Sliced Pear', 2000.00, 1, '2024-12-23 13:21:55', '2024-12-23 13:21:59'),
(18, 4, 'Mango Chunks', 3000.00, 1, '2024-12-23 13:22:04', '2024-12-23 13:22:04'),
(19, 4, 'Figs', 1000.00, 1, '2024-12-23 13:22:10', '2024-12-23 13:22:10'),
(20, 5, 'Nuttela', 5000.00, 1, '2024-12-23 13:22:57', '2024-12-23 13:22:57'),
(21, 5, 'White Chocolate', 3000.00, 1, '2024-12-23 13:23:06', '2024-12-23 13:23:06'),
(22, 5, 'Chocolate sprinkles', 1500.00, 1, '2024-12-23 13:23:12', '2024-12-23 13:23:12'),
(23, 5, 'Dairy Milk', 5000.00, 1, '2024-12-23 13:23:19', '2024-12-23 13:23:19'),
(24, 5, 'Melted Sliver Queen', 6000.00, 1, '2024-12-23 13:23:28', '2024-12-23 13:23:28'),
(25, 6, 'Peanut butter', 3000.00, 1, '2024-12-23 13:23:44', '2024-12-23 13:23:44'),
(26, 6, 'Blueberry jam', 2000.00, 1, '2024-12-23 13:23:52', '2024-12-23 13:23:52'),
(27, 6, 'Strawberry jam', 3000.00, 1, '2024-12-23 13:24:00', '2024-12-23 13:24:00'),
(28, 6, 'Chocolate spread', 3500.00, 1, '2024-12-23 13:24:07', '2024-12-23 13:24:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `custom_categories_size_properties`
--

CREATE TABLE `custom_categories_size_properties` (
  `size_ID` bigint UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowed_flavor` int NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `custom_categories_size_properties`
--

INSERT INTO `custom_categories_size_properties` (`size_ID`, `size`, `allowed_flavor`, `price`, `created_at`, `updated_at`) VALUES
(1, 'sm', 3, 10000.00, '2024-12-23 13:24:26', '2025-01-02 19:54:50'),
(2, 'md', 5, 20000.00, '2024-12-23 13:24:26', '2025-01-02 19:54:50'),
(3, 'lg', 7, 30000.00, '2024-12-23 13:24:26', '2025-01-02 19:54:50'),
(4, 'xl', 9, 40000.00, '2024-12-23 13:24:26', '2025-01-02 19:54:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorite_menu`
--

CREATE TABLE `favorite_menu` (
  `favorit_ID` bigint UNSIGNED NOT NULL,
  `customer_ID` bigint UNSIGNED NOT NULL,
  `menu_ID` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_items`
--

CREATE TABLE `menu_items` (
  `menu_ID` bigint UNSIGNED NOT NULL,
  `menu_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int DEFAULT NULL,
  `menu_description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_items`
--

INSERT INTO `menu_items` (`menu_ID`, `menu_type`, `image`, `name`, `stock`, `menu_description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'coffee', 'menu_images/tDBnTwihdzzqaV54uAFK7MsfkQ7zmOUwRGwnSLIq.png', 'Cappuccino Coffee', 10, 'A classic coffee beverage combining rich espresso and creamy milk topped with a smooth layer of milk foam perfectly balanced with an aromatic flavor to brighten your day', 1, '2024-12-23 12:34:44', '2025-01-02 19:44:01'),
(2, 'coffee', 'menu_images/iYB1wTH0qLkmxKPjTqoW63BsPaAGhwNlIHunKGm5.png', 'Caramel Hazelnut Iced Coffee', 16, 'A delightful iced coffee blend infused with the sweetness of caramel and the nutty aroma of hazelnut a refreshing choice for coffee lovers seeking a smooth flavorful experience', 1, '2024-12-23 13:06:15', '2025-01-02 03:18:53'),
(3, 'coffee', 'menu_images/C8b7I1ocF4FjYSapMxSkOXptvRd9rMzNgZqJKG6v.png', 'Caramel Macchiato', 18, 'A layered coffee drink featuring creamy milk a shot of bold espresso and a drizzle of sweet caramel each sip offers a perfect harmony of sweetness and coffee richness', 1, '2024-12-23 13:06:41', '2024-12-23 13:37:07'),
(4, 'coffee', 'menu_images/IU6i1uKmJvRJH9eiPPmrwTHqcXRvlBpaaReIYLY4.png', 'Dalgona Coffee', 18, 'A whipped coffee sensation with a creamy and fluffy texture this trendy drink combines bold coffee flavors with a light velvety topping to create an indulgent treat', 1, '2024-12-23 13:07:13', '2024-12-23 13:37:07'),
(5, 'coffee', 'menu_images/ZtOJeEvHvGF9nOrVqLwp1q8ttmkwchOO3nTaregS.png', 'Milk Sugar Coffee', 20, 'A simple yet satisfying coffee drink blending smooth milk and just the right amount of sugar for a lightly sweet refreshing taste that’s easy to enjoy', 1, '2024-12-23 13:07:37', '2024-12-23 13:07:37'),
(7, 'pizza', 'menu_images/HKXjiFnFxNZq11kRxtcCLZEDicrxg3nts6HhoRUb.png', 'Chicken Pizza', 4, 'A delicious pizza loaded with tender chicken pieces and savory sauce perfectly complemented by melted cheese for a comforting and hearty meal', 1, '2024-12-23 13:08:56', '2025-01-02 20:25:43'),
(8, 'pizza', 'menu_images/gsVKQbQEijmVuC7k10bprpxH8rpQ2yuJwxtS52Aq.png', 'Meat Lovers Pizza', 18, 'Packed with a variety of premium meats this pizza is a feast for carnivores every bite delivers rich and satisfying flavors of expertly seasoned toppings', 1, '2024-12-23 13:10:02', '2024-12-23 13:37:07'),
(9, 'pizza', 'menu_images/K9L09jYzECPkcqdpxbho1wZCmnsgp5eimW1JKxl0.png', 'New York Pizza', 18, 'A classic New York-style pizza with a thin crispy crust and rich toppings perfect for those who enjoy a traditional pizza experience with bold authentic flavors', 1, '2024-12-23 13:10:56', '2024-12-23 13:37:07'),
(10, 'pizza', 'menu_images/XH8e9LQZflJyqStkHQKrLjHkZ1vF5h34YPYSPv7W.png', 'Pepperoni Pizza', 20, 'A timeless favorite featuring slices of savory pepperoni atop melted cheese and a perfectly baked crust an irresistible choice for any pizza lover', 1, '2024-12-23 13:11:48', '2024-12-23 13:11:48'),
(11, 'pizza', 'menu_images/UpGMGzUEngBeSRpSaTrc2GscIsVg0z2wgdrdeDCH.png', 'Sicilian Pizza', 18, 'An authentic Sicilian-style pizza with a thick fluffy crust and hearty toppings a true Italian classic with flavors that transport you to the Mediterranean', 1, '2024-12-23 13:12:21', '2024-12-23 13:37:07'),
(12, 'bobba', 'menu_images/kJ1g0p6JXy67ExvwzjqqUhxUulAdiww7YnKFtC1Q.png', 'Brown Sugar Syrup and Milk Tea Bobba', 16, 'A delightful milk tea drink enriched with brown sugar syrup and chewy boba pearls the perfect balance of sweetness and creaminess in every sip', 1, '2024-12-23 13:14:00', '2024-12-24 02:30:41'),
(13, 'bobba', 'menu_images/qnMXVz4I6OJb6oSVCTTLoWtWCwEDXkxXxvFXrtPY.png', 'Choco Bobba', 18, 'A rich and indulgent chocolate milk tea paired with soft chewy boba pearls a heavenly treat for chocolate lovers looking for something unique', 1, '2024-12-23 13:14:30', '2024-12-23 13:37:07'),
(14, 'bobba', 'menu_images/sjSVKySh8CnnJTWfcrH3J1hFMj9WDgtyQ39SoJL8.png', 'Matcha Bobba', 18, 'A refreshing drink blending authentic matcha green tea with creamy milk and boba pearls a soothing and flavorful choice for tea enthusiasts', 1, '2024-12-23 13:15:07', '2024-12-23 13:37:07'),
(15, 'bobba', 'menu_images/f8jKwta2BPAITFgMlHgP2PmcRjahEEpBfif514F5.png', 'Milk Bobba', 18, 'A classic milk tea featuring a silky texture and chewy boba pearls its simplicity makes it a versatile and comforting beverage for any occasion', 1, '2024-12-23 13:15:39', '2024-12-23 13:37:07'),
(16, 'bobba', 'menu_images/FPijfl9fEZss5ABqdgqnSZ7ElgrsWUgNbn99VZaY.png', 'Oreo Bobba', 18, 'A creative fusion of crushed Oreo cookies and milk tea complemented by chewy boba pearls a sweet crunchy and chewy delight in every sip', 1, '2024-12-23 13:16:08', '2024-12-23 13:37:07'),
(17, 'bobba', 'menu_images/jBrjjKOWKGIoO90mFDehcozCpo0TbqwbpKcyp8bO.png', 'Taro Bobba', 18, 'A smooth and creamy taro-flavored milk tea with soft boba pearls its sweet nutty taste offers a unique twist to your beverage selection', 1, '2024-12-23 13:16:36', '2024-12-23 13:37:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_properties`
--

CREATE TABLE `menu_properties` (
  `property_ID` bigint UNSIGNED NOT NULL,
  `menu_ID` bigint UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `is_active_properties` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_properties`
--

INSERT INTO `menu_properties` (`property_ID`, `menu_ID`, `size`, `price`, `is_active_properties`, `created_at`, `updated_at`) VALUES
(1, 1, 'sm', 15000.00, 1, '2024-12-23 12:34:44', '2024-12-27 03:49:20'),
(2, 1, 'md', 20000.00, 1, '2024-12-23 12:34:44', '2024-12-27 03:49:20'),
(3, 1, 'lg', 25000.00, 1, '2024-12-23 12:34:44', '2024-12-27 03:49:20'),
(4, 1, 'xl', 30000.00, 1, '2024-12-23 12:34:44', '2024-12-27 03:49:20'),
(5, 2, 'sm', 15000.00, 1, '2024-12-23 13:06:15', '2024-12-23 13:06:27'),
(6, 2, 'md', 20000.00, 1, '2024-12-23 13:06:15', '2024-12-23 13:06:27'),
(7, 2, 'lg', 25000.00, 1, '2024-12-23 13:06:15', '2024-12-23 13:06:27'),
(8, 2, 'xl', 30000.00, 1, '2024-12-23 13:06:15', '2024-12-23 13:06:27'),
(9, 3, 'sm', 15000.00, 1, '2024-12-23 13:06:41', '2024-12-23 13:06:55'),
(10, 3, 'md', 20000.00, 1, '2024-12-23 13:06:41', '2024-12-23 13:06:55'),
(11, 3, 'lg', 25000.00, 1, '2024-12-23 13:06:41', '2024-12-23 13:06:55'),
(12, 3, 'xl', 30000.00, 1, '2024-12-23 13:06:41', '2024-12-23 13:06:55'),
(13, 4, 'sm', 20000.00, 1, '2024-12-23 13:07:13', '2024-12-23 13:07:22'),
(14, 4, 'md', 25000.00, 1, '2024-12-23 13:07:13', '2024-12-23 13:07:22'),
(15, 4, 'lg', 30000.00, 1, '2024-12-23 13:07:13', '2024-12-23 13:07:22'),
(16, 4, 'xl', 35000.00, 1, '2024-12-23 13:07:13', '2024-12-23 13:07:22'),
(17, 5, 'sm', 25000.00, 1, '2024-12-23 13:07:37', '2024-12-23 13:07:50'),
(18, 5, 'md', 35000.00, 1, '2024-12-23 13:07:37', '2024-12-23 13:07:50'),
(19, 5, 'lg', 40000.00, 1, '2024-12-23 13:07:37', '2024-12-23 13:07:50'),
(20, 5, 'xl', 42000.00, 1, '2024-12-23 13:07:37', '2024-12-23 13:07:50'),
(25, 7, 'sm', 25000.00, 1, '2024-12-23 13:08:56', '2024-12-23 13:09:12'),
(26, 7, 'md', 30000.00, 1, '2024-12-23 13:08:56', '2024-12-23 13:09:12'),
(27, 7, 'lg', 35000.00, 1, '2024-12-23 13:08:56', '2024-12-23 13:09:12'),
(28, 7, 'xl', 45000.00, 1, '2024-12-23 13:08:56', '2024-12-23 13:09:12'),
(29, 8, 'sm', 35000.00, 1, '2024-12-23 13:10:02', '2024-12-23 13:10:13'),
(30, 8, 'md', 40000.00, 1, '2024-12-23 13:10:02', '2024-12-23 13:10:13'),
(31, 8, 'lg', 45000.00, 1, '2024-12-23 13:10:02', '2024-12-23 13:10:13'),
(32, 8, 'xl', 55000.00, 1, '2024-12-23 13:10:02', '2024-12-23 13:10:13'),
(33, 9, 'sm', 25000.00, 1, '2024-12-23 13:10:56', '2024-12-23 13:11:06'),
(34, 9, 'md', 35000.00, 1, '2024-12-23 13:10:56', '2024-12-23 13:11:06'),
(35, 9, 'lg', 45000.00, 1, '2024-12-23 13:10:56', '2024-12-23 13:11:06'),
(36, 9, 'xl', 55000.00, 1, '2024-12-23 13:10:56', '2024-12-23 13:11:06'),
(37, 10, 'sm', 25000.00, 1, '2024-12-23 13:11:48', '2024-12-23 13:12:02'),
(38, 10, 'md', 30000.00, 1, '2024-12-23 13:11:48', '2024-12-23 13:12:03'),
(39, 10, 'lg', 40000.00, 1, '2024-12-23 13:11:48', '2024-12-23 13:12:03'),
(40, 10, 'xl', 45000.00, 1, '2024-12-23 13:11:48', '2024-12-23 13:12:03'),
(41, 11, 'sm', 25000.00, 1, '2024-12-23 13:12:21', '2024-12-23 13:13:25'),
(42, 11, 'md', 35000.00, 1, '2024-12-23 13:12:21', '2024-12-23 13:13:25'),
(43, 11, 'lg', 45000.00, 1, '2024-12-23 13:12:21', '2024-12-23 13:13:25'),
(44, 11, 'xl', 60000.00, 1, '2024-12-23 13:12:21', '2024-12-23 13:13:25'),
(45, 12, 'sm', 12000.00, 1, '2024-12-23 13:14:00', '2024-12-23 13:14:17'),
(46, 12, 'md', 22000.00, 1, '2024-12-23 13:14:00', '2024-12-23 13:14:17'),
(47, 12, 'lg', 32000.00, 1, '2024-12-23 13:14:00', '2024-12-23 13:14:17'),
(48, 12, 'xl', 40000.00, 1, '2024-12-23 13:14:00', '2024-12-23 13:14:17'),
(49, 13, 'sm', 15000.00, 1, '2024-12-23 13:14:30', '2024-12-23 13:14:47'),
(50, 13, 'md', 25000.00, 1, '2024-12-23 13:14:30', '2024-12-23 13:14:47'),
(51, 13, 'lg', 35000.00, 1, '2024-12-23 13:14:30', '2024-12-23 13:14:47'),
(52, 13, 'xl', 45000.00, 1, '2024-12-23 13:14:30', '2024-12-23 13:14:47'),
(53, 14, 'sm', 8000.00, 1, '2024-12-23 13:15:07', '2024-12-23 13:15:19'),
(54, 14, 'md', 16000.00, 1, '2024-12-23 13:15:07', '2024-12-23 13:15:19'),
(55, 14, 'lg', 24000.00, 1, '2024-12-23 13:15:07', '2024-12-23 13:15:19'),
(56, 14, 'xl', 30000.00, 1, '2024-12-23 13:15:07', '2024-12-23 13:15:19'),
(57, 15, 'sm', 7000.00, 1, '2024-12-23 13:15:39', '2024-12-23 13:15:52'),
(58, 15, 'md', 12000.00, 1, '2024-12-23 13:15:39', '2024-12-23 13:15:52'),
(59, 15, 'lg', 18000.00, 1, '2024-12-23 13:15:39', '2024-12-23 13:15:52'),
(60, 15, 'xl', 24000.00, 1, '2024-12-23 13:15:39', '2024-12-23 13:15:52'),
(61, 16, 'sm', 8000.00, 1, '2024-12-23 13:16:08', '2024-12-23 13:16:22'),
(62, 16, 'md', 14000.00, 1, '2024-12-23 13:16:08', '2024-12-23 13:16:22'),
(63, 16, 'lg', 20000.00, 1, '2024-12-23 13:16:08', '2024-12-23 13:16:22'),
(64, 16, 'xl', 24000.00, 1, '2024-12-23 13:16:08', '2024-12-23 13:16:22'),
(65, 17, 'sm', 6000.00, 1, '2024-12-23 13:16:36', '2024-12-23 13:16:49'),
(66, 17, 'md', 14000.00, 1, '2024-12-23 13:16:36', '2024-12-23 13:16:49'),
(67, 17, 'lg', 18000.00, 1, '2024-12-23 13:16:36', '2024-12-23 13:16:49'),
(68, 17, 'xl', 22000.00, 1, '2024-12-23 13:16:36', '2024-12-23 13:16:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_27_062957_create_customers_table', 1),
(5, '2024_11_27_063020_create_menu_items_table', 1),
(6, '2024_11_27_063218_create_customers_location_table', 1),
(7, '2024_11_27_063312_create_customers_review_table', 1),
(8, '2024_11_27_063407_create_order_transaction_table', 1),
(9, '2024_11_27_063446_create_favorite_menu_table', 1),
(10, '2024_12_06_011414_create_menu_properties_tabel', 1),
(11, '2024_12_13_005935_create_custom_categories_pizza_table', 1),
(12, '2024_12_13_020347_create_custom_categories_properties_table', 1),
(13, '2024_12_14_133504_create_custom_categories_size_properties_table', 1),
(14, '2024_12_19_020813_create_order_transaction_details', 1),
(15, '2024_12_21_062328_create_order_transaction_location', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_transaction`
--

CREATE TABLE `order_transaction` (
  `order_ID` bigint UNSIGNED NOT NULL,
  `customer_ID` bigint UNSIGNED NOT NULL,
  `total_amounts` decimal(10,2) NOT NULL,
  `status_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_transaction`
--

INSERT INTO `order_transaction` (`order_ID`, `customer_ID`, `total_amounts`, `status_order`, `created_at`, `updated_at`) VALUES
(2, 1, 60000.00, 'canceled', '2024-12-23 20:19:33', '2024-12-31 21:29:13'),
(3, 1, 50000.00, 'completed', '2024-12-23 20:19:47', '2024-12-31 21:16:54'),
(6, 1, 141500.00, 'canceled', '2024-12-25 00:59:14', '2024-12-25 01:03:39'),
(7, 1, 154500.00, 'paid', '2024-12-25 01:03:49', '2024-12-31 21:27:46'),
(11, 1, 100000.00, 'canceled', '2024-12-25 21:58:09', '2024-12-25 21:58:55'),
(12, 1, 15000.00, 'paid', '2024-12-25 21:59:08', '2024-12-25 21:59:17'),
(15, 1, 60000.00, 'paid', '2024-12-26 22:19:16', '2024-12-26 22:51:39'),
(16, 1, 60000.00, 'paid', '2024-12-27 07:40:45', '2024-12-27 07:42:42'),
(18, 1, 30000.00, 'paid', '2024-12-30 03:20:33', '2024-12-30 03:32:17'),
(19, 1, 100000.00, 'canceled', '2024-12-30 03:33:30', '2024-12-31 14:44:46'),
(20, 1, 30000.00, 'canceled', '2024-12-30 03:48:26', '2024-12-31 14:44:54'),
(22, 1, 274500.00, 'canceled', '2024-12-31 14:45:14', '2024-12-31 15:13:55'),
(23, 1, 60000.00, 'canceled', '2024-12-31 14:50:55', '2024-12-31 15:13:51'),
(24, 1, 120000.00, 'canceled', '2024-12-31 15:14:04', '2024-12-31 15:19:01'),
(25, 1, 60000.00, 'canceled', '2024-12-31 15:18:54', '2024-12-31 18:34:07'),
(26, 1, 60000.00, 'canceled', '2024-12-31 18:34:14', '2024-12-31 18:38:49'),
(27, 1, 120000.00, 'canceled', '2024-12-31 18:38:55', '2024-12-31 19:03:15'),
(28, 1, 60000.00, 'canceled', '2024-12-31 19:03:22', '2024-12-31 19:13:08'),
(29, 1, 130000.00, 'canceled', '2024-12-31 19:13:42', '2024-12-31 19:17:07'),
(30, 1, 12000.00, 'canceled', '2024-12-31 19:17:14', '2024-12-31 19:23:51'),
(31, 1, 20000.00, 'canceled', '2024-12-31 19:23:57', '2024-12-31 19:34:58'),
(32, 1, 55000.00, 'canceled', '2024-12-31 19:34:44', '2024-12-31 19:38:26'),
(33, 1, 154500.00, 'canceled', '2024-12-31 19:38:33', '2024-12-31 19:39:10'),
(34, 1, 15000.00, 'canceled', '2024-12-31 19:42:11', '2024-12-31 19:44:13'),
(35, 1, 50000.00, 'canceled', '2024-12-31 19:44:19', '2024-12-31 19:47:40'),
(36, 1, 8000.00, 'canceled', '2024-12-31 19:47:47', '2024-12-31 19:48:35'),
(37, 1, 30000.00, 'canceled', '2024-12-31 19:48:27', '2024-12-31 19:50:20'),
(38, 1, 30000.00, 'canceled', '2024-12-31 19:50:23', '2024-12-31 19:50:45'),
(39, 1, 30000.00, 'canceled', '2024-12-31 19:54:18', '2024-12-31 19:54:47'),
(40, 1, 60000.00, 'canceled', '2024-12-31 19:54:51', '2024-12-31 19:57:12'),
(41, 1, 30000.00, 'canceled', '2024-12-31 19:57:37', '2024-12-31 19:59:05'),
(42, 1, 30000.00, 'canceled', '2024-12-31 19:59:09', '2024-12-31 20:02:19'),
(43, 1, 30000.00, 'canceled', '2024-12-31 20:02:23', '2024-12-31 20:04:23'),
(44, 1, 45000.00, 'paid', '2024-12-31 20:04:27', '2024-12-31 20:04:37'),
(45, 1, 60000.00, 'canceled', '2024-12-31 20:05:44', '2024-12-31 20:08:35'),
(46, 1, 50000.00, 'canceled', '2024-12-31 20:08:40', '2024-12-31 20:09:12'),
(47, 1, 60000.00, 'canceled', '2024-12-31 20:11:38', '2024-12-31 20:12:15'),
(48, 1, 15000.00, 'canceled', '2024-12-31 20:17:00', '2024-12-31 20:30:33'),
(49, 1, 30000.00, 'paid', '2024-12-31 20:30:41', '2024-12-31 20:31:10'),
(50, 1, 50000.00, 'paid', '2024-12-31 20:31:35', '2024-12-31 20:40:58'),
(51, 1, 15000.00, 'paid', '2024-12-31 20:41:27', '2024-12-31 20:41:40'),
(52, 1, 60000.00, 'paid', '2024-12-31 20:42:02', '2024-12-31 20:42:08'),
(53, 1, 15000.00, 'paid', '2024-12-31 20:44:00', '2024-12-31 20:44:09'),
(54, 1, 50000.00, 'paid', '2024-12-31 20:45:45', '2024-12-31 20:47:51'),
(55, 1, 15000.00, 'paid', '2024-12-31 20:49:24', '2024-12-31 22:50:42'),
(56, 1, 25000.00, 'completed', '2024-12-31 20:52:08', '2025-01-02 19:48:41'),
(57, 1, 30000.00, 'canceled', '2024-12-31 20:56:09', '2024-12-31 22:50:14'),
(58, 1, 30000.00, 'paid', '2024-12-31 21:01:56', '2024-12-31 21:02:53'),
(59, 1, 30000.00, 'canceled', '2024-12-31 21:05:08', '2024-12-31 22:49:20'),
(61, 1, 25000.00, 'canceled', '2024-12-31 22:49:30', '2025-01-02 03:18:13'),
(62, 1, 90000.00, 'paid', '2025-01-01 06:15:04', '2025-01-02 03:18:52'),
(63, 1, 60000.00, 'canceled', '2025-01-02 03:22:06', '2025-01-02 03:23:20'),
(64, 1, 90000.00, 'in-progress', '2025-01-02 03:23:35', '2025-01-02 03:23:39'),
(65, 1, 30000.00, 'pending', '2025-01-02 03:28:41', '2025-01-02 03:28:41'),
(67, 7, 119500.00, 'canceled', '2025-01-02 19:37:27', '2025-01-02 19:57:56'),
(70, 7, 70000.00, 'serve', '2025-01-02 20:21:59', '2025-01-02 20:23:01'),
(71, 7, 94500.00, 'shipped', '2025-01-02 20:24:46', '2025-01-02 20:28:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_transaction_details`
--

CREATE TABLE `order_transaction_details` (
  `order_detail_ID` bigint UNSIGNED NOT NULL,
  `order_ID` bigint UNSIGNED NOT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_ID` bigint NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_transaction_details`
--

INSERT INTO `order_transaction_details` (`order_detail_ID`, `order_ID`, `order_type`, `menu_ID`, `size`, `menu_name`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(17, 2, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-23 20:19:33', '2024-12-23 20:19:33'),
(18, 3, 'normal_menu', 7, 'sm', 'Chicken Pizza', 2, 50000.00, '2024-12-23 20:19:47', '2024-12-23 20:19:47'),
(24, 6, 'custom_menu', -99, 'sm', 'Mozzarella Cheese, Cheddar Cheese, Parmesan Cheese', 1, 41500.00, '2024-12-25 00:59:14', '2024-12-25 00:59:14'),
(25, 6, 'normal_menu', 6, 'lg', 'Blackpepper Pizza', 2, 100000.00, '2024-12-25 01:02:25', '2024-12-25 01:02:25'),
(26, 7, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-25 01:03:49', '2024-12-25 01:04:08'),
(27, 7, 'custom_menu', -99, 'xl', 'Mozzarella Cheese, Cheddar Cheese, Parmesan Cheese, Blue Cheese, Grilled Chicken, Pepperoni, Spicy Sausage, Smoked Ham, Ground Beef', 1, 94500.00, '2024-12-25 01:04:02', '2024-12-25 01:04:02'),
(33, 11, 'normal_menu', 6, 'lg', 'Blackpepper Pizza', 2, 100000.00, '2024-12-25 21:58:09', '2024-12-25 21:58:20'),
(34, 12, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 1, 15000.00, '2024-12-25 21:59:08', '2024-12-25 21:59:08'),
(37, 15, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-26 22:19:16', '2024-12-26 22:19:21'),
(38, 16, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-27 07:40:45', '2024-12-27 07:40:45'),
(40, 18, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-30 03:20:33', '2024-12-30 03:20:33'),
(44, 19, 'normal_menu', 6, 'lg', 'Blackpepper Pizza', 2, 100000.00, '2024-12-30 03:33:30', '2024-12-30 03:33:30'),
(45, 20, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-30 03:48:26', '2024-12-30 03:48:26'),
(52, 22, 'normal_menu', 6, 'xl', 'Blackpepper Pizza', 2, 120000.00, '2024-12-31 14:45:14', '2024-12-31 14:45:14'),
(53, 22, 'normal_menu', 2, 'xl', 'Caramel Hazelnut Iced Coffee', 2, 60000.00, '2024-12-31 14:45:20', '2024-12-31 14:45:20'),
(54, 22, 'custom_menu', -99, 'xl', 'Mozzarella Cheese, Cheddar Cheese, Parmesan Cheese, Blue Cheese, Grilled Chicken, Pepperoni, Spicy Sausage, Smoked Ham, Ground Beef', 1, 94500.00, '2024-12-31 14:45:28', '2024-12-31 14:45:28'),
(55, 23, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-31 14:50:55', '2024-12-31 14:50:55'),
(56, 24, 'normal_menu', 2, 'sm', 'Caramel Hazelnut Iced Coffee', 2, 30000.00, '2024-12-31 15:14:05', '2024-12-31 15:14:05'),
(57, 24, 'normal_menu', 1, 'md', 'Cappuccino Coffee', 2, 40000.00, '2024-12-31 15:14:09', '2024-12-31 15:14:09'),
(58, 24, 'normal_menu', 3, 'lg', 'Caramel Macchiato', 2, 50000.00, '2024-12-31 15:14:16', '2024-12-31 15:14:16'),
(59, 25, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-31 15:18:54', '2024-12-31 15:18:54'),
(60, 26, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-31 18:34:14', '2024-12-31 18:34:14'),
(61, 27, 'normal_menu', 6, 'xl', 'Blackpepper Pizza', 2, 120000.00, '2024-12-31 18:38:55', '2024-12-31 18:39:13'),
(62, 28, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-31 19:03:22', '2024-12-31 19:03:22'),
(63, 29, 'normal_menu', 6, 'lg', 'Blackpepper Pizza', 2, 100000.00, '2024-12-31 19:13:42', '2024-12-31 19:13:42'),
(64, 29, 'normal_menu', 13, 'sm', 'Choco Bobba', 2, 30000.00, '2024-12-31 19:13:49', '2024-12-31 19:13:49'),
(65, 30, 'normal_menu', 12, 'sm', 'Brown Sugar Syrup and Milk Tea Bobba', 1, 12000.00, '2024-12-31 19:17:14', '2024-12-31 19:17:14'),
(66, 31, 'normal_menu', 12, 'sm', 'Brown Sugar Syrup and Milk Tea Bobba', 1, 12000.00, '2024-12-31 19:23:57', '2024-12-31 19:23:57'),
(67, 31, 'normal_menu', 14, 'sm', 'Matcha Bobba', 1, 8000.00, '2024-12-31 19:24:02', '2024-12-31 19:24:02'),
(68, 32, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-31 19:34:44', '2024-12-31 19:34:44'),
(69, 32, 'normal_menu', 9, 'sm', 'New York Pizza', 1, 25000.00, '2024-12-31 19:34:51', '2024-12-31 19:34:51'),
(70, 33, 'normal_menu', 1, 'xl', 'Cappuccino Coffee', 2, 60000.00, '2024-12-31 19:38:33', '2024-12-31 19:38:33'),
(71, 33, 'custom_menu', -99, 'xl', 'Mozzarella Cheese, Cheddar Cheese, Parmesan Cheese, Blue Cheese, Grilled Chicken, Pepperoni, Spicy Sausage, Smoked Ham, Ground Beef', 1, 94500.00, '2024-12-31 19:38:42', '2024-12-31 19:38:42'),
(72, 34, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 1, 15000.00, '2024-12-31 19:42:11', '2024-12-31 19:42:11'),
(73, 35, 'normal_menu', 1, 'lg', 'Cappuccino Coffee', 2, 50000.00, '2024-12-31 19:44:19', '2024-12-31 19:44:19'),
(74, 36, 'normal_menu', 14, 'sm', 'Matcha Bobba', 1, 8000.00, '2024-12-31 19:47:47', '2024-12-31 19:47:47'),
(75, 37, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-31 19:48:27', '2024-12-31 19:48:27'),
(76, 38, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-31 19:50:23', '2024-12-31 19:50:23'),
(77, 39, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-31 19:54:18', '2024-12-31 19:54:18'),
(78, 40, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-31 19:54:51', '2024-12-31 19:54:51'),
(79, 41, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-31 19:57:37', '2024-12-31 19:57:37'),
(80, 42, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 2, 30000.00, '2024-12-31 19:59:09', '2024-12-31 19:59:09'),
(81, 43, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-31 20:02:23', '2024-12-31 20:02:23'),
(82, 44, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-31 20:04:27', '2024-12-31 20:04:27'),
(83, 44, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 1, 15000.00, '2024-12-31 20:04:32', '2024-12-31 20:04:32'),
(84, 45, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-31 20:05:44', '2024-12-31 20:05:44'),
(85, 46, 'normal_menu', 2, 'sm', 'Caramel Hazelnut Iced Coffee', 1, 15000.00, '2024-12-31 20:08:40', '2024-12-31 20:08:40'),
(86, 46, 'normal_menu', 4, 'xl', 'Dalgona Coffee', 1, 35000.00, '2024-12-31 20:08:46', '2024-12-31 20:08:46'),
(87, 47, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-31 20:11:38', '2024-12-31 20:11:38'),
(88, 48, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 1, 15000.00, '2024-12-31 20:17:00', '2024-12-31 20:17:00'),
(89, 49, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 1, 30000.00, '2024-12-31 20:30:41', '2024-12-31 20:30:41'),
(90, 50, 'normal_menu', 7, 'sm', 'Chicken Pizza', 2, 50000.00, '2024-12-31 20:31:35', '2024-12-31 20:31:35'),
(91, 51, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 1, 15000.00, '2024-12-31 20:41:27', '2024-12-31 20:41:27'),
(92, 52, 'normal_menu', 6, 'sm', 'Blackpepper Pizza', 2, 60000.00, '2024-12-31 20:42:02', '2024-12-31 20:42:02'),
(93, 53, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 1, 15000.00, '2024-12-31 20:44:00', '2024-12-31 20:44:00'),
(94, 54, 'normal_menu', 7, 'sm', 'Chicken Pizza', 2, 50000.00, '2024-12-31 20:45:45', '2024-12-31 20:45:45'),
(95, 55, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 1, 15000.00, '2024-12-31 20:49:24', '2024-12-31 20:49:24'),
(96, 56, 'normal_menu', 7, 'sm', 'Chicken Pizza', 1, 25000.00, '2024-12-31 20:52:08', '2024-12-31 20:52:08'),
(97, 57, 'normal_menu', 2, 'sm', 'Caramel Hazelnut Iced Coffee', 2, 30000.00, '2024-12-31 20:56:09', '2024-12-31 20:56:09'),
(98, 58, 'normal_menu', 1, 'sm', 'Cappuccino Coffee', 2, 30000.00, '2024-12-31 21:01:56', '2024-12-31 21:01:56'),
(99, 59, 'normal_menu', 2, 'sm', 'Caramel Hazelnut Iced Coffee', 2, 30000.00, '2024-12-31 21:05:09', '2024-12-31 21:05:09'),
(100, 2, 'normal_menu', 2, 'sm', 'Caramel Hazelnut Iced Coffee', 2, 30000.00, '2024-12-31 21:26:49', '2024-12-31 21:26:49'),
(102, 61, 'normal_menu', 7, 'sm', 'Chicken Pizza', 1, 25000.00, '2024-12-31 22:49:30', '2024-12-31 22:50:01'),
(104, 62, 'normal_menu', 1, 'xl', 'Cappuccino Coffee', 2, 60000.00, '2025-01-01 06:15:04', '2025-01-01 06:15:04'),
(105, 62, 'normal_menu', 2, 'sm', 'Caramel Hazelnut Iced Coffee', 2, 30000.00, '2025-01-02 03:18:22', '2025-01-02 03:18:22'),
(106, 63, 'normal_menu', 2, 'xl', 'Caramel Hazelnut Iced Coffee', 2, 60000.00, '2025-01-02 03:22:06', '2025-01-02 03:22:06'),
(107, 64, 'normal_menu', 7, 'xl', 'Chicken Pizza', 2, 90000.00, '2025-01-02 03:23:35', '2025-01-02 03:23:35'),
(108, 65, 'normal_menu', 2, 'sm', 'Caramel Hazelnut Iced Coffee', 2, 30000.00, '2025-01-02 03:28:41', '2025-01-02 03:28:41'),
(110, 67, 'normal_menu', 1, 'lg', 'Cappuccino Coffee', 1, 25000.00, '2025-01-02 19:37:27', '2025-01-02 19:42:15'),
(111, 67, 'custom_menu', -99, 'xl', 'Mozzarella Cheese, Cheddar Cheese, Parmesan Cheese, Blue Cheese, Grilled Chicken, Pepperoni, Spicy Sausage, Smoked Ham, Ground Beef', 1, 94500.00, '2025-01-02 19:39:37', '2025-01-02 19:39:37'),
(115, 70, 'normal_menu', 7, 'lg', 'Chicken Pizza', 2, 70000.00, '2025-01-02 20:21:59', '2025-01-02 20:21:59'),
(116, 71, 'custom_menu', -99, 'md', 'Mozzarella Cheese, Cheddar Cheese, Parmesan Cheese, Blue Cheese, Grilled Chicken', 1, 44500.00, '2025-01-02 20:24:46', '2025-01-02 20:24:46'),
(117, 71, 'normal_menu', 7, 'sm', 'Chicken Pizza', 2, 50000.00, '2025-01-02 20:24:55', '2025-01-02 20:24:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_transaction_location`
--

CREATE TABLE `order_transaction_location` (
  `order_transaction_location_ID` bigint UNSIGNED NOT NULL,
  `order_ID` bigint UNSIGNED NOT NULL,
  `location_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciver_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciver_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciver_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_transaction_location`
--

INSERT INTO `order_transaction_location` (`order_transaction_location_ID`, `order_ID`, `location_label`, `reciver_address`, `reciver_number`, `reciver_name`, `created_at`, `updated_at`) VALUES
(2, 2, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-23 20:19:37', '2024-12-23 20:19:37'),
(3, 3, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-23 20:19:51', '2024-12-23 20:19:51'),
(6, 7, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-25 01:04:17', '2024-12-25 01:04:17'),
(7, 12, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-25 21:59:17', '2024-12-25 21:59:17'),
(8, 15, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-26 22:51:39', '2024-12-26 22:51:39'),
(9, 16, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-27 07:42:42', '2024-12-27 07:42:42'),
(10, 18, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-30 03:32:17', '2024-12-30 03:32:17'),
(11, 19, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-30 03:47:22', '2024-12-30 03:47:22'),
(12, 44, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:04:37', '2024-12-31 20:04:37'),
(13, 49, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:31:10', '2024-12-31 20:31:10'),
(14, 50, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:40:58', '2024-12-31 20:40:58'),
(15, 51, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:41:40', '2024-12-31 20:41:40'),
(16, 52, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:42:08', '2024-12-31 20:42:08'),
(17, 53, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:44:09', '2024-12-31 20:44:09'),
(18, 53, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:44:23', '2024-12-31 20:44:23'),
(19, 54, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:47:51', '2024-12-31 20:47:51'),
(20, 54, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:47:51', '2024-12-31 20:47:51'),
(21, 54, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:47:51', '2024-12-31 20:47:51'),
(22, 55, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 20:50:10', '2024-12-31 20:50:10'),
(23, 58, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 21:02:53', '2024-12-31 21:02:53'),
(24, 7, 'Apartment', 'Lippo Karawaci 1200, Jl. Boulevard Diponegoro No.105, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Kelvin Tan', '2024-12-31 21:27:46', '2024-12-31 21:27:46'),
(25, 62, 'House', 'Jalan M.H. Thamrin Boulevard No.1100, Klp. Dua, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15811', '081314801945', 'Fransisco Renold doi', '2025-01-02 03:18:52', '2025-01-02 03:18:52'),
(26, 67, 'Hotel', 'UPH universitas pelita harapan benton juction jl hasid hakim 2899 15138', '081314801945', 'Kelvin tan', '2025-01-02 19:44:01', '2025-01-02 19:44:01'),
(27, 70, 'Apartment', 'UPH universitas pelita harapan benton juction jl hasid hakim 2899 15138', '081314801945', 'Kelvin tan', '2025-01-02 20:22:39', '2025-01-02 20:22:39'),
(28, 71, 'Apartment', 'UPH universitas pelita harapan benton juction jl hasid hakim 2899 15138', '081314801945', 'Kelvin tan', '2025-01-02 20:25:43', '2025-01-02 20:25:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_ID`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indeks untuk tabel `customers_location`
--
ALTER TABLE `customers_location`
  ADD PRIMARY KEY (`location_ID`),
  ADD KEY `customers_location_customer_id_foreign` (`customer_ID`);

--
-- Indeks untuk tabel `customers_review`
--
ALTER TABLE `customers_review`
  ADD PRIMARY KEY (`review_ID`),
  ADD KEY `customers_review_customer_id_foreign` (`customer_ID`),
  ADD KEY `customers_review_menu_id_foreign` (`menu_ID`);

--
-- Indeks untuk tabel `custom_categories_pizza`
--
ALTER TABLE `custom_categories_pizza`
  ADD PRIMARY KEY (`categories_ID`);

--
-- Indeks untuk tabel `custom_categories_properties`
--
ALTER TABLE `custom_categories_properties`
  ADD PRIMARY KEY (`properties_ID`),
  ADD KEY `custom_categories_properties_categories_id_foreign` (`categories_ID`);

--
-- Indeks untuk tabel `custom_categories_size_properties`
--
ALTER TABLE `custom_categories_size_properties`
  ADD PRIMARY KEY (`size_ID`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `favorite_menu`
--
ALTER TABLE `favorite_menu`
  ADD PRIMARY KEY (`favorit_ID`),
  ADD KEY `favorite_menu_customer_id_foreign` (`customer_ID`),
  ADD KEY `favorite_menu_menu_id_foreign` (`menu_ID`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`menu_ID`);

--
-- Indeks untuk tabel `menu_properties`
--
ALTER TABLE `menu_properties`
  ADD PRIMARY KEY (`property_ID`),
  ADD KEY `menu_properties_menu_id_foreign` (`menu_ID`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_transaction`
--
ALTER TABLE `order_transaction`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `order_transaction_customer_id_foreign` (`customer_ID`);

--
-- Indeks untuk tabel `order_transaction_details`
--
ALTER TABLE `order_transaction_details`
  ADD PRIMARY KEY (`order_detail_ID`),
  ADD KEY `order_transaction_details_order_id_foreign` (`order_ID`);

--
-- Indeks untuk tabel `order_transaction_location`
--
ALTER TABLE `order_transaction_location`
  ADD PRIMARY KEY (`order_transaction_location_ID`),
  ADD KEY `order_transaction_location_order_id_foreign` (`order_ID`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `customers_location`
--
ALTER TABLE `customers_location`
  MODIFY `location_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `customers_review`
--
ALTER TABLE `customers_review`
  MODIFY `review_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `custom_categories_pizza`
--
ALTER TABLE `custom_categories_pizza`
  MODIFY `categories_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `custom_categories_properties`
--
ALTER TABLE `custom_categories_properties`
  MODIFY `properties_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `custom_categories_size_properties`
--
ALTER TABLE `custom_categories_size_properties`
  MODIFY `size_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `favorite_menu`
--
ALTER TABLE `favorite_menu`
  MODIFY `favorit_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `menu_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `menu_properties`
--
ALTER TABLE `menu_properties`
  MODIFY `property_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `order_transaction`
--
ALTER TABLE `order_transaction`
  MODIFY `order_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `order_transaction_details`
--
ALTER TABLE `order_transaction_details`
  MODIFY `order_detail_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel `order_transaction_location`
--
ALTER TABLE `order_transaction_location`
  MODIFY `order_transaction_location_ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `customers_location`
--
ALTER TABLE `customers_location`
  ADD CONSTRAINT `customers_location_customer_id_foreign` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `customers_review`
--
ALTER TABLE `customers_review`
  ADD CONSTRAINT `customers_review_customer_id_foreign` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_review_menu_id_foreign` FOREIGN KEY (`menu_ID`) REFERENCES `menu_items` (`menu_ID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `custom_categories_properties`
--
ALTER TABLE `custom_categories_properties`
  ADD CONSTRAINT `custom_categories_properties_categories_id_foreign` FOREIGN KEY (`categories_ID`) REFERENCES `custom_categories_pizza` (`categories_ID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `favorite_menu`
--
ALTER TABLE `favorite_menu`
  ADD CONSTRAINT `favorite_menu_customer_id_foreign` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_menu_menu_id_foreign` FOREIGN KEY (`menu_ID`) REFERENCES `menu_items` (`menu_ID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menu_properties`
--
ALTER TABLE `menu_properties`
  ADD CONSTRAINT `menu_properties_menu_id_foreign` FOREIGN KEY (`menu_ID`) REFERENCES `menu_items` (`menu_ID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_transaction`
--
ALTER TABLE `order_transaction`
  ADD CONSTRAINT `order_transaction_customer_id_foreign` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_transaction_details`
--
ALTER TABLE `order_transaction_details`
  ADD CONSTRAINT `order_transaction_details_order_id_foreign` FOREIGN KEY (`order_ID`) REFERENCES `order_transaction` (`order_ID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_transaction_location`
--
ALTER TABLE `order_transaction_location`
  ADD CONSTRAINT `order_transaction_location_order_id_foreign` FOREIGN KEY (`order_ID`) REFERENCES `order_transaction` (`order_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
