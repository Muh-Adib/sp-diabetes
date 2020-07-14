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

                    <?= form_open('penyakit/store'); ?>
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" class="form-control "readonly value="<?php echo $max?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="penyebab">Penyebab</label>
                        <textarea type="text" name="penyebab" class="form-control" required rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="solusi">Solusi</label>
                        <textarea name="solusi" id="post_content" class="form-control"  required rows="5"></textarea>
                    </div>
                    <div class="form-group float-right">
                        <a href="<?= base_url('penyakit') ?>" class="btn btn-link">Back</a>
                        <button class="btn btn-primary">Save</button>                        
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