<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Rule
                    <a href="<?php echo base_url('rule/create'); ?>" class="btn btn-primary btn-sm float-right">Tambah</a>
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

                        <div id="demo" class="demo"></div>

                    <table class="table table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Penyakit</th>
                                <th scope="col">Kode Gejala</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php if (!empty($rule) && is_array($rule)) { ?>

                                <?php foreach ($penyakit as $no){?>
                                <tr data-toggle="modal" data-target="#exampleModal" data-id="<?= $no['id'] ?>" data-penyakit="<?= $no['nama'] ?>" >
                                    <td class="text-center">
                                        <?php echo $no['nama'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?php  foreach($rule as $row)
                                        {if ($row['id_penyakit']==$no['id']) {
                                            foreach($gejala as $value)
                                            {if ($value['id']==$row['id_gejala']) {
                                                ?> <a href="<?php echo base_url('rule/destroy/' . $row['id']); ?>" class="btn btn-warning btn-sm" onclick="return confirm('kamu yakin akan hapus ini ?')">
                                        <?php 
                                            echo $value['kode']." <b>x</b>"; 
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
                                        
                                        <div class="gejala">
                                        <?php foreach ($gejala as $key) {?>
                                            <a id="<?= $key['id']?>"
                                            class="btn btn-primary" 
                                            data-toggle="tooltip" 
                                            data-placement="bottom" 
                                            title="<?=$key['detail']?>" 
                                            aria-pressed="true"
                                            onclick="selectGejala('<?= $key['detail']?>','9')">
                                            
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

                    <?= $pager->links(); ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<<script>
    $(document).ready(function() {
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
        
    })
    var gejala = JSON.parse( '<?php echo json_encode($gejala,JSON_HEX_APOS); ?>' );
    var rule = JSON.parse( '<?php echo json_encode($rule,JSON_HEX_APOS); ?>' )
    $('#exampleModal').on('show.bs.modal', function (event) {
           
            var button = $(event.relatedTarget) // Button that triggered the modal
            var penyakit = button.data('penyakit') // Extract info from data-* attributes
            var idPenyakit = button.data('id')// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
           
            
            var modal = $(this)
            modal.find('.modal-title').text('Gejala Penyakit ' + penyakit)
            modal.find('.id_Penyakit').val(idPenyakit)
   
    })

    function selectGejala(gj,cf) {
                const val=gj
                document.getElementById('detail_gejala').value=gj 
                document.getElementById('id_Gejala').value=(event.target.id)
                document.getElementById('formControlRange').value=cf 
                document.getElementById('textInput').value=cf/10;
                console.log(cf)
           }

    function updateTextInput(val) {
        var range = val/10;
        document.getElementById('textInput').value=range; 
    }

$('#exampleModal').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var idPenyakit = button.data('id')
            rule.forEach(fungsi);
            
            function fungsi(iki, index) {

            if (iki['id_penyakit'] == idPenyakit) {
            //cari index gejala
            var result = getIndexOfK(gejala,iki['id_gejala'],'id');
            var find = gejala[result[0]]['id'];
                document.getElementById(find).addClass('btn-secondary');      
                }
                console.log(gejala[result['0']]['id'])
            }

            

        
        function getIndexOfK(arr, k, params) {
            for (var i = 0; i < arr.length; i++) {
                var index = arr[i][params].indexOf(k);
                if (index > -1) {
                return [i, index];
                }
            }
        } 
            
})
       
    
</script>
<?= $this->endSection() ?>