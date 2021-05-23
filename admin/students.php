<?php
    require 'layout/header.php';
    require 'sidebar.php';
?>
    <div class="mt-3">
        <h5>
            <i class="fas fa-users-cog"></i>
            Manage Students
            <hr>
        </h5>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary float-left" id="viewUsersToggle">
            <i class="fas fa-user-graduate"></i>
            View Students
        </button>
        <button class="btn btn-primary float-right" id="addUsersToggle">
            <i class="fas fa-user-plus"></i>
            Add Student
        </button>
    </div>
    <div class="clearfix mb-3"></div>
    <hr>
    <div class="card shadow" id="viewUsers">
        <div class="card-header">
            <h6 class="m-0 text-monospace font-weight-bold text-primary">List of Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display nowrap" id="usersTable">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Reg No</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">ID No</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Password</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                        $stm= $conn->prepare("SELECT * FROM students ORDER BY id");
                        $stm->execute();
                                    
                        if ($stm->rowCount() > 0){
                            while ($userRow= $stm->fetch(PDO::FETCH_ASSOC)) {

                            echo "
                                <tr>
                                    <td id='$userRow[ID]'>" . $userRow['ID'] . "</td>
                                    <td id='$userRow[RegNo]'>" . $userRow['RegNo'] . "</td>
                                    <td id='$userRow[FirstName]'>" . $userRow['FirstName'] . "</td>
                                    <td id='$userRow[LastName]'>" . $userRow['LastName'] . "</td>
                                    <td id='$userRow[IDNo]'>" . $userRow['IDNo'] . "</td>
                                    <td id='$userRow[Faculty]'>" . $userRow['Faculty'] . "</td>
                                    <td><a href='edit_students.php?edit=$userRow[ID]' class='btn badge badge-info'><i class='fas fa-edit'></i> edit</a></td>
                                    <td><a href='reset_students_password.php?reset=$userRow[ID]'><i class='fas fa-user-shield'></i> change</a></td> 
                                </tr>
                                ";
                            }
                            
                        }else{
                            echo "<div class='alert alert-danger'>No Student records found</div>";
                            // die();
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="card w-75 shadow mx-auto" id="addUsers">
        <div class="card-header">
            <span class="card-title text-primary text-monospace font-weight-bold">Add Student Device [User]</span>
        </div>
        <div class="card-body">
            <div class="notify alert"><span>X</span>
                <p></p>
            </div>
            <form id="userForm" autocomplete="off">
                <div class="row">
                    <div class="form-group col">                
                        <input type="text" name="regNo" id="regNo" class="form-control" placeholder="Reg No">
                        <small class="form-text text-muted">Enter Student RegNo</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                    <div class="form-group col">
                        <input type="text" name="idNo" class="form-control" id="idNo" placeholder="ID Number">
                        <small class="form-text text-muted">Enter Student ID Number</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="firstName" class="form-control" id="firstName"  placeholder="First Name">
                        <small class="form-text text-muted">Enter Student First Name</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                    <div class="form-group col">
                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name">
                        <small class="form-text text-muted">Enter Student Last Name</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                </div>    
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="serialNo" id="serialNo" class="form-control" placeholder="Device's Serial No">
                        <small class="form-text text-muted">Enter your Device's Serial No</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                    <div class="form-group col">
                        <select name="model" class="form-control " id="model" placeholder="Device's Model">
                            <option class="text-muted" value="">Device's Model</option>
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
                </div>
                <div class="form-group">
                        <input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty">
                        <small class="form-text text-muted">Enter your Faculty</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                <div class="row">
                    <div class="form-group col">
                        <input type="password" name="password1" class="form-control " id="password1" placeholder="Create Password">
                        <small class="form-text text-muted">Create Password (Should be at least 8 characters)</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                    <div class="form-group col">
                        <input type="password" name="password2" class="form-control" id="password2" placeholder="Confirm Password">
                        <small class="form-text text-muted">Confirm Password</small>
                        <small class="form-text text-danger font-italic font-weight-bold"></small>
                    </div>
                </div>
                <button class="btn btn-primary float-right" id="addUser">
                    <i class="fas fa-user-plus"></i>
                    Sign Up
                </button>
            </form>
        </div>
    </div>
    
<?php include 'layout/footer.php';?>