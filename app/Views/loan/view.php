

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Loan Details</h1>

<!-- Content Row -->
<div class="row">

    <div class="col-lg-6">

        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Info</h6>
            </div>
            <div class="card-body">
                <b>Loan Account Number:</b> <?=$loan->loanAccountNumber ?> <br>
                <b>Loan Ref:</b> <?=$loan->loanRef ?> <br>
                <b>Phone Number:</b> <?=$loan->phoneNumber ?> <br>
                <b>Email:</b> <?=$loan->email ?> <br>
                <b>Loan Amount:</b> <?= number_format($loan->loanAmount, 2)?> <br>
                <b>Repayment Instrument Type:</b> <?=$loan->repaymentInstrumentType ?> <br>
                <b>Repayment Instrument status:</b> <?=$loan->repaymentInstrumentStatus ?> <br>
                <b>Token:</b> <?=$loan->token ?> <br>
                <b>Token Expiry:</b> <?=$loan->tokenExpiry ?> <br>
                <b>Get Loan schedule:</b> <?=$loan->getLoanSchedule ?> <br>
                <b>Created at:</b> <?=date('d M Y h:i:s', strtotime($loan->createdAt)); ?> <br>
                <?php  if($loan->repaymentInstrumentStatus == 'Pending') {?>
                    <b>Repayment base:</b> <?php echo "http://172.105.152.82/public/index.php/getToken?id="+$loan->loanRef  ?> <br>
                <?php # } ?>
                <b>Cba Data:</b> <code><?=$loan->cbaData ?></code> <br>
            </div>
        </div>

    </div>

    <div class="col-lg-6">

        <!-- Roitation Utilities -->
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Repayment Info</h6>
            </div>
            <div class="card-body text-center">
                <div class="bg-primary text-white p-3 rotate-15 d-inline-block my-4">.rotate-15
                </div>
                <hr>
                <div class="bg-primary text-white p-3 rotate-n-15 d-inline-block my-4">.rotate-n-15
                </div>
            </div>
        </div>

    </div>

</div>

</div>


<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->