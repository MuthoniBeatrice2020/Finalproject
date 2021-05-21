<?php
    require 'layout/header.php';
    require 'sidebar.php';

    if((isset($_GET['edit'])) && (is_numeric($_GET['edit']))){
        $studentID= $_GET['edit'];
        $stm= $conn->prepare("SELECT * FROM students WHERE ID=:sid");
        $stm->bindParam('sid', $studentID, PDO::PARAM_INT);
        $value=$stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
    }
?>
    <div class="mt-3">
        <h5>
            <i class="fas fa-users-cog"></i>
            Edit Students
            <hr>
        </h5>
    </div>
    <div class="mb-3">
        <a class="btn float-left" href="students.php">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
    <div class="clearfix mb-3"></div>
    <div class="card w-75 shadow mx-auto" id="editUsers">
        <div class="card-header">
            <span class="card-title text-primary text-monospace font-weight-bold">Edit Student [User]</span>
        </div>
        <div class="card-body">
            <div class="notify alert"><span>X</span>
                <p></p>
            </div>
            <form id="editUserForm" autocomplete="off">
                <input type="text" name="studentId" id="studentId" class="form-control" value="<?php if(isset($studentID)){echo $studentID;}?>" 
                placeholder="studentId" hidden>
                <div class="row">
                    <div class="form-group col">                
                        <input type="text" name="regNo" id="regNo" class="form-control" 
                        value="<?php if(isset($row['RegNo'])){echo $row['RegNo'];}?>">
                        <small class="form-text text-muted">Edit Student Registration Number</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                    <div class="form-group col">
                        <input type="text" name="idNo" id="idNo" class="form-control" 
                        value="<?php if(isset($row['IDNo'])){echo $row['IDNo'];}?>">
                        <small class="form-text text-muted">Edit Student ID Number</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="firstName" id="firstName" class="form-control" 
                        value="<?php if(isset($row['FirstName'])){echo $row['FirstName'];}?>">
                        <small class="form-text text-muted">Edit Student First Name</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                    <div class="form-group col">
                        <input type="text" name="lastName" class="form-control" id="lastName" 
                        value="<?php if(isset($row['LastName'])){echo $row['LastName'];}?>">
                        <small class="form-text text-muted">Edit Student Last Name</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                </div>    
                <div class="form-group">
                    <input type="text" name="faculty" id="faculty" class="form-control" 
                    value="<?php if(isset($row['Faculty'])){echo $row['Faculty'];}?>">
                    <small class="form-text text-muted">Edit your Faculty</small>
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