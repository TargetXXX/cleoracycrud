<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Administrador</title>
    <!-- Adicione os links de referência ao Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css'>
</head>
<body>
    <!-- Barra de navegação -->
    <div class="login_form_callback"> <?php flash();?></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Colégio Cleoracy - Secretaria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=$router->route("app.home")?>">Início</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?=$router->route("admin.dashboard")?>">Administração</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$router->route("app.logoff")?>">Sair</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Conteúdo principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.cardapio")?>">Gerenciar Cardapio do dia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.calendario")?>">Gerenciar Calendário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.users")?>">Gerenciar Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.turmas")?>">Gerenciar Turmas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.materias")?>">Gerenciar Materias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->route("admin.mensagens")?>">Gerenciar Mensagens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gerenciar Galeria</a>
                    </li>
                    
                </ul>
            </div>
            
            <!-- Conteúdo -->
            <div class="col-md-9 content">
                <h1>Dashboard de Administrador</h1>
                <div class="card">
        <div class="card-body">
            <h5 class="card-title">Adicionar foto</h5>
            <form method="post" action="<?= $router->route("auth.saveGallery")?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="prato">Descrição da imagem</label>
                    <input type="text" name="Text" class="form-control" id="prato">
                </div>          
                <div class="form-group">
                    <label for="editAvatar">Foto</label>
                    <div class='custom-file'>
                        <input type='file' name='Image' accept='.jpeg,.png,.jpg' class='custom-file-input' id='editAvatar'>
                        <label class='custom-file-label' id='filel' for='editAvatar'>Escolha um arquivo</label>
                        <input type="hidden" name="croppedImage" id="croppedImage">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="save">Salvar</button>
            </form>
            <br>
            <button  type='button' class='btn btn-primary' disabled id='previewBtn'>Visualizar</button>
        </div>
        <div id="cropModal" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Cortar Imagem</h5>
                <button type="button" class="close bcl" data-dismiss="#cropModal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="imagePreview"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="cropButton">Salvar</button>
                <button type="button" class="bcl btn btn-secondary" data-dismiss="#cropModal">Fechar</button>
              </div>
            </div>
          </div>
        </div>


</body>
</html>
<style>

    #vis {
        
        font-family: cursive;
        font-size: xx-large;

    }

    #vis img {

        height: 200px;
        width: 200px;
        border-radius: 50%;

    }

        .navbar-brand {
            font-weight: bold;
        }

        .sidebar {
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
            padding-top: 15px;
        }

        .sidebar a {
            color: #fff;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #1d2124;
            color: #fff;
            text-decoration: none;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            margin-bottom: 20px;
        }

        .card {
            border-radius: 10px;
        }

        .card-title {
            font-weight: bold;
        }
    </style>
<script>
    $(function () {
        $("form").submit(function (e) {
        e.preventDefault();
    
        var form = $(this);
        var action = form.attr("action");
        var data = new FormData(this);
    
        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function () {
            swal.showLoading();
            
            },
            success: function (su) {
            Swal.close();
    
            if (su.message) {

                Swal.fire({
                    icon: su.message.type === 'error' ? 'error' : 'success',
                    title: su.message.type === 'error' ? 'Erro' : 'Sucesso',
                    text: su.message.message,
                    confirmButtonText: 'OK'

                }).then(() => {
                    if(su.message.type === 'success') {

                        location.reload();
                    }

                });

                return;
            }
    
            if (su.redirect) {
                location.href = su.redirect.url;
            }


            },
            contentType: false,
            processData: false
        });
        });
    });

    function flash(type, message) {

        Swal.fire({
        icon: type === 'error' ? 'error' : 'success',
        title: type === 'error' ? 'Erro' : 'Sucesso',
        text: message
        });

    }




        let baseImage = null;

        $(document).ready(function() {
          $('#editAvatar').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#imagePreview').html('<img src="' + e.target.result + '" id="previewImage">');
              $('#cropModal').modal('show');
              $('#previewBtn').prop('disabled', false);
              initializeCroppie();
            }
            reader.readAsDataURL(this.files[0]);
          });

          $('.bcl').on('click', function(){
            $('#cropModal').modal('hide');
          })

          $('#previewBtn').on('click', function(){
            $('#cropModal').modal('show');


          });

          function initializeCroppie() {
            var croppie = new Croppie(document.getElementById('previewImage'), {
              enableExif: true,
              viewport: {
                width: 250,
                height: 250,
                type: 'square'
              },
              boundary: {
                width: 260,
                height: 260
              }
            });

            $('#cropButton').on('click', function() {
              croppie.result('base64').then(function(base64Image) {
                baseImage = base64Image;
                $('#croppedImage').val(baseImage);
                $('#cropModal').modal('hide');
                $('#filel').html('Imagem selecionada...');
              });
            });
          }
        });


  
</script>
