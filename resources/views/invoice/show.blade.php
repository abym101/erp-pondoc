<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice Work Order</title>
<style>
body{
font-family:Arial;
padding:30px;
}
table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}
th,td{
border:1px solid #ddd;
padding:8px;
}
</style>
</head>
<body>
<h1>INVOICE WORK ORDER</h1>
<p>No WO : {{ $wo->number }}</p>
<p>Customer : {{ optional($wo->customer)->name }}</p>
<p>Kendaraan : {{ optional($wo->vehicle)->plate_number }}</p>
<h3>Jasa</h3>
<table>
<tr>
<th>Nama</th>
<th>Harga</th>
</tr>
@foreach(
\App\Models\WorkOrderService::where(
'work_order_id',
$wo->id
)->get()
as $srv
)
<tr>
<td>
{{ optional($srv->serviceJob)->name }}
</td>
<td>
{{ number_format($srv->price) }}
</td>
</tr>
@endforeach
</table>
<h3>Sparepart</h3>
<table>
<tr>
<th>Produk</th>
<th>Qty</th>
<th>Subtotal</th>
</tr>
@foreach(
\App\Models\WorkOrderItem::where(
'work_order_id',
$wo->id
)->get()
as $item
)
<tr>
<td>
{{ optional($item->product)->name }}
</td>
<td>
{{ $item->qty }}
</td>
<td>
{{ number_format($item->subtotal) }}
</td>
</tr>
@endforeach
</table>
<h2>
TOTAL :
Rp {{ number_format($wo->total) }}
</h2>
</body>
</html>
