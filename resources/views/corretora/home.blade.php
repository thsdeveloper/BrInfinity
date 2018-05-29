@extends('layouts.app')
@section('title', 'Corretoras')
@section('content')
  <div class="container">
    <div class="row">
      <table-corretora :corretoras="{{$corretoras}}" :seguradoras="{{$seguradoras}}"><table-corretora/>
    </div>
  </div>
@endsection
