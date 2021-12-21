#First - create a table in your local DB
CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`f_name` varchar(100) NOT NULL,
`l_name` varchar(100) NOT NULL,
`email` varchar(100) NOT NULL,
`phone` varchar(100) NOT NULL,
`password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# mvc-reg-recman
