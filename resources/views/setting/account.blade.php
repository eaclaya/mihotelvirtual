@extends('template.master')
@section('title', 'Settings')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <h2>Configuracion</h2>
                </div>
                <div class="card-body p-3">
                    <form class="row g-3" method="POST"
                        action="{{ route('setting.account.store', ['account' => $account->id]) }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $account->name }}">
                            @error('name')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" " id=" email"
                                name="email" value="{{ $account->email }}" >
                            @error('email')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label">Telefono</label>
                            <input type="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ $account->phone }}">
                            @error('phone')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="vat_number" class="form-label">RTN</label>
                            <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number"
                                value="{{ $account->vat_number }}">
                            @error('vat_number')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Direccion</label>
                            <textarea class="form-control" id="address" name="address"
                                rows="3">{{ $account->address }}</textarea>
                            @error('address')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-mg-12">
                            <label for="logo" class="form-label">Logo</label>
                            <input class="form-control" type="file" id="logo" name="logo">
                            @error('logo')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if($account->logo)
                        <div class="col-mg-12">
                            <img src="/img/account/{{$account->logo}}" style="max-width: 100px">
                        </div>
                        @endif
                        <div class="col-12">
                            <button type="submit" class="btn myBtn shadow-sm border float-end">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
