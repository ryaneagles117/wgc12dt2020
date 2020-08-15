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


if(isset($_GET['drink'])){
    $drinkid = $_GET['drink'];
}else{
    $drinkid = 1;
}
$this_drink_query = "SELECT Itemname, price FROM drinks WHERE drinkid ='" . $drinkid . "'";
$this_drink_result = mysqli_query($con, $this_drink_query);
$this_drink_record = mysqli_fetch_assoc($this_drink_result);

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query1 = "SELECT * FROM drinks WHERE Itemname LIKE '%$search%'";
    $query = mysqli_query($con, $query1);
    $count = mysqli_num_rows($query);

    if ($count == 0) {
        echo "There is no search results";
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
    <title>WGC Canteen Drinks Menu</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type="text/css" href="canteenstyle.css">
</head>

<body>
<header>
    <h1>WGC Canteen Drinks Menu</h1>
    <nav>
        <ul>
            <li><a href="assessmentindex.php">HOME</a></li>
            <li><a href="drinks.php">DRINKS</a></li>
            <li><a href="food.php">FOOD</a></li>
        </ul>
    </nav>
</header>
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
    </form>
        <h2> Search for a drink</h2>
    <form action="" method="post">
        <input type="text" name='search'>
        <input type="submit" name="submit" value="search">
    </form>
    <h2>Drinks Information</h2>
    <?php
    echo "<p> Drink Name: " . $this_drink_record['Itemname'] . "<br>";
    echo "<p> Cost: $" . $this_drink_record['price'] . "<br>";
    ?>
</main>
</body>

</html>
