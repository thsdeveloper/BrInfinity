@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h1>Relatório Anual</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <report-table :dados="{{$table}}"></report-table>
      </div>
      <div class="col-md-12">
        <report-brinfinty :dados="{{$retorno}}"></report-brinfinty>
      </div>
    </div>
  </div>
@endsection
