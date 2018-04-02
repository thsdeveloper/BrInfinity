@extends('layouts.app')
@section('title', 'Cotações')
@section('content')
    <quotation-brinfinty :cotacoes="{{$cotacoes}}" :corretoras="{{$corretoras}}" :seguradoras="{{$seguradoras}}" :user="{{$user}}"></quotation-brinfinty>
@endsection
