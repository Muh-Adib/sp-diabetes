<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Rule
                    <a href="<?= base_url('diagnosis/create'); ?>" class="btn btn-primary btn-sm float-right">Tambah</a>
                </div>
                <div class="card-body">

                    <?php if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <?php if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php } ?>

                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nama Penyakit</th>
                                <th scope="col">Kode Gejala</th>
                                <th scope="col">Valid(%)</th>
                                <th scope="col">Create At</th>
                                <th scope="col">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($diagnosis) && is_array($diagnosis)) { ?>

                                <?php foreach ($diagnosis as $row){?>
                                <tr>
                                        <td> 
                                         <?php foreach ($penyakit as $key) {
                                            if($row['id_penyakit']==$key['id']){echo $key['nama']; }
                                        }?>
                                        </td>
                                        <td><?= $row['list_gejala']; ?></td>
                                        <td><?= $row['cf']; ?></td>
                                        <td><?= $row['created_at']; ?></td>
                                        <td><a href="<?php echo base_url('penyakit/edit/' . $row['id']); ?>" class="btn btn-primary btn-sm">Detail</a></td>
                                </tr>
                                <?php } ?>
                                
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">Data Diagnosis belum ada.</td>
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