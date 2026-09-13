<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>ERP Pondok Dashboard</title>
<style>
body{
font-family:Segoe UI;
background:#f4f6f9;
margin:0;
padding:30px;
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
background:white;
padding:25px;
border-radius:14px;
box-shadow:0 2px 10px rgba(0,0,0,.08);
}
.label{
font-size:14px;
color:#666;
}
.value{
font-size:34px;
font-weight:700;
margin-top:10px;
}
</style>
</head>
<body>
<h1>ERP Pondok Dashboard</h1>
<div class="grid">
<div class="card">
<div class="label">Products</div>
<div class="value">{{ \ }}</div>
</div>
<div class="card">
<div class="label">Sales</div>
<div class="value">{{ \ }}</div>
</div>
<div class="card">
<div class="label">Purchases</div>
<div class="value">{{ \ }}</div>
</div>
<div class="card">
<div class="label">Work Orders</div>
<div class="value">{{ \ }}</div>
</div>
<div class="card">
<div class="label">Today Sales</div>
<div class="value">{{ \ }}</div>
</div>
<div class="card">
<div class="label">Cash Balance</div>
<div class="value">Rp {{ number_format(\) }}</div>
</div>
<div class="card">
<div class="label">Low Stock</div>
<div class="value">{{ \ }}</div>
</div>
</div>
</body>
</html>
