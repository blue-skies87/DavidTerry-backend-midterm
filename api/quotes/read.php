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

    // Quote query
    $result = $quote->read();
    //Get row count
    $num = $result->rowCount();

    // Check if any quotes
    if($num > 0) {
        // Quote array
        $quotes_arr = array();
        $quotes_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'authorName' => $authorName,
                'quote' => $quote,
                'authorId' => $authorId,
                'categoryId' => $categoryId,
                'categoryName' => $categoryName
            );

            // Push to "data"
            array_push($quotes_arr['data'], $quote_item);
        }

        // Turn to Json and output
        echo json_encode($quotes_arr);

    } else {
        // No quotes
        echo json_encode(
            array('message' => 'No quotes found')
        );
    }
?>