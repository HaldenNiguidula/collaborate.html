<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BREWeb</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fffaf0;
      color: #333;
    }

    body > div {
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      display: flex;
      height: 100%;
      overflow: hidden;
      font-size: 16px;
    }

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
      cursor: pointer;
      user-select: none;
      box-shadow: 0 2px 6px rgba(0,0,0,0.12);
      transition: background-color 0.2s ease;
    }

    .item-box:hover {
      background: #bbb;
    }

    aside h2 {
      text-align: center;
    }

    /*Styles for Navigation*/
    button {
      background-color: #FFD483; /* Light orange-yellow */
      color: #000000;
      font-weight: bold;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      user-select: none;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #e6b74f;
      color: #000000;
    }

    /* Style for Payment Modal/Method */
    .order-controls button {
      background-color: #007bff; /* Blue color for both buttons */
      color: white; /* White text color */
      padding: 10px 20px; /* Adjust padding for a better appearance */
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease; /* Smooth transition for background color */
    }

    /* Order Section Styles */
    section {
      flex: 1;
      padding: 20px;
      border-left: 1px solid #ccc;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100vh;
      max-height: 100vh; /* Ensure it doesn't exceed the viewport height */
      box-sizing: border-box; /* Include padding in height calculation */
    }

    /* Orders List: Make it scrollable if too much content */
    #order-list {
      max-height: 60vh; /* Limits the orders list height */
      overflow-y: auto; /* Allows vertical scrolling if necessary */
      margin-bottom: 20px; /* Space for the buttons */
    }

    /* Order Controls - Make sure it fits properly */
    .order-controls {
      display: flex;
      justify-content: space-between;
      gap: 10px; /* Small gap between the buttons */
      margin-top: auto; /* Push it to the bottom */
    }
    .order-controls button {
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 48%; /* Makes the buttons occupy equal width */
    }

    /* Clear All Button */
    .order-controls button:nth-child(1) {
      background-color: #FFD483;
      color: black;
    }

    .order-controls button:nth-child(1):hover {
      background-color: #FFD483;
      color: black;
    }

    /* Checkout Button */
    .order-controls button:nth-child(2) {
      background-color: #D0AC77;
      color: black;
      font-weight: bold;
    }

    .order-controls button:nth-child(2):hover {
      background-color: #D0AC77;
      color: black;
    }

    /* Order Entry Styles */
    .order-entry {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #999;
      padding: 10px;
      margin-bottom: 8px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      font-size: 15px;
      user-select: none;
    }

    .order-name {
      flex: 1;
      padding-right: 10px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 6px;
      margin: 0 10px;
    }

    .quantity-controls button {
      background-color: #D0AC77;
      border: none;
      border-radius: 4px;
      padding: 3px 9px;
      font-weight: bold;
      font-size: 18px;
      cursor: pointer;
      color: black;
      line-height: 1;
      user-select: none;
      transition: background-color 0.2s ease;
    }

    .quantity-controls button:hover {
      background-color: #B38E53;
      color: white;
    }

    .item-price {
      min-width: 70px;
      text-align: right;
      font-weight: 600;
    }

    .remove-btn {
      background: transparent;
      border: none;
      color: #dc3545;
      font-size: 18px;
      cursor: pointer;
      padding: 0 6px;
      user-select: none;
      transition: color 0.2s ease;
    }
    .remove-btn:hover {
      color: #a71d2a;
    }

    /* Payment Modal */
    #payment-modal {
      display:none;
      position:fixed;
      top:0;
      left:0;
      width:100%;
      height:100%;
      background:#000000aa;
      z-index:2000;
      justify-content:center;
      align-items:center;
      padding: 15px;
      box-sizing: border-box;
    }
    #payment-modal > div {
      background:#fff;
      padding:30px;
      border-radius:10px;
      max-width: 400px;
      width: 100%;
      box-sizing: border-box;
    }
    #payment-modal h3 {
      margin-top:0;
      margin-bottom: 15px;
    }
    #payment-modal select,
    #payment-modal input[type="number"] {
      width: 100%;
      padding: 8px 10px;
      font-size: 16px;
      margin: 10px 0 15px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    #payment-modal p {
      margin: 5px 0;
    }
    #payment-modal button {
      margin-left: 10px;
      border-radius: 5px;
      padding: 8px 15px;
      font-weight: bold;
    }

    /* Dine In / Take Out Section */
    #order-type-section {
      margin: 15px 0 18px 0;
    }
    #order-type-section label {
      margin-right: 20px;
      font-weight: 700;
      cursor: pointer;
      user-select: none;
    }
    #order-type-section input[type="radio"] {
      margin-right: 6px;
      cursor: pointer;
    }
    
    /* Responsive tweaks for small/mobile screens */
    @media (max-width: 600px) {
      main {
        flex-direction: column;
        height: auto;
      }
      section {
        max-height: none;
        border-left: none;
        padding: 10px;
        height: auto;
      }
      .items-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 12px;
      }
      header nav {
        gap: 15px;
      }
      button {
        padding: 8px 12px;
        font-size: 14px;
      }
      .order-controls button {
        padding: 10px;
        font-size: 14px;
      }
      /* Resize logo image for mobile */
      #logo-img {
        max-height: 40px;
        width: auto;
      }
    }

    /* Logo Image Style */
    #logo-img {
      max-height: 50px;
      width: auto;
      object-fit: contain;
    }

    /* Simplified Side Drawer Styles */
    #side-drawer {
      position: fixed;
      top: 0;
      left: 0;
      width: 240px;
      height: 100vh;
      background-color: #FFD483;
      box-shadow: 2px 0 6px rgba(0,0,0,0.3);
      transform: translateX(-100%);
      transition: transform 0.3s ease;
      z-index: 1500;
      padding: 20px;
      box-sizing: border-box;
    }
    #side-drawer.open {
      transform: translateX(0);
    }
    #side-drawer nav {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      font-weight: 600;
    }
    #side-drawer nav a {
      color: #333;
      text-decoration: none;
      padding: 8px 10px;
      border-radius: 6px;
      user-select: none;
      transition: background-color 0.2s ease;
      cursor: pointer;
    }
    #side-drawer nav a:hover {
      background-color: #e6b74f;
      color: black;
    }
    #close-drawer {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      margin-bottom: 15px;
      color: #333;
      user-select: none;
      font-weight: bold;
    }
    #close-drawer:hover {
      color: #b37700;
    }
    /* Backdrop overlay */
    #drawer-backdrop {
      display: none;
      position: fixed;
      top:0; left:0;
      width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.3);
      z-index: 1400;
    }
    #drawer-backdrop.visible {
      display: block;
    }
    /* Hamburger icon */
    header .hamburger {
      font-size: 38px;
      cursor: pointer;
      user-select: none;
      line-height: 1;
    }
    header .hamburger.open {
      color: #b37700;
    }
  </style>
</head>
<body>
  <!-- Container -->
  <div>
    <header style="display: flex; padding: 10px 0; background: #D0AC77; text-align: center; align-items: center;">

      <!-- Left: Hamburger -->
      <div style="flex: 1; display: flex; align-items: center; justify-content: flex-start; padding-left: 20px;">
        <span class="hamburger" role="button" aria-label="Toggle menu" tabindex="0" aria-expanded="false">☰</span>
      </div>

      <!-- Center: Navigation Buttons -->
      <div style="display: flex; justify-content: center; margin-top: 5px;">
          <nav style="display: flex; gap: 70px;">
          <button id="btn-a">Hot Coffee</button>
          <button id="btn-b">Iced Coffee</button>
          <button id="btn-c">Non Coffee</button>
          <button id="btn-d">Pastries</button>
          </nav>
      </div>

      <!-- Right: Logo as Image -->
      <div style="flex: 1; display: flex; align-items: center; justify-content: flex-end; padding-right: 20px;">
        <img id="logo-img" src="logo.png" alt="BREWeb Logo" />
      </div>
    </header>

    <!-- Side Drawer -->
    <div id="side-drawer" aria-hidden="true">
      <button id="close-drawer" aria-label="Close menu">✖ Options</button>

      <!-- Drawer Content -->
      <nav>
          <a href="homepage.php">Log In/Out</a>
          <a href="#">Sales Report</a>
          <a href="transaction-page.php">Transaction</a>
          <a href="cash-drawer.php">Cash Drawer</a>
      </nav>
    </div>

    <!-- Drawer Backdrop -->
    <div id="drawer-backdrop" tabindex="-1"></div>

    <!-- Main Content -->
    <main style="display: flex; height: 100%;">

      <!-- Items Section -->
      <section style="flex: 2; padding: 20px;">
    
        <!-- Section A -->
        <div id="items-a" class="items-grid">
            <div class="item-box" data-name="Cafe Americano" data-price="120">
                <div><strong>Cafe Americano</strong></div>
                <div>₱120.00</div>
            </div>
            <div class="item-box" data-name="Cafe Mocha" data-price="140">
                <div><strong>Cafe Mocha</strong></div>
                <div>₱140.00</div>
            </div>
            <div class="item-box" data-name="Caramel Macchiato" data-price="160">
                <div><strong>Caramel Macchiato</strong></div>
                <div>₱160.00</div>
            </div>
            <div class="item-box" data-name="Cafe Latte" data-price="130">
                <div><strong>Cafe Latte</strong></div>
                <div>₱130.00</div>
            </div>
            <div class="item-box" data-name="Flat White" data-price="125">
                <div><strong>Flat White</strong></div>
                <div>₱125.00</div>
            </div>
            <div class="item-box" data-name="Espresso" data-price="110">
                <div><strong>Espresso</strong></div>
                <div>₱110.00</div>
            </div>
        </div>
        
        <!-- Section B -->
        <div id="items-b" class="items-grid" style="display: none;">
            <div class="item-box" data-name="Coffee Jelly" data-price="130">
                <div><strong>Coffee Jelly</strong></div>
                <div>₱130.00</div>
            </div>
            <div class="item-box" data-name="Dark Mocha" data-price="150">
                <div><strong>Dark Mocha</strong></div>
                <div>₱150.00</div>
            </div>
            <div class="item-box" data-name="Dirty Matcha" data-price="145">
                <div><strong>Dirty Matcha</strong></div>
                <div>₱145.00</div>
            </div>
            <div class="item-box" data-name="Iced Americano" data-price="120">
                <div><strong>Iced Americano</strong></div>
                <div>₱120.00</div>
            </div>
            <div class="item-box" data-name="Iced Latte" data-price="130">
                <div><strong>Iced Latte</strong></div>
                <div>₱130.00</div>
            </div>
        </div>
        
        <!-- Section C -->
        <div id="items-c" class="items-grid" style="display: none;">
            <div class="item-box" data-name="Red Velvet Latte" data-price="155">
                <div><strong>Red Velvet Latte</strong></div>
                <div>₱155.00</div>
            </div>
            <div class="item-box" data-name="Salted Caramel" data-price="160">
                <div><strong>Salted Caramel</strong></div>
                <div>₱160.00</div>
            </div>
            <div class="item-box" data-name="Sea Salt Latte" data-price="150">
                <div><strong>Sea Salt Latte</strong></div>
                <div>₱150.00</div>
            </div>
            <div class="item-box" data-name="Toasted Vanilla" data-price="140">
                <div><strong>Toasted Vanilla</strong></div>
                <div>₱140.00</div>
            </div>
        </div>
        
        <!-- Section D -->
        <div id="items-d" class="items-grid" style="display: none;">
            <div class="item-box" data-name="Pumpkin Spice Latte" data-price="170">
                <div><strong>Pumpkin Spice Latte</strong></div>
                <div>₱170.00</div>
            </div>
            <div class="item-box" data-name="Toffee Nut Crunch" data-price="165">
                <div><strong>Toffee Nut Crunch</strong></div>
                <div>₱165.00</div>
            </div>
            <div class="item-box" data-name="Cinnamon Roll Latte" data-price="150">
                <div><strong>Cinnamon Roll Latte</strong></div>
                <div>₱150.00</div>
            </div>
        </div>

      </section>
    
      <!-- Orders Section -->
      <section style="flex: 1; padding: 20px; border-left: 1px solid #ccc; background-color: #f9f9f9; display: flex; flex-direction: column; justify-content: space-between; height: 90vh;">
        <div>
          <h3 style="background-color: #FFD483; padding: 20px; border-radius: 5px;">Orders</h3>
          <div id="order-list"></div>
        </div>

        <div style="margin-top: auto; padding-top: 10px; border-top: 1px solid #000000;">
          <div style="text-align: right; font-weight: bold; margin-bottom: 10px;">
            Total: ₱<span id="order-total">0.00</span>
          </div>
          <div class="order-controls">
            <button onclick="clearOrders()">Clear All</button>
            <button onclick="checkout()">Checkout</button>
          </div>
        </div>
      </section>

      <!-- Payment Modal -->
      <div id="payment-modal">
        <div>
          <h3>Select Payment Method</h3>

          <!-- Dine In or Take Out -->
          <div id="order-type-section" role="radiogroup" aria-label="Select Order Type">
            <label>
              <input type="radio" name="order-type" value="Dine In" checked />
              Dine In
            </label>
            <label>
              <input type="radio" name="order-type" value="Take Out" />
              Take Out
            </label>
          </div>
          
          <select id="payment-method" aria-label="Select Payment Method">
            <option value="cash">Cash</option>
            <option value="gcash">GCash</option>
          </select>

          <div id="cash-section">
            <p>Total Due: ₱<span id="payment-total">0.00</span></p>
            <label>Received Cash:
                <input type="number" id="cash-input" min="0" step="0.01" aria-label="Received Cash Amount"/>
            </label>
            <p>Change: ₱<span id="change-amount">0.00</span></p>
          </div>

          <div id="gcash-section" style="display:none;">
            <p>Please confirm payment via GCash on your mobile device.</p>
          </div>

          <div style="margin-top:20px; text-align:right;">
            <button onclick="closePaymentModal()">Cancel</button>
            <button onclick="confirmPayment()">Confirm</button>
          </div>
        </div>
      </div>

    </main>      

  </div>

  <script>
    // Navigation Buttons Show/Hide
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

    // Simplified Side Drawer Logic
    const drawer = document.getElementById('side-drawer');
    const backdrop = document.getElementById('drawer-backdrop');
    const hamburger = document.querySelector('header .hamburger');
    const closeBtn = document.getElementById('close-drawer');

    function openDrawer() {
      drawer.classList.add('open');
      backdrop.classList.add('visible');
      drawer.setAttribute('aria-hidden', 'false');
      hamburger.setAttribute('aria-expanded', 'true');
      hamburger.classList.add('open');
    }

    function closeDrawer() {
      drawer.classList.remove('open');
      backdrop.classList.remove('visible');
      drawer.setAttribute('aria-hidden', 'true');
      hamburger.setAttribute('aria-expanded', 'false');
      hamburger.classList.remove('open');
      hamburger.focus();
    }

    hamburger.addEventListener('click', () => {
      if(drawer.classList.contains('open')) {
        closeDrawer();
      } else {
        openDrawer();
      }
    });

    hamburger.addEventListener('keydown', e => {
      if(e.key === 'Enter' || e.key === ' ' || e.key === 'Spacebar') {
        e.preventDefault();
        hamburger.click();
      }
    });

    closeBtn.addEventListener('click', closeDrawer);
    backdrop.addEventListener('click', closeDrawer);

    document.addEventListener('keydown', e => {
      if(e.key === 'Escape' && drawer.classList.contains('open')) {
        closeDrawer();
      }
    });

    // Close drawer when a nav link is clicked
    drawer.querySelectorAll('nav a').forEach(link => {
      link.addEventListener('click', closeDrawer);
    });
  </script>

  <script>
    let total = 0;
    const orders = {}; // Track items and their quantities
    let orderNumberCount = 0; // Track order number count for transactions

    function generateOrderNumber() {
      orderNumberCount++;
      return 'ORD' + String(orderNumberCount).padStart(4, '0');
    }

    // Add item click handler
    document.querySelectorAll(".item-box").forEach(box => {
      box.addEventListener("click", () => {
        const name = box.getAttribute("data-name");
        const price = parseFloat(box.getAttribute("data-price"));

        if (orders[name]) {
          // Increase quantity and price
          orders[name].quantity++;
          orders[name].totalPrice += price;
          updateOrderItem(name);
        } else {
          // New order entry
          orders[name] = {
            quantity: 1,
            price: price,
            totalPrice: price
          };
          addNewOrderItem(name);
        }
        total += price;
        updateTotal();
      });
    });

    function addNewOrderItem(name) {
      const orderList = document.getElementById("order-list");

      const orderItem = document.createElement("div");
      orderItem.classList.add("order-entry");

      // Name
      const itemName = document.createElement("span");
      itemName.classList.add("order-name");
      itemName.textContent = name;

      // Quantity controls container
      const quantityControls = document.createElement("div");
      quantityControls.classList.add("quantity-controls");

      // Minus button
      const minusBtn = document.createElement("button");
      minusBtn.textContent = "−";
      minusBtn.title = "Decrease quantity";
      minusBtn.onclick = () => {
        const item = orders[name];
        if (item.quantity > 1) {
          item.quantity--;
          item.totalPrice -= item.price;
          total -= item.price;
          updateOrderItem(name);
          updateTotal();
        } else {
          // Remove item if quantity reaches 0 or 1 and minus is clicked
          total -= orders[name].totalPrice;
          updateTotal();
          orderItem.remove();
          delete orders[name];
        }
      };

      // Quantity display
      const quantityDisplay = document.createElement("span");
      quantityDisplay.classList.add("item-quantity");
      quantityDisplay.textContent = `x${orders[name].quantity}`;

      // Plus button
      const plusBtn = document.createElement("button");
      plusBtn.textContent = "+";
      plusBtn.title = "Increase quantity";
      plusBtn.onclick = () => {
        const item = orders[name];
        item.quantity++;
        item.totalPrice += item.price;
        total += item.price;
        updateOrderItem(name);
        updateTotal();
      };

      quantityControls.appendChild(minusBtn);
      quantityControls.appendChild(quantityDisplay);
      quantityControls.appendChild(plusBtn);

      // Price
      const itemPrice = document.createElement("span");
      itemPrice.classList.add("item-price");
      itemPrice.textContent = `₱${orders[name].totalPrice.toFixed(2)}`;

      // Remove button
      const removeBtn = document.createElement("button");
      removeBtn.className = "remove-btn";
      removeBtn.textContent = "❌";
      removeBtn.title = "Remove item";
      removeBtn.onclick = () => {
        total -= orders[name].totalPrice;
        updateTotal();
        orderItem.remove();
        delete orders[name];
      };

      orderItem.appendChild(itemName);
      orderItem.appendChild(quantityControls);
      orderItem.appendChild(itemPrice);
      orderItem.appendChild(removeBtn);

      orderList.appendChild(orderItem);

      orders[name].orderItem = orderItem;
    }

    function updateOrderItem(name) {
      const item = orders[name];
      const orderItem = item.orderItem;

      const quantityDisplay = orderItem.querySelector(".item-quantity");
      const itemPrice = orderItem.querySelector(".item-price");

      quantityDisplay.textContent = `x${item.quantity}`;
      itemPrice.textContent = `₱${item.totalPrice.toFixed(2)}`;
    }

    function updateTotal() {
      document.getElementById("order-total").textContent = total.toFixed(2);
    }

    function clearOrders() {
      const orderList = document.getElementById("order-list");
      orderList.innerHTML = "";
      total = 0;
      for (const key in orders) {
        delete orders[key];
      }
      updateTotal();
    }
  </script>

  <script>
    function checkout() {
      if (total <= 0) {
        alert("No orders to checkout.");
        return;
      }
      document.getElementById('payment-modal').style.display = 'flex';
      document.getElementById('payment-total').textContent = total.toFixed(2);
      document.getElementById('cash-input').value = '';
      document.getElementById('change-amount').textContent = '0.00';
      document.getElementById('payment-method').value = 'cash';
      updatePaymentMethodView();
    }

    document.getElementById('payment-method').addEventListener('change', updatePaymentMethodView);

    function updatePaymentMethodView() {
      const method = document.getElementById('payment-method').value;
      document.getElementById('cash-section').style.display = method === 'cash' ? 'block' : 'none';
      document.getElementById('gcash-section').style.display = method === 'gcash' ? 'block' : 'none';
    }

    document.getElementById('cash-input').addEventListener('input', () => {
      const received = parseFloat(document.getElementById('cash-input').value);
      const change = received - total;
      document.getElementById('change-amount').textContent = change >= 0 ? change.toFixed(2) : "0.00";
    });

    // Get selected order type Dine In or Take Out
    function getSelectedOrderType() {
      const radios = document.getElementsByName('order-type');
      for (const radio of radios) {
        if (radio.checked) return radio.value;
      }
      return "Dine In"; // Default fallback
    }

    function confirmPayment() {
      const method = document.getElementById('payment-method').value;
      const orderType = getSelectedOrderType();
      if (method === 'cash') {
          const received = parseFloat(document.getElementById('cash-input').value);
          if (isNaN(received) || received < total) {
            alert("Insufficient cash.");
            return;
          }
          const orderNumber = generateOrderNumber();
          alert("Cash payment confirmed. Change: ₱" + (received - total).toFixed(2) + "\\nOrder Type: " + orderType + "\\nYour order number is: " + orderNumber);
      } else if (method === 'gcash') {
          const orderNumber = generateOrderNumber();
          alert("GCash payment recorded. Thank you!\\nOrder Type: " + orderType + "\\nYour order number is: " + orderNumber);
      }
      closePaymentModal();
      clearOrders();
    }

    function closePaymentModal() {
      document.getElementById('payment-modal').style.display = 'none';
    }
  </script>
</body>
</html>


