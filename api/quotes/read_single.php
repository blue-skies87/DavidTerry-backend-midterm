<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quotes.php';

    // Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quotes($db);

    // Get ID
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    // get quote
    $quote->read_single();

    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'authorName' => $quote->authorName,
        'quote' => $quote->quote,
        'authorId' => $quote->authorId,
        'categoryId' => $quote->categoryId,
        'categoryName' => $quote->categoryName
    );

    // Make JSON
    print_r(json_encode($quote_arr));

    ?>