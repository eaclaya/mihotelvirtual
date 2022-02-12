<table>
	<thead>
		<tr>
			<td>Fecha de pago</td>
			<td>Cliente</td>
			<td>Factura</td>
			<td>Fecha de factura</td>
			<td>Monto de pago</td>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $payment)
		<tr>
			<td>{{$payment->created_at}}</td>
			<td>{{$payment->name}}</td>
			<td>{{$payment->invoice_number}}</td>
			<td>{{$payment->invoice_date}}</td>
			<td>{{$payment->price}}</td>
		</tr>
		@endforeach
	</tbody>
</table>