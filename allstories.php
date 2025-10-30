<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'storybook');
$result = $conn->query("SELECT * FROM storytbl ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>All Stories - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f7fa;
    }
    .main-content {
      margin-left: 240px;
      padding: 2rem 1.5rem;
      min-height: 100vh;
      background: #f5f7fa;
    }
  </style>
</head>
<body>
  <?php include("sidebar.php"); ?>
  <div class="main-content">
    <div class="container-fluid">
      <div class="card shadow rounded" style="margin:2.5rem auto; padding:2rem; max-width:1000px;">
        <h2 class="mb-4">All Stories</h2>
        <table class="table table-bordered table-hover table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>Title</th>
              <th>Tags</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()):
              $tags = array_filter(array_map('trim', explode(',', $row['tags'])));
            ?>
            <tr>
              <td><?php echo htmlspecialchars($row['title']); ?></td>
              <td>
                <?php foreach($tags as $tag): ?>
                  <span class="badge bg-secondary me-1 mb-1"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
              </td>
              <td><?php echo date("d M Y", strtotime($row['created_at'])); ?></td>
              <td>
                <a href="edit_story.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                <a href="delete_story.php?id=<?php echo $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this story?');">Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
