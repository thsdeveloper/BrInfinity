@extends('layouts.app')
@section('title', 'Producao')
@section('content')
  @foreach ($data as $item)
    {{$item->users_name}},
    {{$item->brokerages_name}},
    {{$item->insurers_name}},
    <br>
  @endforeach
@stop
