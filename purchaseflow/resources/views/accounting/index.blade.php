@extends('management.layout')

@section('content')


<div>

    <div  class = 'row row-cols-2'>
    <div class="title">
            <h2>Purchase Requisition Headers</h2>
        </div>
  
        <div class="addCostcenter">
           
            <a href="{{route('welcome')}}" class="btn btn-primary" role = "button">main page</a>
        </div>
    </div>


@if ($message = Session::get('success'))
    <div>
        {{$message}}
    </div>
@endif

@if(Session::has('message'))

    <p class = "alert {{Session::get('alert-class','alert-info')}}">{{Session::get('message')}}</p>
@endif

@if(sizeof($purchases)>0) 
<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Issue date</th>
            <th>Delivery date</th>
            <th>Cost center</th>
            <th>Supplier</th>
            <th>User</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    
    @foreach($purchases as $purchase)
        <tr>
            <td>{{$purchase->id}}</td>
            <td>{{$purchase->issueDate}}</td>
            <td>{{$purchase->deliveryDate}}</td>
            <td>{{$purchase->costcenter}}</td>
            <td>{{$purchase->supplier}}</td>
            <td>{{$purchase->user}}</td>
            <td>{{$purchase->status}}</td>
   
            <td>
                <form action = "{{ route('accounting.promote',$purchase->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                 
                    <a href="{{ route('accounting.show',$purchase->id) }}" class="btn btn-success" role = "button">Show</a>
                  

                @csrf
                @method('PUT')
                <button type="submit" class = "btn btn-primary">Promote</button>
                </form>

            </td>
        </tr>
    @endforeach
    </table>
</div>

@else 
    <div >
         <p>Start create PR</p>
    </div>

</div>
@endif

@endsection