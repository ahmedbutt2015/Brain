@extends('layouts.app')

@section('content')
    <div class="display-4 text-center my-2 text-primary col-md-10 offset-1" style="background: transparent">
        Edit System
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


    <form method="POST" action="{{route('edit-store-system')}}" class="mt-3 offset-1 col-md-10">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$editSystem['id']}}" >
        <div class="form-group row">
            <label for="name" class="col-sm-2 text-center col-form-label">Name: </label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" class="form-control  {{$errors->first('name') ? 'is-invalid' : ''}}"
                value="{{$editSystem['name']}}" >

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
                <input type="url" name="url" id="url" class="form-control {{$errors->first('url') ? 'is-invalid' : ''}}"
                value="{{$editSystem['url']}}">
                
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
            
                <input type="radio" name="type" id="web" value="web" {{$editSystem['type']=="web"?'checked':''}}>
                <label for="web" class="col-sm-2 col-form-label">Web</label>

                <input type="radio" name="type" id="mobile" value="Mobile" {{$editSystem['type']=="Mobile"?'checked':''}}>  
                <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>

                <input type="radio" name="type" id="AR/VR" value="AR/VR" {{$editSystem['type']=="AR/VR"?'checked':''}}>  
                <label for="AR/VR" class="col-sm-2 col-form-label">AR/VR</label>

                <input type="radio" name="type" id="TV" value="TV" {{$editSystem['type']=="TV"?'checked':''}}>  
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
                <input type="text" name="ftpserver" id="ftpserver" class="form-control {{$errors->first('ftpserver') ? 'is-invalid' : ''}}"
                value="{{$editSystem['ftp_server']}}">

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
                <input type="number" name="ftpdoor" id="ftpdoor" value="21" class="form-control {{$errors->first('ftpdoor') ? 'is-invalid' : ''}}"
                value="{{$editSystem['ftp_door']}}">

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
                <input type="text" name="ftpuser" id="ftpuser" class="form-control {{$errors->first('ftpuser') ? 'is-invalid' : ''}}"
                value="{{$editSystem['ftp_username']}}">

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
                <input type="password" name="ftppass" id="ftppass" class="form-control {{$errors->first('ftppass') ? 'is-invalid' : ''}}"
                value="{{$editSystem['ftp_password']}}">

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
                <input type="text" name="ftpfolder" id="ftpfolder" class="form-control {{$errors->first('ftpfolder') ? 'is-invalid' : ''}}"
                value="{{$editSystem['ftp_folder']}}">

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