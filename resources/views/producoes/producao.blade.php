@extends('layouts.app')
@section('title', 'Produção')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <table-production :corretoras="{{$corretoras}}" :seguradoras="{{$seguradoras}}" :producoes="{{$producoes}}"></table-production>
    </div>
  </div>
@endsection
