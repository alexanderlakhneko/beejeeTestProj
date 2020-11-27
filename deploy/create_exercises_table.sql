CREATE TABLE `exercises` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
	`text` text NOT NULL,
	`is_finish` bool DEFAULT false ,
	`is_edit_by_admin` bool DEFAULT false ,
	primary key( `exercises_id` )
);