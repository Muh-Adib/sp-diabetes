<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
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
                    <div class="jumbotron jumbotron-fluid">
                    <div class="container text-center">
                        <h1 class="display-4">Sistem Pakar Diagnosa Penyakit Diabetes</h1>
                        <p class="lead text-center">Disusun Oleh:</p>
                                    <p>Noviyanti Ardi Ningsih		17.12.0284<br>
                                    Muhammad Adib Aulia Hanif	17.12.0298</br>
                                    Mega Satya Ajis			17.12.0292</br>
                                    Onny Octaviany			17.12.0297</br>
                                    Letshin Andherzon Ale		17.12.0339</p>


                                    <p>Dosen Pengampu:</p>
                                    <p class="lead"> Sunyoto, M.Kom., Dr.</p>
                                    
                                    SISTEM INFORMASI
                                    UNIVERSITAS AMIKOM YOGYAKARTA
                                    2019/2020<br>
                                    <a href="<?php echo base_url('diagnosis'); ?>"><span class="btn btn-primary btn-sm ">Diagnosis </span></a>

                    </div>
                    </div>



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