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

                    <?php echo form_open('penyakit/store');
                     echo form_hidden('id', $id);
                     ?>
                   
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" value="<?php echo $penyakit['kode'];?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" value="<?php echo $penyakit['nama'];?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="gejala">Gejala</label>
                        <input type="text" name="gejala" value="<?php echo $penyakit['gejala'];?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="solusi">Solusi</label>
                        <textarea name="solusi" id="post_content" class="form-control"  required><?php echo htmlspecialchars($penyakit['solusi'])?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="" class="form-control">
                            <?php $option=[1 => 'Draft',2 => 'Publised' ];
                            foreach ($option as $key => $value) {?>
                            <option value="<?= $key?>"<?php if($key == $penyakit['status']) echo "selected"?>><?php echo $value?></option><?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update</button>
                        <a href="<?= base_url('penyakit') ?>" class="btn btn-link">Back</a>
                    </div>
                    <?= form_close(); ?>





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