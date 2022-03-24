<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Authors.php';

    // Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Authors($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $author->author = $data->author;

    // Create author
    if($author->create()) {
        echo json_encode(
            array('message' => 'Author Created')
        );
    } else {
        echo json_ecnode(
            array('message' => 'Autor not Created')
        );
    }

?>