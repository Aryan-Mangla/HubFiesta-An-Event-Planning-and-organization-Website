<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $event_id = $_POST['event_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Check if the title and content already exist
    $check_sql = "SELECT * FROM event_faq WHERE event_id = '$event_id' AND title = '$title' AND content = '$content'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // If a record with the same title and content exists, display a message
        echo "Accordion item with the same title and content already exists!";
    } else {
        // Insert accordion data into the database
        $insert_sql = "INSERT INTO event_faq (event_id, title, content) VALUES ('$event_id', '$title', '$content')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "Accordion item added successfully!";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Accordion Item</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-5">Add FAQ</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-50 mx-auto">
            <input type="hidden" name="event_id" value="<?php echo $_GET['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea id="content" name="content" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>

</body>
</html>
