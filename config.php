<?php
// Database connection settings - CAT2 database
$DB_HOST = "localhost";
$DB_USER = "cat2user";
$DB_PASS = "Cat2Pass!";
$DB_NAME = "CAT2";

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
session_start();
