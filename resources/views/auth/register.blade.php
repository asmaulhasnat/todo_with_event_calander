@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="my-form" method="post">
                        @csrf
                        <div>
                            <h3>Basic Information</h3>
                            <section>
                                @include('auth.basic_information')
                            </section>
                            <h3>Login Information</h3>
                            <section>
                                @include('auth.login_info')
                            </section>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/signup.js')}}"></script>
@endsection
