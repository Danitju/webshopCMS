<?php

//Placing the image in the right map 
$temp_location=$_FILES['myfile']['tmp_name'];
$target_location= 'image/' . time() . $_FILES['myfile']['name'];

move_uploaded_file($temp_location, $target_location) or die ('Error moving file.');

$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];

$title = htmlentities($title,ENT_QUOTES,'utf-8');
$price = htmlentities($price,ENT_QUOTES,'utf-8');
$description = htmlentities($description,ENT_QUOTES,'utf-8');

$mysqli = new mysqli('localhost','ikbendani_dani','dani26','ikbendani_dani') or die ('Error connecting');
$query = "INSERT INTO uploaddb VALUES (0,?,?,?,?)";
$stmt = $mysqli->prepare($query) or die ('Error preparing 1');
$stmt->bind_param('sss',$target_location,$title,$price,$description) or die ('Error binding params');
$stmt->execute() or die ('Error inserting data in database');
$stmt->close();

