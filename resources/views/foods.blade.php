{{--<div>--}}
        {{--@foreach($result as $item)--}}
                {{--{{dd(\EasyRdf_Graph::newAndLoad($item->food->getUri()))}}--}}
        {{--@endforeach--}}

{{--</div>--}}

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
<div class="row">
        @foreach($result as $item)
                @php $x=explode('/',$item->food->getUri()) @endphp
                <div class="col s12 m4 l3">
                        <div class="card small sticky-action">
                                <div class="card-image waves-effect waves-block waves-light">
                                        <img class="activator" src="images/food1.jpeg">
                                </div>
                                <div class="card-content">
                                        <span class="card-title activator grey-text text-darken-4">{{end($x)}}<i class="material-icons right">more_vert</i></span>
                                        <p><a href="{{$item->food->getUri()}}">Know more...</a></p>
                                </div>
                                <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                                        <p>Here is some more information about this product that is only revealed once clicked on.</p>
                                </div>
                        </div>
                </div>
        @endforeach
</div>
