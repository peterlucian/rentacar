<div class="container h-100">
<div class="row h-100 justify-content-center padding-top-md">
<!-- <form class="col-12" id="contact-form" method="post" action="pages/create" role="form"> -->
<?php $attributes = array('class' => 'col-12', 'id' => 'contact-form');
echo form_open('pages/create', $attributes); ?>
    <div class="messages"></div>

    <div class="controls">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_cor">Cor: *</label>
                    <select class="form-control" name="cor" id="form_cor" placeholder="Please select the color *" required="required" data-error="Color is required.">
                        <?php foreach ($info as $particular_info): ?>
                            <?php if(is_numeric($particular_info['id_cor'])){ ?>
                            <option value="<?php echo $particular_info['id_cor']; ?>"><?php echo $particular_info['cor']; ?></option>
                        <?php
                            }
                    endforeach; ?>                      
                    </select> 
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_disponibilidade">Disponibilidade *</label>
                    <input id="form_disponibilidade" type="text" name="disponibilidade" class="form-control" placeholder="Please enter the number of cars available *" required="required" data-error="Cars available is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_modelo">Modelo: *</label>
                    <select class="form-control" name="modelo" id="form_modelo" placeholder="Please select the model *" required="required" data-error="Model is required.">
                        <?php foreach ($info as $particular_info): ?>
                            <option value="<?php echo $particular_info['id_modelo']; ?>"><?php echo $particular_info['modelo']; ?></option>
                        <?php endforeach; ?>  
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-send" value="Adicionar">
            </div>
        </div>
    </div>

</form>
</div>
</div>