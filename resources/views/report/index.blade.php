@extends('template.master')
@section('title', 'User')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mt-2 mb-2">
                <div class="col-lg-12 mb-2">
                    <form class="d-flex" method="POST" action="{{ route('report.export') }}">
                        @csrf
                        <div class="col-lg-3">
                            <p>Fecha inicio:</p>
                            <input type="date" name="from_date" id="from_date" class="form-control">
                        </div>

                        <div class="col-lg-3">
                            <p>Fecha fin:</p>
                            <input type="date" name="to_date" id="to_date" class="form-control">
                        </div>

                        <div class="col-lg-3">
                            <p>Tipo de reporte</p>
                            <select name="report_type" id="report_type" class="form-control">
                                <option value="PAYMENT">PAGOS</option>
                                <option value="TRANSACTION">FACTURAS</option>
                                <option value="CUSTOMER">CLIENTES</option>
                                <option value="ROOM">HABITACIONES</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <p>&nbsp;</p>
                            <button class="btn btn-outline-success" type="submit">Exportar</button>
                        </div>
                        
                    </form>
                </div>
            </div>
            
        </div>
        
    </div>



@endsection

@section('footer')
    <script>
        

    </script>
@endsection
