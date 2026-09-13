<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Master Produk</title>
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
    padding:20px;
    border-radius:10px;
    margin-bottom:20px;
}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    border:1px solid #ddd;
    padding:10px;
}
input{
    padding:8px;
    width:180px;
    margin:3px;
}
button{
    padding:8px 15px;
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
</div>
<div class="content">
<h1>Master Produk</h1>
<div class="card">
<form method="POST" action="/erp/products">
@csrf
<input name="sku" placeholder="SKU">
<input name="name" placeholder="Nama Produk">
<input
type="number"
name="purchase_price"
placeholder="Harga Beli">
<input
type="number"
name="selling_price"
placeholder="Harga Jual">
<input
type="number"
name="stock"
placeholder="Stok">
<button type="submit">
Simpan
</button>
</form>
</div>
<div class="card">
<table>
<tr>
<th>ID</th>
<th>SKU</th>
<th>Nama</th>
<th>Stok</th>
<th>Beli</th>
<th>Jual</th>
</tr>
@foreach($products as $p)
<tr>
<td>{{ $p->id }}</td>
<td>{{ $p->sku }}</td>
<td>{{ $p->name }}</td>
<td>{{ $p->stock }}</td>
<td>{{ $p->purchase_price }}</td>
<td>{{ $p->selling_price }}</td>
</tr>
@endforeach
</table>
</div>
</div>
</div>
</body>
</html>
