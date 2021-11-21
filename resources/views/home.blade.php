@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('HW10') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <form id="newEvent" name="newEvent">


                                <div class="form-group">
                                    <label for="textEvent">Добавить новые события:</label>
                                    <textarea class="form-control" id="textEvent" rows="3"></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3">
                                        <button type="submit" class="form-control btn btn-success">Добавить</button>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#" class="form-control btn btn-secondary">Удалить все события</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div>
                            <form class="form-group" id="findEven" name="findEven">
                                <div class="form-group">
                                    <label for="findEvent">Подобрать подходящие событие:</label>
                                    <textarea class="form-control" id="findEvent" rows="3"></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3">
                                        <button type="submit" class="form-control btn btn-success">Подобрать
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#flash-overlay-modal').modal();
    </script>
@endsection
