@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <a href="{{ URL::to('downloadReport/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
        <a href="{{ URL::to('downloadReport/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
        <a href="{{ URL::to('downloadReport/csv') }}"><button class="btn btn-success">Download Excel csv</button></a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h1>Relatório Mensal -</h1>
      </div>
    </div>
    <div class="row">
      <report-table-mensal :dados="{{$retorno}}" :seguradoras="{{$seguradoras}}"></report-table-mensal>
    </div>
  </div>
@endsection
