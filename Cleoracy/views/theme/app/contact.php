<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <title>Colégio Cleoracy</title>
</head>
<body>
    <p id="voltar"> <a class="hover-animation" href="<?= $router->route("app.home") ?>"> ← Voltar</a></p>
    <h1>Contato</h1> <br>
    <h3>
    <div style="margin-top: auto;">
    <?= getContact(); ?>
    </div>
    </h3>
    <div class="modal"  id="contactModal">
            
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contato</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= $router->route("auth.contact") ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="evento">Assunto</label>
                            <input type="text" name="assunto" maxlength="50" class="form-control" id="evento">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Mensagem</label>
                            <textarea maxlength="400" name="message" class="form-control" id="descricao"></textarea>
                        </div>
                        <div class="form-group form-check" style="font-size: x-large;">
                            <input class="form-check-input" type="checkbox" name="anon" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Anonimo</label>
                        </div>

                        <button type="submit" class="btn btn-primary" id="save" >Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <button type='button' style='margin-right: 5px' class='btn' style='background-color: white;' data-toggle='modal' data-target='#visModa'>Minhas mensagens</button>

    <div class='modal fade' id='visModa' tabindex='-1' role='dialog' aria-labelledby='visModalb' aria-hidden='true'>
        <div class='modal-dialog modal-lg modal-dialog-scrollable' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='visModalb'>Suas Mensagens</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
            
                <div class='modal-body'>
                    <?= createUsersOwnMessages(); ?>
    
                </div>
    
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                </div>
    
            </div>
        </div>
    </div> -->
    
</body>
</html>
<script>
    var contactButton = document.getElementById("btnContact");
    var contactModal = document.getElementById("contactModal");
    var closeButton = contactModal.querySelector(".close");


    contactButton.addEventListener("click", function() {
        contactModal.style.display = "block";
    });



    closeButton.addEventListener("click", function() {
        contactModal.style.display = "none";
    });





    window.addEventListener("click", function(event) {
        if (event.target === contactModal) {
            contactModal.style.display = "none";
        }

        if (event.target === contactModal) {
            contactModal.style.display = "none";
        }
    });

    function delMessage(UserId) {
  
      
  var data = {"Id" : UserId, "Own" : 'true'};

  $.ajax({
    url: "<?= site("root")."/admin/delete/Message" ?>",
    data: JSON.stringify(data),
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

          if(su.message.type === 'success') location.reload();

        });

        return;
      }

      if (su.redirect) {
        location.href = su.redirect.url;
      }
    }
  });
}

    $(function() {
        $("form").submit(function(e) {
            e.preventDefault();

            var form = $(this);


            var action = form.attr("action");
            var data = new FormData(this);

            form.trigger('reset');  

            $.ajax({
                url: action,
                data: data,
                type: "post",
                dataType: "json",
                beforeSend: function() {
                    swal.showLoading();

                },
                success: function(su) {

                    Swal.close();

                    if (su.message) {

                        Swal.fire({
                            icon: su.message.type === 'error' ? 'error' : 'success',
                            title: su.message.type === 'error' ? 'Erro' : 'Sucesso',
                            text: su.message.message,
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

</script>

<style> 

    html, body {
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, #607D8B, #ECEFF1) no-repeat;
        background-size: cover;
        text-align: center;
        font-family: monospace;
        font-size: xx-large;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .btnnn {
        background-color: blue;
        font-size: 100%;
        font-family: cursive;
        align-items: center;
        text-align: center;
    
        color: white;
        width: 100%;
        height: 8vh;
        border-radius: 10px;
        border-style: none;
    }
    
    a {
        text-decoration: none;
        color: black;
    }

    #voltar {
        left: 5%;
        top: 2.5%;
        position: absolute;
    }

    #voltar a {
        color: blue;
        font-size: 50px;
        text-decoration: none;
        font-family: cursive;
        left: 0;
    }

    .modal-lg {
        max-width: 1500px; /* Defina a largura desejada */
        width: 100%;
    }

    .modal-dialog-scrollable {
        max-height: 70vh; /* Defina a altura desejada */
    }
    #voltar a:hover {
        transition: all 0.2s;
        border-bottom: solid 3px;

    }
    .hover-animation {
  position: relative;
  display: inline-block;
  text-decoration: none;
  transition: color 0.3s;
}

.hover-animation::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 0;
  background-color: #000;
  visibility: hidden;
  transform: scaleX(0);
  transition: all 0.3s ease-in-out;
}

.hover-animation:hover {
  color: blue; /* Altere para a cor desejada */
}

.hover-animation:hover::before {
  visibility: visible;
  transform: scaleX(1);
}
    h3 img{


        height: 30%;
        width: 30%;
        border-radius: 50%;
        
    }
    
    h3 {

        align-items: center;
        text-align: center;
        
        font-size: xx-large;

        font-family: cursive;

    }


    .btn:hover {

        cursor: pointer;

    }
    .btn:active {

        transform: scale(0.96);

    }

    
</style>