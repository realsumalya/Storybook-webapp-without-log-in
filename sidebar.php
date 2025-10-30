<!-- sidebar.php -->
<div class="sidebar d-flex flex-column">
  <a href="admin.php">Dashboard</a>
  <a href="allstories.php">All Stories</a>
  <a href="upload_stories.php">Upload Stories</a>
  <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
</div>
<style>
  .sidebar {
    min-height: 100vh;
    background: #232d3b;
    color: #fff;
    position: fixed;
    left: 0; top: 0;
    width: 220px;
    padding-top: 2rem;
    z-index: 100;
  }
  .sidebar a, .sidebar button {
    color: #fff;
    display: block;
    padding: 1rem 1.5rem;
    text-decoration: none;
    font-weight: 500;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    transition: background 0.2s;
  }
  .sidebar a:hover, .sidebar button:hover {
    background: #354052;
    color: #23a6d5;
  }
</style>
