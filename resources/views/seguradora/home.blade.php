@extends('layouts.app')
@section('title', 'Seguradoras')
@section('content')
  <div class="container">
    <div class="row">
      <table-seguradora :data="{{$data}}"><table-seguradora/>
    </div>
  </div>
@endsection
