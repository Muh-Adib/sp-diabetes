<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Home
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
                                    2019/2020

                    </div>
                    </div>



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
                            <?php if (!empty($rule) && is_array($rule)) { ?>

                                <?php foreach ($listPenyakit as $no){?>
                                <tr>
                                    <td>
                                        <?php echo $no['nama'] ?>
                                    </td>
                                    <td><?php  foreach($rule as $row){if ($row['id_Penyakit']==$no['id']) {
                                        foreach($listGejala as $value){if ($value['id']==$row['id_Gejala']) {
                                        ?> <a href="<?php echo base_url('rule/edit/' . $row['id']); ?>" class="btn btn-primary btn-sm">
                                        <?php 
                                            echo $value['kode'];
                                        ?></a> <?php } }
                                    }}  ?></td>
                                </tr>
                                <?php } ?>
                                
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">No Rulefound.</td>
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