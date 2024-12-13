<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';
$username = $_SESSION['username'];
$query = "SELECT * FROM students WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Course: <?php echo htmlspecialchars($user['course']); ?></p>
    <p>Age: <?php echo htmlspecialchars($user['age']); ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>

