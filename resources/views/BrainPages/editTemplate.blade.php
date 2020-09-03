@extends('layouts.app')

@section('content')
    <div class="display-4 text-center my-2 text-primary col-md-10 offset-1" style="background: transparent">
        Templates
    </div>
    @if($errors->first('template'))
        <div class="alert alert-danger text-center mt-3" role="alert">
            <strong>"Please Select a template"</strong>
        </div>
    @endif

   
    <form action="{{route('api-edit-store-template')}}" method="POST">
        {{ csrf_field() }}
        <div class="col-md-9 offset-1">
            <div class="card-deck my-2">
                <div class="card" >
                    <div class="card-header">
                        <img src="{{asset('img/template1.png')}}" width="100%" alt="" style="height: 100px">
                    </div>
                    <div class="form-group text-center card-body rounded rounded m-0">
                        <input type="radio" id="template1" name="template" value="template1" {{$editSystem['template']=="template1"?'checked':''}}>
                        <label for="template1" class="col-form-label">Template 1</label>
                    </div>
                </div>
        
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset('img/template2.png')}}" width="100%" alt="">
                    </div>
                    <div class="form-group text-center card-body rounded m-0">
                        <input type="radio" id="template2" name="template" value="template2" {{$editSystem['template']=="template2"?'checked':''}}>
                        <label for="template2" class="col-form-label">Template 2</label>
                    </div>
                </div>
        
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset('img/template3.png')}}" width="100%" alt="">
                    </div>
                    <div class="form-group text-center card-body rounded m-0">
                        <input type="radio" id="template3" name="template" value="template3" {{$editSystem['template']=="template3"?'checked':''}}>
                        <label for="template3" class="col-form-label">Template 3</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            {{-- <a href="" class="btn text-primary"><i class="fa fa-save fa-2x"></i></a> --}}
            <button onclick="sta()" class="btn text-primary" type="submit" title="Publish System" style="background: transparent"><i class="fa fa-cloud fa-2x"></i></button>
        </div>
    </form>

    
@endsection