<?php
    require 'layout/header.php';
    require 'sidebar.php';

    if(isset($_GET['reset'])){
        $securityID= $_GET['reset'];
        $stm= $conn->prepare("SELECT * FROM security WHERE ID=:sid");
        $stm->bindParam('sid', $securityID, PDO::PARAM_INT);
        $value=$stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
    }

?>

    <div class="mt-3">
        <h5>
            <i class="fas fa-user-shield"></i>
            Reset User Password
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
    <div class="card w-75 shadow mx-auto" id="passSecurity">
        <div class="card-header">
            <span class="card-title text-primary text-monospace font-weight-bold">Change Security [Guard] Password</span>
        </div>
        <div class="card-body">
            <div class="notify alert"><span>X</span>
                <p></p>
            </div>
            <form id="passSecurityForm" autocomplete="off">
                <input type="text" name="securityId" id="securityId" class="form-control" value="<?php if(isset($securityID)){echo $securityID;}?>" 
                hidden>
                <div class="form-group">
                    <input type="text" name="currentPass" id="currentPass" class="form-control">
                    <small class="form-text text-muted">Enter Current Password</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group">
                    <input type="text" name="newPass" id="newPass" class="form-control">
                    <small class="form-text text-muted">Enter New Password</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group">
                    <input type="text" name="confirmPass" id="confirmPass" class="form-control">
                    <small class="form-text text-muted">Confirm New Password</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <button class="btn btn-primary float-right" id="changeSecurity">
                    <i class="fas fa-paper-plane"></i>
                    Save
                </button>
            </form>
        </div>
    </div>
    <?php include 'layout/footer.php';?>