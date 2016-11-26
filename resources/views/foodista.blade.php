@extends('layouts.basic')

@section('title')
    WTC
@stop

@section('CSS')
	<!--  General fonts -->
	<style>
		.Logo {
			text-align: center;
			font-size : 30px;
			font-family : 'Tahoma';
		}
	</style>
    <!-- Styles Autocomplete-->
    <style>
        .autocomplete {
            display: -ms-flexbox;
            display: flex;
        }
        .autocomplete .ac-users {
            padding-top: 10px;
        }
        .autocomplete .ac-users .chip {
            -ms-flex: auto;
            flex: auto;
            margin-bottom: 10px;
            margin-right: 10px;
        }
        .autocomplete .ac-users .chip:last-child {
            margin-right: 5px;
        }
        .autocomplete .ac-dropdown .ac-hover {
            background: #eee;
        }
        .autocomplete .ac-input {
            -ms-flex: 1;
            flex: 1;
            min-width: 150px;
            padding-top: 0.6rem;
        }
        .autocomplete .ac-input input {
            height: 2.4rem;
        }
    </style>
@stop

@section('content')
    <div class="container">
		<div class="jumbotron" class="Logo">
			<h2>What To Cook </h2>
			<img src=images/Logo.jpg height =150px, width = 100%/>
			<p></p>
		</div>

		<div class="row">
			<div class="col s5 m5 l5">
				<p> What do you have in hand?</p>
               {{--input box for getting favorite ingredients--}}
               <div id="ingrediants" class="chips chips-placeholder" ></div>
			</div>
		    <div class="col s5 m5 l5">
               <p> What do you want to be not included?</p>
               {{--input box for getting dislikes--}}
               <div id="pleaseNo" class="chips chips-placeholder" ></div>
			</div>
		    <div class="col s2 m2 l2">
		    <p> Type of food?</p>
               {{--select meal--}}
               <select id="meal" class="input-field ">
                   <option value="None" disabled selected>Choose your option</option>
                   <option value="Vegan">Vegan</option>
                   <option value="Seafood">Seafood</option>
                   <option value="Soups">Soups</option>
                   <option value="Meats">Meats</option>
                   <option value="Pasta">Pasta</option>
               </select>
               <label>Select your meal:</label>
		    </div>
		</div>
	
        <a class="btn-floating btn waves-effect waves-light red" onclick="$(this).searchFood();">
            <i class="material-icons">search</i>
        </a>

        <label class="active" for="multipleInput">Search recipes </label>

        <div id="food">
            <div id="extracting"></div>
        </div>


    </div>

@stop

@section('js-footer')
    <script type="application/javascript">
		//favorite ingredients
		var ings = new Array();
		//do not like ingredients
		var ingsNo = new Array();
        $(document).ready(function(){
            //initializing Select
            $('select').material_select();
           //initializing Chips and setting placeholders
            $('#ingrediants').material_chip({
               //placeholder: 'I like',
               secondaryPlaceholder: '+Like',
            });
            $('#pleaseNo').material_chip({
                //placeholder: 'I hate',
                secondaryPlaceholder: '+Dislike',
            });
        });

        // Adding Favorite Ingredients
        $('#ingrediants').on('chip.add', function(e, chip){
            // you have the added chip here
            //add to ingrediant list
            ings.push(chip.tag);
            //console.log(ings.length);
            //console.log(chip.tag);
        });
        $('#ingrediants').on('chip.delete', function(e, chip){
            // you have the deleted chip here
            //remove from array
            ings = jQuery.grep(ings, function(value) {
                return value != chip.tag;
            });
            //console.log(ings);
        });

     // Adding what I do not like
        $('#pleaseNo').on('chip.add', function(e, chip){
            // you have the added chip here
            //add to pleaseNo list
            ingsNo.push(chip.tag);
            //console.log(ings.length);
            console.log(chip.tag);
        });
        $('#pleaseNo').on('chip.delete', function(e, chip){
            // you have the deleted chip here
            //remove from array
            ingsNo = jQuery.grep(ingsNo, function(value) {
                return value != chip.tag;
            });
            //console.log(ings);
        });

        ////search based on what I like and what I do not like
        $.fn.searchFood = function() {
            //console.log(ings);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            $.ajax({
            	data:{likes:ings,dislikes:ingsNo,catmeal:$('#meal').val()},
                url: "{{URL::route('searchF')}}",
                method: "POST",
                async: true,
                beforeSend: function(){
//                  showing preloader, materializecss
                    $("#food").html("<div> </div>");
                    $('#extracting').html(
                            '<div class="preloader-wrapper big active">'+
                            '<div class="spinner-layer spinner-red">'+
                            '<div class="circle-clipper left">'+
                            '<div class="circle"></div>'+
                            '</div><div class="gap-patch">'+
                            '<div class="circle"></div>'+
                            '</div><div class="circle-clipper right">'+
                              '<div class="circle"></div>'+
                            '</div>'+
                          '</div>'
                    );
                },
                success: function(response){
                    //alert(action);
                    //console.log(response);
                    $("#moreFood").remove();
                    $("#food").html(response);

                    response.forEach(function(item) {
                        // do something with `item`
                        console.log(item);

                    });//response
                }//success
            });//ajax
        }

    </script>
@stop
