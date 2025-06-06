<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Customer</title>
  <link rel="stylesheet" href="Customer.css">
</head>
<body>
  <div>
    <!-- Header bar with three sections: profile button, navigation, logo -->
    <header id="page-header">
      <div class="header-left">
        <button id="profile-btn" onclick="handleProfileClick()" aria-label="Profile">
          <img src="profile-icon.png" alt="Profile Icon" />
        </button>
      </div>
      <div class="header-center">
        <nav>
          <button id="btn-a">Hot Coffee</button>
          <button id="btn-b">Iced Coffee</button>
          <button id="btn-c">Non Coffee</button>
          <button id="btn-d">Pastries</button>
        </nav>
      </div>
      <div class="header-right">
        <img id="logo-img" src="logo.png" alt="BREWeb Logo" />
      </div>
    </header>

    <!-- Profile drawer panel -->
    <div id="profile-drawer" aria-hidden="true" tabindex="-1">
      <button id="drawer-close-btn" onclick="closeDrawer()" aria-label="Close profile drawer">✖</button>
      <h3>"For Staff/Admin Only"</h3>
      <a id="drawer-login-btn" href="login.php">Log In/Sign up</a>
    </div>

    <main>
      <section id="items-section">
        <div id="items-a" class="items-grid" tabindex="0"></div>
        <div id="items-b" class="items-grid hidden" tabindex="0"></div>
        <div id="items-c" class="items-grid hidden" tabindex="0"></div>
        <div id="items-d" class="items-grid hidden" tabindex="0"></div>
      </section>

      <section id="order-section" style="height: 90vh; flex: 1;">
        <div>
          <h3 class="orders-header">Orders</h3>
          <div id="order-list" tabindex="0" aria-live="polite"></div>
        </div>
        <div class="order-summary" aria-live="polite" aria-atomic="true">
          <div class="order-total-label">
            Total: ₱<span id="order-total">0.00</span>
          </div>
          <div class="order-controls">
            <button type="button" onclick="clearOrders()">Clear All</button>
            <button type="button" onclick="checkout()">Checkout</button>
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

          <select id="payment-method" aria-label="Payment Method">
            <option value="cash">Cash</option>
            <option value="gcash">GCash</option>
          </select>

          <div id="cash-section" aria-live="polite" aria-atomic="true">
            <p>Total Due: ₱<span id="payment-total">0.00</span></p>
            <label>Received Cash:
                <input type="number" id="cash-input" min="0" step="0.01" aria-label="Received cash amount"/>
            </label>
            <p>Change: ₱<span id="change-amount">0.00</span></p>
          </div>

          <div id="gcash-section" class="hidden" aria-live="polite" aria-atomic="true">
            <p>Please confirm payment via GCash on your mobile device.</p>
          </div>

          <div class="payment-buttons">
            <button type="button" onclick="closePaymentModal()">Cancel</button>
            <button type="button" onclick="confirmPayment()">Confirm</button>
          </div>
        </div>
      </div>

    </main>
  </div>

<script>
  function handleProfileClick() {
    const drawer = document.getElementById('profile-drawer');
    if (drawer.classList.contains('open')) {
      drawer.classList.remove('open');
      drawer.setAttribute('aria-hidden', 'true');
    } else {
      drawer.classList.add('open');
      drawer.setAttribute('aria-hidden', 'false');
      drawer.focus();
    }
  }

  function closeDrawer() {
    const drawer = document.getElementById('profile-drawer');
    drawer.classList.remove('open');
    drawer.setAttribute('aria-hidden', 'true');
  }

  const sections = {
    'btn-a': 'items-a',
    'btn-b': 'items-b',
    'btn-c': 'items-c',
    'btn-d': 'items-d'
  };

  Object.keys(sections).forEach(btnId => {
    document.getElementById(btnId).addEventListener('click', () => {
      Object.values(sections).forEach(id => {
        document.getElementById(id).classList.add('hidden');
      });
      document.getElementById(sections[btnId]).classList.remove('hidden');
    });
  });

  let total = 0;
  const orders = {};
  let orderNumberCount = 0;

  const defaultItems = [
    { id: 'a1', name: "Cafe Americano", price: 120, category: 'a' },
    { id: 'a2', name: "Cafe Mocha", price: 140, category: 'a' },
    { id: 'a3', name: "Caramel Macchiato", price: 160, category: 'a' },
    { id: 'a4', name: "Cafe Latte", price: 130, category: 'a' },
    { id: 'a5', name: "Flat White", price: 125, category: 'a' },
    { id: 'a6', name: "Espresso", price: 110, category: 'a' },
    { id: 'b1', name: "Coffee Jelly", price: 130, category: 'b' },
    { id: 'b2', name: "Dark Mocha", price: 150, category: 'b' },
    { id: 'b3', name: "Dirty Matcha", price: 145, category: 'b' },
    { id: 'b4', name: "Iced Americano", price: 120, category: 'b' },
    { id: 'b5', name: "Iced Latte", price: 130, category: 'b' },
    { id: 'c1', name: "Red Velvet Latte", price: 155, category: 'c' },
    { id: 'c2', name: "Salted Caramel", price: 160, category: 'c' },
    { id: 'c3', name: "Sea Salt Latte", price: 150, category: 'c' },
    { id: 'c4', name: "Toasted Vanilla", price: 140, category: 'c' },
    { id: 'd1', name: "Pumpkin Spice Latte", price: 170, category: 'd' },
    { id: 'd2', name: "Toffee Nut Crunch", price: 165, category: 'd' },
    { id: 'd3', name: "Cinnamon Roll Latte", price: 150, category: 'd' }
  ];

  const categoryContainers = {
    'a': document.getElementById('items-a'),
    'b': document.getElementById('items-b'),
    'c': document.getElementById('items-c'),
    'd': document.getElementById('items-d')
  };

  function loadAndRenderItems() {
    // Using only defaultItems, no localStorage
    Object.values(categoryContainers).forEach(container => container.innerHTML = '');

    defaultItems.forEach(item => {
      if (!categoryContainers[item.category]) return;
      const box = document.createElement('div');
      box.className = 'item-box';
      box.setAttribute('tabindex', '0');
      box.setAttribute('data-name', item.name);
      box.setAttribute('data-price', item.price.toFixed(2));
      box.innerHTML = `<div><strong>${item.name}</strong></div><div>₱${item.price.toFixed(2)}</div>`;
      box.addEventListener('click', () => addItemToOrder(item.name));
      box.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          addItemToOrder(item.name);
        }
      });
      categoryContainers[item.category].appendChild(box);
    });
  }

  function addItemToOrder(itemName) {
    const firstItem = [...document.querySelectorAll('.item-box')].find(box => box.getAttribute('data-name') === itemName);
    if (!firstItem) return;
    const price = parseFloat(firstItem.getAttribute('data-price'));
    if (orders[itemName]) {
      orders[itemName].quantity++;
      orders[itemName].totalPrice += price;
      updateOrderItem(itemName);
    } else {
      orders[itemName] = {
        quantity: 1,
        price: price,
        totalPrice: price
      };
      addNewOrderItem(itemName);
    }
    total += price;
    updateTotal();
  }

  function addNewOrderItem(itemName) {
    const orderList = document.getElementById("order-list");
    const orderItem = document.createElement("div");
    orderItem.classList.add("order-entry");

    const itemNameElem = document.createElement("span");
    itemNameElem.classList.add("order-name");
    itemNameElem.textContent = itemName;

    const quantityControls = document.createElement("div");
    quantityControls.classList.add("quantity-controls");

    const minusBtn = document.createElement("button");
    minusBtn.textContent = "−";
    minusBtn.title = "Decrease quantity";
    minusBtn.onclick = () => {
      const item = orders[itemName];
      if (item.quantity > 1) {
        item.quantity--;
        item.totalPrice -= item.price;
        total -= item.price;
        updateOrderItem(itemName);
        updateTotal();
      } else {
        total -= item.totalPrice;
        updateTotal();
        orderItem.remove();
        delete orders[itemName];
      }
    };

    const quantityDisplay = document.createElement("span");
    quantityDisplay.classList.add("item-quantity");
    quantityDisplay.textContent = `x${orders[itemName].quantity}`;

    const plusBtn = document.createElement("button");
    plusBtn.textContent = "+";
    plusBtn.title = "Increase quantity";
    plusBtn.onclick = () => {
      const item = orders[itemName];
      item.quantity++;
      item.totalPrice += item.price;
      total += item.price;
      updateOrderItem(itemName);
      updateTotal();
    };

    quantityControls.appendChild(minusBtn);
    quantityControls.appendChild(quantityDisplay);
    quantityControls.appendChild(plusBtn);

    const itemPrice = document.createElement("span");
    itemPrice.classList.add("item-price");
    itemPrice.textContent = `₱${orders[itemName].totalPrice.toFixed(2)}`;

    const removeBtn = document.createElement("button");
    removeBtn.className = "remove-btn";
    removeBtn.textContent = "❌";
    removeBtn.title = "Remove item";
    removeBtn.onclick = () => {
      total -= orders[itemName].totalPrice;
      updateTotal();
      orderItem.remove();
      delete orders[itemName];
    };

    orderItem.appendChild(itemNameElem);
    orderItem.appendChild(quantityControls);
    orderItem.appendChild(itemPrice);
    orderItem.appendChild(removeBtn);

    orderList.appendChild(orderItem);

    orders[itemName].orderItem = orderItem;
  }

  function updateOrderItem(itemName) {
    const item = orders[itemName];
    if (!item || !item.orderItem) return;
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
    document.getElementById("order-list").innerHTML = "";
    total = 0;
    for (const key in orders) {
      delete orders[key];
    }
    updateTotal();
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
    updatePaymentMethodView();
  }

  function closePaymentModal() {
    document.getElementById('payment-modal').style.display = 'none';
  }

  document.getElementById('payment-method').addEventListener('change', updatePaymentMethodView);
  function updatePaymentMethodView() {
    const method = document.getElementById('payment-method').value;
    const cashSection = document.getElementById('cash-section');
    const gcashSection = document.getElementById('gcash-section');
    cashSection.style.display = method === 'cash' ? 'block' : 'none';
    gcashSection.style.display = method === 'gcash' ? 'block' : 'none';
  }

  document.getElementById('cash-input').addEventListener('input', () => {
    const received = parseFloat(document.getElementById('cash-input').value);
    const change = received - total;
    document.getElementById('change-amount').textContent = change >= 0 ? change.toFixed(2) : "0.00";
  });

  function getSelectedOrderType() {
    const radios = document.getElementsByName('order-type');
    for (const radio of radios) {
      if (radio.checked) return radio.value;
    }
    return "Dine In";
  }

  function generateOrderNumber() {
    orderNumberCount++;
    return 'CS' + String(orderNumberCount).padStart(4, '0');
  }

  function confirmPayment() {
    const method = document.getElementById('payment-method').value;
    const orderType = getSelectedOrderType();
    const itemsArray = [];
    for(let key in orders) {
      itemsArray.push({
        name: key,
        price: orders[key].price,
        quantity: orders[key].quantity,
        totalPrice: orders[key].totalPrice
      });
    }

    if (method === 'cash') {
      const received = parseFloat(document.getElementById('cash-input').value);
      if (isNaN(received) || received < total) {
        alert("Insufficient cash.");
        return;
      }
      const orderNumber = generateOrderNumber();
      alert(`Cash payment confirmed. Change: ₱${(received - total).toFixed(2)}\nOrder Type: ${orderType}\nYour order number is: ${orderNumber}`);
      saveTransaction({
        orderNumber,
        totalPrice: total,
        items: itemsArray,
        orderType,
        paymentType: method
      });
    } else if (method === 'gcash') {
      const orderNumber = generateOrderNumber();
      alert(`GCash payment recorded. Thank you!\nOrder Type: ${orderType}\nYour order number is: ${orderNumber}`);
      saveTransaction({
        orderNumber,
        totalPrice: total,
        items: itemsArray,
        orderType,
        paymentType: method
      });
    }
    closePaymentModal();
    clearOrders();
  }

  function saveTransaction(transaction) {
    // Save transactions in-memory only, no localStorage
    if (!window.savedTransactions) {
      window.savedTransactions = [];
    }
    window.savedTransactions.push(transaction);
    // No persistent storage since localStorage removed
  }

  window.onload = () => {
    loadAndRenderItems();
  };
</script>
</body>
</html>

