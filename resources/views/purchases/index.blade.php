<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Pembelian</title>
</head>
<body>
<h1>Pembelian Barang</h1>
<form method="POST" action="/erp/purchases">
@csrf
<input name="supplier_id" placeholder="Supplier ID">
<br><br>
<input name="product_id" placeholder="Product ID">
<br><br>
<input name="qty" placeholder="Qty">
<br><br>
<input name="price" placeholder="Harga Beli">
<br><br>
<button>Simpan Pembelian</button>
</form>
<hr>
<table border="1">
<tr>
<th>ID</th>
<th>Nomor</th>
<th>Total</th>
</tr>
@foreach($purchases as $p)
<tr>
<td>{{ $p->id }}</td>
<td>{{ $p->number }}</td>
<td>{{ $p->grand_total }}</td>
</tr>
@endforeach
</table>
</body>
</html>
