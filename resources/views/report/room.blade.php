<table>
	<thead>
		<tr>
			<td>Fecha de ingreso</td>
			<td>Numero</td>
			<td>Precio</td>
			<td>Capacidad</td>
			<td>Detalles</td>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $room)
		<tr>
			<td>{{$room->created_at}}</td>
			<td>{{$room->number}}</td>
			<td>{{$room->price}}</td>
			<td>{{$room->capacity}}</td>
			<td>{{$room->view}}</td>
		</tr>
		@endforeach
	</tbody>
</table>