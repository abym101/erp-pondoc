<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ERP Bengkel</title>
<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}
body{
display:flex;
background:#f5f6fa;
}
.sidebar{
width:250px;
min-height:100vh;
background:#1e293b;
color:white;
padding:20px;
}
.sidebar h2{
margin-bottom:20px;
}
.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:10px;
margin-bottom:5px;
border-radius:5px;
}
.sidebar a:hover{
background:#334155;
}
.content{
flex:1;
padding:25px;
}
.card{
background:white;
padding:20px;
margin-bottom:20px;
border-radius:10px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}
</style>
</head>
<body>
<div class="sidebar">
<h2>ERP Bengkel</h2>
<a href="/erp">Dashboard</a>
<h4>Master Data</h4>
<a href="/erp/products">Produk</a>
<a href="/erp/categories">Kategori</a>
<a href="/erp/customers">Pelanggan</a>
<a href="/erp/vehicles">Kendaraan</a>
<h4>Bengkel</h4>
<a href="/erp/work-orders">
Work Order
</a>
<h4>Kasir</h4>
<a href="/erp/sales">
POS / Kasir
</a>
<h4>Laporan</h4>
<a href="/erp/reports/dashboard">
Dashboard Report
</a>
<a href="/erp/reports/sales">
Laporan Penjualan
</a>
<a href="/erp/reports/work-orders">
Laporan Work Order
</a>
<a href="/erp/reports/stock">
Laporan Stok
</a>
</div>
<div class="content">
@yield('content')
</div>
</body>
</html>
