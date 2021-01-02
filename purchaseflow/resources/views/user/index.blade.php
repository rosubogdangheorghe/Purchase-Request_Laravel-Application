@extends('user.layout')

@section('content')


<div>

    <div  class = 'row row-cols-2'>
    <div class="title">
            <h2>Users List</h2>
        </div>
  
        <div class="addCostcenter">
            <a href="{{route('user.create')}}" class="btn btn-primary" role = "button">Add User</a>
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

@if(sizeof($user)>0) 
<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>UserName</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    
    @foreach($user as $us)
        <tr>
            <td>{{$us->id}}</td>
            <td>{{$us->username}}</td>
            <td>{{$us->firstname}}</td>
            <td>{{$us->lastname}}</td>
            <td>{{$us->email}}</td>
            <td>
                <form action = "{{ route('user.destroy',$us->id) }}" method="POST">
                    <a href="{{ route('user.show',$us->id) }}" class="btn btn-success" role = "button">Show</a>
                    <a href="{{ route('user.edit',$us->id) }}" class="btn btn-primary" role = "button">Edit</a>
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
         <p>Start adding users to dataBase</p>
    </div>

</div>
@endif

@endsection