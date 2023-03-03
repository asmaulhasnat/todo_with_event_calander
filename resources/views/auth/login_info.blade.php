
    <div class="row justify-content-center">
    	<div class="col-md-12">

    		<div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">User Name</label>

            <div class="col-md-6">
            	<input type="hidden" name="step" value='login'>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror required" name="name" value="{{ old('name') }}" required autocomplete="name">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            @if(env('ADMIN_RESI_KEY')==$admin)
            <input type="hidden" value="{{env('ADMIN_RESI_KEY')}}" name="is_admin">
            @endif
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror required email" name="email" value="{{ old('email') }}" required >

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

       

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror required" name="password" required>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="confirm" type="password" class="form-control required" name="confirm"  required>
            </div>
        </div>
    		
    	</div>
        


    </div>



