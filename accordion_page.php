<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $event_id = $_POST['event_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Insert accordion data into the database
    $sql = "INSERT INTO event_faq (event_id, title, content) VALUES ('$event_id', '$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "Accordion item added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Accordion Item</title>
</head>

<body>
    <h2>Add Accordion Item</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="event_id" value="<?php echo $_GET['id']; ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content"></textarea><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>
