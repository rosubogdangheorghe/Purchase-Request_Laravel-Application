@extends('pdf.layout')

@section('content')
<style>
#pr-title{
color:black;}

#company {
position: relative;
float: right;}

table, tr, th, td {
text-align: center;
font-size: 10px;
word-wrap: wrap auto;
border: 2px solid black;
}
#number {width: 100px;}
.date {width: 200px;}
#supplier {width: 400px;}
#currency {width: 100px;}
.line {border: 2px solid black;}
#line-number, #unit-measure {width: 50px;}
#description {width: 350px;}
#accounting {width:100px;}
</style>

<div>

    <div> 
        <div id = "company">
            <h2>Roki Romania Manufacturing SRL</h2>
          
        </div>
         <div id="pr-title">
            <h2>Purchase Requisition</h2>
         </div>
       
    </div>
    <div>
        <table class="table table-hover">
            <thead class = "thead-light">
                <tr class = "pr-header">
                    <th  id="number">Number</th>
                    <th  class = "date">Issue date</th>
                    <th  class = "date">Delivery date</th>
                    <th  colspan = "3">Cost center</th>
            </tr>
            </thead>
            <tbody>
                <tr class = "pr-header">
                    <th >{{$purchaseHeaderById[0]->purchaseheaders_id}}</th>
                    <td >{{$purchaseHeaderById[0]->issueDate}}</td>
                    <td >{{$purchaseHeaderById[0]->deliveryDate}}</td>
                    <td  colspan = "3">{{$purchaseHeaderById[0]->Costcenter}}</td>
                </tr>
            </tbody>
            
             <thead class = "thead-light">
                <tr class = "pr-header">
                    <th  colspan = "3" id = "supplier">Supplier</th>
                    <th  id = "currency">Currency</th>
                    <th  id = "user">User</th>
                    <th  id = "status">Status</th>
                
                </tr>
            </thead>
            <tbody>
          <tr class = "pr-header">
                <td  colspan = "3">{{$purchaseHeaderById[0]->Supplier}}</td>
                <td >{{$purchaseHeaderById[0]->currency}}</td>
                <td >{{$purchaseHeaderById[0]->user}}</td>
                <td >{{$purchaseHeaderById[0]->status}}</td>
            
            </tr>
            </tbody>
            </table>
            <hr class="line">

        <table class="table table-hover">
            <thead class = "thead-light">
        <tr class = "prbody">
            <th class = "align-middle" id = "line-number">Line Number</th>
            <th class = "align-middle" id = "description">Description</th>
            <th class = "align-middle" id = "unit-measure">Unit Measure</th>
            <th class = "align-middle">Quantity</th>
            <th class = "align-middle">Unit price</th>
            <th class = "align-middle">Value</th>
            <th class = "align-middle" id = "accounting">Accounting Division check</th>
            <th class = "align-middle">Budget Line</th>
            

        </tr>
        </thead>
            <?php $i = 0; $total = 0;?>
            @foreach($purchaseHeaderById as $prLine)
            <?php $i++;?>     
            <tbody>

            <tr>
           
                <th class = "align-middle"><?php echo $i; ?></th>
                <td class = "align-middle">{{ $prLine->description }}</td>
                <td class = "align-middle">{{ $prLine->unitMeasure }}</td>
                <td class = "align-middle">{{ $prLine->quantity }}</td>
                <td class = "align-middle">{{ $prLine->unitPrice }}</td>
                <td class = "align-middle">{{ number_format($prLine->prvalue,2,',','.') }}</td>
                <td class = "align-middle">{{ $prLine->budgeted }}</td>
                <td class = "align-middle">{{ $prLine->budgetLine }}</td>
                <?php  $total = $total + $prLine->prvalue; ?>
          
            </tr>
            </tbody>
            @endforeach
            <tr>
                
            <th colspan = "5" class = "align-middle">Total</th>
            <th  class = "align-middle"> {{number_format($total,2,',','.')}} </th>
            <th colspan = "2"  class = "align-middle"></th>

            </tr>
        </table>

    
    </div>

       <div>
            <!-- <a href="{{ route('purchaseheader.show',$purchaseHeaderById[0]->purchaseheaders_id) }}" class="btn btn-primary" role = "button">Back to Purchase requisition</a> -->
            <!-- <a class="btn btn-primary" href="{{route('pdf.show',$purchaseHeaderById[0]->purchaseheaders_id) }}">Export to PDF</a> -->
        </div>
    
        <script type="text/php">
    if (isset($pdf)) {
        $x = 350;
        $y = 550;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 14;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
</div>

@endsection