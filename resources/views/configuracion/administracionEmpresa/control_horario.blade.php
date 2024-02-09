@section('page-content')
      <form class="mt-lg-3" autocomplete="off" method="POST" action="{{route('administracionEmpresa.update',[Crypt::encrypt(session()->get('id_cliente'))])}}">
            @csrf
            @method('PUT')
            <input type="text" name="tipoForm" value="Control de horario" hidden/>
          <input type="text" name="tab" value="controlHorario-tab" hidden/>
            <div class="alert alert-secondary bgc-secondary-l4 brc-secondary-l2 text-dark-tp2" role="alert">
                <h5 class="alert-heading text-primary-d1 font-bolder">
                    Alerta de mensaje </h5>
                M&oacute;dulo de
                <b>control de horario</b> en construcci&oacute;n
            </div>
        </form>
@endsection
