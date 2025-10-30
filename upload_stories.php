<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_story'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $uploaded_files = [];
    if (isset($_FILES["images"]) && is_array($_FILES["images"]["name"])) {
        for($i=0; $i<count($_FILES["images"]["name"]) && $i<4; $i++) {
            if (!empty($_FILES["images"]["name"][$i])) {
                $filename = uniqid() . "_" . preg_replace("/[^A-Za-z0-9_.-]/", "", $_FILES["images"]["name"][$i]); // sanitize
                move_uploaded_file($_FILES["images"]["tmp_name"][$i], "uploads/" . $filename);
                $uploaded_files[] = $filename;
            }
        }
    }
    $images_str = implode(',', $uploaded_files);
    $conn = new mysqli('localhost', 'root', '', 'storybook');
    $stmt = $conn->prepare("INSERT INTO storytbl (title, content, images, tags) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $images_str, $tags);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: upload_stories.php?posted=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Stories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {background:#f5f7fa;}
    .main-content {margin-left:240px; padding:2rem 1.5rem; min-height:100vh; background:#f5f7fa;}
  </style>
</head>
<body>
  <?php include("sidebar.php"); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="card shadow rounded" style="max-width:650px; margin:2.5rem auto; padding:2rem;">
        <h2 class="mb-4">Upload a New Story</h2>
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="post_story" value="1">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Story</label>
            <textarea name="content" rows="5" class="form-control" required style="resize: none;"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Images (up to 4)</label>
            <input name="images[]" type="file" class="form-control" multiple accept="image/*" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Tags</label>
            <input type="text" name="tags" class="form-control" placeholder="Type tags, comma separated" required>
          </div>
          <button type="submit" class="btn btn-primary">Post Story</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
