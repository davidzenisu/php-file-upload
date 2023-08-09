<?php
header("Access-Control-Allow-Origin: *"); 

$target_dir = "uploads";
$uploadOk = 1;
$fileName = $_POST["fileName"];
$fileType = strtolower($_POST["fileType"]);
$target_file = "$target_dir/$fileName.$fileType";

if (!isset( $_FILES["fileToUpload"])) {
  echo "Sorry, no file uploaded.";
  $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  http_response_code(400);
// if everything is ok, try to upload file
} else {
  echo "Want to upload to:";
  // echo $_FILES["fileToUpload"]["name"];
  echo $target_file;
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    http_response_code(200);
  } else {
    echo "Sorry, there was an error uploading your file.";
    http_response_code(500);
  }
}
?>