<?php
    require 'layout/header.php';
    require 'sidebar.php';
    require "vendor/autoload.php";
    //process the device id
    if((isset($_GET['generate'])) && (is_numeric($_GET['generate']))){
        $deviceID= $_GET['generate'];
        
        //get device details using the device id
        $stm= $conn->prepare("SELECT * FROM devices WHERE ID=:did");
        $stm->bindParam('did', $deviceID, PDO::PARAM_INT);
        $value=$stm->execute();

        if($value){
            //extract the device details required(serial no & reg no) to generate the barcode
            $d_row = $stm->fetch(PDO::FETCH_ASSOC);
            $input=$deviceID.'~';
            $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
            $code = $Bar->getBarcode($input, $Bar::TYPE_CODE_128);
            $_SESSION['input'] = $input;
            $_SESSION['regNo'] = $d_row['RegNo'];
        }
        
    }
?>
<div class="mt-3">
    <h5>
        <i class="fas fa-cog"></i>
        Generate Barcode
        <hr>
    </h5>
</div>
<br>
<div class="container">    
    <div class="mx-auto">
        <div class="mb-4">
            <?php echo $code ?>
        </div>
        <div class="">
            <a class="btn btn-primary" href="print.php" target="_blank" id="print">
                <i class="fas fa-print"></i>    
                Save
            </a>
        </div>
    </div>
</div>