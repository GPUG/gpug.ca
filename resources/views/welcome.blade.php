@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-md-12 text-center">
        <h1 class="slack-callout">Join our slack <img src="/img/slack_rgb.png" class="img-responsive"/> channel!</h1>
     </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="/slack-invite" method="post">
            {!! csrf_field() !!}
            <div class="input-group input-group-lg">
                <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Email" aria-label="Email to invite">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-lg">Join</button>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection
