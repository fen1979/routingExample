<?php
// marinaDB connection using RED BEAN PHP or ANY not critical!!!
require "rb-mysql.php";
R::setup('mysql:host=localhost;dbname=your-db-name', 'your-name', 'your-password');

if (!R::testConnection()) {
    exit ('No database connection');
}

session_start();

// Cache-Control и Pragma

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');
