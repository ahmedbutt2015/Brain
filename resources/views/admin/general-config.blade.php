@extends('layouts.app')
@section('content')

    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
        @foreach($familyaddons['data'] as $family)
        <li class="nav-item">
            <a class="nav-link {{$family['name']==="general"? 'active':''}}" id="general-tab" data-toggle="tab" href="#{{$family['name']}}" role="tab" aria-controls="home" aria-selected="true">{{ucfirst($family['name'])}}</a>
        </li>
        @endforeach

    </ul>
    <div class="tab-content" id="simpletabContent">
        @foreach($familyaddons['data'] as $family)
        <div class="tab-pane fade show {{$family['name']==="general"? 'active':''}}" id="{{$family['name']}}" role="tabpanel" aria-labelledby="general-tab">
            @foreach($family['addons'] as $add)
          <div class="row">
              <div class="col-md-1">
                  <i class="fa fa-info-circle info-icon"></i>
              </div>
              <div class="col-md-1">
                  {{--<i class="fa fa-toggle-on toggle-icon"></i>--}}
                  <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="customSwitches">
                      <label class="custom-control-label" for="customSwitches">Do</label><br>
                      </div>
              </div>
              <div class="col-md-8">
                  <p>{{$add['name']}}</p>
              </div>
          </div>
            @endforeach
        </div>
        @endforeach

    </div>
@endsection