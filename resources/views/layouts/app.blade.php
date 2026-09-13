<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>ERP Pondok</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
<style>
body{
    background:#f1f5f9;
}
.sidebar{
    width:260px;
    min-height:100vh;
    background:#0f172a;
    color:white;
    position:fixed;
    left:0;
    top:0;
}
.content{
    margin-left:260px;
}
.menu-item{
    display:block;
    padding:12px 18px;
    color:#cbd5e1;
    text-decoration:none;
    border-radius:10px;
}
.menu-item:hover{
    background:#1e293b;
    color:white;
}
.card{
    background:white;
    border-radius:16px;
    padding:20px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}
.stat{
    font-size:32px;
    font-weight:bold;
}
</style>
</head>
<body>
<div class="sidebar">
<div class="p-5 text-center border-b border-slate-700">
<h2 class="text-xl font-bold">
ERP PONDOK
</h2>
</div>
<div class="p-3">
<a class="menu-item" href="/erp">
<i class="fa fa-chart-line"></i>
 Dashboard
</a>
<a class="menu-item" href="/erp/products">
<i class="fa fa-box"></i>
 Produk
</a>
<a class="menu-item" href="/erp/purchases">
<i class="fa fa-cart-shopping"></i>
 Pembelian
</a>
<a class="menu-item" href="/erp/sales">
<i class="fa fa-cash-register"></i>
 Penjualan
</a>
<a class="menu-item" href="/erp/work-orders">
<i class="fa fa-screwdriver-wrench"></i>
 Workshop
</a>
<a class="menu-item" href="/erp/accounts">
<i class="fa fa-book"></i>
 Akun
</a>
<a class="menu-item" href="/erp/ledger">
<i class="fa fa-file-lines"></i>
 Ledger
</a>
<a class="menu-item" href="/erp/trial-balance">
<i class="fa fa-scale-balanced"></i>
 Trial Balance
</a>
<a class="menu-item" href="/erp/profit-loss">
<i class="fa fa-chart-column"></i>
 Laba Rugi
</a>
<a class="menu-item" href="/erp/balance-sheet">
<i class="fa fa-building-columns"></i>
 Neraca
</a>
<a class="menu-item" href="/erp/fixed-assets">
<i class="fa fa-computer"></i>
 Fixed Asset
</a>
<a class="menu-item" href="/erp/asset-depreciation">
<i class="fa fa-percent"></i>
 Penyusutan
</a>
</div>
</div>
<div class="content">
<div class="bg-white p-4 shadow">
<div class="flex justify-between">
<div>
<h1 class="text-2xl font-bold">
ERP Pondok Pesantren
</h1>
</div>
<div>
{{ now() }}
</div>
</div>
</div>
<div class="p-6">
@yield('content')
</div>
</div>
</body>
</html>
