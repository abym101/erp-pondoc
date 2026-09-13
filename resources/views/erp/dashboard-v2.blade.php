<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ERP Bengkel</title>
<style>
body{
font-family:Arial;
background:#f4f6f9;
margin:0;
padding:0;
}
.header{
background:#1f2937;
color:white;
padding:20px;
font-size:24px;
}
.menu{
background:white;
padding:10px;
border-bottom:1px solid #ddd;
}
.menu a{
text-decoration:none;
margin-right:15px;
font-weight:bold;
}
.container{
padding:20px;
}
.cards{
display:flex;
gap:20px;
flex-wrap:wrap;
}
.card{
background:white;
padding:20px;
width:220px;
border-radius:10px;
box-shadow:0 2px 8px rgba(0,0,0,.1);
}
.card h1{
margin:0;
font-size:32px;
}
.card p{
margin-top:10px;
color:#666;
}
.section{
margin-top:30px;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 2px 8px rgba(0,0,0,.1);
}
</style>
</head>
<body>
<div class="header">
ERP BENGKEL
</div>
<div class="menu">
<a href="/erp">
Dashboard</a>
<a href="/erp/products">
Produk
</a>
<a href="/erp/customers">
Customer
</a>
<a href="/erp/work-orders">
Work Order
</a>
<a href="/erp/sales">
POS
</a>
<a href="/erp/kpi">
KPI
</a>
<a href="/erp/workshop-kpi">
Workshop KPI
</a>
<a href="/erp/finance">
Keuangan
</a>
<a href="/erp/profit-loss">
Laba Rugi
</a>
<a href="/erp/cashflow">
Cashflow
</a>
</div>
<div class="container">
<div class="cards">
<div class="card">
<h1>{{ $products }}</h1>
<p>Produk</p>
</div>
<div class="card">
<h1>{{ $sales }}</h1>
<p>Transaksi POS</p>
</div>
<div class="card">
<h1>{{ $workOrders }}</h1>
<p>Work Order</p>
</div>
<div class="card">
<h1>Rp {{ number_format($cash) }}</h1>
<p>Saldo Kas</p>
</div>
</div>
<div class="section">
<h2>Status ERP</h2>
<p>
Inventory ?
</p>
<p>
POS ?
</p>
<p>
Workshop ?
</p>
<p>
KPI ?
</p>
<p>
Finance ?
</p>
</div>
</div>
</body>
</html>
