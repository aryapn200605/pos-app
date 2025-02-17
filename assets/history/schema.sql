CREATE TABLE `users` (
  `id` char(36) PRIMARY KEY,
  `name` varchar(100),
  `username` varchar(50) UNIQUE,
  `password` varchar(255),
  `printer` varchar(50),
  `created_at` timestamp
);

CREATE TABLE `transaction` (
  `id` char(36) PRIMARY KEY,
  `product_name` varchar(100),
  `total_price` varchar(100),
  `unit_price` varchar(100),
  `quantity` integer,
  `batch_id` char(36)
);

CREATE TABLE `transaction_batch` (
  `id` char(36) PRIMARY KEY,
  `invoice` varchar(50) UNIQUE,
  `deadline` timestamp,
  `customer_name` varchar(100),
  `note` text,
  `type` varchar(50),
  `status` integer(11),
  `created_at` timestamp,
  `created_by` char(36)
);

CREATE TABLE `transaction_history` (
  `id` char(36) PRIMARY KEY,
  `batch_id` char(36),
  `paid_amount` varchar(100),
  `payment_method` integer(11),
  `status` integer(11),
  `created_at` timestamp,
  `created_by` char(36)
);

ALTER TABLE `transaction` ADD FOREIGN KEY (`batch_id`) REFERENCES `transaction_batch` (`id`);

ALTER TABLE `transaction_history` ADD FOREIGN KEY (`batch_id`) REFERENCES `transaction_batch` (`id`);

ALTER TABLE `transaction_batch` ADD FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

ALTER TABLE `transaction_history` ADD FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
