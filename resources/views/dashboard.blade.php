<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ERP Bengkel</title>
<style>
body{
    margin:0;
    font-family:Arial,Helvetica,sans-serif;
    background:#f1f5f9;
}
.wrapper{
    display:flex;
    min-height:100vh;
}
.sidebar{
    width:240px;
    background:#0f172a;
    color:white;
    padding:20px;
}
.sidebar h2{
    margin-top:0;
}
.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:10px;
    margin-bottom:5px;
    border-radius:6px;
}
.sidebar a:hover{
    background:#1e293b;
}
.content{
    flex:1;
    padding:25px;
}
.card{
    background:white;
    border-radius:10px;
    padding:20px;
    margin-bottom:20px;
    box-shadow:0 2px 6px rgba(0,0,0,.08);
}
</style>
</head>
<body>
<div class="wrapper">
<div class="sidebar">
<h2>ERP Bengkel</h2>
<a href="/erp">Dashboard</a>
<h3>Master</h3>
<a href="/erp/products">Produk</a>
<a href="/erp/categories">Kategori</a>
<a href="/erp/customers">Pelanggan</a>
<a href="/erp/vehicles">Kendaraan</a>
<h3>Operasional</h3>
<a href="/erp/work-orders">Work Order</a>
<a href="/erp/sales">POS Kasir</a>
<h3>Laporan</h3>
<a href="/erp/reports/dashboard">Dashboard</a>
<a href="/erp/reports/sales">Penjualan</a>
<a href="/erp/reports/work-orders">Work Order</a>
<a href="/erp/reports/stock">Stok</a>
</div>
<div class="content">
<h1>ERP Bengkel</h1>
<div class="card">
<h2>Status Sistem</h2>
<ul>
<li>Produk</li>
<li>Kategori</li>
<li>Pelanggan</li>
<li>Kendaraan</li>
<li>Work Order</li>
<li>POS</li>
<li>Laporan</li>
</ul>
</div>
<div class="card">
<p>Fondasi ERP sudah berjalan.</p>
<p>Tahap berikutnya adalah integrasi seluruh modul ke layout yang sama.</p>
</div>
</div>
</div>
</body>
</html>
