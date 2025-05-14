<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Enhanced Transaction Page Fullscreen</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

  /* Universal box-sizing for consistent sizing */
  *, *::before, *::after {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    font-family: 'Montserrat', Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    height: 100vh;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  /* Full-width Topbar/Header */
  .topbar {
    width: 100vw;
    background-color: #D0AC77;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 20px;
    font-weight: 700;
    color: #3a2a00;
    box-shadow: 0 2px 6px rgba(255 187 51 / 0.25);
    flex-shrink: 0;
  }

  .left-header,
  .right-header {
    display: flex;
    align-items: center;
  }

  .menu-icon {
    font-size: 22px;
    cursor: pointer;
    user-select: none;
    transition: color 0.3s ease;
  }
  .menu-icon:hover {
    color: #a97200;
  }

  .title {
    font-size: 1.25rem;
    user-select: none;
    margin-left: 8px;
  }

  .search-container {
    position: relative;
    margin-left: 15px;
  }

  .search-input {
    padding: 6px 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
    outline-offset: 2px;
    outline-color: #ffbb33;
    width: 300px;
    max-width: 60vw;
  }
  .search-input::placeholder {
    color: #aaa;
    font-style: italic;
  }

  .search-icon {
    font-size: 22px;
    cursor: pointer;
    user-select: none;
    transition: color 0.3s ease;
    margin-left: 8px;
  }
  .search-icon:hover {
    color: #a97200;
  }

  .logo {
    height: 32px;
    width: auto;
    user-select: none;
    flex-shrink: 0;
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

  /* Main container below header */
  .container {
    display: flex;
    flex-grow: 1;
    width: 100vw;
    overflow: hidden;
  }

  /* Sidebar / Transaction List */
  .sidebar {
    width: 40%;
    border-right: 1px solid #ddd;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    box-shadow: inset -5px 0 10px -7px rgba(0,0,0,0.1);
  }

  .transaction-list {
    flex-grow: 1;
    overflow-y: auto;
    padding-bottom: 10px;
  }

  .date-label {
    background-color: #FFD483;
    padding: 10px 20px;
    font-weight: 700;
    border-top: 1px solid #ddd;
    color: #3a2a00;
    user-select: none;
  }

  .transaction-entry {
    display: flex;
    justify-content: space-between;
    padding: 12px 20px;
    border-top: 1px solid #eee;
    cursor: pointer;
    transition: background-color 0.25s ease;
  }
  .transaction-entry:hover, .transaction-entry:focus {
    background-color: #fff9e5;
    outline: none;
  }
  .transaction-entry.active {
    background-color:rgb(233, 222, 193);
    font-weight: 700;
  }

  .transaction-entry span:first-child {
    color: #666;
    font-weight: 500;
  }

  /* Details Panel */
  .details {
    width: 60%;
    padding: 30px 40px;
    background-color: #fffefc;
    display: flex;
    flex-direction: column;
    box-shadow: inset 4px 0 8px -6px rgba(0,0,0,0.1);
  }

  .detail-header {
    display: flex;
    justify-content: space-between;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #7a6a38;
    letter-spacing: 1.2px;
  }

  .total-price {
    font-size: 36px;
    font-weight: 800;
    margin-bottom: 25px;
    color: #a57a4c;
  }

  .items-box {
    background-color: #f4f3f0;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    flex-grow: 1;
    overflow-y: auto;
    box-shadow: inset 0 3px 10px rgb(0 0 0 / 0.03);
  }

  .item-row {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    font-weight: 600;
    padding: 12px 0;
    border-bottom: 1px solid #ddd;
  }
  .item-row:last-child {
    border-bottom: none;
  }

  .subtotal-row {
    display: flex;
    justify-content: space-between;
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 32px;
    color: #8a7b51;
  }

  .button-row {
    display: flex;
    gap: 15px;
  }

  .btn {
    padding: 16px 24px;
    border: none;
    cursor: pointer;
    font-weight: 700;
    font-size: 16px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgb(0 0 0 / 0.08);
    transition: background-color 0.3s ease, transform 0.15s ease;
    user-select: none;
  }
  .btn:focus-visible {
    outline: 3px solid #ffbb33;
    outline-offset: 3px;
  }

  .btn:hover {
    transform: translateY(-2px);
  }

  .reprint {
    background-color: #ffbb33;
    color: #3a2a00;
  }
  .reprint:hover {
    background-color: #dba20a;
  }

  .refund {
    background-color: #a57a4c;
    color: white;
  }
  .refund:hover {
    background-color: #7a5a27;
  }

  /* Responsive */
  @media (max-width: 900px) {
    .container {
      flex-direction: column;
      height: auto;
      width: 100vw;
      border-radius: 0;
    }

    .sidebar, .details {
      width: 100%;
      height: 50vh;
      box-shadow: none !important;
    }

    .transaction-list {
      padding-bottom: 0;
    }

    .details {
      padding: 20px;
    }

    .topbar {
      flex-wrap: wrap;
      justify-content: center;
      gap: 12px;
      padding: 12px 10px;
    }

    .left-header,
    .right-header {
      width: 100%;
      justify-content: center;
      margin: 0;
      padding: 0;
    }

    .search-container {
      flex-grow: 1;
      margin-left: 0;
      margin-right: 0;
      width: 100%;
      max-width: none;
    }

    .search-input {
      width: 100%;
      max-width: none;
    }

    .search-icon {
      margin-left: 0;
    }

    .title {
      margin-left: 0;
    }
  }
</style>
</head>
<body>
  <!-- Full screen topbar with hamburger menu left and logo right -->
  <header class="topbar" role="banner" aria-label="Application header">
    <div class="left-header">
      <div class="menu-icon" tabindex="0" aria-label="Toggle menu">☰</div>
      <div class="title">Transaction</div>
      <div class="search-container" aria-label="Search transactions">
        <input
          class="search-input"
          type="search"
          placeholder="Search by date, time, price..."
          aria-label="Search transactions"
          id="searchInput"
        />
      </div>
      <div class="search-icon" tabindex="0" aria-label="Search icon">🔍</div>
    </div>
    <div class="right-header">
      <img class="logo" src="Logo.png"/>
    </div>
  </header>

  <div class="container" role="main">
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

    <!-- Left Transaction List Panel -->
    <aside class="sidebar" aria-label="Transaction list">
      <!-- Transaction Entries -->
      <nav class="transaction-list" aria-live="polite" id="transactionList">
        <!-- dynamically populated -->
      </nav>
    </aside>

    <!-- Right Transaction Detail Panel -->
    <section class="details" aria-live="polite" aria-atomic="true" aria-label="Transaction details">
      <div class="detail-header">
        <span class="left-label">Total</span>
        <span class="right-label">Items</span>
      </div>

      <div class="total-price" id="totalPrice">P0.00</div>

      <div class="items-box" id="itemsBox" tabindex="0">
        <!-- dynamically populated -->
        <p style="color:#999; font-style: italic;">No transaction selected</p>
      </div>

      <div class="subtotal-row" id="subtotalRow" style="display:none;">
        <span>Subtotal</span>
        <span id="subtotalPrice">P0.00</span>
      </div>

      <div class="button-row">
        <button class="btn reprint" id="reprintBtn" disabled aria-disabled="true" aria-label="Reprint receipt">Reprint<br />Receipt #000</button>
        <button class="btn refund" id="refundBtn" disabled aria-disabled="true" aria-label="Refund transaction">REFUND</button>
      </div>
    </section>
  </div>

<script>
  // Sample transaction data structure with real-like data
  const transactions = [
    {
      date: '2024-06-15',
      entries: [
        { time: '10:35 AM', totalPrice: 150.00, items: [{ name: 'Iced Matcha Milk', price: 150.00 }] },
        { time: '11:15 AM', totalPrice: 200.00, items: [{ name: 'Latte', price: 100.00 }, { name: 'Croissant', price: 100.00 }] },
        { time: '12:45 PM', totalPrice: 185.00, items: [{ name: 'Iced Matcha Milk', price: 185.00 }] },
      ]
    },
    {
      date: '2024-06-14',
      entries: [
        { time: '09:20 AM', totalPrice: 75.00, items: [{ name: 'Espresso', price: 75.00 }] },
        { time: '02:10 PM', totalPrice: 250.00, items: [{ name: 'Cappuccino', price: 150.00 }, { name: 'Bagel', price: 100.00 }] },
      ]
    }
  ];

  const transactionListEl = document.getElementById('transactionList');
  const totalPriceEl = document.getElementById('totalPrice');
  const itemsBoxEl = document.getElementById('itemsBox');
  const subtotalRowEl = document.getElementById('subtotalRow');
  const subtotalPriceEl = document.getElementById('subtotalPrice');
  const reprintBtn = document.getElementById('reprintBtn');
  const refundBtn = document.getElementById('refundBtn');
  const searchInput = document.getElementById('searchInput');

  let activeTransaction = null;

  // Utility to format numbers as currency
  function formatCurrency(amount) {
    return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP'}).format(amount);
  }

  // Function to build and render transaction entries list filtered by searchTerm
  function renderTransactionList(filter = '') {
    transactionListEl.innerHTML = '';

    let foundAny = false;

    for (const day of transactions) {
      // Filter entries by search term: date, time, price
      let filteredEntries = day.entries.filter(entry => {
        const filterLower = filter.toLowerCase();
        return (
          day.date.includes(filterLower) ||
          entry.time.toLowerCase().includes(filterLower) ||
          entry.totalPrice.toString().includes(filterLower)
        );
      });

      if (filteredEntries.length === 0) continue;

      // Date label
      const dateLabel = document.createElement('div');
      dateLabel.className = 'date-label';
      dateLabel.textContent = (new Date(day.date)).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
      transactionListEl.appendChild(dateLabel);

      // Entries
      filteredEntries.forEach((entry, index) => {
        const entryDiv = document.createElement('div');
        entryDiv.className = 'transaction-entry';
        entryDiv.setAttribute('tabindex', '0');
        entryDiv.setAttribute('role', 'button');
        entryDiv.setAttribute('aria-pressed', 'false');
        entryDiv.dataset.dayIndex = transactions.indexOf(day);
        entryDiv.dataset.entryIndex = index;

        const timeSpan = document.createElement('span');
        timeSpan.textContent = entry.time;
        const priceSpan = document.createElement('span');
        priceSpan.textContent = formatCurrency(entry.totalPrice);

        entryDiv.appendChild(timeSpan);
        entryDiv.appendChild(priceSpan);

        // Click or keyboard select event to load details
        entryDiv.addEventListener('click', () => {
          setActiveTransaction(day, entry, entryDiv);
        });
        entryDiv.addEventListener('keydown', (e) => {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            setActiveTransaction(day, entry, entryDiv);
          }
        });

        transactionListEl.appendChild(entryDiv);
        foundAny = true;
      });
    }

    if (!foundAny) {
      const noItems = document.createElement('p');
      noItems.style.color = '#999';
      noItems.style.fontStyle = 'italic';
      noItems.style.padding = '10px 20px';
      noItems.textContent = 'No transactions found';
      transactionListEl.appendChild(noItems);
    }

    // Clear active selection if list is rerendered
    activeTransaction = null;
    clearDetails();
  }

  // Function to clear the details panel
  function clearDetails() {
    totalPriceEl.textContent = 'P0.00';
    itemsBoxEl.innerHTML = '<p style="color:#999; font-style: italic;">No transaction selected</p>';
    subtotalRowEl.style.display = 'none';
    reprintBtn.disabled = true;
    reprintBtn.setAttribute('aria-disabled', 'true');
    refundBtn.disabled = true;
    refundBtn.setAttribute('aria-disabled', 'true');

    // Remove active classes
    document.querySelectorAll('.transaction-entry.active').forEach(el => el.classList.remove('active'));
  }

  // Function to display transaction details on the right panel
  function setActiveTransaction(day, entry, entryDiv) {
    activeTransaction = { day, entry };

    // Remove active state on all
    document.querySelectorAll('.transaction-entry.active').forEach(el => {
      el.classList.remove('active');
      el.setAttribute('aria-pressed', 'false');
    });

    entryDiv.classList.add('active');
    entryDiv.setAttribute('aria-pressed', 'true');

    totalPriceEl.textContent = formatCurrency(entry.totalPrice);

    // Build items list
    itemsBoxEl.innerHTML = '';
    let subtotal = 0;
    entry.items.forEach(item => {
      const itemRow = document.createElement('div');
      itemRow.className = 'item-row';

      const nameSpan = document.createElement('span');
      nameSpan.textContent = item.name;
      const priceSpan = document.createElement('span');
      priceSpan.textContent = formatCurrency(item.price);

      itemRow.appendChild(nameSpan);
      itemRow.appendChild(priceSpan);

      itemsBoxEl.appendChild(itemRow);

      subtotal += item.price;
    });

    subtotalRowEl.style.display = 'flex';
    subtotalPriceEl.textContent = formatCurrency(subtotal);

    reprintBtn.disabled = false;
    reprintBtn.setAttribute('aria-disabled', 'false');
    refundBtn.disabled = false;
    refundBtn.setAttribute('aria-disabled', 'false');

    // Update reprint button with receipt number (simulate)
    reprintBtn.innerHTML = `Reprint<br />Receipt #${(Math.floor(Math.random() * 900) + 100)}`;

  }

  // Refund confirmation dialog
  refundBtn.addEventListener('click', () => {
    if (!activeTransaction) return;

    const confirmRefund = confirm('Are you sure you want to refund this transaction?');
    if (confirmRefund) {
      alert('Transaction refunded successfully.');
      // Remove refunded transaction from data and refresh list
      const dayIndex = transactions.indexOf(activeTransaction.day);
      const entryIndex = activeTransaction.day.entries.indexOf(activeTransaction.entry);
      if (dayIndex > -1 && entryIndex > -1) {
        transactions[dayIndex].entries.splice(entryIndex, 1);
        // Remove day if no entries left
        if (transactions[dayIndex].entries.length === 0) {
          transactions.splice(dayIndex, 1);
        }
      }
      renderTransactionList(searchInput.value.trim());
      clearDetails();
    }
  });

  // Reprint button alert demo
  reprintBtn.addEventListener('click', () => {
    if (!activeTransaction) return;
    alert(`Reprinting receipt for transaction at ${activeTransaction.entry.time} on ${(new Date(activeTransaction.day.date)).toLocaleDateString()}.`);
  });

  // Search input filtering with debounce
  let searchTimeout = null;
  searchInput.addEventListener('input', () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
      renderTransactionList(searchInput.value.trim());
    }, 250);
  });

  // Initial render
  renderTransactionList();
</script>
</body>
</html>

