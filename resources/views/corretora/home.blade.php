@extends('layouts.app')
@section('title', 'Corretoras')
@section('content')
  <div class="container">
    <div class="row">
      <table-corretora :data="{{$data}}" :users="{{$users}}" :seguradoras="{{$seguradoras}}"><table-corretora/>
    </div>
  </div>
@endsection
