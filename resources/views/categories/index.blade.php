<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Master Kategori</title>
<style>
body{margin:0;font-family:Arial;background:#f1f5f9}
.wrapper{display:flex;min-height:100vh}
.sidebar{width:240px;background:#0f172a;color:#fff;padding:20px}
.sidebar a{display:block;color:#fff;text-decoration:none;padding:10px}
.content{flex:1;padding:25px}
.card{background:#fff;padding:20px;border-radius:10px;margin-bottom:20px}
table{width:100%;border-collapse:collapse}
th,td{border:1px solid #ddd;padding:10px}
input{padding:8px;width:250px}
button{padding:8px 15px}
</style>
</head>
<body>
<div class="wrapper">
<div class="sidebar">
<h2>ERP Bengkel</h2>
<a href="/erp">Dashboard</a>
<a href="/erp/products">Produk</a>
<a href="/erp/categories">Kategori</a>
<a href="/erp/customers">Pelanggan</a>
<a href="/erp/vehicles">Kendaraan</a>
<a href="/erp/work-orders">Work Order</a>
<a href="/erp/sales">POS Kasir</a>
</div>
<div class="content">
<h1>Master Kategori</h1>
<div class="card">
<form method="POST" action="/erp/categories">
@csrf
<input name="name" placeholder="Nama Kategori">
<button type="submit">Simpan</button>
</form>
</div>
<div class="card">
<table>
<tr>
<th>ID</th>
<th>Nama</th>
</tr>
@foreach($categories as $c)
<tr>
<td>{{ $c->id }}</td>
<td>{{ $c->name }}</td>
</tr>
@endforeach
</table>
</div>
</div>
</div>
</body>
</html>
