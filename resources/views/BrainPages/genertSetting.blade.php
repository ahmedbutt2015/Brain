@extends('layouts.app')
@section('content')
<?php 

$active = ['general'];

?>
    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">

        @foreach($familyaddons['data'] as $family)
            @if($family['id'] == 1 || in_array(strtolower($family['name']),$active))
                <li class="nav-item">
                    <a class="nav-link " id="general-tab" data-toggle="tab" href="#{{$family['name']}}" role="tab"
                       aria-controls="home" aria-selected="true">{{ucfirst($family['name'])}}</a>
                </li>
            @else
            <li class="nav-item" style="display:none"  id="tab-{{ucfirst($family['name'])}}">
                    <a class="nav-link "  data-toggle="tab" href="#{{$family['name']}}" role="tab"
                       aria-controls="home" aria-selected="true">{{ucfirst($family['name'])}}</a>
            </li>
            @endif
        @endforeach
    </ul>
    <div class="row">
        <div class="col-md-12">

            <form action="{{route('store-system-addon')}}" method="post">
            {{csrf_field()}}
                <div class="row">
                    <div class="col-md-10">
                        <div class="tab-content" id="simpletabContent">

                            @foreach($familyaddons['data'] as $family)

                                <div class="tab-pane fade show {{$family['name']==="general"? 'active':''}}"
                                     id="{{$family['name']}}" role="tabpanel" aria-labelledby="general-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if($family['name']=="User")
                                                <span class="pl-3 ">How can I going call a list of users?</span><input
                                                        type="text" name="user_name_list" value=""><span>and in a single way</span>
                                                <input type="text" name="user_name_single" value="">
                                            @elseif($family['name']=="Interloctour")
                                                <span class="pl-3 ">How can I going call the other person?</span><input
                                                        type="text" value="" name="contact_name_list">
                                                <span>and in a single way</span><input type="text"
                                                                                       name="contact_name_single"
                                                                                       value="">
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-10">
                                            @foreach($family['addons'] as $add)
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <i class="fa fa-info-circle info-icon"></i>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input getValue"
                                                                   name="addons[]" value="{{ $add['name']}}"
                                                                   id="{{$add['id']}}" {{in_array($add['id'],$active)?'checked':''}}>
                                                            <label class="custom-control-label" style="width:max-content"
                                                                   for="{{ $add['id']}}">{{ $add['name']}}</label><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if($family['name']=="User" )
                                            <div class="col-md-2" style="margin-left: -250px; margin-top: 5px">

                                                
                                                <div class="form-group languageShow" style="display:none" >
                                                    <label for="sel1">Main Language:</label>
                                                    <select class="form-control" name="language">
                                                        <option value="English">English</option>
                                                        <option value="Urdu">Urdu</option>
                                                        <option value="post">Portuguese</option>
                                                        <option value="Arabic">Arabic</option>
                                                    </select>
                                                </div>
                                                

                                                <div class="form-group currencyshow" style="display:none">
                                                    <label for="sel1">Main Currency:</label>
                                                    <select class="form-control" name="currency">
                                                        <option value="Euro">Euro</option>
                                                        <option value="Dollar">Dollar</option>
                                                    </select>
                                                </div>

                                            </div>
                                        @endif

                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 mt-5 offset-md-2">
                                            <button type="submit">
                                                <i class="fa fa-save save-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>


                </div>

            </form>
        </div>


    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$( document ).ready(function() {
    var data = <?php echo json_encode($familyaddons['data']); ?>;
    console.log("data",data);
    $('.getValue').on('change', function() {
   var str = this.value;
   var [before, after] = str.split("for")
    var  after1 =  after.split("?");
    var name2=  after1[0].trim();
        if(name2 === "Multi-language" ){
        $(".languageShow").toggle(this.checked);
    }
    if(name2 === "Multi-currency"){
        $(".currencyshow").toggle(this.checked);
    }
    $("#tab-"+name2).toggle()
var data1 = <?php echo json_encode($familyaddons['data']); ?>;
});
$('#save_value').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
        console.log("val",val);
      });


});
</script>
