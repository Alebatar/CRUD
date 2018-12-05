<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @yield('css')
    <style>
      body{
        background-image: url("img/background.jpg");
      }
      h1{
        text-align: center;
        color: white;
      }
      thead{
        background-color: white;
      }
      table{
        color: black;
      }
      .tab_légende{
        margin-left: 5%;
        border-collapse: collapse;
      }
      .tab_légende td{
        padding: 6px;
      }
      .legend{
        background-color: white;
        width: 200px;
        text-align: center;
        margin-left: 45%;
      }
      .form-group{
        display:inline-block;
      }
    </style>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $('#dialog-form').hide();
            $('#update-modal').hide();
            $('.btn-primary').click(function(){
              	var options = {
              			modal: true,
              			height:300,
              			width:500
              		};
                value = this.value;
                url_update = '{{ $url_update }}';
                url = url_update.substring(url_update.lastIndexOf("/"), 0) + '/' + value;
              	$('#update-modal').load(url).dialog(options).dialog('open');
            });
            $('.btn-danger').click(function(){
              	if(confirm('Voulez vous supprimer cet animal ?'))
                {
                  url_delete = '{{ $url_delete }}';
                  url = url_delete.substring(url_delete.lastIndexOf("/"), 0)
                  window.location.href = url + '/' + this.value;
                }
              });
            var dialog;
            dialog = $( "#dialog-form" ).dialog({
                autoOpen: false,
                height: 350,
                width: 400,
                modal: true,
            });
            $('.btn-success').click(function(){
              dialog.dialog( "open" );
            });
        })
    </script>
</head>
<body>
  <h1>{{ config('app.name') }}</h1>
  <div class="container">
    <button type="button" class="btn btn-success">Ajouter</button>
    <br><br>
    <table class="table">
      <thead>
        <tr>
          <th>Nom</th><th>Description</th><th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($animals as $animal)
          @if ($animal->getType()->getId() == 1)
            <tr style="background-color: #8afcb0;">
          @elseif ($animal->getType()->getId() == 2)
            <tr style="background-color: #fcee69;">
          @elseif ($animal->getType()->getId() == 3)
            <tr style="background-color: #69fcea;">
          @endif
              <td>{{ $animal->getName() }}</td>
              @if ($animal->getType()->getId() == 1)
                <td>{{ $animal->hiss() }}</td>
              @elseif ($animal->getType()->getId() == 2)
                <td>{{ $animal->growl() }}</td>
              @elseif ($animal->getType()->getId() == 3)
                <td>{{ $animal->tweet() }}</td>
              @endif
              <td>
                <button type="button" class="btn btn-primary" value='{{ $animal->getId() }}'>Modifier</button>
                <button type="button" class="btn btn-danger" value='{{ $animal->getId() }}'>Supprimer</button>
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    <button type="button" class="btn btn-success">Ajouter</button>
  </div>
  <div class="legend">
      <h2>Légende</h2>
      <table class="tab_légende">
        <tr>
          <td style="background-color: #8afcb0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Reptile</td>
        </tr>
        <tr>
          <td style="background-color: #fcee69;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Mammifère</td>
        </tr>
        <tr>
          <td style="background-color: #69fcea;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Oiseau</td>
        </tr>
      </table>
      <br>
  </div>
  <div id="dialog-form" title="Insert Animal">
    <p class="validateTips">All form fields are required.</p>
      {!! form($form) !!}
  </div>
  <div id="update-modal" title="Update Animal"></div>
  @yield('content')
  </body>
</html>
