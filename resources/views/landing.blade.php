@extends('layouts.basic')

@section('title')
    WTC
@stop

@section('CSS')
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

    <style>
        body {  padding: 3em; }
    </style>
@stop

@section('content')
    <div class="container">
       <div class="row">
           <div class="col s10 m10 l10">
               <div class="chips chips-placeholder" >
               </div>
           </div>
           <div class="col s2 m2 l2">
               <a class="btn-floating btn waves-effect waves-light red" onclick="$(this).searchFood();">
                   <i class="material-icons">search</i>
               </a>
           </div>
       </div>

        <label class="active" for="multipleInput">Multiple autocomplete: </label>
        <div class="autocomplete" id="multiple">
            <div class="ac-users"></div>
            <div class="ac-input">
                <input type="text" id="multipleInput" placeholder="Please input some letters" data-activates="multipleDropdown" data-beloworigin="true" autocomplete="off">
            </div>
            <ul id="multipleDropdown" class="dropdown-content ac-dropdown"></ul>
            <input type="hidden" name="multipleHidden" />
        </div>

        <div id="food">
            <div id="extracting"></div>
        </div>
    </div>
@stop

@section('js-footer')
    <script type="application/javascript">
        var ings = new Array();
        $(document).ready(function(){
            $('.chips').material_chip({
                placeholder: 'Enter an ingrediant',
                secondaryPlaceholder: '+Ingrediant',
            });
        });

        $('.chips-placeholder').on('chip.add', function(e, chip){
            // you have the added chip here
            //add to ingrediant list
            ings.push(chip.tag);
            console.log(ings.length);
            console.log(chip.tag);
        });

        $('.chips').on('chip.delete', function(e, chip){
            // you have the deleted chip here
            //remove from array
            ings = jQuery.grep(ings, function(value) {
                return value != chip.tag;
            });
            console.log(ings);
        });

        //all food containing ingrediants
        $.fn.searchFood = function() {
            //console.log(ings);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            $.ajax({
                data:{sings:ings},
                url: "{{URL::route('searchFood')}}",
                method: "POST",
                async: true,
                beforeSend: function(){
                    $('#extracting').html("<img src='{{URL::to('/images/ajax-loader.gif')}}' />");
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

        //ingrediants
        $.fn.searchIngs = function() {
            //console.log(ings);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            $.ajax({
                data:{sings:ings},
                url: "",
                method: "POST",
                async: true,
                beforeSend: function(){
                    $('#moreFood').html("<img src='{{URL::to('/images/ajax-loader.gif')}}' />");
                },
                success: function(response){
                    //alert(action);
                    //console.log(response);
                    $("#moreFood").remove();

                    response.forEach(function(item) {
                        // do something with `item`
                        console.log(item);

                    });//response
                }//success
            });//ajax
        }

    </script>

    {{--autocomplete--}}
    <!-- JS file for easyautocomplete -->
    <script src="js/jquery.materialize-autocomplete.js"></script>
    <script>
        //var ings = new Array();
        $(function () {
            var multiple = $('#multipleInput').materialize_autocomplete({
                multiple: {
                    enable: true,
                    onAppend : function (item) {
                        console.log(item);
                        ings.push(item);
                        console.log(ings.length);
                    },
                    onRemove : function (item) {
                        console.log(item);
                        //remove from array
                    }

                },
                appender: {
                    el: '.ac-users'
                },
                dropdown: {
                    el: '#multipleDropdown'
                },
                ignoreCase: true,
                cacheable: true,
                getData: function (value, callback) {
                    // ...
                    callback(value, [{ 'id': '1', 'text': 'omid' }, { 'id': '2', 'text': 'lappeenranta'},{ 'id': '3', 'text': 'helsinki'}]);
                }

            });

            console.log(multiple.value);
        });
    </script>
@stop
