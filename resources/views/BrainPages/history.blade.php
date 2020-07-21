@extends('layouts.app')

@section('content')
    <div class="display-4 text-center my-2 text-primary col-md-10 offset-1" style="background: transparent">
        History
    </div>
    
    <div class="offset-1">
        <div class="col-md-11 mt-2">
            @if (isset($histories))
                @if(count($histories) > 0)
                    @foreach ($histories as $history)
                        <div class="">
                            <div class="">
                                <strong>{{$history['title']}}</strong>
                            </div>
                            <div class="pl-4">
                                {{$history['description']}}
                            </div>
                            <div class="pl-4">
                                <small><strong>Created At: {{$history['created_at']}}</strong></small>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <h3 class="text-center">
                        <strong>No History!</strong>
                    </h3>
                @endif
            @endif
        </div>
    </div>
@endsection