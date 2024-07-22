<?php
require_once 'model/CobroModel.php';

$model = new AutenticacionModel();

$sizes = $model->getPaperSizes();
$types = $model->getPaperTypes();
$printTypes = $model->getPrintTypes();

$response = [
    'sizes' => $sizes,
    'types' => $types,
    'printTypes' => $printTypes
];

echo json_encode($response);
?>
