<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BREWeb with Manage Items Button in Header</title>
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
      min-height: 80px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .item-box:hover {
      background: #bbb;
    }

    /* Styles for Navigation Buttons (including Manage Items) */
    header nav {
      display: flex;
      gap: 24px;
      align-items: center;
    }

    header nav button {
      background-color: #FFD483; /* Light orange-yellow */
      color: #000000;
      font-weight: bold;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      user-select: none;
      transition: background-color 0.3s ease;
      font-size: 16px;
      white-space: nowrap;
    }

    header nav button:hover {
      background-color: #e6b74f;
      color: #000000;
    }

    /* Distinct style for Manage Items button in header */
    .manage-items-btn-header {
      background-color:rgb(4, 179, 4);
      color: black;
      font-weight: bold;
      border-radius: 8px;
      padding: 10px 22px;
      font-size: 16px;
      box-shadow: 0 2px 6px rgba(179, 119, 0, 0.7);
      transition: background-color 0.3s ease;
      white-space: nowrap;
    }
    .manage-items-btn-header:hover {
      background-color:rgb(5, 149, 5);
      color: black;
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
      max-height: 100vh;
      box-sizing: border-box;
    }

    #order-list {
      max-height: 60vh;
      overflow-y: auto;
      margin-bottom: 20px;
    }

    .order-controls {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-top: auto;
    }
    
    .order-controls button {
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 48%;
    }
    .order-controls button:nth-child(1) {
      background-color: #FFD483;
      color: black;
    }
    .order-controls button:nth-child(1):hover {
      background-color: #FFD483;
      color: black;
    }
    .order-controls button:nth-child(2) {
      background-color: #D0AC77;
      color: black;
      font-weight: bold;
    }
    .order-controls button:nth-child(2):hover {
      background-color: #D0AC77;
      color: black;
    }

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
    #payment-modal select, #payment-modal input[type="number"] {
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
        gap: 12px;
      }
      header nav button {
        padding: 8px 14px;
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
      width: 280px;
      height: 100vh;
      background-color: #FFD483;
      box-shadow: 2px 0 6px rgba(0,0,0,0.3);
      transform: translateX(-100%);
      transition: transform 0.3s ease;
      z-index: 1500;
      padding: 20px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
    }
    #side-drawer.open {
      transform: translateX(0);
    }
    #side-drawer nav.main-nav {
      display: flex;
      flex-direction: column;
      gap: 12px;
      font-weight: 600;
      flex-grow: 1;
      overflow-y: auto;
    }
    #side-drawer nav.main-nav a {
      color: #333;
      text-decoration: none;
      padding: 8px 10px;
      border-radius: 6px;
      user-select: none;
      transition: background-color 0.2s ease;
      cursor: pointer;
      background: none;
      border: none;
      text-align: left;
    }
    #side-drawer nav.main-nav a:hover {
      background-color: #e6b74f;
      color: black;
    }
    #side-drawer nav.bottom-nav {
      font-weight: 600;
      margin-top: auto;
      border-top: 1px solid #b37700;
      padding-top: 12px;
    }
    #side-drawer nav.bottom-nav a {
      color: #b30000;
      text-decoration: none;
      padding: 8px 10px;
      border-radius: 6px;
      user-select: none;
      transition: background-color 0.2s ease, color 0.2s ease;
      cursor: pointer;
      background: none;
      border: none;
      text-align: left;
      font-weight: 700;
    }
    #side-drawer nav.bottom-nav a:hover {
      background-color: #cc0000;
      color: white;
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

    /* Manage Items Modal */
    #manage-items-modal {
      display:none;
      position: fixed;
      z-index: 3000;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      padding: 20px;
      box-sizing: border-box;
    }
    #manage-items-modal > div {
      background: #fff;
      border-radius: 10px;
      max-width: 600px;
      width: 100%;
      max-height: 90vh;
      overflow-y: auto;
      padding: 20px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
    }
    #manage-items-modal h2 {
      margin-top: 0;
      margin-bottom: 20px;
      text-align: center;
      color: #b37700;
    }

    #manage-items-list {
      flex-grow: 1;
      margin-bottom: 20px;
      overflow-y: auto;
    }
    .manage-item-row {
      display: flex;
      gap: 10px;
      align-items: center;
      margin-bottom: 12px;
    }
    .manage-item-row input[type="text"],
    .manage-item-row input[type="number"],
    .manage-item-row select {
      padding: 6px 10px;
      font-size: 14px;
      border-radius: 6px;
      border: 1px solid #ccc;
      flex-grow: 1;
      box-sizing: border-box;
    }
    .manage-item-row input[type="number"] {
      max-width: 100px;
    }
    .manage-item-row select {
      max-width: 140px;
    }
    .manage-item-row button.delete-item-btn {
      background-color: #dc3545;
      color: white;
      border: none;
      border-radius: 6px;
      padding: 6px 10px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.2s ease;
    }
    .manage-item-row button.delete-item-btn:hover {
      background-color: #a71d2a;
    }
    #add-item-btn {
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 6px;
      padding: 10px 16px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
      font-weight: bold;
      margin-bottom: 20px;
      transition: background-color 0.3s ease;
    }
    #add-item-btn:hover {
      background-color: #1e7e34;
    }

    /* Manage modal buttons */
    .manage-actions {
      display: flex;
      justify-content: flex-end;
      gap: 15px;
    }
    .manage-actions button {
      background-color: #D0AC77;
      color: black;
      border: none;
      border-radius: 8px;
      padding: 12px 20px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .manage-actions button:hover {
      background-color: #b37a2f;
    }
    .manage-actions button.cancel-btn {
      background-color: #dc3545;
      color: white;
    }
    .manage-actions button.cancel-btn:hover {
      background-color: #a71d2a;
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
        <nav role="navigation" aria-label="Menu Categories">
          <button id="btn-a">Hot Coffee</button>
          <button id="btn-b">Iced Coffee</button>
          <button id="btn-c">Non Coffee</button>
          <button id="btn-d">Pastries</button>
          <button class="manage-items-btn-header" id="manage-items-header-btn">Manage Items</button>
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
      <nav class="main-nav">
          <a href="#">Sales Report</a>
          <a href="transaction-page.php">Transaction</a>
          <a href="cash-drawer.php">Cash Drawer</a>
      </nav>

      <nav class="bottom-nav" aria-label="User Identity">
          <a href="homepage.php">Log Out</a>
      </nav>
    </div>

    <!-- Drawer Backdrop -->
    <div id="drawer-backdrop" tabindex="-1"></div>

    <!-- Main Content -->
    <main style="display: flex; height: 100%;">
      <!-- Items Section -->
      <section style="flex: 2; padding: 20px;">
        <div id="items-grid" class="items-grid" aria-live="polite" aria-label="Menu items">
          <!-- Items rendered by JS -->
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
      <div id="payment-modal" role="dialog" aria-modal="true" aria-labelledby="payment-modal-title" tabindex="-1">
        <div>
          <h3 id="payment-modal-title">Select Payment Method</h3>
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

      <!-- Manage Items Modal -->
      <div id="manage-items-modal" role="dialog" aria-modal="true" aria-labelledby="manage-items-title" tabindex="-1">
        <div>
          <h2 id="manage-items-title">Manage Menu Items</h2>
          <button id="add-item-btn" aria-label="Add new menu item">+ Add New Item</button>
          <div id="manage-items-list" role="list" aria-live="polite" aria-label="Menu items management list">
          </div>
          <div class="manage-actions">
            <button id="save-items-btn">Save Changes</button>
            <button id="cancel-items-btn" class="cancel-btn">Cancel</button>
          </div>
        </div>
      </div>
    </main>      
  </div>

  <script>
    // Initial Items & Variables
    const defaultItems = [
      { id: 'a1', name: "Cafe Americano", price: 120, category:'a' },
      { id: 'a2', name: "Cafe Mocha", price: 140, category:'a' },
      { id: 'a3', name: "Caramel Macchiato", price: 160, category:'a' },
      { id: 'a4', name: "Cafe Latte", price: 130, category:'a' },
      { id: 'a5', name: "Flat White", price: 125, category:'a' },
      { id: 'a6', name: "Espresso", price: 110, category:'a' },
      { id: 'b1', name: "Coffee Jelly", price: 130, category:'b' },
      { id: 'b2', name: "Dark Mocha", price: 150, category:'b' },
      { id: 'b3', name: "Dirty Matcha", price: 145, category:'b' },
      { id: 'b4', name: "Iced Americano", price: 120, category:'b' },
      { id: 'b5', name: "Iced Latte", price: 130, category:'b' },
      { id: 'c1', name: "Red Velvet Latte", price: 155, category:'c' },
      { id: 'c2', name: "Salted Caramel", price: 160, category:'c' },
      { id: 'c3', name: "Sea Salt Latte", price: 150, category:'c' },
      { id: 'c4', name: "Toasted Vanilla", price: 140, category:'c' },
      { id: 'd1', name: "Pumpkin Spice Latte", price: 170, category:'d' },
      { id: 'd2', name: "Toffee Nut Crunch", price: 165, category:'d' },
      { id: 'd3', name: "Cinnamon Roll Latte", price: 150, category:'d' }
    ];
    const categories = {
      'btn-a': 'a',
      'btn-b': 'b',
      'btn-c': 'c',
      'btn-d': 'd'
    };
    let currentCategory = 'a';
    let items = [];
    const orders = {};
    let total = 0;
    let orderNumberCount = 0;

    window.onload = () => {
      loadItems();
      setupCategoryButtons();
      renderItemsGrid();
      setupSideDrawer();
      setupManageItems();
      setupPaymentModal();
      updateTotal();
    };

    function loadItems() {
      const stored = localStorage.getItem('menuItems');
      if (stored) {
        try {
          items = JSON.parse(stored);
          if (!Array.isArray(items)) throw new Error();
        } catch(e) {
          items = [...defaultItems];
        }
      } else {
        items = [...defaultItems];
      }
    }
    function saveItems() {
      localStorage.setItem('menuItems', JSON.stringify(items));
    }
    function setupCategoryButtons() {
      Object.keys(categories).forEach(btnId => {
        document.getElementById(btnId).addEventListener('click', () => {
          currentCategory = categories[btnId];
          renderItemsGrid();
        });
      });
      // Setup Manage Items button in header
      const manageBtnHeader = document.getElementById('manage-items-header-btn');
      manageBtnHeader.addEventListener('click', () => {
        openManageItemsModal();
      });
    }
    function renderItemsGrid() {
      const container = document.getElementById('items-grid');
      container.innerHTML = '';
      const filteredItems = items.filter(i => i.category === currentCategory);
      if (filteredItems.length === 0) {
        const noItemsMsg = document.createElement('div');
        noItemsMsg.textContent = "No items in this category.";
        noItemsMsg.style.fontStyle = 'italic';
        noItemsMsg.style.gridColumn = 'span 3';
        container.appendChild(noItemsMsg);
        return;
      }
      filteredItems.forEach(item => {
        const box = document.createElement('div');
        box.className = 'item-box';
        box.setAttribute('data-id', item.id);
        box.setAttribute('data-name', item.name);
        box.setAttribute('data-price', item.price.toFixed(2));
        box.tabIndex = 0;
        box.innerHTML = `<div><strong>${item.name}</strong></div><div>₱${item.price.toFixed(2)}</div>`;
        box.addEventListener('click', () => addItemToOrder(item.id));
        box.addEventListener('keydown', e => {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            addItemToOrder(item.id);
          }
        });
        container.appendChild(box);
      });
    }
    function addItemToOrder(id) {
      const item = items.find(i => i.id === id);
      if (!item) return;
      if (orders[id]) {
        orders[id].quantity++;
        orders[id].totalPrice += item.price;
        updateOrderItem(id);
      } else {
        orders[id] = {
          quantity: 1,
          price: item.price,
          totalPrice: item.price
        };
        addNewOrderItem(id);
      }
      total += item.price;
      updateTotal();
    }
    function addNewOrderItem(id) {
      const orderList = document.getElementById("order-list");
      const item = orders[id];

      const orderItem = document.createElement("div");
      orderItem.classList.add("order-entry");

      const itemName = document.createElement("span");
      itemName.classList.add("order-name");
      const menuItem = items.find(i => i.id === id);
      itemName.textContent = menuItem ? menuItem.name : "";

      const quantityControls = document.createElement("div");
      quantityControls.classList.add("quantity-controls");

      const minusBtn = document.createElement("button");
      minusBtn.textContent = "−";
      minusBtn.title = "Decrease quantity";
      minusBtn.onclick = () => {
        if(item.quantity > 1) {
          item.quantity--;
          item.totalPrice -= item.price;
          total -= item.price;
          updateOrderItem(id);
          updateTotal();
        } else {
          total -= item.totalPrice;
          updateTotal();
          orderItem.remove();
          delete orders[id];
        }
      };

      const quantityDisplay = document.createElement("span");
      quantityDisplay.classList.add("item-quantity");
      quantityDisplay.textContent = `x${item.quantity}`;

      const plusBtn = document.createElement("button");
      plusBtn.textContent = "+";
      plusBtn.title = "Increase quantity";
      plusBtn.onclick = () => {
        item.quantity++;
        item.totalPrice += item.price;
        total += item.price;
        updateOrderItem(id);
        updateTotal();
      };

      quantityControls.appendChild(minusBtn);
      quantityControls.appendChild(quantityDisplay);
      quantityControls.appendChild(plusBtn);

      const itemPrice = document.createElement("span");
      itemPrice.classList.add("item-price");
      itemPrice.textContent = `₱${item.totalPrice.toFixed(2)}`;

      const removeBtn = document.createElement("button");
      removeBtn.className = "remove-btn";
      removeBtn.textContent = "❌";
      removeBtn.title = "Remove item";
      removeBtn.onclick = () => {
        total -= item.totalPrice;
        updateTotal();
        orderItem.remove();
        delete orders[id];
      };

      orderItem.appendChild(itemName);
      orderItem.appendChild(quantityControls);
      orderItem.appendChild(itemPrice);
      orderItem.appendChild(removeBtn);

      orderList.appendChild(orderItem);

      orders[id].orderItem = orderItem;
    }
    function updateOrderItem(id) {
      const item = orders[id];
      if(!item || !item.orderItem) return;
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
    function setupSideDrawer() {
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
    function setupManageItems() {
      const modal = document.getElementById('manage-items-modal');
      const addBtn = document.getElementById('add-item-btn');
      const listContainer = document.getElementById('manage-items-list');
      const saveBtn = document.getElementById('save-items-btn');
      const cancelBtn = document.getElementById('cancel-items-btn');

      window.openManageItemsModal = function() {
        renderManageItemsList();
        modal.style.display = 'flex';
        modal.focus();
      };
      cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
      });
      addBtn.addEventListener('click', () => {
        addManageItemRow({ id: generateId(), name: '', price: 0, category: 'a' }, true);
      });
      saveBtn.addEventListener('click', () => {
        const updatedItems = [];
        let valid = true;
        const rows = listContainer.querySelectorAll('.manage-item-row');
        rows.forEach(row => {
          const id = row.getAttribute('data-id');
          const nameInput = row.querySelector('input.name-input');
          const priceInput = row.querySelector('input.price-input');
          const categorySelect = row.querySelector('select.category-select');
          const name = nameInput.value.trim();
          const price = parseFloat(priceInput.value);
          const category = categorySelect.value;
          if (!name) {
            alert("Item name cannot be empty.");
            valid = false;
            return;
          }
          if (isNaN(price) || price < 0) {
            alert("Price must be a valid non-negative number.");
            valid = false;
            return;
          }
          updatedItems.push({ id, name, price, category });
        });
        if(!valid) return;
        items = updatedItems;
        saveItems();
        modal.style.display = 'none';
        renderItemsGrid();
        clearOrders();
      });
    }
    function renderManageItemsList() {
      const container = document.getElementById('manage-items-list');
      container.innerHTML = '';
      items.forEach(item => {
        addManageItemRow(item, false);
      });
    }
    function addManageItemRow(item, isNew) {
      const container = document.getElementById('manage-items-list');
      const row = document.createElement('div');
      row.className = 'manage-item-row';
      row.setAttribute('data-id', item.id);

      const nameInput = document.createElement('input');
      nameInput.type = 'text';
      nameInput.className = 'name-input';
      nameInput.value = item.name;
      nameInput.placeholder = 'Item Name';
      nameInput.setAttribute('aria-label', 'Item Name');

      const priceInput = document.createElement('input');
      priceInput.type = 'number';
      priceInput.className = 'price-input';
      priceInput.min = 0;
      priceInput.step = 0.01;
      priceInput.value = item.price;
      priceInput.placeholder = 'Price';
      priceInput.setAttribute('aria-label', 'Price');

      const categorySelect = document.createElement('select');
      categorySelect.className = 'category-select';
      categorySelect.setAttribute('aria-label', 'Item Category');
      const optionNames = {
        'a': 'Hot Coffee',
        'b': 'Iced Coffee',
        'c': 'Non Coffee',
        'd': 'Pastries'
      };
      for (const key in optionNames) {
        let opt = document.createElement('option');
        opt.value = key;
        opt.textContent = optionNames[key];
        if (item.category === key) {
          opt.selected = true;
        }
        categorySelect.appendChild(opt);
      }

      const deleteBtn = document.createElement('button');
      deleteBtn.className = 'delete-item-btn';
      deleteBtn.title = "Delete Item";
      deleteBtn.textContent = '🗑️';
      deleteBtn.addEventListener('click', () => {
        row.remove();
      });

      row.appendChild(nameInput);
      row.appendChild(priceInput);
      row.appendChild(categorySelect);
      row.appendChild(deleteBtn);

      container.appendChild(row);

      if(isNew) {
        nameInput.focus();
      }
    }
    function generateId() {
      return 'id-' + Math.random().toString(36).substr(2, 9);
    }
    function setupPaymentModal() {
      const paymentModal = document.getElementById('payment-modal');
      const paymentMethodSelect = document.getElementById('payment-method');
      const cashSection = document.getElementById('cash-section');
      const gcashSection = document.getElementById('gcash-section');
      const cashInput = document.getElementById('cash-input');
      const changeAmount = document.getElementById('change-amount');

      paymentMethodSelect.addEventListener('change', () => {
        if(paymentMethodSelect.value === 'cash') {
          cashSection.style.display = "block";
          gcashSection.style.display = "none";
        } else {
          cashSection.style.display = "none";
          gcashSection.style.display = "block";
        }
      });

      cashInput.addEventListener('input', () => {
        const received = parseFloat(cashInput.value);
        const change = received - total;
        changeAmount.textContent = change >= 0 ? change.toFixed(2) : "0.00";
      });
    }
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
      document.getElementById('cash-section').style.display = 'block';
      document.getElementById('gcash-section').style.display = 'none';
    }
    function closePaymentModal() {
      document.getElementById('payment-modal').style.display = 'none';
    }
    function getSelectedOrderType() {
      const radios = document.getElementsByName('order-type');
      for (const radio of radios) {
        if (radio.checked) return radio.value;
      }
      return "Dine In";
    }
    function generateOrderNumber() {
      orderNumberCount++;
      return 'ORD' + String(orderNumberCount).padStart(4, '0');
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
          alert("Cash payment confirmed. Change: ₱" + (received - total).toFixed(2) + 
          "\nOrder Type: " + orderType + 
          "\nYour order number is: " + orderNumber);
      } else if (method === 'gcash') {
          const orderNumber = generateOrderNumber();
          alert("GCash payment recorded. Thank you!\nOrder Type: " + orderType + "\nYour order number is: " + orderNumber);
      }
      closePaymentModal();
      clearOrders();
    }
  </script>
</body>
</html>

