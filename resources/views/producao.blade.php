@extends('layouts.app')
@section('title', 'Produção')
@section('content')
  <div class="row">
    <div class="col-md-12">

      <table class="table">
        <thead>
          <tr>
            <th>CORRETORAS</th>
            @foreach ($seguradoras as $key => $s)
              <th>{{$s->name}}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($corretoras as $c)
            <tr>
              <th>{{$c->name}}</th>
              {{-- @foreach ($seguradoras->producoes as $p)
                <td>{{$p->getTotalValor($c->id, $s->id)}}</td>
              @endforeach --}}
            </tr>
          @endforeach
        </tbody>
      </table>
      {{-- <table-production :corretoras="{{$corretoras}}"></table-production> --}}
    </div>
  </div>
@endsection
