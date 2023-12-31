<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} // silence a warning
if(!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
include('serverconnect.php');
?>

<!DOCTYPE html>
<html>

<?php
include('header.php')
?>

  <script>
            function displayFromDatabase(filter,sortC,sortE){
                $.ajax({
                    url: "fetchIndex.php",
                    type: "POST",
                    async: false,
                    data: {
                        "display": 1,
                        "filterCat": filter,
                        "sortC":sortC,
                        "sortE":sortE
                    },
                    success:function (data) {
                        $("#box").html(data);
                    }

                })
            }
  </script>
<body class="form-v8 loggedin" id="fade" onload="displayFromDatabase(0,1,1)">

<div id="loader">
    <div class="loader"><div></div><div></div><div></div><div></div></div>
</div>

<script>
  window.user_id = '<?php echo $_SESSION["id"]; ?>';
</script>

<?php
if ($_SESSION['admin']) {
    include('adminNavbar.php');
} else {
    include('navbar.php');
}
?>

<div style="height: 63px; opacity: 0; padding: 0; margin: 0" ></div>


<div class="content">
    <?php if (isset($_GET['sent']) && $_GET['sent'] == 1) {
        echo '<p style="color: green" >Your request is sent</p>';
    } ?>
    <?php if (isset($_GET['verify']) && $_GET['verify'] == 1) {
        echo '<p style="color: green" >Successfully Verified</p>';
    } ?>
    <?php if (isset($_GET['return']) && $_GET['return'] == 1) {
        echo '<p style="color: green" >Successfully Returned</p>';
    } ?>
    <?php if (isset($_GET['return']) && $_GET['return'] == 0) {
        echo '<p style="color: red" >Error occurred, please login with the user you borrowed the equipment with</p>';
    } ?>
    <?php if (isset($_GET['adminonly']) && $_GET['adminonly'] == 1) {
        echo '<p style="color: red" >This page is only accessible by the admininistrator</p>';
    } ?><?php if (isset($_GET['reset']) && $_GET['reset'] == 1) {
        echo '<p style="color: green" >Password successfully reset</p>';
    } ?>
</div>


<?php $getCategory = mysqli_query($db, "SELECT * FROM EqManage.categories");

?>


<div class="features-boxed" style="height: 787px;">
    <div class="container">
        <div class="intro">

            <h2 class="text-center">Availability Status</h2>
            <p class="text-center">In this page, you can check whether the equipment is available or not</p>

            <input id="input" type="text" placeholder="Search.." style="padding-top: 10px;margin-top: 10px">



            <form action="#">

                <div class="select-box">

                    <label for="select-box1" class="label select-box1"><span class="label-desc">Filter By Category</span> </label>
                    <select id="select-box1" class="select" name="filtercat" onchange="getIndex1()">
                        <option value="0" selected>--All--</option>

                        <?php while ($row = mysqli_fetch_array($getCategory)) { ?>


                            <?php echo "<option value=\"".$row['id']."\" name=\"filterCat\">".$row['categoryName']."</option>"; ?>



                        <?php } ?>
                    </select>

                </div>

            </form>

            <form action="#">

                <div class="select-box">

                    <label for="select-box2" class="label select-box1"><span class="label-desc">Sort By Category Name: </span> </label>
                    <select id="select-box2" class="select" onchange="getIndex1()">

                        <option value="1" selected>Category Name Ascending</option>
                        <option value="2" >Category Name Descending</option>



                    </select>

                </div>

            </form>

            <form action="#">

                <div class="select-box">

                    <label for="select-box3" class="label select-box1"><span class="label-desc">Sort By Equipment Name: </span> </label>
                    <select id="select-box3" class="select" onchange="getIndex1()">

                        <option value="1" >Equipment Name Ascending</option>
                        <option value="2" >Equipment Name Descending</option>



                    </select>

                </div>

            </form>

        </div>





        <div class="row justify-content-center features" id="box">
            <!--<div class="col-sm-6 col-md-5 col-lg-4 item">
                <div class="box">
                    <h3 class="name">Equipment Name</h3>
                    <p class="description">Details</p><a href="#" class="learn-more">Borrow This Equipment »</a></div>
            </div>-->



            <!---->
            <!--            --><?php //$results = mysqli_query($db, "SELECT * FROM equipment");
            //            $results2 = mysqli_query($db, "SELECT C.categoryName, E.id, E.equipment, E.leftQuantity, E.availability, C.id
            //      FROM EqManage.categories C
            //      LEFT JOIN EqManage.equipment E ON C.id=E.category
            //      GROUP BY C.id,E.id, C.categoryName, E.equipment
            //      ORDER BY C.categoryName,E.equipment");
            //
            //?>
            <!---->
            <!--            --><?php //while ($row = mysqli_fetch_array($results2)) {?>
            <!---->
            <!---->
            <!--                --><?php //echo "<div class=\"col-sm-6 col-md-5 col-lg-4 item\">";?>
            <!---->
            <!---->
            <!---->
            <!--                --><?php //if ($row['availability'] == 1) {
            //                    echo "<div class=\"box\" id='box2'>";
            //                } elseif ($row['availability'] == 0){
            //                    echo "<div class=\"box\" id='box2'>";
            //                } else echo "Error";?>
            <!---->
            <!---->
            <!---->
            <!---->
            <!--                --><?php ///*echo "<h3 class=\"name\">".$row['Equipment']."</h3>"; */?>
            <!---->
            <!---->
            <!---->
            <!--                --><?php //if ($row['availability'] == 1) {
            //                    echo "<a style='font-style: italic; text-decoration: underline'>".$row['categoryName']."<a/><h3 class=\"name\">".$row['equipment']."</h3>";
            //                } elseif ($row['availability'] == 0){
            //                    echo "<h3 class=\"name\" style='color: orangered'>".$row['equipment']."</h3>";
            //                } else echo "Error";?>
            <!---->
            <!---->
            <!---->
            <!--                --><?php //if ($row['availability'] == 1) {
            //                    echo "<p class=\"description\">".$row['leftQuantity']." Available";
            //                } elseif ($row['availability'] == 0){
            //                    echo "<p class=\"description\" style='color: red'>Not Available";
            //                } else echo "Error";?>
            <!---->
            <!---->
            <!--                --><?php //echo "</p>";?>
            <!---->
            <!---->
            <!---->
            <!--                --><?php //if ($row['availability'] == 1) {
            //                    echo "<a href=\"direct-checkout.php?selected=".$row['id']."\" class=\"learn-more\">Borrow This Equipment »</a>";
            //                } elseif ($row['availability'] == 0){
            //                    echo "";
            //                } else echo "Error";?>
            <!---->
            <!--                --><?php //echo "</div>";?>
            <!--                --><?php //echo "</div>";?>
            <!---->
            <!--            --><?php //}?>
            <!---->
            <!--        </div>-->
            <!--    </div>-->

        </div>
        <script>

            $(document).ready(function(){
                $("#input").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#box div").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                // document.getElementById("add-cart").onclick(function() {
                //     $(".dropdown-toggle").dropdown("toggle");
                //     console.log("opened");
                // });
                // $('.trigger_button').click(function(e){
                //     // Kill click event:
                //     e.stopPropagation();
                //
                //     console.log("pressed");
                //     $('.dropdown-toggle').dropdown('toggle');
                // });

            });







            /* $(document).ready(function getIndex(){
                 $("#select-box1").onchange(function getIndex1(){
                     var e = document.getElementById("select-box1");
                     var cat = e.options[e.selectedIndex].value;
                     $.ajax({
                         url: "fetchindex.php",
                         type: "POST",
                         async: false,
                         data:{
                             "filterCat":cat
                         },
                         success: function(data){
                             displayFromDatabase();
                         }

                     });
                 });
             });*/

            function getIndex1(){
                var e = document.getElementById("select-box1");
                var cat = e.options[e.selectedIndex].value;
                var e2 = document.getElementById("select-box2");
                var sortC = e2.options[e2.selectedIndex].value;
                var e3 = document.getElementById("select-box3");
                var sortE = e3.options[e3.selectedIndex].value;
                $.ajax({
                    url: "fetchIndex.php",
                    type: "POST",
                    async: false,
                    data: {
                    },
                    success:function(data){

                        displayFromDatabase(cat,sortC,sortE);
                    }

                })
            }

            function addCart(eqID) {
                console.log(eqID);
                var idname = eqID + "_qty";
                var qty = document.getElementById(idname).value;
                console.log(qty);

                $.ajax({
                    url:"navbarCart.php",
                    type:"POST",
                    data:{
                        "eqID":eqID,
                        "qty":qty
                    },
                    success:function (data) {
                        console.log("added to cart");
                        $("#cartDiv").html(data);
                        console.log(data);
                    }
                })
            }

            function clearCart() {
                $.ajax({
                    url:"navbarCart.php",
                    type:"POST",
                    data:{
                        "destroy_cart":"1",
                    },
                    success:function (data) {
                        console.log("cleared cart");
                        $("#cartDiv").html(data);
                    }
                })
            }

            function deleteItem(eqID) {
                console.log(eqID);
                $.ajax({
                    url:"navbarCart.php",
                    type:"POST",
                    data:{
                        "delete":"1",
                        "eqID":eqID
                    },
                    success:function (data) {
                        console.log("deleted item");
                        $("#cartDiv").html(data);
                        console.log(data);
                    }
                })
            }

            function updateQty(eqID, qty) {
                console.log(qty);
                console.log(eqID);
                $.ajax({
                    url:"navbarCart.php",
                    type:"POST",
                    data:{
                        "update":"1",
                        "qty":qty,
                        "eqID":eqID
                    },
                    success:function (data) {
                        $("#cartDiv").html(data);
                        console.log(data);
                    }
                })

            }


        </script>

</body>
