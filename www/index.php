<html>
<head>
  <title>Hello...</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Hi! I'm happy</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>MySQL Data</h2>
                <?php
                $mysql_conn = mysqli_connect('db', 'user', 'test', 'myDb');

                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }

                $query = "SELECT * From Person";
                $result = mysqli_query($mysql_conn, $query);

                echo '<table class="table table-striped">';
                echo '<thead><tr><th></th><th>id</th><th>name</th></tr></thead>';
                while($value = $result->fetch_array()) {
                    echo '<tr>';
                    echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
                    foreach($value as $element) {
                        echo '<td>' . $element . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';

                $result->close();
                mysqli_close($mysql_conn);
                ?>
            </div>

            <div class="col-md-6">
                <h2>PostgreSQL Data</h2>
                <?php
                try {
                    $pgsql_conn = new PDO("pgsql:host=postgres;dbname=myPgDb", "pguser", "pgtest");
                    $pgsql_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // вывод данных для постгрескл
                    $stmt = $pgsql_conn->query("SELECT * FROM person");
                    
                    echo '<table class="table table-striped">';
                    echo '<thead><tr><th></th><th>id</th><th>name</th></tr></thead>';
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';

                    // Форма для добавления данных
                    echo '
                    <div class="panel panel-default">
                        <div class="panel-heading">Add to PostgreSQL</div>
                        <div class="panel-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>';

                    // Обработка добавления данных
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["name"])) {
                        $name = $_POST["name"];
                        $stmt = $pgsql_conn->prepare("INSERT INTO person (name) VALUES (:name)");
                        $stmt->bindParam(':name', $name);
                        $stmt->execute();
                        
                        echo '<div class="alert alert-success">Added successfully! Refresh to see changes.</div>';
                    }
                } catch(PDOException $e) {
                    echo "PostgreSQL Connection failed: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>