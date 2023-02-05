<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User management</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Last login</th>
                                    <th>Created </th>
                                    <th>Last updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <?php if (count($users) > 10) {?>
                            <tfoot>
                            <tr>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Last login</th>
                                    <th>Created </th>
                                    <th>Last updated</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <?php } ?>
                            <tbody>

                            <?php
                            for ($i = 0; count($users) > $i; $i++) {?>
                                <tr>
                                    <td><?= $users[$i]->email?></td>
                                    <td><?php if($users[$i]->isActive == '1') { echo 'Active';} else {echo 'Inactive';}?></td>
                                    <td><?= $users[$i]->lastLogin?></td>
                                    <td><?= $users[$i]->createdAt?></td>
                                    <td><?= $users[$i]->updatedAt?></td>
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

</div>
<!-- /.container-fluid -->
