<?php
    require 'layout/header.php';
    require 'sidebar.php';
?>
    <div class="mt-3">
        <h5>
            <i class="fas fa-clipboard-list"></i>
            Manage Devices
            <hr>
        </h5>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary float-left" id="viewTicToggle">
            <i class="fas fa-clipboard-check"></i>
            View Devices
        </button>
        <button class="btn btn-primary float-right" id="viewEscTicToggle">
            <i class="fas fa-external-link-square-alt"></i>
            Stolen Devices
        </button>
    </div>
    <div class="clearfix mb-3"></div>
    <hr>
    <div class="card shadow" id="viewTic">
        <div class="card-header">
            <h6 class="m-0 text-monospace font-weight-bold text-primary">List of Active Electronic Devices</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table data-order='[[ 0, "desc" ]]' class="table table-bordered" id="ticTable">
                    <thead>
                    <tr>
                        <th>Reg No</th>                        
                        <th>Serial No</th>
                        <th>Model</th>
                        <th>Registration Date</th>
                        <th>Status</th>
                        <th>Barcode</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stm= $conn->prepare("SELECT * FROM devices WHERE Status = 0 ORDER BY DATETIME ASC");
                    $value=$stm->execute();
                    
                    if($stm->rowCount() > 0) {

                        while ($t_row = $stm->fetch(PDO::FETCH_ASSOC)) {

                            echo "
                            <tr>
                                <td>" . $t_row['RegNo'] . "</td>
                                <td>" . $t_row['SerialNo'] . "</td>
                                <td>" . $t_row['Model'] . "</td>
                                <td>" .date('l d/m/y h:i A',strtotime($t_row['DATETIME'])) . "</td>
                                <td><span class='badge badge-success'> Active </span></td>
                                <td><a href='barcode.php?generate=". $t_row['ID'] ."' class='btn badge badge-info'> Generate </a></td>
                                <td><a href='edit_devices.php?edit=". $t_row['ID'] ."' class='btn badge badge-info'><i class='fas fa-edit'></i> edit  </a></td>
                                <td><a href='edit_devices.php?delete=". $t_row['ID'] ."' class='btn badge badge-info'><i class='fas fa-trash'></i> delete </a></td>
                            </tr>     
                         ";                            
                        }
                    }else{
                        echo "<div class='alert alert-danger'>No Devices found</div>";
                        // die();
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow" id="viewEscTic">
        <div class="card-header">
            <h6 class="m-0 text-monospace font-weight-bold text-primary">List of Stolen Devices</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="escTicTable">
                    <thead>
                        <tr>
                            <th>Reg No</th>
                            <th>Serial No</th>
                            <th>Model</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="tktsTab">
                        <?php
                            $stm= $conn->prepare("SELECT * FROM devices WHERE Status = 1 ORDER BY DATETIME ASC");
                            $value=$stm->execute();
                            
                            if($stm->rowCount() > 0) {

                                while ($t_row = $stm->fetch(PDO::FETCH_ASSOC)) {

                                    echo "
                                    <tr>
                                        <td>" . $t_row['RegNo'] . "</td>
                                        <td>" . $t_row['SerialNo'] . "</td>
                                        <td>" . $t_row['Model'] . "</td>
                                        <td>" .date('l d/m/y h:i A',strtotime($t_row['DATETIME'])) . "</td>
                                        <td><span class='badge badge-warning'> Stolen </span></td>
                                        <td><a href='edit_devices.php?edit=". $t_row['ID'] ."' class='btn badge badge-info'><i class='fas fa-edit'></i> edit </a></td>
                                        <td><a href='edit_devices.php?delete=". $t_row['ID'] ."' class='btn badge badge-info'><i class='fas fa-trash'></i> delete </a></td>   
                                    </tr>     
                                ";                        
                                }
                            }else{
                                echo "<div class='alert alert-danger'>No Devices found</div>";
                                // die();
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.php';?>