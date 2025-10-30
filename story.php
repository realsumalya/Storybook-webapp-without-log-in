<?php
$conn = new mysqli('localhost', 'root', '', 'storybook');
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM storytbl WHERE id = $id");
$row = $result->fetch_assoc();
$images = explode(',', $row['images']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($row['title']); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
    <div class="mb-3">
      <?php foreach ($images as $img):
        if ($img): ?>
          <img src="uploads/<?php echo htmlspecialchars($img); ?>" class="img-fluid rounded mb-2" style="max-width:320px;" alt="Story image">
        <?php endif; endforeach; ?>
    </div>
    <div class="mb-2">
      <?php
      // Split tags by comma, trim whitespace, and remove empty entries
      $tags = array_filter(array_map('trim', explode(',', $row['tags'])));
      foreach($tags as $tag):
      ?>
        <span class="badge bg-secondary me-1 mb-1"><?php echo htmlspecialchars($tag); ?></span>
      <?php endforeach; ?>
      <span class="text-muted ms-2"> 
        <?php echo date("d M Y", strtotime($row['created_at'])); ?>
      </span>
    </div>
    <a href="homepage.php" class="btn btn-outline-primary mt-4">Back to Homepage</a>
  </div>
</body>
</html>
