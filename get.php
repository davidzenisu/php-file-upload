<?php
header("Access-Control-Allow-Origin: *"); 

$dir    = 'uploads/';
$files = array_values(array_filter(scandir($dir, SCANDIR_SORT_DESCENDING), function($item) {
    return !is_dir('uploads/' . $item);
}));

$response = (object) [
    'uploads' => $files
];

echo json_encode($response);
?>