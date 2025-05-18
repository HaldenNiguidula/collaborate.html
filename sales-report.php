<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SALES REPORT</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&family=Irish+Grover&family=Joan&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="sales-report.css" />
</head>
<body>
  <header>
    <!-- Left: Hamburger and Title -->
    <div class="header-left">
      <button class="hamburger" role="button" aria-label="Toggle menu" aria-expanded="false" tabindex="0">☰</button>
      <span class="menu-title">Sales Report</span>
    </div>
    <!-- Right: Logo as Image -->
    <div class="header-right">
      <img id="logo-img" src="logo.png" alt="BREWeb Logo" />
    </div>
  </header>

  <div class="title" aria-label="Page Title">Sales Report</div>

  <div class="top-boxes" role="region" aria-label="Top summary boxes">
    <div class="box">
      <h2>GCash Sales</h2>
      <p>₱1,500</p>
    </div>
    <div class="box">
      <h2>Cash Sales</h2>
      <p>₱3,000</p>
    </div>
    <div class="box">
      <h2>Cash Expenses</h2>
      <p>₱0</p>
    </div>
    <div class="box">
      <h2>Cash Added</h2>
      <p>₱0</p>
    </div>
  </div>

  <div class="bottom-boxes" role="region" aria-label="Bottom summary boxes">
    <div class="box">
      <h2>NUMBER OF SALES</h2>
      <p>0</p>
    </div>
    <div class="box">
      <h2>REVENUE</h2>
      <p>₱0</p>
    </div>
    <div class="box">
      <h2>PROFIT</h2>
      <p>₱0</p>
    </div>
    <div class="box">
      <h2>LOSS</h2>
      <p>₱0</p>
    </div>
  </div>

  <!-- Side Drawer -->
  <div id="side-drawer" aria-hidden="true">
    <button id="close-drawer" aria-label="Close menu">✖ Close</button>

    <!-- Drawer Content -->
    <nav class="main-nav" role="navigation" aria-label="Main Navigation">
      <a href="Admin.php">Home</a>
      <a href="profile.php">Profile</a>
      <a href="admin-transaction.php">Transaction</a>
      <a href="sales-report.php">Sales Report</a>
    </nav>

    <nav class="bottom-nav" aria-label="User Identity">
      <a href="homepage.php">Log Out</a>
    </nav>
  </div>

  <!-- Drawer Backdrop -->
  <div id="drawer-backdrop" tabindex="-1"></div>

  <!-- Main Content -->
  <main>
    <!-- Items Section -->
    <section class="items-section">
      <div id="items-grid" class="items-grid" aria-live="polite" aria-label="Menu items">
        <!-- Items rendered by JS -->
      </div>
    </section>
  </main>

  <script>
    function setupSideDrawer() {
      // Set up hamburger menu toggle and side drawer behavior
      const hamburger = document.querySelector('.hamburger');
      const sideDrawer = document.getElementById('side-drawer');
      const backdrop = document.getElementById('drawer-backdrop');
      const closeBtn = document.getElementById('close-drawer');

      hamburger.addEventListener('click', () => {
        sideDrawer.classList.add('open');
        backdrop.classList.add('visible');
        hamburger.classList.add('open');
        hamburger.setAttribute('aria-expanded', 'true');
        sideDrawer.setAttribute('aria-hidden', 'false');
      });

      const closeDrawer = () => {
        sideDrawer.classList.remove('open');
        backdrop.classList.remove('visible');
        hamburger.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
        sideDrawer.setAttribute('aria-hidden', 'true');
      };

      closeBtn.addEventListener('click', closeDrawer);
      backdrop.addEventListener('click', closeDrawer);
      document.addEventListener('keydown', e => {
        if(e.key === 'Escape' && sideDrawer.classList.contains('open')) {
          closeDrawer();
        }
      });
      sideDrawer.querySelectorAll('nav a').forEach(link => {
        link.addEventListener('click', closeDrawer);
      });
    }

    // Call the setup function once script loads
    setupSideDrawer();
  </script>
</body>
</html>

