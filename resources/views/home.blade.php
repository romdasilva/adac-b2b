<html>

<body>
  <div class="col-xs-2 col-md-3 pfc">
    <div class=" header-logo">
      <div class="logo-wrap">
        <a href="https://demo.b2b-fahrsicherheit.de/"><img src="https://demo.b2b-fahrsicherheit.de/styles/adac/pages/img/adac-logo.svg" alt="Startseite" title="Startseite"></a>
      </div>
    </div>
  </div>


  <form action="{{route('result')}}" method="POST">
    @csrf
    </br>
    </br>
    <div class="form-group">

      <select class="form-control" name="screenshot_id">
        @foreach($screenshots as $screenshot)
        <option value="{{$screenshot}}">{{$screenshot}}</option>
        @endforeach
      </select>

      <button type="submit" name="action" value='download'>Download</button>

    </div>

    <!-- fields -->
    @foreach ($dirs as $dir)
    <button type="submit" name="action" value={{$dir}}>{{$dir}}</button>
    @endforeach



</body>

</html>