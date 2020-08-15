<?php
$con = mysqli_connect("localhost", "eagleska", "niceflock68", "eagleska_canteen");
if (mysqli_connect_error()) {
    echo "failed to connect to MySQL:" . mysqli_connect_error();
    die();
} else {
    echo "connected to database";
}
$all_drinks_query = "SELECT Itemname, drinkid FROM drinks";
$all_drinks_results = mysqli_query($con, $all_drinks_query);

$all_food_query = "SELECT Itemname, foodid FROM food";
$all_food_results = mysqli_query($con, $all_food_query);
?>

<!DOCTYPE html>
<html lang="en">
<div class="container">
    <head>
        <title>"WGC Canteen"</title>
        <meta charset="utf-8">
        <link rel='stylesheet' type="text/css" href="canteenstyle.css">
    </head>

    <body>
    <div class="body">
        <div class="container">
            <header>
                <div class="header">
                    <h1>Wellington Girls' College Canteen</h1>
                    <nav>
                        <ul>
                            <li><a href="assessmentindex.php">HOME</a></li>
                            <li><a href="drinks.php">Drinks menu</a></li>
                            <li><a href="food.php">Food Menu</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
        </div>
        <main>

            <!--Drinks form-->
            <form name="drinks_form" id="drinks_form" method="get" action="drinks.php">
                <select id="drink" name="drink">
                    <!--options-->
                    <?php
                    while ($all_drinks_record = mysqli_fetch_assoc($all_drinks_results)) {
                        echo "<option value ='" . $all_drinks_record["drinkid"] . "'>'";
                        echo $all_drinks_record['Itemname'];
                        echo "</option>";
                    }
                    ?>

                </select>
                <input type="submit" name="drinks_buttons" value="show me the drink information">
 

        </main>
    </div>
    </body>

</div>