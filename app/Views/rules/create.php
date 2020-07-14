<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
                <?= $title ?><a href="<?= base_url('penyakit') ?>" class="btn btn-danger">Hapus</a>
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

                    
                    
                    

                    

                    <!-- Button trigger modal -->
                    <?php foreach ($list_p as $key) {?>
                        <div class="row d-flex">
                        <div class="col-4">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-id="<?= $key['id'] ?>" data-penyakit="<?= $key['nama']?>">
                            <?php echo $key['kode']." : ".$key['nama']?>
                        </button>
                        </div>
                        <?php foreach ($rule as $rules) {
                            if ($rules['id_penyakit']==$key['id']) {
                               foreach ($list_g as $gejala) {
                                   if ($rules['id_Gejala']==$gejala['id']) {
                                       echo "hello";
                                   }
                               }
                            }
                        } ?>
                        <div class="col-7">
                            <span class="btn btn-sucess">
                                G1
                            </span>
                        </div>
                        </div>
                    <?php }?>


                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <?= form_open('rule/store'); ?>
                                    <div class="form-group">
                                        <label for="id_Gejala">Kode Gejala</label>
                                        
                                        <div class="">
                                        <?php foreach ($list_g as $key) {?>
                                            <a id="<?= $key['id']?>"
                                            class="btn btn-primary" 
                                            data-toggle="tooltip" 
                                            data-placement="bottom" 
                                            title="<?=$key['detail']?>" 
                                            aria-pressed="true"
                                            onclick="selectGejala('<?= $key['detail']?>')">
                                            
                                            <?=$key['kode']?>
                                            </a>
                                        <?php }
                                        ?>
                                        </div>
                                        <input type="hidden" name="id_Penyakit" class="id_Penyakit" value="" required/>
                                        <input id="id_Gejala" type="hidden" name="id_Gejala" class="id_Gejala" value="" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama-gejala">Detail Gejala</label>
                                        <input type="text" id="detail_gejala" class="form-control" readonly placeholder="keterangan gejala">
                                    </div>
                                    <div class="form-group">
                                        <label for="cf">Belief</label>
                                            <span></span>
                                            <input type="range" class="form-control-range" id="formControlRange" min="0" max="10" onchange="updateTextInput(this.value);">
                                            <input name="cf" type="text" id="textInput" value="0.5"  class="form-control" readonly>
                                    </div>
                                </div>
                                
                        
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save</button>
                                    </div>    
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                    

                    
                    
                    

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
                        </tbody>
                    </table>



                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>

<?= $this->endSection() ?>