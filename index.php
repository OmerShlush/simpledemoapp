<!DOCTYPE html>
<html>
<head>
    <title>Connection Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .status {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <h1>Connection Status</h1>
    <?php
    // Function to check MySQL connection
    function checkMySQL() {
        try {
            $host = getenv('MYSQL_HOST') ?: 'localhost';
            $port = getenv('MYSQL_PORT') ?: '3306';
            $user = getenv('MYSQL_USER');
            $pass = getenv('MYSQL_PASS');
            $db = getenv('MYSQL_DB');

            if (!$user || !$pass || !$db) {
                throw new Exception("Missing MySQL environment variables");
            }

            $dsn = "mysql:host=$host;port=$port;dbname=$db";
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // Function to check RabbitMQ connection
    function checkRabbitMQ() {
        try {
            $host = getenv('RABBITMQ_HOST') ?: 'localhost';
            $port = getenv('RABBITMQ_PORT') ?: '5672';
            $user = getenv('RABBITMQ_USER');
            $pass = getenv('RABBITMQ_PASS');

            if (!$user || !$pass) {
                throw new Exception("Missing RabbitMQ environment variables");
            }

            $connection = new AMQPConnection([
                'host' => $host,
                'port' => $port,
                'login' => $user,
                'password' => $pass
            ]);
            
            $connection->connect();
            $connection->disconnect();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // Check MySQL connection
    $mysqlStatus = checkMySQL();
    echo '<div class="status ' . ($mysqlStatus ? 'success' : 'error') . '">';
    echo '<h2>MySQL Connection</h2>';
    echo $mysqlStatus ? 'Connected successfully' : 'Connection failed';
    echo '</div>';

    // Check RabbitMQ connection
    $rabbitmqStatus = checkRabbitMQ();
    echo '<div class="status ' . ($rabbitmqStatus ? 'success' : 'error') . '">';
    echo '<h2>RabbitMQ Connection</h2>';
    echo $rabbitmqStatus ? 'Connected successfully' : 'Connection failed';
    echo '</div>';
    ?>
</body>
</html> 