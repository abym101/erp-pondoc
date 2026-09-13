# =========================================================
# ERP DASHBOARD FULL RECOVERY
# Ubah JSON /erp menjadi Dashboard HTML
# =========================================================
New-Item -ItemType Directory -Force resources\views\erp | Out-Null
@'
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ERP Dashboard</title>
<style>
body{
    font-family:Arial,Helvetica,sans-serif;
    background:#f4f6f9;
    margin:20px;
}
h1{
    margin-bottom:20px;
}
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}
.card{
    background:#fff;
    border-radius:10px;
    padding:20px;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}
.label{
    color:#666;
    font-size:14px;
}
.value{
    font-size:32px;
    font-weight:bold;
    margin-top:10px;
}
</style>
</head>
<body>
<h1>ERP Dashboard</h1>
<div class="grid">
<div class="card">
<div class="label">Products</div>
<div class="value">{{ $products }}</div>
</div>
<div class="card">
<div class="label">Sales</div>
<div class="value">{{ $sales }}</div>
</div>
<div class="card">
<div class="label">Purchases</div>
<div class="value">{{ $purchases }}</div>
</div>
<div class="card">
<div class="label">Work Orders</div>
<div class="value">{{ $work_orders }}</div>
</div>
<div class="card">
<div class="label">Today Sales</div>
<div class="value">{{ $today_sales }}</div>
</div>
<div class="card">
<div class="label">Cash Balance</div>
<div class="value">Rp {{ number_format($cash_balance) }}</div>
</div>
<div class="card">
<div class="label">Low Stock</div>
<div class="value">{{ $low_stock_count }}</div>
</div>
</div>
</body>
</html>
