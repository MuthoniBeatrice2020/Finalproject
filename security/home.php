    <?php
        //page header load
        include 'layout/header.php';
    ?>
    <div class="container-fluid">
        <!-- List of submitted tickets     -->
        <div class="card w-80 shadow mt-3">
            <div class="card-header">
                <h6 class="m-0 text-monospace font-weight-bold text-primary">List of registered devices</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table data-order='[[ 0, "desc" ]]' class="table table-hover" id="ticTable">
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>Reg No</th>                        
                                <th>Serial No</th>
                                <th>Model</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stm= $conn->prepare("SELECT * FROM devices");
                                $value=$stm->execute();
                                
                                if($stm->rowCount() > 0) {

                                    while ($t_row = $stm->fetch(PDO::FETCH_ASSOC)) {

                                        echo "
                                        <tr>
                                            <td>" . $t_row['ID'] . "</td>
                                            <td>" . $t_row['RegNo'] . "</td>
                                            <td>" . $t_row['SerialNo'] . "</td>
                                            <td>" . $t_row['Model'] . "</td>
                                            <td>" .date('l d/m/y h:i A',strtotime($t_row['DATETIME'])) . "</td>";
                                            if($t_row['Status'] == 0){
                                                echo "<td><span class='badge badge-success'> Active </span></td>";
                                            }else{
                                                echo "<td><span class='badge badge-warning'> Stolen </span></td>";
                                            } 
                                        echo  "</tr>";                            
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
    </div>
    <?php include 'layout/footer.php';?>
