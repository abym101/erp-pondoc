<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>POS Kasir</title>
<style>
body{
margin:0;
font-family:Arial;
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
.sidebar a{
display:block;
color:white;
padding:10px;
text-decoration:none;
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
input,select{
width:100%;
padding:8px;
box-sizing:border-box;
}
button{
padding:10px 20px;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="sidebar">
<h2>ERP Bengkel</h2>
<a href="/erp">Dashboard</a>
<a href="/erp/products">Produk</a>
<a href="/erp/customers">Pelanggan</a>
<a href="/erp/vehicles">Kendaraan</a>
<a href="/erp/work-orders">Work Order</a>
<a href="/erp/sales">POS Kasir</a>
</div>
<div class="content">
<h1>POS Kasir</h1>
<div class="card">
<form method="POST" action="/erp/sales">
@csrf
<label>Pelanggan</label>
<select name="customer_id">
@foreach($customers as $c)
<option value="{{ $c->id }}">
{{ $c->name }}
</option>
@endforeach
</select>
<br><br>
<label>Produk</label>
<select name="product_id">
@foreach($products as $p)
<option value="{{ $p->id }}">
{{ $p->name }}
(Stock {{ $p->stock }})
</option>
@endforeach
</select>
<br><br>
<label>Qty</label>
<input
type="number"
name="qty"
value="1">
<br><br>
<button type="submit">
Simpan Transaksi
</button>
</form>
</div>
<div class="card">
<h2>Riwayat Penjualan</h2>
<table>
<tr>
<th>ID</th>
<th>Invoice</th>
<th>Total</th>
</tr>
@foreach($sales as $s)
<tr>
<td>{{ $s->id }}</td>
<td>{{ $s->invoice_no }}</td>
<td>{{ $s->grand_total }}</td>
</tr>
@endforeach
</table>
</div>
</div>
</div>
</body>
</html>
