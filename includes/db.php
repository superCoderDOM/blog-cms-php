<?php 

    // $db['db_host'] = 'localhost';
    // $db['db_username'] = 'root';
    // $db['db_password'] = 'c0ding!5fun';
    // $db['db_database'] = 'cms';

    // foreach($db as $key => $value) {
    //     define(strtoupper($key), $value);
    // }

    $connection = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);

    if(!$connection) {
        echo "Could not connect to database.";
    }

?>