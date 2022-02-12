@extends('template.master')
@section('title', 'Settings')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <h2>Facturacion</h2>
                </div>
                <div class="card-body p-3">
                    <form class="row g-3" method="POST"
                        action="{{ route('setting.invoice.store', ['invoice' => $invoice->id]) }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="col-md-12">
                            <label for="cai" class="form-label">CAI</label>
                            <input type="text" class="form-control @error('cai') is-invalid @enderror" id="cai"
                                name="cai" value="{{ $invoice->cai }}">
                            @error('cai')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="from_range" class="form-label">Rango Inicial</label>
                            <input type="text" class="form-control @error('from_range') is-invalid @enderror" " id=" from_range"
                                name="from_range" value="{{ $invoice->from_range }}" >
                            @error('from_range')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="to_range" class="form-label">Rango Final</label>
                            <input type="text" class="form-control @error('to_range') is-invalid @enderror" id="to_range"
                                name="to_range" value="{{ $invoice->to_range }}">
                            @error('to_range')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="limit_date" class="form-label">Fecha Limite</label>
                            <input type="date" class="form-control @error('limit_date') is-invalid @enderror" id="limit_date" name="limit_date"
                                value="{{ $invoice->limit_date }}">
                            @error('limit_date')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn myBtn shadow-sm border float-end">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
