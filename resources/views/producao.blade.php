@extends('layouts.app')
@section('title', 'Produção')
@section('content')
  <div class="row">
    <div class="col-md-12">

      <table class="table">
        <thead>
          <tr>
            <th>CORRETORAS</th>
            <th>Seguradoras</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($corretoras as $c)
            <tr>
              <th>{{$c->name}}</th>
              <td>{{$c->getTotalValor()}}</td>
            </tr>
          @endforeach
        </tbody>

      </table>

      {{-- <table-production :corretoras="{{$corretoras}}"></table-production> --}}
    </div>
  </div>
@endsection
