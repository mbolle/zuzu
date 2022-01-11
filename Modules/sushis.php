<?php

function getSushis()
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM sushi");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_CLASS, "Sushi");
    return $result;
}

function getSushi($id)
{
    global $pdo;
    $query = $pdo->prepare("SELECT amount FROM sushi WHERE id = '$id'");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_CLASS, "Sushi");
    return $result[0];
}

function updateAmount($id, $order_amount)
{
    global $pdo;
    $sushi = getSushi($id);
    $cur = $order_amount[$id];
    echo "OM <br>";
    var_dump($order_amount);
    $query = " UPDATE sushi SET amount=($sushi->amount - $cur) WHERE id=$id";
    $stmt = $pdo->prepare($query);
    $order_amount = filter_input(INPUT_POST, 'order_amount', FILTER_SANITIZE_NUMBER_INT);
//    $query->bindParam('$order_amount', $order_amount,PDO::PARAM_INT);
    $result = $stmt->execute();


}

function getPrice()
{
    global $pdo;
    $query = $pdo->prepare("SELECT price FROM sushi WHERE id = ?");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_CLASS, "Sushi");
    return $result;
}