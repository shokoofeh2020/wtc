<div>
    @foreach($result as $item)
        {{\EasyRdf_Graph::newAndLoad($item->food->getUri())}}
        @php $x=explode('/',$item->food->getUri()) @endphp
        <li> <a href="{{$item->food->getUri()}}">{{end($x)}}</a> </li>
    @endforeach
</div>