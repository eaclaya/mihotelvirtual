@extends('template.master')
@section('title', 'Add Room')
@section('head')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="{{asset('package/select2/css/select2.css')}}" rel="stylesheet" />
<script src="{{asset('package/select2/js/select2.js')}}"></script>
@endsection
@section('content')
<style>
    .select2-container .select2-selection--single {
        height: 34px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ccc !important;
        border-radius: 0px !important;
    }
</style>
<div class="row justify-content-md-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border">
            <div class="card-header">
                <h2>Nueva Habitacion</h2>
            </div>
            <div class="card-body p-3">
                <form class="row g-3" method="POST" action="{{route('room.store')}}">
                    @csrf
                    <div class="col-md-12">
                        <label for="type_id" class="form-label">Tipo</label>
                        <select id="type_id" name="type_id" class="form-control select2">
                            @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="room_status_id" class="form-label">Estado</label>
                        <select id="room_status_id" name="room_status_id" class="form-control select2">
                            @foreach ($roomstatuses as $roomstatus)
                            <option value="{{$roomstatus->id}}">{{$roomstatus->name}} ({{$roomstatus->code}})</option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="number" class="form-label">Numero de Habitacion</label>
                        <input room="text" class="form-control @error('number') is-invalid @enderror" id="number"
                            name="number" value="{{old('number')}}" placeholder="ej: 1A">
                        @error('number')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="capacity" class="form-label">Capacidad</label>
                        <input room="text" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                            name="capacity" value="{{old('capacity')}}" placeholder="ej: 4">
                        @error('capacity')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="price" class="form-label">Precio</label>
                        <input room="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{old('price')}}" placeholder="ej: 5000">
                        @error('price')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="view" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="view" name="view" rows="3" placeholder="ej: Vista a la playa">{{old('view')}}</textarea>
                        @error('view')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button room="submit" class="btn btn-light shadow-sm border float-end">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.select2').select2();
</script>

@endsection
