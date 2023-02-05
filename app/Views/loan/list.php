

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Loans</h6>
            
        </div>
        
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Loan Ac. Number</th>
                            <th>Loan Ref</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Loan Amount</th>
                            <th>Repay. Inst. Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Loan Ac. Number</th>
                            <th>Loan Ref</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Loan Amount</th>
                            <th>Repay. Inst. Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    <?php
                    for ($i = 0; count($loans) > $i; $i++) {
                        $loandate = strtotime($loans[$i]->createdAt);
                        ?>
                        <tr>
                            <td><?= $loans[$i]->loanAccountNumber?></td>
                            <td><?= $loans[$i]->loanRef?></td>
                            <td><?= $loans[$i]->phoneNumber?></td>
                            <td><?= $loans[$i]->email?></td>
                            <td><?= $loans[$i]->loanAmount?></td>
                            <td><?= $loans[$i]->repaymentInstrumentStatus?></td>
                            <td><?= date('d M Y h:i:s', $loandate);?></td>
                            <td><a href="#" title="edit" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="#" title="delete" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
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