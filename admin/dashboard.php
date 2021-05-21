<?php
    require 'layout/header.php';
    require 'sidebar.php';

    $deviceCount = $stolenCount = $activeCount = $studentCount = $modelCount = $securityCount = '0';
    $hpCount = $dellCount = $lenovoCount = $macCount = $acerCount = $asusCount = '0';

try {
    $stm = $conn->prepare("SELECT * FROM devices");
    $value = $stm->execute();
    $deviceCount = $stm->rowCount();  

    if ($deviceCount > 0){

        while($device = $stm->fetch(PDO::FETCH_ASSOC)){
            //calculating device status count
            if ($device['Status'] == 0){
                $activeCount+=1;
            }else{
                $stolenCount+=1;
            }

            //calculating device model count
            switch ($device['Model']){
                case 'HP':
                    $hpCount+=1;
                    break;
                case 'Dell':
                    $dellCount+=1;
                    break;
                case 'Lenovo':
                    $lenovoCount+=1;
                    break;
                case 'MacBook':
                    $macCount+=1;
                    break;
                case 'Acer':
                    $acerCount+=1;
                    break;
                case 'Asus':
                    $asusCount+=1;
                    break;
            }
        }
    }
    //calculating how many models are registered
    $s = $conn->prepare("SELECT DISTINCT Model FROM devices");
    $v = $s->execute();
    $modelCount = $s->rowCount();  

    //calculating how many students are registered
    $s = $conn->prepare("SELECT * FROM students");
    $v = $s->execute();
    $studentCount = $s->rowCount();  

    //calculating how many security guards are registered
    $s = $conn->prepare("SELECT * FROM security");
    $v = $s->execute();
    $securityCount = $s->rowCount();

}catch (Exception $e){
    echo 'Error: '.$e->getMessage();
}
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <h5 class="font-weight-bold pt-1 pb-1">Devices</h5>
    <div class="row">
        <!-- Total device(s) Count card  -->
        <div class="col-xl col-md-6 mb-2">
            <div class="card border-left-info shadow h-80 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total </div>
                            <div class="h5 mb-0 font-weight-bold"><?php echo $activeCount + $stolenCount;?> device(s)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Open device(s) Count Card -->
        <div class="col-xl col-md-6 mb-2">
            <div class="card border-left-primary shadow h-80 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bolder text-success text-uppercase mb-1">Active </div>
                            <div class="h5 mb-0 font-weight-bold"><?php echo $activeCount;?> device(s)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Solved device(s) Count Card -->
        <div class="col-xl col-md-6 mb-2">
            <div class="card border-left-warning shadow h-80 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Stolen </div>
                            <div class="h5 mb-0 font-weight-bold"><?php echo $stolenCount;?> device(s)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="text-info font-weight-bold">Count</h5>
    <div class="row">
        <!-- Security Guard Count Card -->
        <div class="col-xl col-md-6 mb-2">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Security Guards</div>
                            <div class="h5 mb-0 font-weight-bold"><?php echo $securityCount;?> guard(s)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Student Count Card -->
        <div class="col-xl col-md-6 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Students</div>
                            <div class="h5 mb-0 font-weight-bold"><?php echo $studentCount;?> student(s)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category Count Card -->
        <div class="col-xl col-md-6 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Models</div>
                            <div class="h5 mb-0 font-weight-bold"><?php echo $modelCount;?> model(s)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-layer-group fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="card shadow mb-3">
                <div class="card-header">
                    <strong class="text-info">Device Status</strong>
                </div>
                <div class="card-body" style="position: relative;">
                    <canvas class="w-100" id="pieDS" width="400px" height="400px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card shadow mb-3">
                <div class="card-header">
                    <strong class="text-info">Device Model</strong>
                </div>
                <div class="card-body" style="position: relative;">
                    <canvas class="w-100" id="pieDM" width="400px" height="400px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo $jquery_js;?>"></script>
    <script src="<?php echo $bootstrap_js;?>"></script>
    <script src="<?php echo $popper_js;?>"></script>
    <script src="<?php echo $main_js;?>"></script>

    <!-- Chart level plugins -->
    <script src="<?php echo $chartjs_js;?>"></script>

    <script>
        var ptx = $("#pieDS");
        var pieDS = new Chart(ptx, {
            type: 'pie',
            data: {
                labels: ["Active", "Stolen"],
                datasets: [{
                    data: [<?php echo $activeCount;?>, <?php echo $stolenCount;?>],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                    ]
                }]
            },

        });
    </script>
    <script>
        var ptc = $("#pieDM");
        var pieDM = new Chart(ptc, {
            type: 'pie',
            data: {
                labels: ["HP", "Dell","Lenovo", "MacBook", "Acer", "Asus"],
                datasets: [{
                    data: [<?php echo $hpCount;?>, <?php echo $dellCount?>, <?php echo $lenovoCount;?>,
                        <?php echo $macCount;?>, <?php echo $acerCount;?>, <?php echo $asusCount;?>],

                    backgroundColor: [
                        'rgba(102, 16, 242, 0.8)',
                        'rgba(232, 62, 140, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(32, 201, 151, 0.8)',
                        'rgba(150, 100, 100, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                    ]
                }]
            },

        });
    </script>
    