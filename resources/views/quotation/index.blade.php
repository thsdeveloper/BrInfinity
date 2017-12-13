@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <quotation-brinfinty :cotacao="{{$quotations}}" :brokerage="{{$brokerage}}" :business="{{$business}}" :insurer="{{$insurer}}" :user="{{$user}}"></quotation-brinfinty>
  </div>
@endsection
