

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Loan Details</h1>

<!-- Content Row -->
<div class="row">

    <div class="col-lg-6">

        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add new loan</h6>
            </div>
            <div class="card-body">
                <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-warning">
                            <?= session()->getFlashdata('msg') ?>
                        </div>
                <?php endif;?>
                <form class="user" action="<?php echo base_url(); ?>/do_create_loan" method="POST">
                    <label>Customer email</label>
                    <input type="text" class="form-control" type="email" required><br/>
                    <label>Customer phone number</label>
                    <input type="text" class="form-control" type="number" required><br/>
                    <label>Bankone Loan account number</label>
                    <input type="text" class="form-control" type="number" required><br/><br/>
                    <input type="submit" class="btn btn-primary"><br/>
                </form>
            </div>
        </div>

    </div>

</div>

</div>


<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
