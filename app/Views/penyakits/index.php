<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Penyakit
                    <a href="<?php echo base_url('penyakit/create'); ?>" class="btn btn-primary btn-sm float-right">Tambah</a>
                </div>
                <div class="card-body">

                    <?php if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <?php if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-danger">
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php } ?>

                    <table class="table table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <!-- <th scope="col">Action</th> -->
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($penyakits) && is_array($penyakits)) { ?>
                                <?php foreach ($penyakits as $row) { ?>
                                    
                                    <tr  onclick="window.location='<?php echo base_url('penyakit/edit/' . $row['id']); ?>'";>
                                    
                                        <td><?php echo $row['kode']; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <!-- <td class="d-flex">
                                            <a href="<?php /* echo base_url('penyakit/edit/' . $row['id']); */ ?>" class="btn btn-primary btn-sm mr-2">Edit</a>
                                            <a href="<?php /* echo base_url('penyakit/destroy/' . $row['id']); */ ?>" class="btn btn-danger btn-sm" onclick="return confirm('kamu yakin?');">Delete</a>
                                        </td> -->
                                    
                                    </tr>
                                    

                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">Data Penyakit Kosong.</td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <?= $pager->links(); ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    $(document).ready(function() {
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
    })
</script>
<?= $this->endSection() ?>