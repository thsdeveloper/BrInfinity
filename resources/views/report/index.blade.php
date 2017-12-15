@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <h1>Relatório anual</h1>
      </div>
      <div class="col-md-6">
        <report-brinfinty :dados="{{$retorno}}"></report-brinfinty>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <report-table :dados="{{$table}}"></report-table>
      </div>
    </div>
  </div>
@endsection
