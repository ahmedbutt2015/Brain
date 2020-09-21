@extends('layouts.app')
<?php
                                                
                                                $lan =  $familyaddons['system']['data'];
                                                  $lan = json_decode($lan);
                                                 
                                                   $cun =  $lan->currency;
                                                   
                                                  $lan = $lan->language;
                                                   
                                                 ?>
@section('content')
    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">

        @foreach($familyaddons['data'] as $family)
            @if($family['id'] == 1 || in_array(strtolower($family['name']),$familyaddons['activeNames']))
                <li class="nav-item">
                    <a class="nav-link " 
                    @if($family['id'] == 1)
                    id="general-tab"
                    @else
                    id="tab-{{ucfirst($family['name'])}}"
                    @endif
                     data-toggle="tab" href="#{{$family['name']}}" role="tab"
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

            <form action="{{route('edit-system-addon')}}" method="post">
            {{csrf_field()}}
                <input type="hidden" name="system_id" value="{{$system_id }}">
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
                                                        type="text" name="user_name_list" value="{{isset($system_data['user_name_list']) ? $system_data['user_name_list'] : ''}}"><span>and in a single way</span>
                                                <input type="text" name="user_name_single" value="{{isset($system_data['user_name_single']) ? $system_data['user_name_single'] : ''}}">
                                            @elseif($family['name']=="Interloctour")
                                                <span class="pl-3 ">How can I going call the other person?</span><input
                                                        type="text" value="{{isset($system_data['contact_name_list']) ? $system_data['contact_name_list'] : ''}}" name="contact_name_list">
                                                <span>and in a single way</span><input type="text"
                                                                                       name="contact_name_single"
                                                                                       value="{{isset($system_data['contact_name_single']) ? $system_data['contact_name_single'] : ''}}">
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
                                                            <input type="checkbox" class="custom-control-input getValue checkbox-{{ucfirst($family['name'])}}"
                                                                   name="addons[]" value="{{ $add['name']}}"
                                                                   id="{{$add['id']}}" {{in_array($add['id'],$familyaddons['active_addons'])?'checked':''}}>
                                                            <label class="custom-control-label" style="width:max-content"
                                                                   for="{{ $add['id']}}">{{ $add['name']}}</label><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if($family['name']=="User" )
                                            <div class="col-md-2" style="margin-left: -250px; margin-top: 5px">
                                            @if(in_array('multi-language',$familyaddons['activeNames']))

                                                <div class="form-group multi-language1">
                                                    <label for="sel1">Main Language:</label>
                                                    <select class="form-control" name="language" id="language" >
                                                        <option value="English" {{$lan==="English"?'selected':''}} >English</option>
                                                        <option value="Urdu" {{$lan==="Urdu"?'selected':''}}>Urdu</option>
                                                        <option value="post" {{$lan==="post"?'selected':''}}>Portuguese</option>
                                                        <option value="Arabic" {{$lan==="Arabic"?'selected':''}}>Arabic</option>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                @else
                                                <div class="form-group languageShow" style="display:none" >
                                                    <label for="sel1">Main Language:</label>
                                                    <select class="form-control" name="language">
                                                        <option value="English">English</option>
                                                        <option value="post">Portuguese</option>
                                                        <option value="Urdu">Urdu</option>
                                                        <option value="Arabic">Arabic</option>
                                                    </select>
                                                </div>

                                                @endif  
                                                @if(in_array('multi-currency',$familyaddons['activeNames']))
                                                <div class="form-group currencyshow1">
                                                    <label for="sel1">Main Currency:</label>
                                                    <select class="form-control" name="currency" id="currency">
                                                        <option value="Euro" {{$cun === "Euro"?'selected':''}}>Euro</option>
                                                        <option value="Dollar" {{$cun === "Dollar"?'selected':''}}>Dollar</option>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                @else
                                                <div class="form-group currencyshow" style="display:none">
                                                    <label for="sel1">Main Currency:</label>
                                                    <select class="form-control" name="currency">
                                                        <option value="Euro">Euro</option>
                                                        <option value="Dollar">Dollar</option>
                                                    </select>
                                                </div>
                                                @endif
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
    var active = <?php echo json_encode($familyaddons['activeNames']); ?>;
    console.log("data",data);
    console.log("active",active);
    $('.getValue').on('change', function() {
   var str = this.value;
   var [before, after] = str.split("for")
    var  after1 =  after.split("?");
    var name2=  after1[0].trim();
    console.log(str)
    console.log("aa",after1)
    console.log("bb",name2)
    
    if(name2 === "Multi-language"){
        console.log("dcssdvsdv");
    if(jQuery.inArray("multi-language",active) != -1){
        console.log("bbb",this.checked);
        if(this.checked){
        $(".multi-language1").toggle(this.checked).css('display','');}
        else{
            
            $(".multi-language1").toggle(this.checked).css('display','none');
        }
    }
    else{
        console.log("mmmm");
        $(".languageShow").toggle(this.checked);
    }
    }
    if(name2 === "Multi-currency"){
        console.log("dcssdvsdv");
    if(jQuery.inArray("multi-currency",active) != -1){
        console.log("bbb",this.checked);
        console.log("12");
        if(this.checked){
        $(".currencyshow1").toggle(this.checked).css('display','');}
        else{
            console.log("1");
            $(".currencyshow1").toggle(this.checked).css('display','none');
        }
    }
    else{
        console.log("mmmm");
        $(".currencyshow").toggle(this.checked);
    }
    }
    $("#tab-"+name2).toggle()
    $(".checkbox-"+name2).attr('checked',false)
    if("#tab-"+name2 === "#tab-User" && this.checked === false ){
        $("input[name=user_name_list]").val('');
        $("input[name=user_name_single]").val('');
        $("#language option[value='']").attr('selected', true);
        $("#currency option[value='']").attr('selected', true);
    }
    if("#tab-"+name2 === "#tab-Interloctour" && this.checked === false ){
        $("input[name=contact_name_list]").val('');
        $("input[name=contact_name_single]").val('');
    }

var data1 = <?php echo json_encode($familyaddons['data']); ?>;
});

function firstCap(str){
  var returnVar='';
  var strSplit=str.split(' ');
 for(var i=0;i<strSplit.length;i++){
 returnVar=returnVar+strSplit[i].substring(0,1).toUpperCase()+strSplit[i].substring(1).toLowerCase() +' ';
  }
return returnVar
}

});
</script>
<style>
    input {text-transform: capitalize;}
</style>
