@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-10">
              User
            </div>
            <div class="col-md-2">
              <a class="btn btn-primary" href="{{route('user.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>

            </div>
          </div>
        </div>

        <div class="card-body">


          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                  <th scope="col">Assign Cam.Tree</th>
                  <th scope="col" width='20%'>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($user as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->name ?? null}}</td>
                  <td>{{$value->email ?? null}}</td>
                  <td>{{$value->role==1?'Admin':'End User'}}</td>
                  <td align="center">@if($value->is_admin==0)<a class="btn btn-info" href="{{route('campaigntree.assign',$value->id)}}" ><i class="fa fa-trophy"></i></a>@endif</td>
                  <td>
                    <a class="btn btn-info" href="{{route('user.agreement',$value->id)}}" ><i class="fa fa-handshake-o" aria-hidden="true"></i></a>
                    <a class="btn btn-info" href="{{route('user.edit',$value->id)}}"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" onclick="return confirm('Are you want to sure delete ?')" href="{{route('user.delete',$value->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    @if($value->is_admin==0)
                    <form method="post" action="{{route('user.panel')}}" style="display: inline;">
                      @csrf
                      <input type="hidden" name="user_id" value="{{$value->id}}">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-forward" aria-hidden="true"></i></button>
                    </form>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6">No data available</td>
                </tr>
                @endforelse
                <tr>
                  <td colspan="6">{!! $user->links() !!}</td>
                </tr>
              </tbody>
            </table>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>
@endsection