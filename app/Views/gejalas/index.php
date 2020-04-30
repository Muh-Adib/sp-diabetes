<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Gejala
                    <a href="<?php echo base_url('gejala/create'); ?>" class="btn btn-primary btn-sm float-right">Tambah</a>
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



                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($gejala) && is_array($gejala)) { ?>
                                <?php foreach ($gejala as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['kode']; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        
                                        <td><?= $row['created_at'] ?></td>
                                        <td>
                                            <a href="<?php echo base_url('gejala/edit/' . $row['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="<?php echo base_url('gejala/destroy/' . $row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('kamu yakin?');">Delete</a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">Data Gejala Kosong.</td>
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