<?php
    // require "./Config/database.php";

    $conf = [
        'server' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'database' => 'bcc',
    ];

    $conn = new mysqli(
        $conf['server'],
        $conf['username'],
        $conf['password'],
        $conf['database']
    )

?>