@extends('layouts.app')
@section('title', 'Producao')
@section('content')
  <?php $checkAdmin = Voyager::can('browse_admin'); ?>
  <div class="m-b-md">
    <div class="row">
      @if($checkAdmin)
        <div class="col-md-3">
          <div class="form-group">
            <label for="usr">Corretores:</label>
            <select id="select_user" class="form-control select-user" name="filter-user" >
              <option value="todos">Todos</option>
              @foreach($brokers as $broker)
                <?php $pos = strpos($_SERVER['REQUEST_URI'], '/producao/'.$broker->users_id); ?>
                <option value="{{$broker->users_id}}" @if($pos > 0) selected @endif>{{$broker->users_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        @else
          <div class="col-md-3">
            <div class="form-group">
              <label for="usr">Corretores:</label>
              <select id="select_user" class="form-control select-user" name="filter-user" >
                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
              </select>
            </div>
          </div>
        @endif
        <div class="col-md-2">
          <div class="form-group">
            <label for="usr">Periodo:</label>
            <select id="select_date" class="form-control select-date" name="filter-date" >
              <option value="todos">Todos</option>
              @foreach($dates as $date)
                <?php
                $new_date = explode('-',$date->productivities_data);
                $pos = strpos($_SERVER['REQUEST_URI'], $new_date[0].'/'.$new_date[1]);
                ?>
                <option value="{{$new_date[0]}}/{{$new_date[1]}}" @if($pos > 0) selected @endif>{{$new_date[1]}}/{{$new_date[0]}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="usr">Pesquisar na Tabela:</label>
              <input class="form-control" id="myInput" type="text" placeholder="Search..">
            </div>
          </div>
        </div>
        @if($errors=='')

          <table class="table">
            <thead>
              <tr>
                <th scope="col">Corretoras</th>
                @foreach($insurers as $key => $insurer)
                  <th scope="col">{{$key}}</th>
                @endforeach
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody id="producao">
              @foreach($producao as $key => $items)
                <tr>
                  <th scope="row">{{$key}}</th>
                  <?php $total = 0; ?>
                  @foreach($items as $keyitems => $value)
                    <td>
                      <table-producao intermediations="{{$value[1]}}" valor="{{$value[0]}}"></table-producao>
                    </td>
                    <?php $total = $total+$value[0]; ?>
                  @endforeach
                  <td>{{$total}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p>{{$errors}}</p>
        @endif
      </div>

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Produção</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
    @stop
