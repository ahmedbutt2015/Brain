@extends('layouts.app', ['page_name' => 'View Systems'])

@section('content')
    <div class="display-4 text-center my-2 text-primary col-md-10 offset-1" style="background: transparent">
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
                    <th scope="col">Customer Name</th>
                    <th scope="col">System Name</th>
                    <th scope="col">URL</th>
                    <th scope="col">Type</th>
                    <th scope="col">Template</th>
                    </tr>
                </thead>
                <tbody>
                        @if (isset($customers))
                            @if (count($customers) > 0)
                                @foreach ($customers as $customer)
                                    <tr class="text-center">
                                        <th scope="row">{{$customer['id']}}</th>
                                        <td>{{$customer['name']}}</td>
                                        <td>
                                            <a href="{{$customer['url']}}">
                                                {{$customer['url']}}
                                            </a>
                                        </td>
                                        <td>{{$customer['type']}}</td>
                                        <td>{{$customer['template']}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5" class="text-center">
                                        No Customer added yet! <br>
                                        <a href="{{url('/new-system')}}" class="btn btn-primary mt-2">Add a Customer</a>
                                    </th>
                                </tr>
                            @endif
                        @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
        