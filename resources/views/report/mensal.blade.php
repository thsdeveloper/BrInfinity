@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h1>Relatório Mensal</h1>
      </div>
    </div>
    <div class="row">
      <report-table-mensal :dados="{{$retorno}}" :seguradoras="{{$seguradoras}}"></report-table-mensal>
    </div>
  </div>
@endsection
