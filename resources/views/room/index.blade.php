@extends('template.master')
@section('title', 'Room')
@section('head')
    <style>
        .text {
            display: block;
            width: 150px;
            height: 100px;
            overflow: hidden;
            /* white-space: nowrap; */
            text-overflow: ellipsis;
        }

    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row mt-2 mb-2">
                <div class="col-lg-1 mb-2">
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ route('room.create') }}" class="btn btn-sm shadow-sm myBtn border rounded">
                            <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 mb-2">
                    <form class="row" method="GET" action="{{ route('room.search') }}">
                        <div class="col-md-3">
                            <input type="text" name="capacity" class="form-control" placeholder="Numero de personas">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="check_in" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="check_out" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-dark" room="submit" style="display: block; width: 100%;">Ver disponibilidad</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-3 mb-2">
                    <form class="d-flex" method="GET" action="{{ route('room.index') }}">
                        
                            <input class="form-control me-2" room="search" placeholder="Numero de habitacion"  aria-label="Buscar"
                            id="search" name="search" value="{{ request()->input('search') }}">
                        

                        <button class="btn btn-outline-dark" room="submit">Buscar</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Numero</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Capacidad</th>
                                            <th scope="col">Precio / Dia</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rooms as $room)
                                            <tr>
                                                <td scope="row">
                                                    {{ ($rooms->currentpage() - 1) * $rooms->perpage() + $loop->index + 1 }}
                                                </td>
                                                <td>{{ $room->number }}</td>
                                                <td>{{ $room->type->name }}</td>
                                                <td>{{ $room->capacity }}</td>
                                                <td>{{ Helper::convertToRupiah($room->price) }}</td>
                                                {{-- <td><span class="text">{{ $room->view }}</span></td> --}}
                                                <td>{{ $room->roomStatus->name }}</td>
                                                <td>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                        href="{{ route('room.edit', ['room' => $room->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit room">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form class="btn btn-sm" method="POST"
                                                        id="delete-room-form-{{ $room->id }}"
                                                        action="{{ route('room.destroy', ['room' => $room->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-light btn-sm rounded shadow-sm border delete" href="#"
                                                            room-id="{{ $room->id }}" room-role="room"
                                                            room-name="{{ $room->name }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete room">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </form>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                        href="{{ route('room.show', ['room' => $room->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Detalle de Habitacion">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    No hay datos disponibles
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h3>Habitacion</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center mt-3">
                <div class="col-sm-10 d-flex justify-content-md-center">
                    {{ $rooms->onEachSide(2)->links('template.paginationlinks') }}
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')
<script>
    $('.delete').click(function() {
        var room_id = $(this).attr('room-id');
        var room_name = $(this).attr('room-name');
        var room_url = $(this).attr('room-url');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Estas seguro?',
            text: "Numero de habitacion " + room_name + " sera eliminado y no podras recuperarlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'No, cancelar! ',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                id = "#delete-room-form-" + room_id
                console.log(id)
                $(id).submit();
            }
        })
    });

</script>
@endsection
