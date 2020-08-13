@extends('layouts.app')
@section('content')

{{-- Family with addons--> commit--}}
    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
        @foreach($familyaddons['data'] as $family)
        <li class="nav-item">
            <a  class="nav-link {{$family['name']==="general"? 'active':''}}" id="general-tab" data-toggle="tab" href="#{{$family['name']}}" role="tab" aria-controls="home" aria-selected="true">{{ucfirst($family['name'])}}</a>
        </li>
        @endforeach

    </ul>

    <div class="tab-content" id="simpletabContent">


        @foreach($familyaddons['data'] as $family)
        <div class="tab-pane fade show {{$family['name']==="general"? 'active':''}}" id="{{$family['name']}}" role="tabpanel" aria-labelledby="general-tab">

            <form action="{{route('api-saveAddon')}}" method="post">

            @foreach($family['addons'] as $add)

          <div class="row">
              <div class="col-md-1">
                  <i class="fa fa-info-circle info-icon"></i>
              </div>
              <div class="col-md-6">



                  <div class="custom-control custom-switch">
                      @foreach($add['useraddons'] as $a)
                      <input type="checkbox" class="custom-control-input" name="addons[]" value="{{$add['id']}}" id="{{$add['id']}}" {{$a['addon_id']===$add['id']?'checked':''}}>
                      @endforeach
                      <label class="custom-control-label" for="{{$add['id']}}">{{$add['name']}}</label><br>
                  </div>
              </div>
              @if($family['name']=="user")
                 <div class="col-md-3">
                     <form action="{{route('api-language-currency')}}" method="post" >
                         {{csrf_field()}}
                         <div class="form-group">
                             <label>Main Language</label>
                             <select id="framework" name="language"  class="form-control" >
                                 <option value="Codeigniter">English</option>
                                 <option value="CakePHP">Urdu</option>
                                 <option value="Laravel">Arabic</option>
                             </select>
                         </div>
                         <div class="form-group">
                             <label>Main Currency</label>
                             <select id="framework" name="currency"  class="form-control" >
                                 <option value="Codeigniter">USD Dollar</option>
                                 <option value="CakePHP">Pkr</option>

                             </select>
                         </div>
                         <button type="submit">
                             <i class="fa fa-save save-icon"></i>
                         </button>
                     </form>
                 </div>
              @endif

          </div>

            @endforeach
                <div class="row">
                    <div class="col-md-12 mt-5 offset-md-2">
                        <button type="submit">
                            <i class="fa fa-save save-icon"></i>
                        </button>
                    </div>
                </div>
                </form>

        </div>
        @endforeach

    </div>

@endsection