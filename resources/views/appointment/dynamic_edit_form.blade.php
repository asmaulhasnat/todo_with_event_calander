<style type="text/css">
    
    .hide_field{
        display:none;

    }
</style>


<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">{{$appointment->title }}  <br>
        <i class="fa fa-envelope" aria-hidden="true"></i>
        
    </h5>


    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <p></p>
  </div>
  <div class="modal-body">
    <div>
    <hr>
    <br>

    @if($appointment)
    <form method="POST" action="{{ route('todo.update',$appointment->id) }}" >
        @csrf
        <input type="hidden" name="cal" value="yes">

                            <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $appointment->title }}" required autocomplete="name" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" name="last_name" required >{{ $appointment->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ $appointment->status }}" required>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                                
                        

                       

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Date</label>
                            <div class="col-md-6">
                                <input id="date"  type="text" class="form-control @error('date_time') is-invalid @enderror" name="date_time" required placeholder="YYYY-MM-DD" value="{{$appointment->date_time}}" autocomplete="off">
                                @error('date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

        <div class="form-group row">
        <label for="note" class="col-md-4 col-form-label text-md-right">End user Note</label>

        <div class="col-md-6">
            <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ $appointment->note ?? null }}" autocomplete="note">{{ $appointment->note?? null}}</textarea>

            @error('note')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        </div>
       
       
        <div class="form-group row mb-0">
            <div class="col-md-2 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>

            <div class="col-md-2">
                <a  class="btn btn-danger" href="{{route('todo.cancel',['id'=>$appointment->id,'cancel_cal'=>1])}}" onclick="return confirm('Are you sure want to remove ?')">
                    Remove
                </a>
            </div>
        </div>
        

        
    </form>

    @endif

    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
  </div>
</div>