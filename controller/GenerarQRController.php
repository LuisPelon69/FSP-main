<?php
require_once '../vendor/autoload.php'; // Asegúrate de tener instalada la librería phpqrcode
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
