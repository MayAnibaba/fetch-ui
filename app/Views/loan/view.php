

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
                <b>Loan Amount:</b> &#x20A6; <?= number_format($loan->loanAmount, 2)?> <br>
                <b>Repayment Instrument Type:</b> <?=$loan->repaymentInstrumentType ?> <br>
                <b>Repayment Instrument status:</b> <?=$loan->repaymentInstrumentStatus ?> <br>
                <b>Token:</b> <?=$loan->token ?> <br>
                <b>Token Expiry:</b> <?=$loan->tokenExpiry ?> <br>
                <b>Get Loan schedule:</b> <?=$loan->getLoanSchedule ?> <br>
                <b>Created at:</b> <?=date('d M Y h:i:s', strtotime($loan->createdAt)); ?> <br>
                <?php  if($loan->repaymentInstrumentStatus == 'pending') {?>
                    <b>Repayment base:</b> <a href='<?php echo "http://172.105.152.82/public/index.php/getToken?id=" . $loan->loanRef  ?>' target='_blank'><?php echo "http://172.105.152.82/public/index.php/getToken?id=" . $loan->loanRef  ?> </a><br>
                <?php  } ?>
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Due date</th>
                            <th>Due Amount</th>
                            <th>Collection status</th>
                            <th>Collected Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php if (count($loanSchedules) > 10) {?>
                        <tfoot>
                            <tr>
                                <th>Due date</th>
                                <th>Due Amount</th>
                                <th>Collection status</th>
                                <th>Collected Amount</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    <?php } ?>
                     
           
                    <tbody>

                    <?php
                     for ($i = 0; count($loanSchedules) > $i; $i++) {
                        $transdate = strtotime($loanSchedules[$i]->dueDate);
                        ?>
                        <tr>
                            <td><?= date('d M Y h:i:s', $transdate);?></td>
                            <td>&#x20A6; <?= number_format($loanSchedules[$i]->dueAmount,2)?></td>
                            <td><?= $loanSchedules[$i]->collectionStatus?></td>
                            <td><?= $loanSchedules[$i]->collectedAmount?></td>
                            <td></td>
                        </tr>
                    <?php  } ?>
                       
                    </tbody>
                </table>
            </div>
            </div>
        </div>

    </div>

</div>

</div>


<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->