<?php

echo "connecting to DB".PHP_EOL;

if( in_array ('pdo_mysql', get_loaded_extensions())) {
    // ! this code is bad, credentials are not read from a file or from env variables !
    $dsn = "mysql:host=db;dbname=test_db";
    $opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
    echo "connected to DB".PHP_EOL;
    try {
        $connection = new PDO($dsn, "root", '', $opt);

        $val = 'testStr';
        // nothing is dynamic here, this code really sucks !
        $sql = 'INSERT INTO test_table(test_field) VALUES(:val)';   
        $statement = $connection->prepare($sql);
        $statement->execute([
            ':val' => $val
        ]);   

    } catch (\PDOException $pdoe) {
        echo $pdoe->getMessage();
    }
}