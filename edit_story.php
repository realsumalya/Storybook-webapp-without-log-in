<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'storybook');
$id = intval($_GET['id']);

// Handle Save changes (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];

    // Only update images if new images uploaded
    $images_str = $_POST['prev_images'];
    $uploaded_files = [];
    if (!empty($_FILES["images"]["name"][0])) {
        for ($i = 0; $i < 4; $i++) {
            if (!empty($_FILES["images"]["name"][$i])) {
                $filename = uniqid() . "_" . $_FILES["images"]["name"][$i];
                move_uploaded_file($_FILES["images"]["tmp_name"][$i], "uploads/" . $filename);
                $uploaded_files[] = $filename;
            }
        }
        $images_str = implode(',', $uploaded_files);
    }
    $stmt = $conn->prepare("UPDATE storytbl SET title=?, content=?, images=?, tags=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $content, $images_str, $tags, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: allstories.php");
    exit;
}

// Fetch current story data
$result = $conn->query("SELECT * FROM storytbl WHERE id = $id");
$row = $result->fetch_assoc();
$images = explode(',', $row['images']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Story</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Edit Story</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Story</label>
        <textarea name="content" rows="5" class="form-control" required><?php echo htmlspecialchars($row['content']); ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Current Images:</label><br>
        <?php foreach ($images as $img): if ($img): ?>
          <img src="uploads/<?php echo htmlspecialchars($img); ?>" class="img-fluid rounded mb-2" style="max-width:120px;" alt="Story image">
        <?php endif; endforeach; ?>
        <input type="hidden" name="prev_images" value="<?php echo htmlspecialchars($row['images']); ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Change Images (Upload up to 4, leave blank to keep old ones).</label>
        <input name="images[]" type="file" class="form-control" multiple accept="image/*">
      </div>
      <div class="mb-3">
        <label class="form-label">Tags (comma separated)</label>
        <input name="tags" type="text" class="form-control" value="<?php echo htmlspecialchars($row['tags']); ?>">
      </div>
      <button type="submit" class="btn btn-success">Save Changes</button>
      <a href="allstories.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
