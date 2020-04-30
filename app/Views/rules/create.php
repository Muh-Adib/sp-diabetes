<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?= $title ?>
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

                    <?= form_open('rule/store'); ?>
                    
                    <div class="form-group">
                        <label for="id_Penyakit">Kode Penyakit</label>
                        <select name="id_Penyakit" id="" class="form-control">
                            <?php foreach ($list_p as $key) {?>
                            <option value="<?= $key['id']?>"><?php echo $key['kode']." : ".$key['nama']?></option><?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_Gejala">Kode Gejala</label>
                        <select name="id_Gejala" id="" class="form-control">
                            <?php foreach ($list_g as $key) {?>
                            <option value="<?= $key['id']?>"><?php echo $key['kode']." : ".$key['nama']?></option><?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_Gejala">Belief</label>
                        <select name="cf" id="" class="form-control">
                            <?php for($i=0;$i<99;$i++) {?>
                            <option value="<?= 0,$i?>"><?php echo $i.'%'?></option><?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Save</button>
                        <a href="<?= base_url('rule') ?>" class="btn btn-link">Back</a>
                    </div>
                    <?= form_close(); ?>

                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Kode Penyakit</th>
                                <th scope="col">Kode Gejala</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($rule) && is_array($rule)) { ?>

                                <?php foreach ($list_p as $no){?>
                                <tr>
                                    <td>
                                        <?php echo $no['nama'] ?>
                                    </td>
                                    <td><?php  foreach($rule as $row){if ($row['id_Penyakit']==$no['id']) {
                                        foreach($list_g as $value){if ($value['id']==$row['id_Gejala']) {
                                        ?> <a href="<?php echo base_url('rule/destroy/' . $row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('kamu yakin akan hapus?');">
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



                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#penyakit_content').summernote({
            tabsize: 2,
            height: 500
        });
    })
</script>
<?= $this->endSection() ?>