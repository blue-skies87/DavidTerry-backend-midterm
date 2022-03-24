<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Categories.php';

    // Instantiate DB object and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Categories($db);

    // Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // get category
    $category->read_single();

    // Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    // Make JSON
    print_r(json_encode($category_arr));

    ?>