@extends('layouts.app', ['page_name' => 'View Systems'])

@section('content')
    <div class="display-4 text-center my-2 text-primary col-md-10 offset-1" style="background: transparent">
        <a href="{{route('new-system')}}"><i class="fa fa-plus pull-left" style="font-size:48px;color:green"></i></a>
        View Systems
    </div>
    
    @if(session('success'))
        <div class="alert alert-danger mt-4">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    <div class="tab-content col-md-10 offset-1">
        <div class="tab-pane fade show active" id="system">
            <table class="table mt-2 table-bordered">
                <thead class="thead-light text-center">
                    <tr>
                    <th scope="col">System Name</th>
                    <th scope="col">URL</th>
                    <th scope="col">Type</th>
                    <th scope="col">Template</th>
                    <th scope="col">General Config</th>
                    </tr>
                </thead>
                <tbody>
                        @if (isset($customers))
                            @if (count($customers) > 0)
                                @foreach ($customers as $customer)
                                @if($loop->last)
                                {{ session()->put('lastSystem',$customer)}}
                                 @endif
                                    <tr class="text-center">
                                        <td>{{$customer['name']}}</td>
                                        <td>
                                            <a href="{{$customer['url']}}">
                                                {{$customer['url']}}
                                            </a>
                                        </td>
                                        <td>{{$customer['type']}}</td>
                                        <td>{{$customer['template']}}</td>
                                        <td><a href="{{url('edit-system/'.$customer['id'])}}">Edit</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    
                                </tr>
                            @endif
                        @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
        