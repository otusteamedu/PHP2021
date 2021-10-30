<?php
try {
	$db = new PDO('mysql:host=db;dbname=testdb', 'root', 'qwerty123!wq');
} catch(PDOException $e){
  echo "Error!: " . $e->getMessage();
  die();
}
