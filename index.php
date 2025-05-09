<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>KioskBrew</title>
  <style>
  .items-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 20px;
  }
  .item-box {
    background: #ccc;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
  }
  .item-box {
    background: #ccc;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    cursor: pointer;
  }
  .item-box:hover {
    background: #bbb;
  }
</style>
</head>
<body>

  <!-- Container -->
  <div>

        <header style="display: flex; padding: 10px 0; background: #f0e4d7; text-align: center;">

        <!-- Left: Hamburger -->
        <div style="flex: 1; display: flex; align-items: center; justify-content: flex-start; padding-left: 20px;">
          <span style="font-size: 40px; cursor: pointer;">☰</span>
        </div>

        <!-- Center: Navigation Buttons -->
        <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
          <nav style="display: flex; gap: 20px;">
            <button id="btn-a">A</button>
            <button id="btn-b">B</button>
            <button id="btn-c">C</button>
            <button id="btn-d">D</button>
          </nav>

        </div>

        <!-- Right: Logo -->
        <div style="flex: 1; display: flex; align-items: center; justify-content: flex-end; padding-right: 20px;">
          <div style="font-weight: bold; font-size: 20px;">BREweb</div>
        </div>

      </header>

    <!-- Main Content -->
    <main style="display: flex;">

      <!-- Items Section -->
    <section style="flex: 2; padding: 20px;">
      <h2>Items</h2>

      <div id="items-a" class="items-grid">
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Mocha</div>
        <div class="item-box">Caramel Macchiato</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
      </div>

      <div id="items-b" class="items-grid" style="display: none;">
        <div class="item-box">Coffee Jelly</div>
        <div class="item-box">Dark Mocha</div>
        <div class="item-box">Dirty Matcha</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
      </div>

      <div id="items-c" class="items-grid" style="display: none;">
        <div class="item-box">Red Velvet Latte</div>
        <div class="item-box">Salted Caramel</div>
        <div class="item-box">Sea Salt Latte</div>
        <div class="item-box">Cafe Americano</div>
        <div class="item-box">Cafe Americano</div>
      </div>

      <div id="items-d" class="items-grid" style="display: none;">
        <div class="item-box">Pumpkin Spice Latte</div>
        <div class="item-box">Spanish Latte</div>
        <div class="item-box">Toffee Nut Crunch</div>
        <div class="item-box">Cafe Americano</div>
      </div>
    </section>


      <!-- Orders Panel -->
      <aside style="flex: 1; background: #eee; padding: 50px;">
        <h2>Orders</h2>
        <div id="orders-list" style="display: flex; flex-direction: column; gap: 10px;"></div>
      </aside>


    </main>

  </div>
      <script>
        const sections = {
          'btn-a': 'items-a',
          'btn-b': 'items-b',
          'btn-c': 'items-c',
          'btn-d': 'items-d'
        };

        Object.keys(sections).forEach(btnId => {
          document.getElementById(btnId).addEventListener('click', () => {
            Object.values(sections).forEach(id => {
              document.getElementById(id).style.display = 'none';
            });
            document.getElementById(sections[btnId]).style.display = 'grid';
          });
        });
      </script>

      <script>
        const ordersList = document.getElementById('orders-list');

        // Attach click events to all item boxes
        document.querySelectorAll('.item-box').forEach(box => {
          box.addEventListener('click', () => {
            const orderItem = document.createElement('div');
            orderItem.textContent = box.textContent;
            orderItem.style.border = '1px solid black';
            orderItem.style.padding = '10px';
            orderItem.style.borderRadius = '8px';
            orderItem.style.background = '#fff';
            ordersList.appendChild(orderItem);
          });
        });
      </script>

</body>
</html>