<div class="container-fluid">
   @guest
   @else
    @if(session('admin_id')!=null)


    <div class="text-center">
        <form method="post" action="{{route('user.panel')}}" style="display: inline;margin: bottom 5px;">
            @csrf
            <input type="hidden" name="user_id" value="{{session('admin_id')}}">
            <button type="submit" class="btn btn-primary">Back To My Panel <i class="fa fa-forward" aria-hidden="true"></i></button>
        </form>

    </div>
    <br>
    @endif
    @endguest
    @if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif



</div>