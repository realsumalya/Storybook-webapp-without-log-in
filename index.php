<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Story Collection</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- GSAP (GreenSock Animation Platform) -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    .video-bg {
      position: fixed;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      object-fit: cover;
      z-index: -1;
      background: #111;
    }
    .center-content {
      min-height: 100vh;
      /* Flex center for all device sizes */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 2;
      position: relative;
      padding: 1.5rem;
    }
    h1, h3 {
      color: #fff;
      text-shadow: 0 2px 25px #000a;
    }
    .enter-btn {
      margin-top: 2rem;
      padding: 0.75em 2em;
      font-size: 1.2rem;
      border-radius: 8px;
      border: none;
      background: linear-gradient(90deg, #23a6d5 40%, #e73c7e 100%);
      color: #fff;
      font-weight: bold;
      box-shadow: 0 3px 15px #23a6d577;
      transition: background 0.3s;
      cursor: pointer;
    }
    .enter-btn:hover, .enter-btn:focus {
      background: linear-gradient(90deg, #e73c7e 40%, #23a6d5 100%);
    }
    /* Responsive headline sizes */
    @media (max-width: 600px) {
      h1 { font-size: 2rem; }
      h3 { font-size: 1.1rem; }
    }
  </style>
</head>
<body>
  <!-- Replace 'yourvideo.mp4' with your actual video file -->
  <video class="video-bg" src="banner.mp4" autoplay loop muted playsinline></video>
  <div class="container-fluid center-content">
    <h1 class="display-4">Welcome to Story Collection</h1>
    <h3 class="mb-4">An story publishing platform developed by Sumalya</h3>
    <button class="enter-btn" onclick="window.location.href='homepage.php'">Enter</button>
  </div>
  <script>
    // GSAP entrance animation for smart effect
    gsap.from(".center-content h1", {
      y: -100,
      opacity: 0,
      duration: 1,
      ease: "power3.out"
    });
    gsap.from(".center-content h3", {
      y: 100,
      opacity: 0,
      duration: 1.2,
      delay: 0.7,
      ease: "power3.out"
    });
    gsap.from(".enter-btn", {
      scale: 0.7,
      opacity: 0,
      duration: 0.8,
      delay: 1.3,
      ease: "back.out(1.7)"
    });
  </script>
</body>
</html>
