<?php
include("../Connection/connection.php");
session_start();

require_once('../TCPDF-main/tcpdf.php');


// Check if the user is logged in
if (!isset($_SESSION['username']) || isset($_SESSION['username']) != 'admin') {
    // Redirect the user to the login page
    header('Location: ../Connection/log-in.php');
    exit;
}

// Check if a user is selected
if (isset($_GET['selected_user'])) {
    $selectedUser = $_GET['selected_user'];
    $selectedUser = $selectedUser - 1;

    // Retrieve the selected user's information from the database
    $sqlUser = "SELECT * FROM users WHERE id = $selectedUser";
    $resultUser = $con->query($sqlUser);
    $selectedUserInfo = $resultUser->fetch_assoc();

    // Generate a PDF file with the related data from the database
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('');
    $pdf->SetTitle('Utilisateur');
    $pdf->AddPage();

    // Set font properties for table headers
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetFillColor(200, 200, 200); // Set background color for headers

    // Define the tables you want to include in the CSV
    $tables = [
        'patients',
        'personnels',
        'familiaux',
        'toxiques',
        'signes_dappel_oculaires',
        'signes_dappel_extra_oculaires',
        'consultations',
        'av_atteint',
        'av_adelphe',
        'investigations_etiologique',
        'investigations_biologique',
        'investigations_radiologiques',
        'etiologie_retenue',
        'corticothérapie',
        'immunosuppresseur',
        'anti_infectieux',
        'biothérapie',
        'evolutions'
    ];


    foreach ($tables as $table) {
        // Determine the column name based on the table
        $columnName = ($table === 'patients') ? 'user_id' : 'patientid';

        // Determine the starting ID based on the table
        $startingID = ($table === 'patients') ? $selectedUser + 1 : $selectedUser;

        // Retrieve and add data from each table to the PDF
        $sqlData = "SELECT * FROM $table WHERE $columnName = $startingID";
        $resultData = $con->query($sqlData);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, 'Table: ' . $table, 0, 1);
        $pdf->Ln();

        // Add table heading
        $pdf->Cell(0, 10, 'Table: ' . $table, 1, 1, 'L', true);
        $pdf->Ln(5);

        // Set font properties for table content
        $pdf->SetFont('helvetica', '', 10);
        // $pdf->SetFillColor(255, 255, 255); // Set background color for content

        // Retrieve and loop through the data
        while ($rowData = $resultData->fetch_assoc()) {
            foreach ($rowData as $column => $value) {
                // Set width for the column name cell
                $pdf->Cell(60, 10, $column, 1, 0, 'L', true); // Adjust the width as per your requirement
                $pdf->Cell(0, 10, $value, 1, 1, 'L', true);
            }
        }

        $pdf->Ln(10);
    }


    // Output the PDF to the browser
    $pdf->Output('user_data_' . $selectedUser . '.pdf', 'D');

    exit;
}

// Retrieve the list of users from the database
$sql = "SELECT * FROM users";
$result = $con->query($sql);

// Store the users in an array
$users = array();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- adding css files -->
    <link rel="stylesheet" href="../css/global-rules.css">
    <link rel="stylesheet" href="../css/home.css">
    <!-- adding google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300&display=swap"
        rel="stylesheet">
    <!-- adding fonts-awesome library -->
    <script src="https://kit.fontawesome.com/687c4d88d6.js" crossorigin="anonymous"></script>
    <title>Accueil</title>
</head>

<body>
    <div class="container">
        <div class="formDiv admin">

            <form action="" method="GET" class="admin-form">
                <label for="selected_user" class="admin-label">Veuillez choisir un utilisateur :</label>
                <select name="selected_user" id="selected_user" class="admin-select">
                    <?php foreach ($users as $user): ?>
                        <?php if ($user['Id'] != 1): ?>
                            <option value="<?php echo $user['Id']; ?>"><?php echo $user['Username']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Télécharger" class="admin-submit">
            </form>

        </div>
    </div>
</body>

</html>