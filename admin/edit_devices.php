<?php
    require 'layout/header.php';
    require 'sidebar.php';

    if((isset($_GET['edit'])) && (is_numeric($_GET['edit']))){
        $deviceID= $_GET['edit'];
        $stm= $conn->prepare("SELECT * FROM devices WHERE ID=:sid");
        $stm->bindParam('sid', $deviceID, PDO::PARAM_INT);
        $value=$stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
    }
?>
    <div class="mt-3">
        <h5>
            <i class="fas fa-pc"></i>
            Edit Device
            <hr>
        </h5>
    </div>
    <div class="mb-3">
        <a class="btn float-left" href="devices.php">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
    <div class="clearfix mb-3"></div>
    <div class="card w-75 shadow mx-auto" id="editDevice">
        <div class="card-header">
            <span class="card-title text-primary text-monospace font-weight-bold">Edit Device</span>
        </div>
        <div class="card-body">
            <div class="notify alert"><span>X</span>
                <p></p>
            </div>
            <form id="editDeviceForm" autocomplete="off">
                <input type="text" name="deviceID" id="deviceID" class="form-control" value="<?php if(isset($deviceID)){echo $deviceID;}?>" 
                placeholder="deviceID" hidden>
                <div class="form-group">
                <input type="text" name="serialNo" id="serialNo" class="form-control"
                    value="<?php if(isset($row['SerialNo'])){echo $row['SerialNo'];}?>">
                    <small class="form-text text-muted">Edit Device Serial Number</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group">
                    <select name="model" class="form-control " id="model">
                        <option class="badge-info" value="<?php if(isset($row['Model'])){echo $row['Model'];}?>"><?php if(isset($row['Model'])){echo $row['Model'];}?></option>
                        <option value="HP">HP</option>
                        <option value="Dell">Dell</option>
                        <option value="Lenovo">Lenovo</option>
                        <option value="MacBook">MacBook</option>
                        <option value="Acer">Acer</option>
                        <option value="Asus">Asus</option>
                    </select>
                    <small class="form-text text-muted">Select your Device's Model</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group">
                    <select name="status" class="form-control " id="status">
                        <option class="badge-info" value="">Device's Status</option>
                        <option value="active">Active</option>
                        <option value="stolen">Stolen</option>
                    </select>
                    <small class="form-text text-muted">Select your Device's Status</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <button class="btn btn-primary float-right" id="editUser">
                    <i class="fas fa-paper-plane"></i>
                    Save
                </button>
            </form>
        </div>
    </div>
    <?php include 'layout/footer.php';?>