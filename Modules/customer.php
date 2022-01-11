<?php

function makeUser() {
    global $pdo;

    $query = $pdo->prepare('INSERT INTO customers (first_name,last_name,address,zipcode,city, email)
                                VALUES (:first_name, :last_name, :address, :zipcode, :city, :email)');

    //var_dump($_POST);
    $first = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

    $query->bindParam(':first_name', $first,PDO::PARAM_STR);
    $query->bindParam(':last_name', $last,PDO::PARAM_STR);
    $query->bindParam(':address', $address,PDO::PARAM_STR);
    $query->bindParam(':zipcode', $zipcode,PDO::PARAM_STR);
    $query->bindParam(':city', $city,PDO::PARAM_STR);
    $query->bindParam(':email', $email,PDO::PARAM_STR);

    $query->execute();
    $_POST = [];

}

function getCustomer($id){

    global $pdo;
    try
    {
        $query=$pdo->prepare("SELECT * FROM customers WHERE id = :id");
        $query->bindParam("id", $productId);
        $query->setFetchMode(PDO::FETCH_CLASS, 'Customer');
        $query->execute();
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $query->fetch();
}