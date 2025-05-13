<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Transaction Page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <!-- Left Transaction List Panel -->
  <div class="sidebar">
    <div class="topbar">
      <div class="menu-icon">☰</div>
      <div class="title">Transaction</div>
      <div class="search-icon">🔍</div>
    </div>

    <!-- Transaction Entries -->
    <div class="transaction-list">
      <div class="date-label">DATE:</div>
      <div class="transaction-entry"><span>TIME:</span><span>TOTAL PRICE</span></div>
      <div class="transaction-entry"><span>TIME:</span><span>TOTAL PRICE</span></div>
      <div class="transaction-entry"><span>TIME:</span><span>TOTAL PRICE</span></div>
      <div class="date-label">DATE:</div>
      <div class="transaction-entry"><span>TIME:</span><span>TOTAL PRICE</span></div>
      <div class="transaction-entry"><span>TIME:</span><span>TOTAL PRICE</span></div>
      <div class="transaction-entry"><span>TIME:</span><span>TOTAL PRICE</span></div>
      <div class="date-label">DATE:</div>
      <div class="transaction-entry"><span>TIME:</span><span>TOTAL PRICE</span></div>
    </div>
  </div>

  <!-- Right Transaction Detail Panel -->
  <div class="details">
    <div class="detail-header">
      <span class="left-label">TOTAL</span>
      <span class="right-label">ITEMS</span>
    </div>

    <div class="total-price">P185</div>

    <div class="items-box">
      <div class="item-row">
        <span>Iced Matcha Milk</span>
        <span>P185</span>
      </div>
    </div>

    <div class="subtotal-row">
      <span>SUBTOTAL</span>
      <span>P185</span>
    </div>

    <div class="button-row">
      <button class="btn reprint">Reprint<br>Receipt #000</button>
      <button class="btn refund">REFUND</button>
    </div>
  </div>
</div>

</body>
</html>
