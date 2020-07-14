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

                    <?= form_open_multipart('diagnosis/create'); ?>
                    
                    <div class="form-group text-center">
                        <h2 class="lead text-center">Apakah <?php echo $nama." ".$nama_gejala ?> ?</h2>
                        <?=form_hidden('Q', $Q);?>
                        <?=form_hidden('control', $control);?>
                        <?=form_hidden('kode', $kode);?>
                        <?=form_hidden('rute', $rute);?>
                    </div>
                    <div class="form-group text-center">
                    
                    <div class="form-group text-center">
                        <button name="y" value=1 class="btn btn-primary" >Iya</button>
                        <button name="y" value=0.8 class="btn btn-primary" >Kadang</button>
                        <button name="y" value=0.4 class="btn btn-primary" >Jarang</button>
                        <button name="y" value=0.2 class="btn btn-primary" >Tidak Yakin</button>
                        <button name="n" value=0 class="btn btn-primary" >Tidak</button>
                    </div>
                    
                    <div class="form-group">
                        <!-- <button class="btn btn-primary">Save</button> -->
                        <a href="<?= base_url('diagnosis') ?>" class="btn btn-primary">Back</a>
                    </div>
                    <?= form_close(); ?>

                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Gejala</th>
                                <th scope="col">Kepastian</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($log) && is_array($log)) { ?>

                                <?php foreach ($log as $row){?>
                                <tr>
                                <?php foreach($gejala as $g){if($row['id_gejala']==$g['id']){?>
                                        <td><?= $g['kode']; ?></td>
                                        <td><?= $g['detail'];}} ?></td>
                                        <td><?= $row['cf'] ?></td>
                                </tr>
                                <?php } ?>
                                
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">Data Diagnosis belum ada.</td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>


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