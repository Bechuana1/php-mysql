<?php
require_once '../../config/config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If user is not logged in, redirect to the login page
    header("Location: ../../auth/login.html");
    exit; // Stop further execution
}



$errors = [];

// Fetch all authors from the database
$sql = "SELECT * FROM authors";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    $authors = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $errors[] = "Failed to fetch authors: " . mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Authors</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>All Authors</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $error): ?>
                                <?php echo $error; ?><br>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php foreach ($authors as $author): ?>
                                <li class="list-group-item"><?php echo $author['name']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="../dash.php" class="justify-content-center"><button class="btn btn-success">Back to Dashboard</button></a>
<a href="../authors/add_author.php" class="justify-content-center"><button class="btn btn-primary">Add New Author</button></a>


<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
