create database reask charset=utf8;

create table reask_admin(
    `admin_id` int unsigned auto_increment not null,
    `admin_username` varchar(20) not null,
    `admin_password` char(32) not null,
    primary key(`admin_id`)
)engine=innodb charset=utf8;

create table reask_version(
    `version_id` int unsigned auto_increment not null,
    `version_code` varchar(15) not null,
    `version_apkname` varchar(50) not null,
    `version_detail` text not null,
    `version_date` char(19) not null,
    primary key(`version_id`)
)engine=innodb charset=utf8;