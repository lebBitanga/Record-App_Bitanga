<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<?php
require('config/config.php');
require('config/db.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';

$results_per_page = 10;

$query =  "SELECT * FROM employee ";
$result = mysqli_query($conn, $query);
$number_of_result = mysqli_num_rows($result);

$number_of_page=ceil($number_of_result/$results_per_page);

if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}

$page_first_result=($page-1) * $results_per_page;

if (strlen($search) > 0) {
$query = 'SELECT employee.lastname, employee.firstname,employee.address, office.name as office_name FROM employee, office WHERE employee.office_id = office.id AND employee.address = '.$search.' ORDER BY employee.lastname LIMIT '.$page_first_result.','.$results_per_page;
}else{
$query = 'SELECT employee.id, employee.lastname, employee.firstname,employee.address, office.name as office_name FROM employee, office WHERE employee.office_id = office.id ORDER BY employee.lastname LIMIT '. $page_first_result . ',' . $results_per_page;
}

$result = mysqli_query($conn, $query);

$employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <?php include('includes/sidebar.php');?>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <?php include ('includes/navbar.php');?>
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>
                    <div class="row">
                                    <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <br/>
                                <div class="col-md-12">
                                    <form action="employee.php" method="GET">
                                        <input type="text" name="search" />
                                        <input type="submit" value="Search" class="btn btn-info btn-fill" />
                                    </form>   
                                </div>                                
                                <div class="col-md-12">
                                <a href="employee-add.php">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add New Employee</button>
                                </a>
                                <div class="card-header ">
                                    <h4 class="card-title">Employee</h4>
                                    <p class="card-category">Here is a subtitle for this table</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Address</th>
                                            <th>Office</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach($employees as $employee) : ?>
                                            <tr>
                                        <td><?php echo $employee ['lastname']; ?></td>
                                        <td><?php echo $employee ['firstname']; ?></td>
                                        <td><?php echo $employee ['address']; ?></td>
                                        <td><?php echo $employee ['office_name']; ?></td>
                                        <td>
                                            <a href="employee-edit.php?id=<?php echo $employee['id']; ?>">
                                                <button type="submit" class="btn btn-warning btn-fill pull-right">Edit</button>
                                            </a>
                                        </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    for($page=1; $page <= $number_of_page; $page++){
                        echo '<a href="employee.php?page='. $page .'"> '. $page .'</a>';
                    }
                    ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>