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
                            <form id="addEven" name="addEven" action="addEven" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="textEvent">Добавить новые события:</label>
                                    <textarea class="form-control" id="textEvent" name="textEvent" rows="3"></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3">
                                        <button type="submit" class="form-control btn btn-success">Добавить</button>
                                    </div>
                                    <div class="col-auto">
                                        <a href="clear" class="form-control btn btn-secondary">Удалить все события</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div>
                            <form id="findEven" name="findEven" action="findEven" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="findEvent">Подобрать подходящие событие:</label>
                                    <textarea class="form-control" id="findEvent" rows="3" name="findEvent"></textarea>
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

            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Пример события:</div>

                    <div class="card-body">
                        [{"priority":1000,
                          "conditions":{ "param1":1},
                          "event":"event"
                         },
                         {"priority":2000,
                          "conditions":{
                          "param2":2
                         },
                          "event":"event2"
                         }
                        ]
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Пример поиска:</div>

                    <div class="card-body">
                        {
                        params: {
                        "param1" : 1,
                        "param2" : 2
                        }
                        }
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#flash-overlay-modal').modal();
    </script>
@endsection
