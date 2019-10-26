@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <passport-clients></passport-clients> {{-- create clients --}}
            <passport-authorized-clients></passport-authorized-clients> {{-- see authorized clients and revoke access --}}
            <passport-personal-access-tokens></passport-personal-access-tokens> {{-- generate access tokens --}}
        </div>
    </div>
</div>
@endsection
