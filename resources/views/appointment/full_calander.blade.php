<!DOCTYPE html>
<html>

<head>
  @include('include.header')
</head>

<body>
  <div id="app">
    <div id="app">
      @include('include.navbar')
      <br>
      @include('include.common_success_error')
      @yield('content')
      </main>
    </div>
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" id="dynamic_form" role="document">
       
      </div>
    </div>

    <div attr_site_url="{{url('/')}}" id='calendar'></div>
  </div>

  @include('include.footer')
  <script src="{{asset('js/calender.js')}}"></script>
</body>

</html>