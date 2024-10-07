<?php
    // Display the welcome message and version information 
    echo "<h1>Hi All, Good Day </h1>";

    // Database connection details
    $host = "postgres-service";  // Service name defined in docker-compose
    $user = "user";              // PostgreSQL username
    $password = "password";      // PostgreSQL password
    $dbname = "testdb";          // Database name

    try {
        // Create a connection to the PostgreSQL database
        $dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$password";
        $pdo = new PDO($dsn);

        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create a sample table
        $createTableQuery = "
            CREATE TABLE IF NOT EXISTS greetings (
                id SERIAL PRIMARY KEY,
                message TEXT NOT NULL
            );
        ";
        $pdo->exec($createTableQuery);
        echo "Table 'greetings' created successfully.<br>";

        // Insert a sample record
        $insertQuery = "INSERT INTO greetings (message) VALUES ('Hi Stackroute Team and Natwest group, Thank You for the training. Special Thanks to the trainer Raman Khanna from Team 2!')";
        $pdo->exec($insertQuery);
        echo "Sample data inserted into 'greetings' table.<br>";

        // Fetch the inserted data
        $selectQuery = "SELECT message FROM greetings";
        $stmt = $pdo->query($selectQuery);

        echo "<h2>Inserted Messages:</h2>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['message'] . "<br>"; // Display each message
        }

        // Example query to fetch PostgreSQL version
        $versionQuery = "SELECT version()";  // Fetch PostgreSQL version
        $stmt = $pdo->query($versionQuery);
        $version = $stmt->fetchColumn();

        echo "Connected to PostgreSQL version: " . $version;

    } catch (PDOException $e) {
        // Handle connection error
        echo "Connection failed: " . $e->getMessage();
    }
?>
