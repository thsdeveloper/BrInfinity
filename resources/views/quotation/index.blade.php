@extends('layouts.app')

@section('content')
  <div class="container-fluid">

    <a href="{{ URL::to('downloadCotacao/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
    <a href="{{ URL::to('downloadCotacao/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
    <a href="{{ URL::to('downloadCotacao/csv') }}"><button class="btn btn-success">Download CSV</button></a>

    <quotation-brinfinty :cotacao="{{$quotations}}" :brokerage="{{$brokerage}}" :business="{{$business}}" :insurer="{{$insurer}}" :user="{{$user}}"></quotation-brinfinty>
  </div>
@endsection
