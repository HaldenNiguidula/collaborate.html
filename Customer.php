<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Customer</title>
  <!-- Link to external CSS file -->
  <link rel="stylesheet" href="Customer.css" />
</head>
<body>
  <div>
    <!-- Header bar with three sections: profile button, navigation, logo -->
    <header id="page-header">
      <!-- Left section: Profile drawer toggle button -->
      <div class="header-left">
        <button id="profile-btn" onclick="handleProfileClick()" aria-label="Profile">
          <img src="profile-icon.png" alt="Profile Icon" />
        </button>
      </div>

      <!-- Center section: Navigation buttons for coffee categories -->
      <div class="header-center">
        <nav>
          <button id="btn-a">Hot Coffee</button>
          <button id="btn-b">Iced Coffee</button>
          <button id="btn-c">Non Coffee</button>
          <button id="btn-d">Pastries</button>
        </nav>
      </div>

      <!-- Right section: Company logo -->
      <div class="header-right">
        <img id="logo-img" src="logo.png" alt="BREWeb Logo" />
      </div>
    </header>

    <!-- Profile drawer panel (hidden by default, slides in) -->
    <div id="profile-drawer">
      <button id="drawer-close-btn" onclick="closeDrawer()">✖</button>
      <h3>"For Staff/Admin Only"</h3>
      <a id="drawer-login-btn" href="login.php">Log In/Sign up</a>
    </div>

    <main>
      <!-- Left section: items grid for coffee and pastries -->
      <section id="items-section">
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
        
        <div id="items-b" class="items-grid hidden">
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
        
        <div id="items-c" class="items-grid hidden">
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
        
        <div id="items-d" class="items-grid hidden">
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

      <!-- Right section: Orders list and checkout controls -->
      <section id="order-section" style="height: 90vh;">
        <div>
          <h3 class="orders-header">Orders</h3>
          <div id="order-list"></div>
        </div>

        <div class="order-summary">
          <div class="order-total-label">
            Total: ₱<span id="order-total">0.00</span>
          </div>
          <div class="order-controls">
            <button onclick="clearOrders()">Clear All</button>
            <button onclick="checkout()">Checkout</button>
          </div>
        </div>
      </section>

      <!-- Payment modal popup for order payment -->
      <div id="payment-modal" role="dialog" aria-modal="true" aria-labelledby="payment-modal-title">
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

          <div id="cash-section">
            <p>Total Due: ₱<span id="payment-total">0.00</span></p>
            <label>Received Cash:
                <input type="number" id="cash-input" min="0" step="0.01" aria-label="Received cash amount"/>
            </label>
            <p>Change: ₱<span id="change-amount">0.00</span></p>
          </div>

          <div id="gcash-section" class="hidden">
            <p>Please confirm payment via GCash on your mobile device.</p>
          </div>

          <div class="payment-buttons">
            <button onclick="closePaymentModal()">Cancel</button>
            <button onclick="confirmPayment()">Confirm</button>
          </div>
        </div>
      </div>

    </main>      
  </div>

  <script>
    // Profile button click handler toggles drawer visibility
    function handleProfileClick() {
      const drawer = document.getElementById('profile-drawer');
      if (drawer.classList.contains('open')) {
        drawer.classList.remove('open');
      } else {
        drawer.classList.add('open');
      }
    }

    function closeDrawer() {
      document.getElementById('profile-drawer').classList.remove('open');
    }

    // Mapping navigation buttons to items grid sections
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

    // Generate unique order number with padding
    function generateOrderNumber() {
      orderNumberCount++;
      return 'CS' + String(orderNumberCount).padStart(4, '0');
    }

    // Add click event listeners to item boxes to add to orders
    document.querySelectorAll(".item-box").forEach(box => {
      box.addEventListener("click", () => {
        const name = box.getAttribute("data-name");
        const price = parseFloat(box.getAttribute("data-price"));

        if (orders[name]) {
          orders[name].quantity++;
          orders[name].totalPrice += price;
          updateOrderItem(name);
        } else {
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

    // Add new order entry to order list UI
    function addNewOrderItem(name) {
      const orderList = document.getElementById("order-list");
      const orderItem = document.createElement("div");
      orderItem.classList.add("order-entry");
      const itemName = document.createElement("span");
      itemName.classList.add("order-name");
      itemName.textContent = name;
      const quantityControls = document.createElement("div");
      quantityControls.classList.add("quantity-controls");
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
          total -= orders[name].totalPrice;
          updateTotal();
          orderItem.remove();
          delete orders[name];
        }
      };
      const quantityDisplay = document.createElement("span");
      quantityDisplay.classList.add("item-quantity");
      quantityDisplay.textContent = `x${orders[name].quantity}`;
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
      const itemPrice = document.createElement("span");
      itemPrice.classList.add("item-price");
      itemPrice.textContent = `₱${orders[name].totalPrice.toFixed(2)}`;
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

    // Update quantity and price display for order item
    function updateOrderItem(name) {
      const item = orders[name];
      const orderItem = item.orderItem;
      const quantityDisplay = orderItem.querySelector(".item-quantity");
      const itemPrice = orderItem.querySelector(".item-price");
      quantityDisplay.textContent = `x${item.quantity}`;
      itemPrice.textContent = `₱${item.totalPrice.toFixed(2)}`;
    }

    // Update total price display
    function updateTotal() {
      document.getElementById("order-total").textContent = total.toFixed(2);
    }

    // Clear all orders and reset UI and data
    function clearOrders() {
      const orderList = document.getElementById("order-list");
      orderList.innerHTML = "";
      total = 0;
      for (const key in orders) {
        delete orders[key];
      }
      updateTotal();
    }

    // Show payment modal for checkout
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

    // Toggle cash or gcash payment section visibility
    function updatePaymentMethodView() {
      const method = document.getElementById('payment-method').value;
      document.getElementById('cash-section').style.display = method === 'cash' ? 'block' : 'none';
      document.getElementById('gcash-section').style.display = method === 'gcash' ? 'block' : 'none';
    }

    // Update change amount when user inputs received cash
    document.getElementById('cash-input').addEventListener('input', () => {
      const received = parseFloat(document.getElementById('cash-input').value);
      const change = received - total;
      document.getElementById('change-amount').textContent = change >= 0 ? change.toFixed(2) : "0.00";
    });

    // Get selected order type from radio buttons
    function getSelectedOrderType() {
      const radios = document.getElementsByName('order-type');
      for (const radio of radios) {
        if (radio.checked) return radio.value;
      }
      return "Dine In";
    }

    // Confirm payment, validate input and save transaction
    function confirmPayment() {
      const method = document.getElementById('payment-method').value;
      const orderType = getSelectedOrderType();

      // Prepare items array for transaction
      const itemsArray = Object.keys(orders).map(name => {
        return {
          name: name,
          price: orders[name].price,
          quantity: orders[name].quantity,
          totalPrice: orders[name].totalPrice
        };
      });

      if (method === 'cash') {
          const received = parseFloat(document.getElementById('cash-input').value);
          if (isNaN(received) || received < total) {
            alert("Insufficient cash.");
            return;
          }
          const orderNumber = generateOrderNumber();
          alert("Cash payment confirmed. Change: ₱" + (received - total).toFixed(2) + "\nOrder Type: " + orderType + "\nYour order number is: " + orderNumber);
          
          // Save transaction to localStorage
          saveTransaction(orderNumber, total, itemsArray, orderType, method);

      } else if (method === 'gcash') {
          const orderNumber = generateOrderNumber();
          alert("GCash payment recorded. Thank you!\nOrder Type: " + orderType + "\nYour order number is: " + orderNumber);
          
          // Save transaction to localStorage
          saveTransaction(orderNumber, total, itemsArray, orderType, method);
      }
      closePaymentModal();
      clearOrders();
    }

    // Save transaction details into localStorage
    function saveTransaction(orderNumber, totalPrice, items, orderType, paymentMethod) {
      const TRANSACTION_STORAGE_KEY = 'savedTransactions';
      let savedTransactions = [];
      try {
        const existing = localStorage.getItem(TRANSACTION_STORAGE_KEY);
        if (existing) {
          const parsed = JSON.parse(existing);
          if (Array.isArray(parsed)) {
            savedTransactions = parsed;
          }
        }
      } catch(e) {
        console.error('Error reading saved transactions', e);
      }

      // Create simplified items array for transaction - each item should have name and price for customer transaction page
      // Quantity can be included if needed by that page
      const simplifiedItems = items.map(item => ({
        name: item.name,
        price: item.price,
        quantity: item.quantity
      }));

      const newTransaction = {
        orderNumber: orderNumber,
        totalPrice: totalPrice,
        items: simplifiedItems,
        orderType: orderType,
        paymentMethod: paymentMethod
      };

      savedTransactions.push(newTransaction);

      try {
        localStorage.setItem(TRANSACTION_STORAGE_KEY, JSON.stringify(savedTransactions));
      } catch(e) {
        console.error('Error saving transaction', e);
      }
    }

    // Close/hide the payment modal popup
    function closePaymentModal() {
      document.getElementById('payment-modal').style.display = 'none';
    }
  </script>
</body>
</html>

