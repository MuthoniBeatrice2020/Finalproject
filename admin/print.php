<?php
session_start();
if (isset($_SESSION['input'])){
    
    require "vendor/autoload.php";

    //proper barcode file naming
    if(strstr($_SESSION['regNo'], '-')){
        $out1=str_replace('-','.',$_SESSION['regNo']);
        $out2=str_replace('/','.',$out1);
    }

    if(isset($out2)){
        $filename = $out2;
    }

    $Bar = new Picqer\Barcode\BarcodeGeneratorPNG();
    //gd extension to be enabled in php.ini 
    file_put_contents('barcodes/'.$filename.'.png', $Bar->getBarcode($_SESSION['input'], $Bar::TYPE_CODE_128, 3, 50));

?>
<!DOCTYPE html>
<html>
    <head></head>
<body>
    <img src="barcodes/<?php echo $filename;?>.png">
</body>
</html>
<script>
    window.print();
</script>
<?php 
    unset($_SESSION['input']);
    unset($_SESSION['regNo']);
}else{
    header('location: devices.php');
}
?>