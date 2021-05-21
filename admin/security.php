<?php
    require 'layout/header.php';
    require 'sidebar.php';
?>
    <div class="mt-3">
        <h5>
            <i class="fas fa-user-tie"></i>
            Manage Security
            <hr>
        </h5>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary float-left" id="viewAgentsToggle">
            <i class="fas fa-users"></i>
            View Guards
        </button>
        <button class="btn btn-primary float-right" id="addAgentsToggle">
            <i class="fas fa-user-plus"></i>
            Add Guards
        </button>
    </div>
    <div class="clearfix mb-3"></div>
    <hr>
    <div class="card shadow" id="viewAgents">
        <div class="card-header">
            <h6 class="m-0 text-monospace font-weight-bold text-primary">List of Guards [security]</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="agentsTable">
                    <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ID Number</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Password</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stm = $conn->prepare("SELECT * FROM security ORDER BY ID");
                    $value = $stm->execute();
                    
                    if($stm->rowCount() > 0) {

                        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

                            echo "
                        <tr>
                            <td>" . $row['ID'] . "</td>
                            <td>" . $row['IDNo'] . "</td>
                            <td>" . $row['FirstName'] . "</td>
                            <td>" . $row['LastName'] . "</td>
                            <td><a href='edit_security.php?edit=$row[ID]' class='badge badge-info'><i class='fas fa-edit'></i> edit</a></td>
                            <td><a href='delete_security.php?delete=$row[ID]' class='badge badge-info'><i class='fas fa-trash'></i> delete</a></td> 
                            <td><a href='reset_security_password.php?reset=$row[ID]'><i class='fas fa-user-shield'></i> change</a></td> 
                       </tr>
                  ";
                        }
                    }else{
                        echo "<div class='alert alert-danger'>No user records found</div>";
                        // die();
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="card w-75 mx-auto shadow" id="addAgents">
        <div class="card-header">
            <span class="card-title text-primary text-monospace font-weight-bold">Add Guard [security]</span>
        </div>
        <div class="card-body">
            <div class="notify alert"><span>X</span>
                <p></p>
            </div>
            <form id="securityForm" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="idNo" class="form-control" id="idNo" placeholder="Username (ID Number)">
                    <small class="form-text text-muted">Enter your username(IDNo)</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group">
                    <input type="text" name="firstName" class="form-control" id="firstName"  placeholder="First Name">
                    <small class="form-text text-muted">Enter security guard First Name</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group ">
                    <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name">
                    <small class="form-text text-muted">Enter security guard Last Name</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group ">
                    <input type="password" name="password1" class="form-control" id="password1" placeholder="Create Password">
                    <small class="form-text text-muted">Create Password (Should be at least 8 characters)</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <div class="form-group ">
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Confirm Password">
                    <small class="form-text text-muted">Confirm Password</small>
                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                </div>
                <button class="btn btn-primary float-right">
                    <i class="fas fa-user-plus"></i>
                    Add Guard
                </button>
            </form>
        </div>
    </div>
<?php include 'layout/footer.php';?>