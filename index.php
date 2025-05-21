<!DOCTYPE html>
<html>
<head>
    <title>Database Data</title>
</head>
<body>
    <h1>MySQL Data</h1>
    <?php
    try {
        $pdo = new PDO("mysql:host=mysql;dbname=mydb", "user", "pass");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        foreach($pdo->query("SELECT * FROM users") as $row) {
            echo $row['id'] . ": " . $row['name'] . "<br>";
        }
    } catch (PDOException $e) {
        echo "MySQL Error: " . $e->getMessage();
    }
    ?>

    <h1>PostgreSQL Data</h1>
    <?php
    try {
        $pdo = new PDO("pgsql:host=postgres;dbname=pgdb", "pguser", "pgpass");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        foreach($pdo->query("SELECT * FROM employees") as $row) {
            echo $row['id'] . ": " . $row['name'] . "<br>";
        }
    } catch (PDOException $e) {
        echo "PostgreSQL Error: " . $e->getMessage();
    }
    ?>
</body>
</html>