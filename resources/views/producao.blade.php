@extends('layouts.app')
@section('title', 'Produção')
@section('content')
  <div class="row">
    <div class="col-md-12">
      {{-- Atualização  {{dd($productions)}} --}}

      <table-production :productions="{{$productions}}"></table-production>
    </div>
  </div>
@endsection
