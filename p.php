\<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="project3.css">
</head>
<body>
    <div class="container">
        <h1>Database Access Form</h1>

        <button type="submit" class="button" id="receptionistsButton" value="submit">Receptionist Records</button>
        <button type="submit" class="button" id="patientsButton" value="submit">Patient Records</button>
        <button type="submit" class="button" id="medicalRecordsButton" value="submit">Medical Records</button>
        <button type="submit" class="button" id="appointmentsButton" value="submit">Appointments/Procedures</button>
        <a href="p.php" class="button home-button">HOME</a>
    </div>

    <div class="translucent-background">
        <?php
        if (isset($_POST['table'])) {
            $table = $_POST['table'];
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
            if ($table === "receptionists") {
                $sql = "SELECT * FROM Receptionists";
            } elseif ($table === "patients") {
                $sql = "SELECT * FROM Patients";
            } elseif ($table === "medicalrecords") {
                $sql = "SELECT * FROM MedicalRecords";
            } elseif ($table === "appointmentsprocedures") {
                $sql = "SELECT * FROM AppointmentsProcedures";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
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

    <script>
        function hideButtons() {
            var buttons = document.getElementsByClassName('button');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].style.visibility = 'hidden';
            }
        }
        document.getElementById('receptionistsButton').addEventListener('click', function () {
            hideButtons();
            document.getElementById('tableType').value = 'receptionists';
            document.forms['fetchTableForm'].submit();
        });

        document.getElementById('patientsButton').addEventListener('click', function () {
            hideButtons();
            document.getElementById('tableType').value = 'patients';
            document.forms['fetchTableForm'].submit();
        });

        document.getElementById('medicalRecordsButton').addEventListener('click', function () {
            hideButtons();
            document.getElementById('tableType').value = 'medicalrecords';
            document.forms['fetchTableForm'].submit();
        });

        document.getElementById('appointmentsButton').addEventListener('click', function () {
            hideButtons();
            document.getElementById('tableType').value = 'appointmentsprocedures';
            document.forms['fetchTableForm'].submit();
        });
    </script>
    <form id="fetchTableForm" method="post">
        <input type="hidden" name="table" id="tableType">
    </form>
</body>
</html>


