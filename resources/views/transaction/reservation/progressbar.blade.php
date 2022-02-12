<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="progress-indicator m-4">
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.createIdentity' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.pickFromCustomer' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.viewCountPerson' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Tarjeta de cliente
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.viewCountPerson' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Cantidad de personas?
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Escoge una habitacion
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Confirmacion
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
