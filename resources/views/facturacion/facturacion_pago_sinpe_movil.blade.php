<div class="card-body">
    <div class="form-group row mt-n1">
        <div class="col-lg-12">
            Seleccione la entidad Financiera asociada a su Número telefónico - Cuenta SINPE MÓVIL:
        </div>
    </div>

    <div class="row w-100 mt-4">
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/bncr.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">BANCO NACIONAL</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://2627{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/bac.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">BAC</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://70701222{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/mutual_alajuela.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">MUTUAL ALAJUELA</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://70707079{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/bcr.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">BANCO DE COSTA RICA</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link"  href="sms://2276{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/lafise.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">BANCO LAFISE</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://9091{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>

    <div class="row w-100 mt-4 mb-4">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/promerica.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">BANCO PROMERICA</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://62232450{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/mucap.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">MUCAP</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://62229525{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/davivienda.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">DAVIVIENDA</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://70707474{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/caja_ande.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">CAJA DE ANDE</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://62229532{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <img src="{{ url('/img/imagenesBancos/sinpeMovil/coopealianza.png') }}" class="card-img-top stretched-link" alt="">
                <div class="card-footer bg-dark text-white text-center">
                    <small class="fw-bold">COOPEALIANZA</small>
                </div>
                @if($dispositivo == "movil")
                    <a class="stretched-link" href="sms://62229523{{ $separadorSMS }}body=pase {{ $monto }} 71091675 {{ $factura }}"></a>
                @else
                    <a class="stretched-link" href="{{ url('/files/pagoSinpeMovil/PagoSinpeMovil.pdf') }}" target="_blank"></a>
                @endif
            </div>
        </div>
        <div class="col-md-1">&nbsp;</div>
    </div>
</div>
