@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">BR INFINITE - Serviço de Apoio a Corretores</div>

          <div class="panel-body">
            <a href="{{ URL::to('listaEmails/csv') }}"><button class="btn btn-success">Lista de E-mails</button></a>
            <a href="{{ URL::to('listaEmails/csv') }}"><button class="btn btn-success">Aniversariantes</button></a>
            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            <p>A BR Infinite é uma Assessoria de Seguros Multimarcas que nasceu para prestar atendimento comercial, técnico e operacional a todos os Corretores de Seguros do território Brasileiro. Estamos presentes no Mato Grosso, Mato Grosso do Sul e Distrito Federal</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
