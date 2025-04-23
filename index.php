<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>KioskBrew</title>
</head>
<body>

  <!-- Container -->
  <div>

    <!-- Header with 3 equal parts -->
    <header style="display: flex; padding: 10px 0; background: #f0e4d7; text-align: center;">
      
      <!-- Left: Hamburger + Tabs -->
      <div style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 10px;">
        <span style="font-size: 24px; cursor: pointer;">☰</span>
        <nav style="display: flex; gap: 8px;">
          <button>A</button>
          <button>B</button>
          <button>C</button>
          <button>D</button>
        </nav>
      </div>

      <!-- Middle: Empty (or you can put date/time or status here) -->
      <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
        <!-- Optional center content -->
      </div>

      <!-- Right: Logo -->
      <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
        <div style="font-weight: bold; font-size: 20px;">KioskBrew</div>
      </div>
    </header>

    <!-- Main Content -->
    <main style="display: flex;">

      <!-- Items Section -->
      <section style="flex: 2; padding: 20px;">
        <h2>Items</h2>
        <div>
          <div>Cafe Mocha</div>
          <div>Caramel Macchiato</div>
          <div>Dark Mocha</div>
          <div>Dirty Mocha</div>
        </div>
      </section>

      <!-- Orders Panel -->
      <aside style="flex: 1; background: #eee; padding: 20px;">
        <h2>Orders</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
          <div style="width: 50px; height: 30px; border: 1px solid black;"></div>
          <div style="width: 50px; height: 30px; border: 1px solid black;"></div>
          <div style="width: 50px; height: 30px; border: 1px solid black;"></div>
          <div style="width: 50px; height: 30px; border: 1px solid black;"></div>
          <div style="width: 50px; height: 30px; border: 1px solid black;"></div>
          <div style="width: 50px; height: 30px; border: 1px solid black;"></div>
          <div style="width: 50px; height: 30px; border: 1px solid black;"></div>
          <div style="width: 50px; height: 30px; border: 1px solid black;"></div>
        </div>
      </aside>

    </main>

  </div>

</body>
</html>
