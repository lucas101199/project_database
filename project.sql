-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2019 at 02:36 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `value` decimal(10,4) NOT NULL,
  `TST` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `value`, `TST`) VALUES
(1, 'EUR', '1.0000', '2019-10-18 00:00:00'),
(2, 'USD', '0.9003', '2019-10-25 16:31:44'),
(3, 'AUD', '0.6146', '2019-10-25 16:31:44'),
(4, 'JPY', '0.0083', '2019-10-25 15:28:20'),
(5, 'BGN', '0.5113', '2019-10-25 15:28:20'),
(6, 'CZK', '0.0391', '2019-10-25 15:28:20'),
(7, 'DKK', '0.1339', '2019-10-25 15:28:20'),
(8, 'GBP', '1.1589', '2019-10-25 15:28:20'),
(9, 'HUF', '0.0030', '2019-10-25 15:28:20'),
(10, 'PLN', '0.2338', '2019-10-25 15:28:20'),
(11, 'RON', '0.2104', '2019-10-25 15:28:20'),
(12, 'SEK', '0.0935', '2019-10-25 15:28:20'),
(13, 'CHF', '0.9075', '2019-10-25 15:28:20'),
(14, 'ISK', '0.0072', '2019-10-25 15:28:20'),
(15, 'NOK', '0.0987', '2019-10-25 15:28:20'),
(16, 'HRK', '0.1342', '2019-10-25 15:28:20'),
(17, 'RUB', '0.0140', '2019-10-25 15:28:20'),
(18, 'TRY', '0.1556', '2019-10-25 15:28:20'),
(19, 'BRL', '0.2227', '2019-10-25 15:28:20'),
(20, 'CAD', '0.6875', '2019-10-25 15:28:20'),
(21, 'CNY', '0.1271', '2019-10-25 15:28:20'),
(22, 'HKD', '0.1146', '2019-10-25 15:28:20'),
(23, 'IDR', '0.0001', '2019-10-25 15:28:20'),
(24, 'ILS', '0.2550', '2019-10-25 15:28:20'),
(25, 'INR', '0.0127', '2019-10-25 15:28:20'),
(26, 'KRW', '0.0008', '2019-10-25 15:28:20'),
(27, 'MXN', '0.0470', '2019-10-25 15:28:20'),
(28, 'MYR', '0.2147', '2019-10-25 15:28:20'),
(29, 'NZD', '0.5747', '2019-10-25 15:28:20'),
(30, 'PHP', '0.0175', '2019-10-25 15:28:20'),
(31, 'SGD', '0.6595', '2019-10-25 15:28:20'),
(32, 'THB', '0.0297', '2019-10-25 15:28:20'),
(33, 'ZAR', '0.0614', '2019-10-25 15:28:20');

--
-- Triggers `currency`
--
DELIMITER $$
CREATE TRIGGER `move_to_history` BEFORE UPDATE ON `currency` FOR EACH ROW BEGIN
    	INSERT INTO `currency_history`
        SET name = OLD.name,
        value = OLD.value,
        TST = OLD.TST,
        TET = FROM_UNIXTIME(UNIX_TIMESTAMP(CURRENT_TIMESTAMP()));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `currency_history`
--

CREATE TABLE `currency_history` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` decimal(10,4) NOT NULL,
  `TST` datetime NOT NULL,
  `TET` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency_history`
--

INSERT INTO `currency_history` (`id`, `name`, `value`, `TST`, `TET`) VALUES
(1, 'AUD', '1.6246', '2019-10-18 00:00:00', '2019-10-18 15:29:47'),
(2, 'USD', '1.1043', '2019-10-18 00:00:00', '2019-10-25 16:26:07'),
(3, 'AUD', '1.6247', '2019-10-18 00:00:00', '2019-10-25 16:26:07'),
(4, 'USD', '0.9003', '2019-10-18 00:00:00', '2019-10-25 16:31:44'),
(5, 'AUD', '0.6146', '2019-10-18 00:00:00', '2019-10-25 16:31:44');

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
CREATE TRIGGER `Hash` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN

    DECLARE id integer;
    DECLARE from_account integer;
    DECLARE to_account integer;
    DECLARE currency integer;
    DECLARE current_hash BINARY(32);
    DECLARE prev_id integer;
    DECLARE prev_hash BINARY(32);

    SET @id := NEW.id;
    SET @from_account := NEW.from_account;
    SET @to_account := NEW.to_account;
    SET @currency := NEW.currency;
    SET @current_hash := md5(@id + @from_account + @to_account + 		@currency);
    SELECT id INTO @prev_id FROM Transactions_block ORDER BY id DESC LIMIT 1;
    SET @prev_hash := (SELECT CurrentHash FROM Transactions_block WHERE id=1);

    INSERT INTO Transactions_block(Transactions_id, CurrentHash) VALUES(@id, @current_hash);

    UPDATE Transactions_block SET Prev_id=22
    WHERE id=23;

END
$$
DELIMITER ;
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
-- Table structure for table `Transactions_block`
--

CREATE TABLE `Transactions_block` (
                                      `id` int(11) NOT NULL,
                                      `Transactions_id` int(11) NOT NULL,
                                      `CurrentHash` binary(32) NOT NULL,
                                      `Prev_id` int(11) DEFAULT NULL,
                                      `Prev_hash` binary(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Transactions_block`
--

INSERT INTO `Transactions_block` (`id`, `Transactions_id`, `CurrentHash`, `Prev_id`, `Prev_hash`) VALUES
(1, 17, 0x3334313733636233386630376638396464626562633261633931323833303366, NULL, NULL),
(2, 18, 0x3334313733636233386630376638396464626562633261633931323833303366, NULL, NULL),
(3, 21, 0x3665613961623162616130656662396531393039343434306333313765323162, NULL, NULL),
(4, 22, 0x3163333833636433306237633239386162353032393361646665636237623138, NULL, NULL),
(5, 23, 0x3334313733636233386630376638396464626562633261633931323833303366, NULL, NULL),
(6, 24, 0x6533363938353364663736366661343465316564306666363133663536336264, NULL, NULL),
(10, 29, 0x6634353763353435613964656438386631386563656534373134356137326330, NULL, NULL),
(16, 32, 0x3634326539326566623739343231373334383831623533653165316231386236, 10, 0x6634353763353435613964656438386631386563656534373134356137326330),
(17, 38, 0x6136383465636565653736666335323237373332383661383935626338343336, NULL, NULL),
(18, 39, 0x6634353763353435613964656438386631386563656534373134356137326330, NULL, 0x6634353763353435613964656438386631386563656534373134356137326330),
(19, 40, 0x3961313135383135346466613432636164646264303639346134653962646338, NULL, NULL),
(20, 41, 0x6438326338643136313961643831373664363635343533636662326535356630, NULL, NULL),
(21, 42, 0x6330633763373664333062643364636165666339366634303237356264633061, NULL, NULL),
(22, 43, 0x6136383465636565653736666335323237373332383661383935626338343336, NULL, NULL),
(23, 44, 0x3037326230333062613132366232663462323337346633343262653965643434, 22, NULL),
(24, 45, 0x3766333966383331376662646231393838656634633632386562613032353931, NULL, NULL),
(25, 46, 0x3033616664626436366537393239623132356638353937383334666138336134, NULL, NULL),
(26, 47, 0x3636663034316531366136303932386230356137653232386138396333373939, NULL, NULL),
(27, 48, 0x3037326230333062613132366232663462323337346633343262653965643434, NULL, NULL);


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
-- Indexes for table `currency_history`
--
ALTER TABLE `currency_history`
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
-- Indexes for table `Transactions_block`
--
ALTER TABLE `Transactions_block`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `Prev_id` (`Prev_id`),
    ADD KEY `FK_Transactions` (`Transactions_id`);

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
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `currency_history`
--
ALTER TABLE `currency_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Transactions_block`
--
ALTER TABLE `Transactions_block`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `currency_fk` FOREIGN KEY (`currency`) REFERENCES `currency` (`id`),
  ADD CONSTRAINT `from_account_fk` FOREIGN KEY (`from_account`) REFERENCES `account` (`number`),
  ADD CONSTRAINT `to_account_fk` FOREIGN KEY (`to_account`) REFERENCES `account` (`number`);

--
-- Constraints for table `Transactions_block`
--
ALTER TABLE `Transactions_block`
    ADD CONSTRAINT `FK_Transaction_block_PrevID` FOREIGN KEY (`Prev_id`) REFERENCES `Transactions_block` (`id`),
    ADD CONSTRAINT `FK_Transactions` FOREIGN KEY (`Transactions_id`) REFERENCES `transactions` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
