<?php
$conn = new mysqli('localhost', 'root', '', 'storybook');
$result = $conn->query("SELECT * FROM storytbl ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Story Collection - Homepage</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar-brand img { height: 40px; width: auto; margin-right: 10px; }
    .card { box-shadow: 0 3px 15px #23a6d533; }
    .card-title { font-size: 1.15rem; font-weight: bold; }
    .card-text { font-size: 0.98rem; }
  </style>
</head>
<body>
  <!-- Navbar code as before ... (omitted for brevity) -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark" style="background: #232d3b;">
  <div class="container-fluid">
    <!-- Text Logo -->
    <a class="navbar-brand fw-bold" href="#" style="font-size:1.45rem;">
      StoryBook
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Menu -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin Panel</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container mt-5">
    <h2 class="mb-4">Welcome to Story Collection Homepage!</h2>
    <div class="row" id="story-cards">
      <?php while ($row = $result->fetch_assoc()):
        $first_line = strtok($row['content'], "\n"); // Get first line
      ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100" style="width:250px;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
              <!-- <p class="card-text"><?php echo htmlspecialchars($first_line); ?></p> -->
              <div class="mt-auto">
                <a href="story.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Read full story</a>
              </div>
            </div>
            <div class="card-footer">
  <div>
    <?php
    $tags = array_filter(array_map('trim', explode(',', $row['tags'])));
    foreach($tags as $tag):
    ?>
      <span class="badge bg-secondary me-1 mb-1"><?php echo htmlspecialchars($tag); ?></span>
    <?php endforeach; ?>
  </div>
  <span class="text-muted float-end" style="font-size:0.85em;">
    <?php echo date("d M Y", strtotime($row['created_at'])); ?>
  </span>
</div>

          </div>
        </div>
      <?php endwhile; $conn->close(); ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
