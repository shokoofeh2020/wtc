<!-- {{--<div>--}} -->
<!--         {{--@foreach($result as $item)--}} -->
<!--                 {{--{{dd(\EasyRdf_Graph::newAndLoad($item->subjectName->getUri()))}}--}} -->
<!--         {{--@endforeach--}} -->

<!-- {{--</div>--}} -->

<style>
        .card {
                text-align: center;
        }

        @media (max-width: 990px) {
                .resizeimg {
                        height: auto;
                }
        }

        @media (min-width: 1000px) {
                .resizeimg {
                        width: auto;
                        height: 350px;
                }
        }
</style>

@if (empty($result1))
	<center> {{"Oops! No food found, please try something else!"}} </center>
@endif
<div class="row">
        @foreach($result1 as $item)
        		@php 
        			
        			if (strlen($item->subjectName->getValue())> 20){
        		   		$foodname =substr($item->subjectName->getValue(),0,17);
        		   		$foodname=$foodname."...";
        			}
        			$foodabstract = substr($item->abstract->getValue(),0,200);
        			$foodabstract = $foodabstract."...";
        		@endphp
                <div class="col s12 m4 l3">
                        <div class="card small sticky-action">
                                <div class="card-image waves-effect waves-block waves-light">
                                        <img class="activator" src="{{$item->img->getValue()}}" height =150 width =100%>
                                </div>
                                <div class="card-content">
                                        <span style="font-size: 14px;" class="card-title activator grey-text text-darken-4">{{$foodname}}<i class="material-icons right">more_vert</i></span>
                                        <p><a href="{{$item->links->getUri()}}" target="_blank">Know more...</a></p>
                                </div>
                                <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
                                        <p>{{$foodabstract}}</p>
                                        <p><a href="{{$item->links->getUri()}}" target="_blank">Know more...</a></p>
                                </div>
                        </div>
                </div>
        @endforeach
</div>
@if (empty($result2))
	<center> {{"Oops! No food found, please try something else!"}} </center>
@endif
<div class="row">
        @foreach($result2 as $item)
        		@php 
        			
        			if (strlen($item->subject->getUri())> 20){
        		   		$foodname =substr($item->subject->getUri(),0,17);
        		   		$foodname=$foodname."...";
        			}
        			
        			$foodabstract = "Abstract of food comes here.";
        		@endphp
                <div class="col s12 m4 l3">
                        <div class="card small sticky-action">
                                <div class="card-image waves-effect waves-block waves-light">
                                        <img class="activator" src="{{$item->img->getUri()}}" height =150 width =100%>
                                </div>
                                <div class="card-content">
                                        <span style="font-size: 14px;" class="card-title activator grey-text text-darken-4">{{$foodname}}<i class="material-icons right">more_vert</i></span>
                                        <p><a href="{{$item->links->getUri()}}" target="_blank">Know more...</a></p>
                                </div>
                                <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
                                        <p>{{$foodabstract}}</p>
                                        <p><a href="{{$item->links->getUri()}}" target="_blank">Know more...</a></p>
                                </div>
                        </div>
                </div>
        @endforeach
</div>
