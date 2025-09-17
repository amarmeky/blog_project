<?php
session_start();
$hostname = 'localhost';
$name = 'root';
$password = '';
$dbname = 'blog_project';
$conn = mysqli_connect($hostname, $name, $password, $dbname);
