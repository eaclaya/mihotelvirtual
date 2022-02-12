<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            max-width: 280px;
            text-align: center;
            font-size: 8px;
        }
        td, th {
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <p><img src="/img/account/{{$account->logo}}" alt="" style="max-width: 100px"></p>
    <p><strong>{{$account->name}}</strong></p>
    <p>{{$account->address}}</p>
    <p>TEL:{{$account->phone}}</p>
    <p>RTN:{{$account->vat_number}}</p>

    @if($transaction->invoice_setting_id)
    <p>CAI:{{$transaction->getInvoiceSetting()->cai}}</p>
    <p>FECHA LIMITE:{{$transaction->getInvoiceSetting()->limit_date}}</p>
    <p>RANGO AUTORIZADO:{{$transaction->getInvoiceSetting()->from_range}} al {{$transaction->getInvoiceSetting()->to_range}}</p>
    @endif

    <p>CLIENTE: {{$transaction->customer->name}}</p>

    @if($transaction->customer->vat_number)
        <p>RTN:{{$transaction->customer->vat_number}}</p>
    @endif
    <p>FECHA: {{$transaction->invoice_date}}</p>
    <p><strong>FACTURA:{{$transaction->invoice_number}}</strong></p>


    <table style="width: 100%">
        <thead>
            <tr>
                <td>Check In</td>
                <td>Check Out</td>
                <td>Dias</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}
                </td>
            </tr>
        </tbody>
    </table>

    <br><br>

    <table style="width: 100%">
        <thead>

            <tr>
                <th width="500">Descripcion</th>
                <th width="100">Total</th>
            </tr>
        </thead>
        <tbody>
           <tr>
               <td>Hospedaje </td>
               <td>{{$transaction->amount}}</td>
           </tr>

        </tbody>
        <tfoot>
            <tr>
                <td >Subtotal Gravado 15%</td>
                
                <td>{{number_format(($transaction->amount/1.15 ) , 3, '.', ',')}}</td>
                
            </tr>
            <tr>
                <td >Subtotal Exento</td>
                    @if($transaction->tax_rate1 == 0)
                                <td>{{$transaction->amount}}</td>
                                @else
                                <td>0.00</td>
                                @endif
                        </tr>
            <tr>
                <td >Subtotal Exonerado</td>
                @if($transaction->tax_rate1 == -1)
                <td>{{$transaction->amount}}</td>
                @else
                <td>0.00</td>
                @endif
                        </tr>
            <tr>
                                <td >Descuentos y Rebajas</td>
                                <td>{{ number_format($transaction->discount, 3, '.', ',') }}</td>
                        </tr>
            <tr>
                <td >ISV 15%</td>
                @if($transaction->tax_rate1 > 0)
                <td>{{ number_format((($transaction->amount/(1 + (15/100))) * 0.15), 3, '.', ',') }}</td>
                @else
                <td>0.00</td>
                @endif
            </tr>
            <tr>
                
                <td ><strong>Total</strong></td>
                <td><strong>{{$transaction->amount}}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
<script>
    window.print();
    setTimeout(() => {
        window.location.href = '/transaction';
    }, 2000);
</script>
