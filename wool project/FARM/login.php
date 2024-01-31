<?php
$conn = new mysqli('localhost', 'root','');

// create database login
$sql = "CREATE DATABASE login";
mysqli_query($conn,$sql);

// create table name ram
$sql = "CREATE TABLE `ram` (`id` INT(11) NOT NULL AUTO_INCREMENT , `wool_type` VARCHAR(30) NOT NULL ,
 `fiber_length` INT(20) NOT NULL , `fiber_diameter` INT(20) NOT NULL , `staple_length` INT(20) NOT NULL ,
 `cleanliness` INT(11) NOT NULL , `latitude` FLOAT(20) NOT NULL , `longitude` FLOAT(20) NOT NULL , PRIMARY KEY (`id`))";
mysqli_query($conn,$sql);

// create table name transport
$sql = "CREATE TABLE `transport` (`id` INT(11) NOT NULL AUTO_INCREMENT , `wool_type` VARCHAR(30) NOT NULL ,
 `fiber_length` INT(20) NOT NULL , `fiber_diameter` INT(20) NOT NULL , `staple_length` INT(20) NOT NULL ,
  `cleanliness` INT(11) NOT NULL , PRIMARY KEY (`id`)) ";

mysqli_query($conn,$sql);
?>