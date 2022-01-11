<?php
include_once 'templates/includes/head.php';
require 'modules/database.php';
require 'modules/customers.php';
require 'modules/sushis.php';
$order_amount =  $_POST['order_amount'];

if (isset($_POST['sent'])){
    $sushiGo = true;
//    $price = getPrice();
//    var_dump($price);
    foreach ($_POST['order_amount'] AS $sushiid => $amount){
        if ($amount > 10 ){
            $sushiGo = false;
        }
    }

    if ($sushiGo) {
        $i = 1;
        foreach ($_POST['order_amount'] AS $sushiid => $amount) {
            echo $sushiid.' - '.$amount . '<br>';
            if (isset($sushiid)) {
                updateAmount($sushiid, $order_amount);
            }
            $i ++;

//                $total = $price * $amount;
//            echo $total;
        }
    } else {
        echo 'order something valid';
    }

    //makeUser();



}
$sushis = getSushis();
?>
<h1>Welcome to ZUZU</h1>
<form method="post" action="">
    <label>First Name</label>
    <input type="text" name="first_name"> <br>
    <label>Last Name</label>
    <input type="text" name="last_name"> <br>
    <label>Address</label>
    <input type="text" name="address"> <br>
    <label>Zipcode</label>
    <input type="text" name="zipcode"> <br>
    <label>City</label>
    <input type="text" name="city"> <br>
    <label>E-Mail</label>
    <input type="text" name="email"> <br>

    <?php foreach ($sushis as $sushi): ?>

        <div>
            <img src="<?= $sushi->picture ?>" alt="image">
            <div><?= $sushi->name ?></div>
            <div>Amount left :<?= $sushi->amount ?></div>
            <div>€ <?= $sushi->price ?></div>
            <label>Oder amount</label>
            <input type="number" name="order_amount[<?= $sushi->id?>]" value="0">
        </div>

    <?php endforeach; ?>
    <button type="submit" name="sent"> Submit </button>



</form>






<?php
include_once 'templates/includes/footer.php';
?>
