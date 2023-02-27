@extends('layouts.app')

@section('title')
    Registration
@endsection

@section('js')
    @parent
    <script type="text/javascript" src="/js/pages/reg.js"></script>
    <script type="text/javascript">
        let submit_url = '{{ route('registration.submit') }}';
    </script>
@endsection

@section('content')

    <form id="reg">
        {!! csrf_field() !!}
        <h3>Please register</h3>

        <div id="errors" class="p-3 text-Danger-emphasis bg-primary-subtle border border-primary-subtle rounded-3"></div>

        <div id="form">
            <div>
                <div>Name</div>
                <div><input type="text" name="name" /></div>
            </div>
            <div>
                <div>Last Name</div>
                <div><input type="text" name="last_name" /></div>
            </div>
            <div>
                <div>Email</div>
                <div><input type="email" name="email" /></div>
            </div>
            <div>
                <div>Password</div>
                <div><input type="password" name="password" /></div>
            </div>
            <div>
                <div>Confirm password</div>
                <div><input type="password" name="password_confirmation" /></div>
            </div>
            <div>
                <div></div>
                <div><input type="button" value="Registration" onclick="send_data()" /></div>
            </div>
        </div>

    </form>
@endsection
