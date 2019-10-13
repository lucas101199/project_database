-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 13, 2019 at 10:48 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
                           `number` int(11) NOT NULL,
                           `userId` int(11) NOT NULL,
                           `balance` decimal(11,4) NOT NULL,
                           `currency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`number`, `userId`, `balance`, `currency`) VALUES
(1, 2, '897.0000', 1),
(2, 3, '2342.0000', 1),
(3, 2, '2332.0000', 1),
(4, 2, '1234.0000', 1),
(5, 2, '1234.0000', 1),
(6, 2, '9500.0000', 1),
(7, 2, '0.0000', 1),
(8, 2, '0.0000', 2),
(9, 2, '54.0000', 3),
(10, 2, '93.6364', 3);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
                            `id` int(11) NOT NULL,
                            `name` varchar(255) NOT NULL,
                            `value` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `value`) VALUES
(1, 'EUR', '1.0000'),
(2, 'USD', '1.1043'),
(3, 'AUD', '1.6246');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
                                `id` int(11) NOT NULL,
                                `from_account` int(11) NOT NULL,
                                `to_account` int(11) NOT NULL,
                                `amount` int(11) NOT NULL,
                                `currency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `from_account`, `to_account`, `amount`, `currency`) VALUES
(8, 1, 5, 13, 1),
(9, 1, 6, 3, 1),
(10, 1, 6, 100, 1),
(11, 1, 6, 9000, 1),
(12, 8, 9, 50, 2),
(13, 8, 10, 50, 2),
(14, 9, 10, 10, 3),
(15, 9, 10, 10, 3);

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `update_account` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
    DECLARE balance_user integer;
    DECLARE balance_user_to integer;
    DECLARE currency_account_from integer;
    DECLARE currency_account_to integer;
    DECLARE convert_amount integer;

    SET @currency_account_from :=
            (SELECT value
             FROM account JOIN currency
                               ON account.currency=currency.id
             WHERE account.number=NEW.from_account);

    SET @currency_account_to :=
            (SELECT value
             FROM account JOIN currency
                               ON account.currency=currency.id
             WHERE account.number=NEW.to_account);

    SET @convert_amount := NEW.amount/@currency_account_from * 		@currency_account_to;

    SET @balance_user := (SELECT balance
                          FROM account
                          WHERE number=NEW.from_account) - NEW.amount;

    SET @balance_user_to := (SELECT balance
                             FROM account
                             WHERE number=NEW.to_account) + 	@convert_amount;

    UPDATE account SET balance=@balance_user WHERE
            number=NEW.from_account;

    UPDATE account SET balance=@balance_user_to WHERE
            number=NEW.to_account;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `name` varchar(255) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        `password` varchar(255) NOT NULL,
                        `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `admin`) VALUES
(2, 'test', 'test@test.test', 'test', 0),
(3, 'lucas', 'lucas@lucas.lucas', 'azert', 0),
(4, 'ldz', 'da@ja.da', 'zd', 0),
(5, 'lus', 'lus@lus.lus', 'lus', 0),
(6, 'admin', 'admin@admin.admin', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
    ADD PRIMARY KEY (`number`),
    ADD KEY `user_fk` (`userId`),
    ADD KEY `currency_acc_fk` (`currency`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
    ADD PRIMARY KEY (`id`),
    ADD KEY `from_account_fk` (`from_account`),
    ADD KEY `to_account_fk` (`to_account`),
    ADD KEY `currency_fk` (`currency`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
    MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
    ADD CONSTRAINT `currency_acc_fk` FOREIGN KEY (`currency`) REFERENCES `currency` (`id`),
    ADD CONSTRAINT `user_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
    ADD CONSTRAINT `currency_fk` FOREIGN KEY (`currency`) REFERENCES `currency` (`id`),
    ADD CONSTRAINT `from_account_fk` FOREIGN KEY (`from_account`) REFERENCES `account` (`number`),
    ADD CONSTRAINT `to_account_fk` FOREIGN KEY (`to_account`) REFERENCES `account` (`number`);
