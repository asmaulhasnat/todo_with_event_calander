<div class="row justify-content-center">
        <div class="col-md-12">
        <div class="form-group row">
            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

            <div class="col-md-6">
            	<input type="hidden" name="step" value="basic">
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror required" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

            <div class="col-md-6">
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror required" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

         <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

            <div class="col-md-6">
                <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror required" name="address" required autocomplete="address" autofocus>{{ old('address') }}</textarea>

                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
