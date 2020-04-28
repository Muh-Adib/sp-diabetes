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
                        <button class="btn btn-primary">Save</button>
                        <a href="<?= base_url('rule') ?>" class="btn btn-link">Back</a>
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