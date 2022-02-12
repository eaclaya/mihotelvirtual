<table>
	<thead>
		<tr>
			<td>Fecha de factura</td>
			<td>Cliente</td>
			<td>Factura</td>
			<td>Habitacion</td>
			<td>Total</td>
			<td>Pagado</td>
			<td>Pendiente</td>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $transaction)
		<tr>
			<td>{{$transaction->invoice_date}}</td>
			<td>{{$transaction->name}}</td>
			<td>{{$transaction->invoice_number}}</td>
			<td>{{$transaction->number}}</td>
			<td>{{$transaction->amount}}</td>
			<td>{{$transaction->amount - $transaction->balance}}</td>
			<td>{{$transaction->balance}}</td>
		</tr>
		@endforeach
	</tbody>
</table>