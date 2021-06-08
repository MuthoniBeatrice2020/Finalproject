    <?php
        //page header load
        require 'session.php';
        include 'layout/header.php';
    ?>
    <div class="container-fluid">
        <!-- List of submitted tickets     -->
        <div class="card w-80 shadow mt-3">
            <div class="card-header">
                <h6 class="m-0 text-monospace font-weight-bold text-primary">List of your registered devices</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="deviceTable" data-order='[[ 0, "desc" ]]' class="table table-hover display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Reg No</th>                        
                                <th>Serial No</th>
                                <th>Model</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                                <th>Report Stolen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stm= $conn->prepare("SELECT * FROM devices WHERE RegNo=:regNo");
                                $stm->bindParam(":regNo",$student, PDO::PARAM_STR);
                                $value=$stm->execute();
                                
                                if($stm->rowCount() > 0) {

                                    while ($t_row = $stm->fetch(PDO::FETCH_ASSOC)) {

                                        echo "
                                        <tr>
                                            <td>" . $t_row['RegNo'] . "</td>
                                            <td>" . $t_row['SerialNo'] . "</td>
                                            <td>" . $t_row['Model'] . "</td>
                                            <td>" .date('l d/m/y h:i A',strtotime($t_row['DATETIME'])) . "</td>";
                                            if($t_row['Status'] == 0){
                                                echo "<td><span class='badge badge-success'> Active </span></td>
                                                     <td><span id='" . $t_row['ID'] . "' class='btn badge badge-info report-active' data-toggle='modal'> Report </span></td>";
                                            }else{
                                                echo "<td><span class='badge badge-warning'> Stolen </span></td>
                                                      <td><span id='" . $t_row['ID'] . "' class='btn badge badge-info report' data-toggle='modal'> Report </span></td>";
                                                
                                            } 
                                        echo  "
                                            
                                        </tr>";                            
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
        <!--  -->
        <!-- delete Ticket Modal -->
        <div class="modal fade" id="reportDeviceModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="reportDeviceLabel">
                            <i class="fas fa-sitemap mr-2"></i>
                            Report Device as stolen
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="reportDeviceForm">
                        <div class="modal-body">
                            <div class="notify alert"><span>X</span>
                                <p></p>
                            </div>
                            <div class="form">
                                <div class="form-group">
                                    <h5 class="p-2">Do you want to report this device as <span class="text-info">stolen</span> ?</h5>
                                    <input type="text" name="deviceID" id="deviceID" class="form-control" value="" hidden>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" name="comment" id="comment" class="form-control"></textarea>
                                    <small class="form-text text-muted">Comment on where and when your device was stolen</small>
                                    <small class="form-text text-danger font-italic font-weight-bold"></small>
                                    <?php if (!empty($requiredUsername)){
                                        echo '<small class="form-text text-danger font-italic font-weight-bold">'.$requiredUsername.'</small>';
                                    }
                                    if (!empty($emailErr)){
                                        echo '<small class="form-text text-danger font-italic font-weight-bold">'.$emailErr.'</small>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="report-close" data-dismiss="modal">No</button>
                            <button class="btn btn-success" id="report-btn">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.php';?>
