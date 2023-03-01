

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Trans Ref</th>
                            <th>Schedule Ref</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Amount</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php if (count($transactions) > 10) {?>
                        <tfoot>
                    <tr>
                            <th>Trans Ref</th>
                            <th>Schedule Ref</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Amount</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <?php } ?>
                    
                    <tbody>

                    <?php
                    for ($i = 0; count($transactions) > $i; $i++) {
                        
                        $transdate = strtotime($transactions[$i]->createdAt);
                        
                        ?>
                        <tr>
                            <td><?= $transactions[$i]->transRef?></td>
                            <td><?= $transactions[$i]->scheduleRef?></td>
                            <td><?= $transactions[$i]->status?></td>
                            <td><?= $transactions[$i]->message?></td>
                            <td>&#x20A6; <?= number_format($transactions[$i]->amount / 100, 2)?></td>
                            <td><?= date('d M Y h:i:s', $transdate);?></td>
                            <td><a href="#" title="edit" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
                        </tr>
                    <?php  } ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->