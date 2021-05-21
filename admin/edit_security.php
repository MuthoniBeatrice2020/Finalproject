<?php
    require 'layout/header.php';
    require 'sidebar.php';

    if((isset($_GET['edit'])) && (is_numeric($_GET['edit']))){
        $securityID= $_GET['edit'];
        $stm= $conn->prepare("SELECT * FROM security WHERE ID=:sid");
        $stm->bindParam('sid', $securityID, PDO::PARAM_INT);
        $value=$stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
    }
?>
    <div class="mt-3">
        <h5>
            <i class="fas fa-user-tie"></i>
            Edit Security
            <hr>
        </h5>
    </div>
    <div class="mb-3">
        <a class="btn float-left" href="security.php">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
    <div class="clearfix mb-3"></div>
    <div class="card w-75 shadow mx-auto" id="editSecurity">
        <div class="card-header">
            <span class="card-title text-primary text-monospace font-weight-bold">Edit Security [Guard]</span>
        </div>
        <div class="card-body">
            <div class="notify alert"><span>X</span>
                <p></p>
            </div>
            <form id="editSecurityForm" autocomplete="off">
                <input type="text" name="securityId" id="securityId" class="form-control" value="<?php if(isset($securityID)){echo $securityID;}?>" 
                placeholder="securityId" hidden>
                <div class="form-group">
                    <input type="text" name="idNo" id="idNo" class="form-control" 
                    value="<?php if(isset($row['IDNo'])){echo $row['IDNo'];}?>">
                    <small class="form-text text-muted">Edit Security ID Number</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group">
                    <input type="text" name="firstName" id="firstName" class="form-control" 
                    value="<?php if(isset($row['FirstName'])){echo $row['FirstName'];}?>">
                    <small class="form-text text-muted">Edit Security First Name</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group">
                    <input type="text" name="lastName" class="form-control" id="lastName" 
                    value="<?php if(isset($row['LastName'])){echo $row['LastName'];}?>">
                    <small class="form-text text-muted">Edit Security Last Name</small>
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