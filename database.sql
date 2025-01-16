CREATE Database users;

CREATE TABLE users (
  id int(200) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  firstName varchar(255) NOT NULL,
  lastName varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  pass_word varchar(300) NOT NULL,
  `profile_pic` mediumtext DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`links`)),
  `gender` enum('Male','Female') DEFAULT NULL,
  `relationship` enum('None','Single','Married','Engaged','In Relationship') NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dumping data for table `users`
INSERT INTO `users` (id, `username`, firstName, lastName, email, pass_word, `profile_pic`, `bio`, `links`, `gender`, `relationship`)
VALUES
('1', 'user001', 'Jina la kwanza', 'la mwisho', 'user01@gmail.com', '$2y$10$HDCKdTKf6H3GccOmkUE62ubblhYribT1aJAye7kYaFjrXkV4bKtfe', 'user0016777f6efb73aa9.46776440png', 'groupone', NULL, 'Male', 'Married');