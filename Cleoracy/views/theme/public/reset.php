<!DOCTYPE html>
        <html>
            
        <head>
            <title>Resetar senha</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
            <link rel="stylesheet" href="<?=site("root")?>/views/assets/css/login.css">
            <link rel="stylesheet" href="<?=site("root")?>/views/assets/css/message.css">
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
            <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="<?=site("root")?>/views/assets/js/form.js"></script>
            <script src="<?=site("root")?>/views/assets/js/utils.js"></script>
        </head>
        <body>
            <div class="container h-100">
                <div class="login_form_callback"> <?=flash();?></div>
                <div class="d-flex justify-content-center h-100" style="position: absolute;">
                    <div class="user_card" style="left: 110%;">
                        <div class="d-flex justify-content-center">
                            <div class="brand_logo_container">
                                <img src="http://localhost/cleoracy/views/assets/images/logo.png" class="brand_logo" alt="Logo">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center form_container">
                            <form method="POST" action="<?= $router->route("auth.reset")?>">
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control input_user" required placeholder="Senha nova">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password_re" class="form-control input_user" required placeholder="Confirmar senha nova">
                                </div>


                                    <div class="d-flex justify-content-center mt-3 login_container">
                                     <button type="submit" name="button" class="btn login_btn btn-primary">Resetar senha</button>
                                   </div>
                                   <div class="d-flex justify-content-center mt-3 login_container"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>