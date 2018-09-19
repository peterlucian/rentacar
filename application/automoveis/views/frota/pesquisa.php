<div class="container">  
      <?php $attributes = array('class' => 'col-12 margin-bottom-md', 'id' => 'contact-form');
      echo form_open('pages/frota', $attributes); ?>        
        <h2>Filterable Table</h2>
        <p>Type something in the input field to search the table for manufacturer, model or color:</p>  
          <div class="messages"></div>
          <div class="controls">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <select class="form-control" name="categoria" id="form_categoria" placeholder="Please select the model *" required="required" data-error="Model is required.">
                            <option value="fabricantes" selected >Fabricante</option>
                            <option value="modelos" >Modelo</option>
                            <option value="cores" >Cor</option>
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <input id="form_pesquisa" type="text" name="filtro" class="form-control" placeholder="Please enter what u wanna search for *" data-error="Lastname is required.">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                    <input type="submit" class="btn btn-success btn-send" value="Filtrar">
                  </div>
                  <div class="col-md-6"></div>
              </div>
          </div>
      </form>
  <table id="tblData"  class="table">
    <thead>
      <tr>
        <th>Fabricante</th>
        <th>Modelo</th>
        <th>Cor</th>
        <th>Disponiblidade</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="myTable">
    <?php foreach ($listauto as $auto): ?>
        <tr>
            <td><?php echo $auto['fabricante']; ?></td>
            <td><?php echo $auto['modelo']; ?></td>      
            <td><?php echo $auto['cor']; ?></td>
            <td><?php echo $auto['disponibilidade']; ?></td>
            <?php if(isset($this->session->userdata['logged_in'])){ ?>
            <td><a href="<?php echo site_url('pages/frota/update/'.$auto['id']); ?>"><i class="fas fa-edit"></i></a><a href="<?php echo site_url('pages/delete/'.$auto['id']); ?>"><i class="fas fa-trash-alt"></i></a><td>
            <?php } ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
