<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="diagnosis">
        <div class="col-md-12 text-center">
        
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

                    <?php 
                    $ket=json_decode($diagnosis['ket'],true);
                    $gej=json_decode($diagnosis['gejala'],true);
                    if (is_array($ket)) {
                        # code...
                            ?>
                            <div class="card text-white bg-info mb-3">
                            <div class="card-header"><h2>Hasil Diagnosis</h2></div>
                            <div class="card-body">
                                <h5 class="card-title">Halo, <?= $diagnosis['nama'] ?></h5>
                                <p class="card-text">Terima kasih telah menggunakan pelayanan kami berikut hasil diagnosis  <?= $diagnosis['nama'] ?></p>
                            </div>
                            </div>
                            <?php

                            $keya=current(array_keys($ket));
                            

                        foreach ($ket as $k => $vk) {
                            # code...
                            
                            foreach ($detail as $d ) {
                                # code...
                                if ($d['kode'] == $keya) {
                                    # code... 
                                    $penyebab = $d['penyebab'];
                                    # code... 
                                    $solusi = $d['solusi'];
                                }

                                if ($d['kode'] == $k) {
                                    # code...
                                    
                                    $penyakit = $d;
                                }
                            }
                            if ( 30 > $vk && $vk > 0 ) {
                                # code...
                                $color = "bg-secondary text-light";
                                $text = $diagnosis['nama']." memiliki <b>kemungkinan kecil ".$vk."%</b> mengalami <b>".$penyakit['nama']."</b> periksalah ke dokter untuk diagnosa yang lebih akurat";
                                
                            } else
                            if ( 60 > $vk && $vk > 30 ) {
                                # code...
                                $color = "bg-warning text-dark";
                                $text = $diagnosis['nama']." memiliki <b>kemungkinan ".$vk."%</b> mengalami <b>".$penyakit['nama']."</b> periksalah ke dokter untuk diagnosa yang lebih akurat";
                                
                            } else
                            if ( 100 > $vk && $vk > 60 ) {
                                # code...
                                $color = "bg-danger text-light";
                                $text = $diagnosis['nama']." memiliki <b>kemungkinan besar ".$vk."%</b> mengalami <b>".$penyakit['nama']."</b> harap periksa ke dokter untuk diagnosa yang lebih akurat";
                                
                            } 

                            ?>
                            <div class="card  <?= $color ?> mb-3" >
                                <div class="card-body">
                                    <p class="card-text"><?= $text ?></p>
                                </div>
                            </div>
                            <?php

                        }
                            ?>
                        <div class="card text-white bg-secondary mb-3" >
                            
                                <div class="card-body">
                                    <h3 class="card-title">Gejala</h3>
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
                                </div>
                            </div>
                            <div class="card text-white bg-info mb-3">
                            
                            <div class="card-body">
                                <h5 class="card-title">Penyebab</h5>
                                <p class="card-text"><?= $penyebab ?></p>
                            </div>
                            </div>
                            <div class="card text-white bg-success mb-3">
                            
                            <div class="card-body">
                                <h5 class="card-title">Solusi</h5>
                                <p class="card-text"><?= $solusi ?></p>
                            </div>
                            </div>
                            <?php
                    }else {
                        # code...
                        ?>
                        <div class="card text-white bg-success mb-3" >
                            <div class="card-header">Hasil Diagnosis</div>
                            <div class="card-body">
                                <h5 class="card-title">Halo, <?= $diagnosis['nama'] ?></h5>
                                <p class="card-text"><?= $diagnosis['gejala'] ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                        
            <div class="d-flex">
                <a href="<?php echo base_url('diagnosis'); ?>" class="btn btn-primary m-2">back</a>
                <a href="<?php echo base_url('diagnosis/destroy/' . $diagnosis['id']); ?>" class="btn btn-danger m-2">Hapus</a>
            </div>
            
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extda-js') ?>
<script>
    $(document).ready(function() {
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
    })
</script>
<?= $this->endSection() ?>