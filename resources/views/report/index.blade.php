@extends('layouts.app')
@section('title', 'Relatório anual')
@section('content-fluid')
  <div class="row">
    <div class="col-md-12">
      <relatorio-anual :table="{{$table}}"></relatorio-anual>
    </div>
  </div>
@endsection
