@component('mail::message',['emailData' => $emailData])
# Introduction

You have Purchase Requisition to treat.
Please go to Purchase flow to check it.<br>
Purchase Request Number : {{ $emailData[0]->purchaseheaders_id }}<br>
Issue date : {{ $emailData[0]->issueDate }}<br>
Status:{{ $emailData[0]->status }} by accounting <br>
Initiator : {{ $emailData[0]->user }}<br>

@component('mail::button', ['url' => 'http://localhost/02_Proiecte/roki_pr/purchaseflow/public/','color'=>'green'])
Purchase flow
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
