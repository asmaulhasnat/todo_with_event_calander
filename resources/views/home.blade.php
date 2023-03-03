@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Todo List
                        </div> 
                        <div class="col-md-2">
                            
                        </div>
                    </div>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Description</th>
                          <th scope="col">Date</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($all_appointment as $key=>$value)
                        <tr>
                          <td scope="col">{{$loop->iteration}}</td>
                          <td scope="col">{{$value->title ?? null}}</td>
                          <td scope="col">{{$value->descripton ?? null}}</td>
                          <td scope="col">{{$value->date_time ?? null}}</td>
                          <td scope="col">{{$value->status ?? null}}</td>
                          <td scope="col"><a class="btn btn-info" href="{{route('todo.edit',$value->id)}}"><i class="fa fa-edit"></i></a>  
                            <a class="btn btn-danger" href="{{route('todo.cancel',$value->id)}}" onclick="return confirm('Are you sure want to cancel ?')"><i class="fa fa-times"></i></a>  
                        </td>
                        </tr>
                        @empty
                        <tr>
                          <td colspan="8">No data available</td>
                        </tr>
                        @endforelse
                        <tr>
                          <td colspan="8">{!! $all_appointment->links() !!}</td>
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
