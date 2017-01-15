CREATE TABLE `ANSWER` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quest` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `answer` text COLLATE utf8_polish_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci


CREATE TABLE `LOG` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `ip` text COLLATE utf8_polish_ci NOT NULL,
  `agent` text COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci


CREATE TABLE `MSG` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_send` text COLLATE utf8_polish_ci NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `msg` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci


CREATE TABLE `QUEST` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `like` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `title` text COLLATE utf8_polish_ci NOT NULL,
  `quest` text COLLATE utf8_polish_ci NOT NULL,
  `category` text COLLATE utf8_polish_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci


CREATE TABLE `USERS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text CHARACTER SET latin1 NOT NULL,
  `pass` text CHARACTER SET latin1 NOT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `query` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `auto_notifications` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=COMPACT