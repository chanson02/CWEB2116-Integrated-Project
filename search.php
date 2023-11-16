<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: login.php');
    exit();
}
if ($_SESSION['username'] != 'administrator'){
    header('Location: index.php?adminonly=1');
}


include('serverconnect.php');
?>

<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <?php include('header.php') ?>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/bootstrap-iso.css">
    <script src="assets/js/select2.min.js"></script>

</head>

<body>

<div class="wrapper" id="main">

    <div class="main-panel">
        <!-- Navbar -->
        <?php include('adminNavbar.php')?>

        <!-- End Navbar -->

        <div class="content" id="content">
            <?php include('searchContent.php') ?>


        </div>
    </div>

</div>

<?php
if ($_SESSION['username'] == 'administrator'){
    include ('adminModal.php');
}

?>

</body>

</html>

<script>
    $("#select").select2( {
        placeholder: "Enter ID",
        allowClear: true,

    } );

    $(document).ready(function() {

        $("#userSelect").change(function () {
            var id = $(this).val();
            console.log("Working");

            var url = 'fetchSearchUser.php?' + 'id=' + id;
            console.log(url);

            $("#user").load(url);
            console.log("Done");

        })
    });

    function displayRadioValue() {//Check which radio button is being selected
        var ele = document.getElementsByName('type');
        var id;
        for(var i = 0; i < ele.length; i++) {
            if(ele[i].checked){
                id = ele[i].value;
            }
            var url = 'searchContent.php?' + 'type=' + id;
            //Add the selected id to the url so this data can be retrieved via GET by php
        }
        $("#content").load(url);//Load the url into content div (reloads the searchContent.php with type of search selected)
    }

    <?php
    $id = $_GET['id'];
    $type = $_GET['type'];
    $target = "";
    switch ($type){
        case 1 : $target = "userSelect"; break;
        case 2 : $target = "eqSelect"; break;
        case 3 : $target = "logSelect"; break;
        case 4 : $target = "requestSelect"; break;
        case 5 : $target = "categorySelect";
    }
    if ($id != null){
        echo "$('#$target').val('$id');
    $('#$target').trigger('change');";
    }
    ?>
</script>
