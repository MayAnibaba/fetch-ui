

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Transaction Details</h1>

<!-- Content Row -->
<div class="row">

    <div class="col-lg-6">

        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Info</h6>
            </div>
            <div class="card-body">
                <b>Transaction Ref:</b> <?=$transaction->transRef ?> <br>
                <b>Loan schedule Ref:</b> <?=$transaction->scheduleRef ?> <br>
                <b>Status:</b> <?=$transaction->status ?> <br>
                <b>Message:</b> <?=$transaction->message ?> <br>
                <b>Code:</b> <?=$transaction->code ?> <br>
                <b>Amount:</b> &#x20A6; <?= number_format($transaction->amount / 100, 2)?>  <br>
                <b>Data:</b> <code><?=$transaction->data ?></code> <br>
                <b>Created at:</b> <?=date('d M Y h:i:s', strtotime($transaction->createdAt)); ?> <br>
            </div>
        </div>

    </div>

</div>

</div>


<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->