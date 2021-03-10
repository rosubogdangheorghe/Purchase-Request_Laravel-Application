@extends('purchaseheader.layout')

@section('content')

<div class = "container">
    <div class="title">
        <h2>Purchase requisition form</h2>
    </div>
    <div class="header">
        <a href="{{ route('purchaseheader.index') }}" class="btn btn-primary" role="button">Back</a>
    </div>

</div>

@if($errors->any())
<div>
    <p> <strong>Ops!</strong>There is some problems with your input</p>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
@if ($message = Session::get('success'))
    <div>
        {{$message}}
    </div>
@endif

@if(Session::has('message'))

    <p class = "alert {{Session::get('alert-class','alert-info')}}">{{Session::get('message')}}</p>
@endif


<form action="{{ route('purchaseheader.store') }}" method="POST" class="was-validated">

    @csrf

    <div class="form-group">
        <label for="issueDate" class="mb-2 mr-sm-2">Issue Date: </label>
        <input type="date" name="issueDate" class="form-control mb-2 mr-sm-2 w-25" placeholder="issueDate" id="issueDate" required>
        <label for="deliveryDate" class="mb-2 mr-sm-2">Delivery Date: </label>
        <input type="date" name="deliveryDate" class="form-control mb-2 mr-sm-2 w-25" placeholder="deliveryDate" id="deliveryDate" required>
        <label for="costcenters_id" class="mb-2 mr-sm-2">Cost center </label>
        <select name="costcenters_id" class="form-control mb-2 mr-sm-2 w-25" required>
            <option value="" selected disabled>Select Cost Center</option>
            @foreach($ccId as $cc)
            <option value="{{$cc->id}} ">{{$cc->id}}- {{$cc->code}} - {{$cc->description}}</option>

            @endforeach
        </select>

        <label for="suppliers_id" class="mb-2 mr-sm-4">Supplier: </label>
        <select name="suppliers_id" class="form-control mb-2 mr-sm-2 w-25" required>
            <option value="" selected disabled>Select Supplier</option>
            @foreach($suppId as $supplier)
            <option value="{{$supplier->id}} ">{{$supplier->id}}- {{$supplier->code}} - {{$supplier->description}}</option>

            @endforeach
        </select>
        <label for="users_id" class="mb-2 mr-sm-4">Requester :</label>
        <select name="users_id" class="form-control mb-2 mr-sm-2 w-25" required>
            <option value="" selected disabled>Purchase Requisition Autor</option>
            @foreach($userId as $user)
            <option value="{{$user->id}} ">{{$user->id}}- {{$user->firstName}} - {{$user->lastName}}</option>

            @endforeach
        </select>
        <label for="currency" class="mb-2 mr-sm-4">Currency:</label>
        <select name="currency" class="form-control mb-2 mr-sm-2 w-25" required>
            <option value="" selected disabled>Select Currency</option>
            @foreach($currencies as $currency)
            <option value="{{$currency}}">{{$currency}}</option>
            @endforeach
        </select>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Please fill out this field</div>

    </div>
    <button type="submit" class="btn btn-primary">Save PR header</button>

</form>

    <hr>
   
  
<script>
    function setTwoNumberDecimal() {
        this.value = parseFloat(this.value).toFixed(2);
    }

    function valueCalculation() {
        this.quantity = document.getElementById("quantity").value;
        this.unitPrice = document.getElementById("unitPrice").value;
        prvalue = (quantity * unitPrice).toFixed(2);

        document.getElementById('prvalue').value = prvalue;
    }
</script>
@endsection