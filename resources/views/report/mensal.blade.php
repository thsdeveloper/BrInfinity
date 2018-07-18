@extends('layouts.app')
@section('title', 'Relatório mensal')
@section('content')
  <div class="container">
    <div class="row">
      <relatorio-mensal :table="{{$table}}"></relatorio-mensal>
    </div>
  </div>
@endsection
