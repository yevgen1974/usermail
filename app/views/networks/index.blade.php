@extends("default")
@section("content")


@if (isset($networks))



<ul>


@foreach ($networks as $ntw)
{
           <li>ID:{{$ntw->nid}}</li>
                  <br>
         <li>Name:{{$ntw->n_name}}</li>
                  <br>
         <li>IP Address:{{$ntw->n_ip}}</li>
                  <br>
          <li>Status:{{$ntw->n_status}}</li>
                  <br> 

}
@endforeach
   </ul>

 <ul>
@else
No any data in collection

@endif





@stop
