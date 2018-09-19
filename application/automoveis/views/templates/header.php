<html>
        <head>
            <title>CodeIgniter Tutorial</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
            <style>
                .padding-top-md { padding-top: 1em; }
                .margin-bottom-md { margin-bottom: 1em; }
                .focus { cursor: pointer; }
                .pageNumber { padding: 2px; }
            </style>
        </head>
        <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Rent-a-Car</a>
            <button class="navbar-toggler float-left" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo site_url('pages/view/home'); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('pages/view/sobre'); ?>">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('pages/view/contactos'); ?>">Contacto</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Automóveis
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo site_url('pages/frota/pesquisa'); ?>">Pesquisar</a>
                            <?php if(isset($this->session->userdata['logged_in'])) { ?>
                            <a class="dropdown-item" href="<?php echo site_url('pages/frota/adicionar'); ?>">Adicionar</a>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <?php if(isset($this->session->userdata['logged_in'])){ ?>
                        <a class="nav-link" href="<?php echo site_url('pages/logout'); ?>" >Logout</a>
                        <?php } 
                        else{ ?>
                        <a class="nav-link" href="" data-target="#myModal" data-toggle="modal">Admin</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
      
            <div class="modal-body">
                <?php $attributes = array('class' => 'col-12', 'id' => 'contact-form');
                echo form_open('pages/set_admin', $attributes); ?>               
                    <div class="messages"></div>

                    <div class="controls">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_password">Password *</label>
                                    <input id="form_password" type="password" name="password" class="form-control" placeholder="Please enter your password *" required="required" data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">  
                                    <p id="image_captcha"><?php echo $captchaImg; ?></p>
                                    <?php // echo $this->session->userdata('valuecaptchaCode'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="captcha" value="" class="form-control" placeholder="Please insert the 5 characters *" required="required" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="javascript:void(0);" class="captcha-refresh" ><img style="width: 35px;" src="<?php echo base_url().'assets/refresh.png'; ?>"/></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send" value="Log in">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
        </div>