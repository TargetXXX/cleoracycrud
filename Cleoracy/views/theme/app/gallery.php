<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <title>Colégio Cleoracy</title>
</head>
<body>
    
    <p id="voltar"> <a class="hover-animation" href="<?= $router->route("app.home") ?>"> ← Voltar</a></p>
    <h1>Galeria de fotos <?php if(getSessionUser()->Grupo == 'Owner' || getSessionUser()->Grupo == 'Admin') echo "<a class='btn btn-primary' href='".$router->route("admin.gallery")."'><i class='fas fa-plus'></i></a>" ?> </h1>  <br> 
    <h3>

    <?= getGallery(); ?>
    </h3>

</body>
</html>


<style>

    html {
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

    .btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.5;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 0.25rem;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn:active,
    .btn:focus {
        outline: none;
        box-shadow: none;
    }

    body {
        padding: 0;
        margin: 0;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    p {
        left: 5%;
        top: 0%;
        position: absolute;
    }

    p a {
        color: blue;
        font-size: 50px;
    }

    a {
        font-size: xx-large;
        font-family: cursive;
        text-decoration: none;
        color: black;
    }

    h3{
        margin-top: 200px;
    }

    h3 img {
        height: 30%;
        width: 30%;
        border-radius: 50%;
    }
    h1{
        margin-top: -30px;
    }
    p a:hover {
        transition: all 0.2s;
        border-bottom: solid 2px;
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
        color: blue;
        /* Altere para a cor desejada */
    }

    .hover-animation:hover::before {
        visibility: visible;
        transform: scaleX(1);
    }

    h3 {
        align-items: center;
        text-align: center;
        font-size: xx-large;
        font-family: cursive;
    }

    .pagination {
        list-style-type: none;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 120px;
        margin-bottom: 10px;
        margin-top: 70px;
        left: 40%;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li.active a {
        background-color: #007bff;
        color: #fff;
    }

    .pagination li a {
        display: inline-block;
        padding: 5px 10px;
        text-decoration: none;
        color: #007bff;
        border: 1px solid #007bff;
    }

    .pagination li a:hover {
        background-color: #007bff;
        color: #fff;
    }

    h1 {
        position: absolute;
        top: 120px;

    }

    /* Adicione regras de mídia para tornar o layout responsivo */

    @media (max-width: 768px) {
        /* Aplique estilos para telas menores que 768px */
        h3 img {
            height: 20%;
            width: 20%;
        }
    }
    @media (max-width: 1120px) {
        /* Aplique estilos para telas menores que 768px */
        h1 {
            top: 120px;
        }
    }

    @media (max-width: 576px) {
        /* Aplique estilos para telas menores que 576px */
        .pagination {
            left: 20%;
            top: 210px;
        }

        h3 img {
            height: 10%;
            width: 10%;
        }
    }
    @media (max-width: 400px) {
        /* Aplique estilos para telas menores que 576px */
        .pagination {
            left: 5%;
            top: 260px;
        }

        
    }

    @media (max-width: 310px) {
        /* Aplique estilos para telas menores que 576px */
        .pagination {
            font-size: xx-small;
            left: 0%;
            top: 260px;
            padding-left: 0;
        }

        
    }

</style>
