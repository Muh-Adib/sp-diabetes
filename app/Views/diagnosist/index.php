<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-8 d-flex text-center">
                <?=form_open('diagnosis/create')?>
                <div class="form-group">
                    <h2>Mulai Diagnosis</h2>
                    <label for="nama">Masukan Nama Anda</label>
                    <input type="text" name="nama" id="nama" class="form-control my-3" required>
                    <button type="submit" class="btn btn-primary">Buat Diagnosis</button>
                </div>
                <?=form_close()?>

            </div>
            <div class="card">
                <div class="card-header">
                    Diagnosis
                    
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
                    <?php }  ?>

                    <table class="table table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Penyakit</th>
                                <th scope="col">Gejala</th>
                                <th scope="col">Tanggal Cek-Up</th>
                                
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($diagnosis) && is_array($diagnosis)) { ?>

                                <?php foreach ($diagnosis as $d){
                                    $ket=json_decode($d['ket'],true);
                                    $gej=json_decode($d['gejala'],true);
                                    $keya=current(array_keys($ket));
                                    foreach ($penyakit as $p ) {
                                        # code...
                                        if ($p['kode'] == $keya) {
                                            # code... 
                                            $sakit = $p['nama'];
                                            $pe = $p['penyebab'];
                                        }
                                    } 
                                    ?>
                                    
                                <tr data-toggle="tooltip" 
                                    data-placement="bottom" 
                                    title="<?=$pe?>"
                                    onclick="window.location='<?php echo base_url('diagnosis/show/' . $d['id']); ?>'";
                                    >
                                        <td> 
                                         <?=$d['nama']; ?>
                                        </td>
                                        <td>
                                        <?=$sakit?>
                                        </td>
                                        <td>
                                        <?php
                                        foreach ($gej as $g ) {
                                            # code...
                                            foreach ($gejala as $dtlg) {
                                                # code...
                                                if ($dtlg['id'] == $g) {
                                                    # code...
                                                    $dtg = $dtlg;
                                                }
                                            }
                                            ?>
                                            <span class="btn btn-danger"  data-toggle="tooltip" 
                                                            data-placement="bottom" 
                                                            title="<?=$dtg['detail']?>" 
                                                            
                                                            ><?=$dtg['kode']?></span>
                                            <?php
                                        }
                                            ?>
                                        </td>
                                        <td><?= $d['created_at'] ?></td>
                                        
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
<script>
    $(document).ready(function() {
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
    })
</script>
<?= $this->endSection() ?>