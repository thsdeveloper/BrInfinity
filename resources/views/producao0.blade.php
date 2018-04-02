@extends('layouts.app')
@section('title', 'Produção')
@section('content')
  <?php $checkAdmin = Voyager::can('browse_admin'); ?>
  <div class="m-b-md">
    <div class="row">
      @if($checkAdmin)
        <div class="col-md-4">
          <div class="form-group">
            <label for="usr">Comercial:</label>
            <select id="select_user" class="form-control select-user" name="filter-user">
              <option value="todos">Todos</option>
              @foreach($brokers as $broker)
                <?php $pos = strpos($_SERVER['REQUEST_URI'], '/producao/'.$broker->users_id); ?>
                <option value="{{$broker->users_id}}" @if($pos > 0) selected @endif>{{$broker->users_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        @else
          <div class="col-md-4">
            <div class="form-group">
              <label for="usr">Corretores:</label>
              <select id="select_user" class="form-control select-user" name="filter-user" >
                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
              </select>
            </div>
          </div>
        @endif
        <div class="col-md-4">
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="usr">Pesquisar na Tabela:</label>
              <input class="form-control" id="myInput" type="text" placeholder="Digite a sua pesquisa..">
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

      <script>
      $(document).ready(function(){

        $( ".btn-intermediations" ).click(function() {
          var intermediations_id = $(this).attr( "intermediations_id" );
          $.get( "{{ url('/producao/intermediacao/') }}/"+intermediations_id )
          .done(function( data ) {
            console.log(data);
            $( "#myModal .modal-body" ).after( data );
          });
        });

        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#producao tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });

        $( ".select-date" ).change(function() {
          if($(this).val() != 'todos'){
            var url = "{{ url('/producao/') }}/"+$("#select_user").val()+"/periodo/"+$(this).val();
          }else{
            var url = "{{ url('/producao/') }}/"+$("#select_user").val();
          }
          window.location = url;
        });

        $( ".select-user" ).change(function() {
          if($(this).val() != 'todos'){
            var url = "{{ url('/producao/') }}/"+$(this).val();
          }else{
            var url = "{{ url('/producao/') }}";
          }
          window.location = url;
        });
      });
      </script>
    @stop
