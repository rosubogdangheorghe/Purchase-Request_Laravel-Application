@extends('purchaseheader.layout')

@section('content')


<div>

    <div  class = "container">
    <div class="title">
            <h2>Purchase Requisition Headers</h2>
        </div>
  
        <div class="header">
            <a href="{{route('purchaseheader.create')}}" class="btn btn-primary" role = "button">Add Purchase Requisition</a>
            <a href="{{route('welcome')}}" class="btn btn-primary" role = "button">Main page</a>
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
    <div class= "container">
        <tr>
            <td>{{$purchase->id}}</td>
            <td>{{$purchase->issueDate}}</td>
            <td>{{$purchase->deliveryDate}}</td>
            <td>{{$purchase->costcenter}}</td>
            <td>{{$purchase->supplier}}</td>
            <td>{{$purchase->user}}</td>
            <td>{{$purchase->status}}</td>
   
            <td>
               
                <form action = "{{ route('purchaseheader.promote',$purchase->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                        <a href= "{{ route('purchaseheader.edit',$purchase->id) }}" class = "btn btn-warning btn-sm" role = "button" id="edit-pr-header">Edit PR Header</a>
                        <a href="{{ route('purchaseheader.show',$purchase->id) }}" class="btn btn-success btn-sm" role = "button" id="show-pr">Show</a>
                        <a href="{{ route('purchasebody.createPrLine',$purchase->id) }}" class="btn btn-primary btn-sm" role = "button" id="input-pr-lines">Input PR lines</a>

                    @csrf
                    @method('PUT')
                    <button type="submit" class = "btn btn-danger btn-sm" id="promote-pr">Promote</button>
                </form>
                </div>
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