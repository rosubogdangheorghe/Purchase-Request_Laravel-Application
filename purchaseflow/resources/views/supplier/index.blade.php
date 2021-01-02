@extends('supplier.layout')

@section('content')


<div>

    <div  class = 'row row-cols-2'>
    <div class="title">
            <h2>Suppliers List</h2>
        </div>
  
        <div class="addCostcenter">
            <a href="{{route('supplier.create')}}" class="btn btn-primary" role = "button">Add Supplier</a>
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

@if(sizeof($supplier)>0) 
<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Description</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
    
    @foreach($supplier as $sup)
        <tr>
            <td>{{$sup->id}}</td>
            <td>{{$sup->code}}</td>
            <td>{{$sup->description}}</td>
            <td>{{$sup->created_at}}</td>
            <td>{{$sup->updated_at}}</td>
            <td>
                <form action = "{{ route('supplier.destroy',$sup->id) }}" method="POST">
                    <a href="{{ route('supplier.show',$sup->id) }}" class="btn btn-success" role = "button">Show</a>
                    <a href="{{ route('supplier.edit',$sup->id) }}" class="btn btn-primary" role = "button">Edit</a>

                @csrf
                @method('DELETE')
                <button type="submit" class = "btn btn-danger">Delete</button>
                </form>

            </td>
        </tr>
    @endforeach
    </table>
</div>

@else 
    <div >
         <p>Start adding suppliers to dataBase</p>
    </div>

</div>
@endif

@endsection