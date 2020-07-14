<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Rule
                    <a href="<?php echo base_url('rule/create'); ?>" class="btn btn-primary btn-sm float-right">Tambah</a>
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
                                <th scope="col">Penyakit</th>
                                <th scope="col">Kode Gejala</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php if (!empty($rule) && is_array($rule)) { ?>

                                <?php foreach ($listPenyakit as $no){?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $no['nama'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?php  foreach($rule as $row)
                                        {if ($row['id_penyakit']==$no['id']) {
                                            foreach($listGejala as $value)
                                            {if ($value['id']==$row['id_gejala']) {
                                                ?> <a href="<?php echo base_url('rule/edit/' . $row['id']); ?>" class="btn btn-primary btn-sm">
                                        <?php 
                                            echo $value['kode'];
                                        ?></a> <?php } }
                                    }}  ?></td>
                                </tr>
                                <?php } ?>
                                
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">Data Rule Kosong.</td>
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