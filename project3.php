<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="project3.css">
</head>
<body>
    <div class="container">
        <h1>Database Access Form</h1>
        <form method="post">
            <button class="button" name="table" value="receptionists">Receptionist Records</button>
            <button class="button" name="table" value="patients">Patient Records</button>
            <button class="button" name="table" value="medicalrecords">Medical Records</button>
            <button class="button" name="table" value="appointmentsprocedures">Appointments/Procedures</button>
        </form>
        <a href="project3.php" class="button home-button">HOME</a>
    </div>

    <div class="translucent-background">
        <?php
        if (isset($_POST['table'])) {
            $table = $_POST['table'];
            header("Location: displayTable.php?table=$table"); // Redirect to displayTable.php
            exit; // Stop processing the current page
        }
        ?>
    </div>
</body>
</html>
