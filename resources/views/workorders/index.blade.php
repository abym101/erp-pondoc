<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Work Order</title>
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
    text-decoration:none;
    padding:10px;
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
input,
textarea,
select{
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
<a href="/erp/categories">Kategori</a>
<a href="/erp/customers">Pelanggan</a>
<a href="/erp/vehicles">Kendaraan</a>
<a href="/erp/work-orders">Work Order</a>
<a href="/erp/sales">POS Kasir</a>
</div>
<div class="content">
<h1>Work Order</h1>
<div class="card">
<form method="POST" action="/erp/work-orders">
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
<label>Kendaraan</label>
<select name="vehicle_id">
@foreach($vehicles as $v)
<option value="{{ $v->id }}">
{{ $v->plate_number ?? $v->id }}
</option>
@endforeach
</select>
<br><br>
<label>Keluhan</label>
<textarea
name="complaint"></textarea>
<br><br>
<label>Diagnosa</label>
<textarea
name="diagnosis"></textarea>
<br><br>
<label>Biaya Jasa</label>
<input
type="number"
name="service_cost"
value="0">
<br><br>
<button type="submit">
Simpan Work Order
</button>
</form>
</div>
<div class="card">
<h2>Daftar Work Order</h2>
<table>
<tr>
<th>ID</th>
<th>Nomor</th>
<th>Status</th>
<th>Total</th>
<th>Invoice</th>
</tr>
@foreach($workorders as $w)
<tr>
<td>{{ $w->id }}</td>
<td>{{ $w->number }}</td>
<td>{{ $w->status }}</td>
<td>{{ $w->total }}</td>
<td>
<a
target="_blank"
href="/erp/invoice/{{ $w->id }}">
Invoice
</a>
</td>
</tr>
@endforeach
</table>
</div>
</div>
</div>
</body>
</html>
