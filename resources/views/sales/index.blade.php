@extends('layouts.app')
@section('content')
<h1>Sales</h1>
<div class='card'>
<table>
<tr>
<th>Invoice</th>
<th>Total</th>
<th>Status</th>
</tr>
@foreach(\ as \)
<tr>
<td>{{ \->invoice_no }}</td>
<td>Rp {{ number_format(\->grand_total,0,',','.') }}</td>
<td>{{ \->payment_status }}</td>
</tr>
@endforeach
</table>
</div>
@endsection
