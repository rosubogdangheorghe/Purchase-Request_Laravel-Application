@extends('costcenter.layout')

@section('content')



<div>
    <div class = 'row row-cols-2'>
        <div class="title">
            <h2>Cost Center List</h2>
        </div>
        <div class="addCostcenter">
            <a href="{{route('costcenter.create')}}" class="btn btn-primary" role = "button">Add Cost Center</a>
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

@if(sizeof($costcenter)>0) 
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
    
    @foreach($costcenter as $cc)
        <tr>
            <td>{{$cc->id}}</td>
            <td>{{$cc->code}}</td>
            <td>{{$cc->description}}</td>
            <td>{{$cc->created_at}}</td>
            <td>{{$cc->updated_at}}</td>
            <td>
                <form action = "{{ route('costcenter.destroy',$cc->id) }}" method="POST">
                    <a href="{{ route('costcenter.show',$cc->id) }}" class="btn btn-success" role = "button">Show</a>
                    <a href="{{ route('costcenter.edit',$cc->id) }}" class="btn btn-primary" role = "button">Edit</a>

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
         <p>Start adding costcenters to dataBase</p>
    </div>

</div>
@endif

@endsection