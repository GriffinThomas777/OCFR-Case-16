<?php

require 'common.php';

// Step 1: Get a datase connection from our helper class
$db = DbConnection::getConnection();

// Step 2: Create & run the query
$sql = 'SELECT * FROM Members';
$vars = [];

if (isset($_GET['Member_ID'])) {
  // This is an example of a parameterized query
  $sql = 'SELECT * FROM Members WHERE Member_ID = ?';
  $vars = [ $_GET['Member_ID'] ];
}

$stmt = $db->prepare($sql);
$stmt->execute($vars);

$patients = $stmt->fetchAll();

// Step 3: Convert to JSON
$json = json_encode($patients, JSON_PRETTY_PRINT);

// Step 4: Output
header('Content-Type: application/json');
echo $json;