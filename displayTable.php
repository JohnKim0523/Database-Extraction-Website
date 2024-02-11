<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="project3.css">
</head>
<body>
    <div class="container">
        <h1>Database Access Form</h1>
        <a href="project3.php" class="button home-button">HOME</a>
    </div>

    <div class="translucent-background">
        <?php
        if (isset($_GET['table'])) {
            $table = $_GET['table'];
            displayTable($table);
        }
        function displayTable($table) {
            $servername = "sql1.njit.edu";
            $username = "jk727";
            $password = "Hosoo052304$";
            $dbname = "jk727";
        
            $conn = new mysqli($servername, $username, $password, $dbname);
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            $sql = "";
            $tableNames = ["Receptionists", "Patients", "MedicalRecords", "AppointmentsProcedures"];
        
            if (in_array($table, $tableNames)) {
                // Construct the SQL query based on the selected table
                $sql = "SELECT * FROM " . $table;
            } else {
                echo "Invalid table selected.";
                $conn->close();
                return;
            }
        
            $result = $conn->query($sql);
        
            if (!$result) {
                echo "Query error: " . $conn->error;
            } elseif ($result->num_rows > 0) {
                echo "<table>";
                $row = $result->fetch_assoc();
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<th>$key</th>";
                }
                echo "</tr>";
        
                $result->data_seek(0);
        
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No records found.";
            }
        
            $conn->close();
        }
        
        ?>
    </div>
</body>
</html>
