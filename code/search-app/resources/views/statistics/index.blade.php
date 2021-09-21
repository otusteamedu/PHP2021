@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @include('statistics.blocks.form')
                    </div>
                </div>
            </div>
        </div>
        <div class="row"><div class="col col-sm-12">&nbsp;</div></div>
        <div class="card">
            <div class="card-header">
                Результат ({{ count($rows) ?? '' }})
            </div>
            <div class="card-body">
                @include('statistics.blocks.result')
            </div>
        </div>
    </div>
@endsection
