<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ERP Pondok</title>
<style>
body{
font-family:Segoe UI;
background:#f4f6f9;
margin:0;
}
.nav{
background:#1f2937;
padding:15px;
}
.nav a{
color:white;
text-decoration:none;
margin-right:20px;
font-weight:bold;
}
.container{
padding:20px;
}
.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 2px 8px rgba(0,0,0,.1);
margin-bottom:20px;
}
table{
width:100%;
border-collapse:collapse;
background:white;
}
th,td{
padding:12px;
border:1px solid #ddd;
}
th{
background:#111827;
color:white;
}
h1{
margin-top:0;
}
</style>
</head>
<body>
<div class="nav">
<a href="/erp">Dashboard</a>
<a href="/erp/customers">Customers</a>
<a href="/erp/vehicles">Vehicles</a>
<a href="/erp/sales">Sales</a>
<a href="/erp/products">Products</a>
<a href="/erp/purchases">Purchases</a>
<a href="/erp/work-orders">Workshop</a>
<a href="/erp/fixed-assets">Assets</a>
</div>
<div class="container">
@yield('content')
</div>
</body>
</html>
