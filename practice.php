<?php
    include "phpqrcode\qrlib.php";
    
    $text="Geeks of Geeks";
    QRcode::png($text);
?>