@extends('layouts.app')

@section('content')
    <div class="display-4 text-center my-2 text-primary col-md-10 offset-1" style="background: transparent">
        New System
    </div>
    @if(session('fill'))
        <div class="col-md-6 offset-1  alert alert-danger mt-4">
            <strong>{{ session('fill') }}</strong>
        </div>
    @endif

    @if(session('error'))
        <div class="col-md-6 offset-1 alert alert-danger mt-4">
            <strong>{{ session('error') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{route('store-system')}}" class="mt-3 offset-1 col-md-10">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="name" class="col-sm-2 text-center col-form-label">Name: </label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" class="form-control  {{$errors->first('name') ? 'is-invalid' : ''}}">

                @if($errors->first('name'))
                    <div class="col-md-4 text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="url" class="col-sm-2 text-center col-form-label">URL: </label>
            <div class="col-sm-10">
                <input type="url" name="url" id="url" class="form-control {{$errors->first('url') ? 'is-invalid' : ''}}">
                
                @if($errors->first('url'))
                    <div class="col-md-4 text-danger">
                        <strong>{{ $errors->first('url') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="type" class="col-sm-2 text-center col-form-label">Type: </label>
            <div class="col-sm-10 form-group">
            
                <input type="radio" name="type" id="web" value="web" checked>
                <label for="web" class="col-sm-2 col-form-label">Web</label>

                <input type="radio" name="type" id="mobile" value="Mobile">  
                <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>

                <input type="radio" name="type" id="AR/VR" value="AR/VR">  
                <label for="AR/VR" class="col-sm-2 col-form-label">AR/VR</label>

                <input type="radio" name="type" id="TV" value="TV">  
                <label for="TV" class="col-sm-2 col-form-label">TV</label>

                @if($errors->first('type'))
                    <div class="col-md-4 text-danger">
                        <strong>{{ $errors->first('type') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="ftpserver" class="col-sm-2 text-center col-form-label">FTP Server: </label>
            <div class="col-sm-10">
                <input type="text" name="ftpserver" id="ftpserver" class="form-control {{$errors->first('ftpserver') ? 'is-invalid' : ''}}">

                @if($errors->first('ftpserver'))
                    <div class="col-md-4 text-danger">
                        <strong>{{ $errors->first('ftpserver') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="ftpdoor" class="col-sm-2 text-center col-form-label">FTP Door: </label>
            <div class="col-sm-10">
                <input type="number" name="ftpdoor" id="ftpdoor" value="21" class="form-control {{$errors->first('ftpdoor') ? 'is-invalid' : ''}}">

                @if($errors->first('ftpdoor'))
                    <div class="col-md-4 text-danger">
                        <strong>{{ $errors->first('ftpdoor') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="ftpuser" class="col-sm-2 text-center col-form-label">FTP User: </label>
            <div class="col-sm-10">
                <input type="text" name="ftpuser" id="ftpuser" class="form-control {{$errors->first('ftpuser') ? 'is-invalid' : ''}}">

                @if($errors->first('ftpuser'))
                    <div class="col-md-4 text-danger">
                        <strong>{{ $errors->first('ftpuser') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="ftppass" class="col-sm-2 text-center col-form-label">FTP Password: </label>
            <div class="col-sm-10">
                <input type="password" name="ftppass" id="ftppass" class="form-control {{$errors->first('ftppass') ? 'is-invalid' : ''}}">

                @if($errors->first('ftppass'))
                    <div class="col-md-4 text-danger">
                        <strong>{{ $errors->first('ftppass') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="ftpfolder" class="col-sm-2 text-center col-form-label">FTP Folder: </label>
            <div class="col-sm-10">
                <input type="text" name="ftpfolder" id="ftpfolder" class="form-control {{$errors->first('ftpfolder') ? 'is-invalid' : ''}}">

                @if($errors->first('ftpfolder'))
                    <div class="col-md-4 text-danger">
                        <strong>{{ $errors->first('ftpfolder') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" title="Save System Details" class="btn text-primary" style="background: transparent">
                <i class="fa fa-save fa-3x"></i>
            </button>
        </div>
    </form>
@endsection