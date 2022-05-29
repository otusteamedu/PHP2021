@extends('layouts.app')
@section('content')
    <?php /** @var \App\Models\Youtubechannel $youtubechannel */ ?>
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">
                    {{ $youtubechannel->name }} ({{ $youtubechannelViews }})
                </h1>
                <p class="lead">
                    <div>
                        @foreach ($youtubechannel->videos as $video)
                            <span class="badge badge-light">{{ $video}}</span>
                        @endforeach
                    </div>
                </p>
            </div>
        </div>
    </div>
@stop
