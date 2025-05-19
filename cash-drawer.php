<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cash Drawer</title>
    <link rel="stylesheet" href="cash-drawer.css">
</head>
<body>
    <header>
        <!-- Left: Hamburger and Title -->
        <div class="header-left">
            <span class="hamburger" role="button" aria-label="Toggle menu" tabindex="0" aria-expanded="false">☰</span>
            <span class="menu-title">Cash Drawer</span>
        </div>

        <!-- Right: Logo as Image -->
        <div class="header-right">
            <img id="logo-img" src="logo.png" alt="BREWeb Logo" />
        </div>
    </header>

<div class="container">
    <div class="top-row">
        <div class="card">
            <h3>Cash Sales</h3>
            <div class="amount" id="cashAmount">₱0.00</div>
        </div>
        <div class="card">
            <h3>GCash Sales</h3>
            <div class="amount" id="gcashAmount">₱0.00</div>
        </div>
</div>

    <div class="bottom-row">
        <div class="large-box">
            <h3>Cash Added</h3>
        </div>
        <div class="large-box">
            <h3>Cash Expenses</h3>
        </div>
    </div>
</div>

<!-- Side Drawer -->
        <div id="side-drawer" aria-hidden="true">
            <button id="close-drawer" aria-label="Close menu">✖ Close</button>

            <!-- Drawer Content -->
            <nav class="main-nav">
                <a href="Admin.php">Home</a>
                <a href="profile.php">Profile</a>
                <a href="admin-transaction.php">Transaction</a>
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

<script>
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
                if (e.key === 'Escape' && sideDrawer.classList.contains('open')) {
                    closeDrawer();
                }
            });
            sideDrawer.querySelectorAll('nav a').forEach(link => {
                link.addEventListener('click', closeDrawer);
            });
    }

    function updateSalesAmounts() {
        const storedTransactions = localStorage.getItem('savedTransactions');
        let transactions = [];
        try {
            transactions = storedTransactions ? JSON.parse(storedTransactions) : [];
            if (!Array.isArray(transactions)) transactions = [];
        } catch {
            transactions = [];
        }

        let cashTotal = 0;
        let gcashTotal = 0;

        transactions.forEach(tx => {
            if (tx.paymentType && tx.items && Array.isArray(tx.items)) {
                const txTotal = tx.items.reduce((sum, item) => sum + (item.price || 0), 0);
                if (tx.paymentType.toLowerCase() === 'gcash') {
                    gcashTotal += txTotal;
                } else if (tx.paymentType.toLowerCase() === 'cash') {
                    cashTotal += txTotal;
                }
            }
        });

        const gcashEl = document.getElementById('gcashAmount');
        const cashEl = document.getElementById('cashAmount');
        const formatter = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' });

        gcashEl.textContent = formatter.format(gcashTotal);
        cashEl.textContent = formatter.format(cashTotal);
    }

    document.addEventListener('DOMContentLoaded', () => {
        setupSideDrawer();
        updateSalesAmounts();
    });
</script>
</body>
</html>

