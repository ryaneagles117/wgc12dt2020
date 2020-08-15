<?php
$con = mysqli_connect("localhost", "eagleska", "niceflock68", "eagleska_canteen");
if (mysqli_connect_error()) {
    echo "failed to connect to MySQL:" . mysqli_connect_error();
    die();
} else {
    echo "connected to database";
}
$all_food_query = "SELECT Itemname, foodid FROM food";
$all_food_results = mysqli_query($con, $all_food_query);


if(isset($_GET['food'])){
    $foodid = $_GET['food'];
}else{
    $foodid = 1;
}
$this_food_query = "SELECT Itemname, price FROM food WHERE foodid ='" . $foodid . "'";
$this_food_result = mysqli_query($con, $this_food_query);
$this_food_record = mysqli_fetch_assoc($this_food_result);

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $query1 = "SELECT * FROM food WHERE Itemname LIKE '%$search%'";
    $query = mysqli_query($con, $query1);
    $count = mysqli_num_rows($query);

    if ($count == 0) {
        echo "there is no search results";
    } else {
        while ($row = mysqli_fetch_array($query)) {
            echo $row ['Itemname'];
            echo "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WGC Canteen Food</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type="text/css" href="canteenstyle.css">
</head>

<body>
<header>
    <h1>WGC Canteen</h1>
    <nav>
        <ul>
            <li><a href="assessmentindex.php">HOME</a></li>
            <li><a href="drinks.php">DRINKS</a></li>
            <li><a href="food.php">FOOD</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2> Search for a food item</h2>
    <form action="" method="post">
        <input type="text" name='search'>
        <input type="submit" name="submit" value="search">
    </form>
    </form>

    <!--Food form-->
    <form name="food_form" id="food_form" method="get" action="food.php">
        <select id="food" name="food">
            <!--options-->
            <?php
            while ($all_food_record = mysqli_fetch_assoc($all_food_results)) {
                echo "<option value='" . $all_food_record["foodid"] . "'>'";
                echo $all_food_record['Itemname'];
                echo "</option>";
            }
            ?>


        </select>

        <input type="submit" name="food_buttons" value="show me the food information">
    </form>
    <h2>Food Information</h2>
    <?php
    echo "<p>Food Name: " . $this_food_record['Itemname'] . "<br>";
    echo "<p>Price: $" . $this_food_record['price'] . "<br>";
    ?>
</main>
</body>

</html>
