@extends('layouts.app')
@section('title', 'Usuários')
@section('content')
<table-users :users="{{$users}}"></table-users>
@endsection
