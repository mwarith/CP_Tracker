<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News - CP-Tracker</title>
    <link rel="stylesheet" href="add_news_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="add-news-container">
        <h1>Add News</h1>
        <form action="insert1.php" method="POST">
            <label for="news-title">News Title:</label>
            <input type="text" id="news-title" name="news-title" placeholder="Enter the news title" required>

            <label for="news-content">News Content:</label>
            <textarea id="news-content" name="news-content" placeholder="Enter the news content" rows="6"
                required></textarea>

            <button type="submit">Submit News</button>
        </form>
    </div>
</body>

</html>