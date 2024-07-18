<?php
require_once '../vendor/autoload.php'; // Asegúrate de la ruta correcta al autoloader
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class GenerarQRController {
    public static function generarQR($data) {
        $qrCode = new QrCode(json_encode($data));
        $qrCode->setSize(300);
        
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        
        $filename = '../qrcodes/' . uniqid() . '.png';
        $result->saveToFile($filename);
        
        return $filename;
    }
}
?>
