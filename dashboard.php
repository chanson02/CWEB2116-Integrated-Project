<?php
include('serverconnect.php');
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: login.php');
    exit();
}
if ($_SESSION['username'] != 'administrator'){
    header('Location: index.php?adminonly=1');
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <?php include('adminheader.php') ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="assets/css/dashboardstyle.css" rel="stylesheet" />
    <script src="assets/js/select2.min.js"></script>
    <link rel="stylesheet" href="assets/css/select2.min.css"/>

</head>
<style>
    .content > p, .content > div {
        /*box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);*/
        box-shadow: none;

    }

    .content > div p {

        box-shadow: none;
    }

</style>
<body style="background-color: #eef4f7">
<div id="loader">
    <div class="loader"><div></div><div></div><div></div><div></div></div>
</div>
<div class="wrapper">

    <div class="main-panel">
        <!-- Navbar -->

        <?php
        if ($_SESSION['username'] == 'administrator'){
            include ('adminNavbar.php');
        } else{
            include ('navbar.php');
        }
        ?>
        <!-- End Navbar -->

        <div class="content" style="background-color: #eef4f7;">
            <div style="background-color: #eef4f7; margin-top:63px">
            <h2 class="text-center" style="margin-bottom: 50px">Dashboard</h2>


            <div class="container-fluid" id="container" style="background-color: #eef4f7" >

                <!-- your content here -->


                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <span class="material-icons">
                                    watch_later
                                    </span>
                                </div>
                                <p class="card-category">Overdue</p>
                                <div id="overdue"><?php include('fetchOverdue.php') ?></div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="overdue.php">View overdue >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <span class="material-icons">
                                    today
                                    </span>
                                </div>
                                <p class="card-category">Checked Out Today</p>
                                <div id="todayCheckout"><?php include('fetchTodayCheckout.php') ?></div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
<!--                                    <i class="material-icons">date_range</i>-->
                                    <a href="log.php">View log >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon">
                                    <span class="material-icons">
                                    pending
                                    </span>
                                </div>
                                <p class="card-category">Waiting Approval</p>
                                <div id="pendingRequest"><?php include('fetchPendingRequest.php') ?></div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
<!--                                    <i class="material-icons">local_offer</i> Tracked from Github-->
                                    <a href="requests.php">View all requests >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <span class="material-icons">
                                    pending_actions
                                    </span>
                                </div>
                                <p class="card-category">Pending Checkout</p>
                                <div id="regEq"><?php include('fetchPendingCheckout.php') ?></div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
<!--                                    <i class="material-icons">update</i> Just Updated-->
                                    <a data-toggle="modal" role="button" href="#checkoutModal" data-backdrop="false" id="checkoutModalBtn">Checkout Equipment >></a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div> <!-- Small statiistic template -->
                <div class="row">

                    <div class="col-md-4">
                        <div class="card card-chart">
                            <div class="card-header card-header-danger">
                                <div class="ct-chart" id="websiteViewsChart"></div>
                            </div>
                            <div class="card-body" id="currentCO">
<!--                                <h4 class="card-title">Currently Checked Out: 4</h4>-->
<!--                                <p class="card-category">-->
<!--                                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>-->
<!--                                <p class="card-category">List goes here</p>-->
<!--                                <p class="card-category" style="padding-bottom: 0px; margin-bottom: 0px">List goes here</p>-->
<!--                                <p class="card-category" style="padding-bottom: 0px; margin-bottom: 0px">List goes here</p>-->
                                <?php include('fetchCurrentCheckoutEq.php'); ?>

                            </div>
                            <div class="card-footer">
                                <div class="stats">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-chart">
                            <div class="card-header card-header-danger">
                                <div class="ct-chart" id="websiteViewsChart"> </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Weekly Checkout</h4>
                                <p class="card-category">Checkout performance of last 7 days</p>
                            </div>
                            <div id="chartContainer2" style="height: 150px; width: 100%;"></div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="">View log</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" style="width: 400px">
                        <div class="card card-chart">
                            <div class="card-header card-header-danger">
                                <div class="ct-chart" id="websiteViewsChart"> </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Most Popular</h4>
                                <p class="card-category">Most frequently checked out equipment</p>
                            </div>
                            <div id="chartContainer" style="height: 200px; width: 100%;"></div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="">Manage Equipment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div>
<?php

include('serverconnect.php');

?>

</body>

<?php
if ($_SESSION['username'] == 'administrator'){
    include ('adminModal.php');
}
?>
<script>




        // $.getJSON("popularEqGraph.php", function (result) {
        //
        //     var chart = new CanvasJS.Chart("chartContainer", {
        //         animationEnabled: false,
        //         exportEnabled: false,
        //         theme: "light1", // "light1", "light2", "dark1", "dark2"
        //         title:{
        //
        //         },
        //         data: [{
        //             type: "bar", //change type to bar, line, area, pie, etc
        //             dataPoints: result
        //         }]
        //     });
        //
        //     chart.render();
        // });
        window.onload = function () {
            $.getJSON("popularEqGraph.php", function(result){//Get JSON encoded array from the PHP file
                var dps= [];
                //Array assignments
                for(var i=0; i<result.length;i++) {
                    dps = result;
                    console.log(dps);
                }

                //Making chart
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{
                    },
                    data: [{
                        type: "bar", //bar, line, area, pie, etc
                        dataPoints: dps
                    }]
                });
                chart.render();
            });

            $.getJSON("weeklyCoGraph.php", function(result){
                var dps= [];
                //Array assignments
                for(var i=0; i<result.length;i++) {
                    dps = result;
                    console.log(dps);
                }
                //Making chart
                var chart = new CanvasJS.Chart("chartContainer2", {
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{

                    },
                    data: [{
                        type: "line", //bar, line, area, pie, etc
                        dataPoints: dps
                    }]
                });
                chart.render();
            });
        }
        
        


</script>

<script>
    function refreshOverdue() { //Refresh 'Overdue' Count
        xmlhttpOverdue=new XMLHttpRequest();
        xmlhttpOverdue.open("GET","fetchOverdue.php", false);
        xmlhttpOverdue.send(null);
        document.getElementById("overdue").innerHTML=xmlhttpOverdue.responseText;

    }
    function refreshPR() { //Refresh 'Pending Requests' count
        xmlhttpPR = new XMLHttpRequest();
        xmlhttpPR.open("GET", "fetchPendingRequest.php",false);
        xmlhttpPR.send(null);
        document.getElementById("pendingRequest").innerHTML=xmlhttpPR.responseText;
    }

    function refreshCOM() { //Refresh 'Pending Checkout' count
        xmlhttpCOM = new XMLHttpRequest();
        xmlhttpCOM.open("GET", "fetchPendingCheckout.php",false);
        xmlhttpCOM.send(null);
        document.getElementById("regEq").innerHTML=xmlhttpCOM.responseText;
    }


    function refreshCOT() { //Refresh 'Checked out Today' count
        xmlhttpCOT = new XMLHttpRequest();
        xmlhttpCOT.open("GET", "fetchTodayCheckout.php", false);
        xmlhttpCOT.send(null);
        document.getElementById("todayCheckout").innerHTML=xmlhttpCOT.responseText;
    }

    function refreshCurrentCO() {//Refresh 'Currently checked out' count
        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "fetchCurrentCheckoutEq.php", false);
        xmlhttp.send(null);
        document.getElementById("currentCO").innerHTML=xmlhttp.responseText;
    }

    // function refreshGraph() {
    //     xmlhttp = new XMLHttpRequest(); // Checkout today
    //     xmlhttp.open("GET", "popularEqGraph.php", false);
    //     xmlhttp.send(null);
    //     document.getElementById("popGraph").innerHTML=xmlhttp.responseText;
    // }

    function reloadGraph() {
        $.getJSON("popularEqGraph.php", function(result){
            var dps= [];
            for(var i=0; i<result.length;i++) {
                dps = result;
                console.log(dps);
            }
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: false,
                exportEnabled: false,
                theme: "light1",
                title:{

                },
                data: [{
                    type: "bar",
                    dataPoints: dps
                }]
            });
            chart.destroy();
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: false,
                exportEnabled: false,
                theme: "light1",
                title:{

                },
                data: [{
                    type: "bar",
                    dataPoints: dps
                }]
            });
            chart.render();
        });
    }


    function reloadGraph2() {
        $.getJSON("weeklyCoGraph.php", function(result){
            var dps= [];
            for(var i=0; i<result.length;i++) {
                dps = result;
                console.log(dps);
            }
            var chart = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: false,
                exportEnabled: false,
                theme: "light1",
                title:{
                },
                data: [{
                    type: "line",
                    dataPoints: dps
                }]
            });
            chart.destroy();
            var chart = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: false,
                exportEnabled: false,
                theme: "light1",
                title:{
                },
                data: [{
                    type: "line",
                    dataPoints: dps
                }]
            });
            chart.render();
        });
    }


    refreshOverdue();
    refreshCOT();
    refreshPR();
    refreshCOM();
    refreshCurrentCO();

    setInterval(function () {
        refreshOverdue();
        refreshCOT();
        refreshPR();
        refreshCOM();
        refreshCurrentCO();
        reloadGraph();
        reloadGraph2();
    },5000);

    //
    // function getName(){
    //     var e = document.getElementById('eqselect');
    //     var id = e.options[e.selectedIndex].value;
    //     $.ajax({
    //         url: "fetchName.php",
    //         type: "POST",
    //         async: false,
    //         data: {
    //             "eqID":id
    //         },
    //         success:function(data){
    //
    //             // displayFromDatabase(id);
    //             $("#studentselect").append(data);
    //         }
    //
    //     })
    // };

    // function getReturnName(){
    //     var e = document.getElementById('returnEqSelect');
    //     var id = e.options[e.selectedIndex].value;
    //     $.ajax({
    //         url: "fetchReturnName.php",
    //         type: "POST",
    //         async: false,
    //         data: {
    //             "eqID":id
    //         },
    //         success:function(data){
    //
    //             // displayFromDatabase(id);
    //             $("#returnStudentSelect").append(data);
    //         }
    //
    //     })
    // };




    // function displayFromDatabase(id){
    //     $.ajax({
    //         url: "fetchName.php",
    //         type: "POST",
    //         async: false,
    //         data: {
    //             "display": 1,
    //                 "eqID":id
    //         },
    //         success:function (data) {
    //             $("#studentselect").append(data);
    //
    //         }
    //
    //     })
    // }


</script>




</html>
