<?php

namespace Source\Controllers;

use DateInterval;
use DateTime;
use Source\Models\CalendarEvent;
use Source\Models\Cardapio;
use Source\Models\Gallery;
use Source\Models\User;
use Source\Models\Turma;
use Source\Models\Horario;
use Source\Models\Materia;
use Source\Models\Message;

class AdminAuth extends Controller
{


    public function __construct($router)
    {

        parent::__construct($router);
    }

    public function saveCardapio($data): void
    {
            
        $data = filter_var_array($data, FILTER_DEFAULT);



        $today = date("Y-m-d");

        try {

            if (in_array("", $data) || isEmptyArray($data)) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor preencher todos os campos."
                ]);

                return;
            }

            $dishName = filter_var($data["dishName"], FILTER_DEFAULT);

            $dishDesc = filter_var($data["dishDesc"], FILTER_DEFAULT);

            $dishImage = filter_var($data["croppedImage"], FILTER_DEFAULT);


            if (!$dishName) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor informar dados válidos."
                ]);

                return;
            }

            if (!$dishDesc) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor informar dados válidos."
                ]);

                return;
            }

            if (!$dishImage) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor enviar uma imagem."
                ]);

                return;
            }

            $dishImage2 = $_FILES["dishImage"];

            if ($dishImage2['error']) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Erro no envio da imagem."
                ]);

                return;
            }

            if ($dishImage2['size'] > 2097152) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Arquivo muito grande! Max: 2MB"
                ]);

                return;
            }



            list($type, $dishImage) = explode(';', $dishImage);
            list(, $dishImage) = explode(',', $dishImage);
            list(, $ext) = explode('/',$type);

            $dishImage = base64_decode($dishImage);

            $foto_name = time().'.'.$ext;


       


            if ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Arquivo inválido."
                ]);

                return;
            }

            $result = file_put_contents('source/Client/Files/Images/Cardapio/'.$foto_name, $dishImage);


            if (!$result) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Erro ao fazer upload do arquivo."
                ]);

                return;
            }


            
            $cardapio = new Cardapio();



            $cardapio->Name = $dishName;
            $cardapio->Image = '/source/Client/Files/Images/Cardapio/'.$foto_name;;
            $cardapio->Date = $today;
            $cardapio->Descricao = $dishDesc;

            $cardapio->saveCardapio();

            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Cardápio alterado com sucesso!",
                "cardapio" => getTodayMenu()
            ]);
        } catch (\Exception $error) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $error->getMessage()
            ]);
        }
    }

    public function saveGallery($data): void
    {
            
        $data = filter_var_array($data, FILTER_DEFAULT);



        try {

            if ((in_array("", $data) || isEmptyArray($data)) && !empty($data["Text"])) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor preencher todos os campos."
                ]);

                return;
            }

            $Text = $data["Text"];

            $Image = filter_var($data["croppedImage"], FILTER_DEFAULT);

        
            if(!empty($Text)) {
                if(!is_string($Text) || ctype_space($Text) ) {
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => "Mensagem inválida."
                    ]);
           
                    return;
                }



                if(strlen($Text) > 13) {
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => "Descrição da imagem muito grande!"
                    ]);
    
                    return;
                }
            }


            if (!$Image) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor enviar uma imagem."
                ]);

                return;
            }

            $Image2 = $_FILES["Image"];

            if ($Image2['error']) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Erro no envio da imagem."
                ]);

                return;
            }

            if ($Image2['size'] > 2097152) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Arquivo muito grande! Max: 2MB"
                ]);

                return;
            }



            list($type, $Image) = explode(';', $Image);
            list(, $Image) = explode(',', $Image);
            list(, $ext) = explode('/',$type);

            $Image = base64_decode($Image);

            $foto_name = time().'.'.$ext;


       


            if ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Arquivo inválido."
                ]);

                return;
            }

            $result = file_put_contents('source/Client/Files/Images/Gallery/'.$foto_name, $Image);


            if (!$result) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Erro ao fazer upload do arquivo."
                ]);

                return;
            }


            
            $image = new Gallery();



            $image->Text = ' '.$Text;
            $image->Image = '/source/Client/Files/Images/Gallery/'.$foto_name;;

            $image->saveImage();

            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Imagem salva com sucesso!"
            ]);
        } catch (\Exception $error) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $error->getMessage()
            ]);
        }
    }

    public function delCalEvent($data): void
    {

        $data = filter_var_array($data, FILTER_DEFAULT);


            if (in_array("", $data) || isEmptyArray($data)) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor preencher todos os campos."
                ]);

                return;
            }

            $eventId = intval($data["event"]);



            if (!$eventId) {

                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor informar dados válidos."
                ]);

                return;
            }
        $Event = (new CalendarEvent())->findById($eventId);
        if(!$Event) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Evento não encontrado!"
            ]);

            return;
        }

        if($Event->destroy()) {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Evento excluido com sucesso!"
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "error",
            "message" => "Erro ao tentar excluir evento!"
        ]);

    }

    public function saveCalEvent($data): void
    {

        $data = filter_var_array($data, FILTER_DEFAULT);
        

        if (in_array("", $data) || isEmptyArray($data)) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor preencher todos os campos."
            ]);

            return;
        }

        // $eventName = filter_var($data["eventName"], FILTER_DEFAULT);
        // $eventDesc = filter_var($data["eventDesc"], FILTER_DEFAULT);
        // $eventDate = filter_var($data["eventDate"], FILTER_DEFAULT);
        // $eventType = filter_var($data["eventType"], FILTER_DEFAULT);
        $eventName = $data["eventName"];
        $eventDesc = $data["eventDesc"];
        $eventDate = $data["eventDate"];
        $eventType = intval($data["eventType"]);


        // if (!$eventName || !$eventDesc || !$eventDate || !$eventType) {

        //     echo $this->ajaxResponse("message", [
        //         "type" => "error",
        //         "message" => "Favor informar dados válidos."
        //     ]);

        //     return;
        // }
        if(!is_int($eventType) || !($eventType > 0 && $eventType <= 3)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informar um tipo válido."
            ]);

            return;
        }
        $date = DateTime::createFromFormat('Y-m-d', $eventDate);

        if(!$date) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informar uma data válida."
            ]);

            return;
        }
        
        $date->add(new DateInterval("P1D"));
        $formattedDate = $date->format('Y-m-d');

        $types = ["holiday", "event", "birthday"];

        $Event = new CalendarEvent();

        $Event->Name = $eventName;
        $Event->Date = $formattedDate;
        $Event->Description = $eventDesc;
        $Event->Type = $types[$eventType - 1];
        $Event->everyYear = 1;
        $Event->save();



        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Evento salvo com sucesso!"
         ]);
    }

    public function saveUser($data) : void {
        $data = json_decode(file_get_contents('php://input'));
        $username =  filter_var($data->Username, FILTER_DEFAULT);
        $email = filter_var($data->Email, FILTER_DEFAULT);
        $first_name = filter_var($data->First_Name, FILTER_DEFAULT);
        $last_name = filter_var($data->Last_Name, FILTER_DEFAULT);
        $grupo = filter_var($data->Grupo, FILTER_DEFAULT);
        $Id = filter_var($data->Id, FILTER_DEFAULT);
        $Turma = filter_var($data->Turma, FILTER_DEFAULT);
        $Materias = (isset($data->Materias) && !ctype_space($data->Materias)) ? filter_var_array($data->Materias, FILTER_DEFAULT) : false;





        if (($grupo == 'Professor' && empty($Materias)) || ($grupo == 'Aluno' && empty($Turma))) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos!"
            ]);
    
            return;
        }
        


        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informe um email válido!"
            ]);

            return;
        }

        $check_validUserId = (new User())->findById($Id);

        if(!$check_validUserId) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Usuário inexistente!"
            ]);

            return;
        }

        if($check_validUserId->Grupo == 'Owner') {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você não possui permissão para alterar informações deste usuário!"
            ]);

            return;
        }

        if($Id == $_SESSION["user"]) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você não pode alterar seu próprio usuário por essa tela!"
            ]);

            return;
        }

        if(getSessionUser()->Grupo !== 'Owner' && getSessionUser()->Grupo !== 'Admin') {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você não tem permissão para alterar um usuário!"
            ]);

            return;
        }

        if(str_contains($username, ' ')) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O Username deve conter apenas uma palavra! Verifique se há espaços em branco..."
            ]);

            return;
        }

        if(strlen($username) > 20) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O Username deve conter no máximo 20 caracteres!"
            ]);

            return;
        }
        
        $check_user_username = (new User())->find('Username = :u AND Id <> :id', "u={$username} & id={$Id}")->count();


        if($check_user_username) {
           
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Já existe um Usuário cadastrado com esse Username!"
            ]);

            return;
        }

        $filter_fname = filter_var($first_name, FILTER_SANITIZE_SPECIAL_CHARS);
        $filter_lname = filter_var($last_name, FILTER_SANITIZE_SPECIAL_CHARS);

        if(!$filter_fname || !$filter_lname) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Digite um nome válido!"
            ]);

            return;
        }


        $check_numbers_fname = preg_match('/\d/', $filter_fname);
        $check_numbers_lname = preg_match('/\d/', $filter_lname);

        if($check_numbers_fname || $check_numbers_lname) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Digite um nome válido!"
            ]);

            return;
        }

        if(mb_strlen($filter_fname) > 15) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O nome deve conter no máximo 15 letras!"
            ]);

            return;
        }

        if(mb_strlen($filter_lname) > 50) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O sobrenome deve conter no máximo 50 letras!"
            ]);

            return;
        }

        if(str_word_count($filter_fname) > 1) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O nome deve conter apenas uma palavra!"
            ]);

            return;

        }

        if(str_word_count($filter_lname) > 6) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O sobrenome deve conter no máximo 6 palavras!"
            ]);

            return;

        }

        if(!$grupo) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Grupo inválido!"
            ]);

            return;
        }

        if($grupo != "Aluno" && $grupo != 'Admin' && $grupo != 'Owner' && $grupo != 'Professor') {


            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Grupo inválido!"
            ]);

            return;
        }

        if($grupo == 'Owner' && getSessionUser()->Grupo != 'Owner') {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você não possui permissão para setar este grupo!"
            ]);

            return;
        }

        $check_user_email_qtd = (new User())->find('Email = :e AND Id <> :id', "e={$email} & id={$Id}")->count();

        if($check_user_email_qtd) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Este email já atingiu o número máximo de registros!"
            ]);

            return;

        }

        $userNameExplode = explode(' ', $username);

        $user = (new User())->findById($Id);
        $user->Username = $userNameExplode[0];
        $user->First_Name = $first_name;
        $user->Last_Name = $last_name;
        $user->Email = $email;
        $user->Grupo = $grupo;
        $user->Turma = null;
        
        if($grupo == 'Aluno') {
            $Turma = intval($Turma);
            if(!$Turma) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Turma inválida!"
                ]);
    
                return;
            }

            if(!(new Turma())->findById($Turma)) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Turma inválida!"
                ]);
    
                return;
            }
            
            $user->Turma = $Turma;
        } else if($grupo == 'Professor') {


            if(!$Materias) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Materia(s) inválida(s)!"
                ]);
    
                return;
            }

            $MateriasValidate = array_map('intval', $Materias);

            foreach($MateriasValidate as $t) {
                if(!is_int($t)) {
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => "Materia inválida!"
                    ]);
        
                    return;
                }

                $check = (new Materia())->findById($t);
                if(!$check) {
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => "Materia inválida!"
                    ]);
        
                    return;
                }

                
            }

            $user->MateriasTurma = implode(",", $MateriasValidate);
        }

        $user->save();
        

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Usuário salvo com sucesso!"
        ]);
    }

    public function delUser($data) : void {
        $data = json_decode(file_get_contents('php://input'));
        $userId = intval($data->Id);



        if (!$userId) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informar dados válidos."
            ]);

            return;
        }
        $User = (new User())->findById($userId);
        if(!$User) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Usuário não encontrado!"
            ]);

            return;
        }

        if(getSessionUser()->Grupo !== 'Owner' && getSessionUser()->Grupo !== 'Admin') {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você não tem permissão para excluir um usuário!"
            ]);

            return;
        }

        if($User->Grupo == "Owner") {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você não possui permissão para excluir este usuário!"
            ]);

            return;
        }

        if($User->destroy()) {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Usuário excluido com sucesso!"
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "error",
            "message" => "Erro ao tentar excluir usuário!"
        ]);
    }


    function saveTurma($data): void {
        $data = json_decode(file_get_contents('php://input'));
        $Name =  filter_var($data->Name, FILTER_DEFAULT);
        $Desc =  filter_var($data->Description, FILTER_DEFAULT);
        $Id = filter_var($data->Id, FILTER_DEFAULT);


        foreach($data as $value) {
            if($value != $Id && (empty($value) || ctype_space($value))) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos! $value"
                ]);
    
                return;
            }
        }



        $check_validTurmaId = (new Turma())->findById($Id);

        if(!$check_validTurmaId) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Turma inexistente!"
            ]);

            return;
        }


        if(strlen($Name) > 30) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O Nome deve conter no máximo 20 caracteres!"
            ]);

            return;
        }
        
        $check_name = (new Turma())->find('Name = :u AND Id <> :id', "u={$Name} & id={$Id}")->count();


        if($check_name) {
           
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Já existe uma Turma cadastrada com esse Nome!"
            ]);

            return;
        }

        $filter_desc = filter_var($Name, FILTER_SANITIZE_SPECIAL_CHARS);

        if(!$filter_desc) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Digite uma descrição válida!"
            ]);

            return;
        }

        if(mb_strlen($filter_desc) > 60) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "A descrição deve conter no máximo 50 caracteres!"
            ]);

            return;
        }



        $turma = (new Turma())->findById($Id);
        $turma->Name = $Name;
        $turma->Description = $Desc;
        $turma->Materias = 'a';



        if($turma->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Turma salva com sucesso!"
            ]);

            return;
        }
        

        echo $this->ajaxResponse("message", [
            "type" => "error",
            "message" => "Erro ao salvar a turma!"
        ]);
    }

    
    function delTurma($data): void {
        $data = json_decode(file_get_contents('php://input'));
        $turmaId = intval($data->Id);



        if (!$turmaId) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informar dados válidos."
            ]);

            return;
        }
        $Turma = (new Turma())->findById($turmaId);
        if(!$Turma) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Turma não encontrada!"
            ]);

            return;
        }



        if($Turma->destroy()) {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Turma excluida com sucesso!"
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "error",
            "message" => "Erro ao tentar excluir turma!"
        ]);
    }

    function delGallery($data): void {
        $data = json_decode(file_get_contents('php://input'));
        $imageId = intval($data->Id);



        if (!$imageId) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informar dados válidos."
            ]);

            return;
        }
        $Image = (new Gallery())->findById($imageId);
        if(!$Image) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Imagem não encontrada!"
            ]);

            return;
        }

        if(getSessionUser()->Grupo !== 'Owner' && getSessionUser()->Grupo !== 'Admin') {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Usuário sem permissão!"
            ]);

            return;
        }

        if($Image->destroy()) {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Imagem excluida com sucesso!"
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "error",
            "message" => "Erro ao tentar excluir imagem!"
        ]);
    }

    function registerTurma($data): void {
        $data = filter_var_array($data, FILTER_DEFAULT);
        

        if (in_array("", $data) || isEmptyArray($data)) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor preencher todos os campos."
            ]);

            return;
        }


        

        $Name = $data["name"];
        $Desc = $data["description"];

        if(!$Name || !is_string($Name) || strlen($Name) > 30) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Nome inválido ou extenso demais!"
            ]);

            return;
        }

        if(!$Desc || !is_string($Desc) || strlen($Desc) > 60) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Descrição inválida ou extensa demais!"
            ]);

            return;
        }

        $check_turma_name = (new Turma())->find("Name = :n", "n={$Name}")->count();

        if($check_turma_name > 0) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Turma já cadastrada!"
            ]);

            return;
        }

        $Turma = new Turma();
        $Turma->Name = $Name;
        $Turma->Description = $Desc;

        $Turma->save();


        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Turma cadastrada com sucesso!"
         ]);
    }

    
    function registerMateria($data): void {
        $data = filter_var_array($data, FILTER_DEFAULT);
        

        if (in_array("", $data) || isEmptyArray($data)) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor preencher todos os campos."
            ]);

            return;
        }


        

        $Name = $data["name"];


        if(!$Name || !is_string($Name) || strlen($Name) > 30) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Nome inválido ou extenso demais!"
            ]);

            return;
        }

        $Turma = $data["turma"];
        $Turma = intval($Turma);
        
        if(!$Turma || !(new Turma())->findById($Turma)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Turma inválida!"
            ]);

            return;
        }

        $check_materia_name = (new Materia())->find("Name = :n AND Turma = :t", "n={$Name}&t={$Turma}")->count();

        if($check_materia_name > 0) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Materia já cadastrada!"
            ]);

            return;
        }


        $Materia = new Materia();
        $Materia->Name = $Name;
        $Materia->Turma = $Turma;


        $Materia->save();


        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Materia cadastrada com sucesso!"
         ]);
    }

    function saveMateria($data): void {
        $data = json_decode(file_get_contents('php://input'));
        $Name =  filter_var($data->Name, FILTER_DEFAULT);
        $Id = intval(filter_var($data->Id, FILTER_DEFAULT));
        $Turma = intval(filter_var($data->Turma, FILTER_DEFAULT));


        foreach($data as $value) {
            if($value != $Id && (empty($value) || ctype_space($value))) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos! $value"
                ]);
    
                return;
            }
        }



        $check_validMateriaId = (new Materia())->findById($Id);

        if(!$check_validMateriaId) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Materia inexistente!"
            ]);

            return;
        }

        if(!$Turma || !(new Turma())->findById($Turma)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Turma inválida!"
            ]);

            return;
        }

        if(strlen($Name) > 30) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "O Nome deve conter no máximo 20 caracteres!"
            ]);

            return;
        }
        
        $check_name = (new Materia())->find('Name = :u AND Turma = :t AND Id <> :id', "u={$Name} & t={$Turma} & id={$Id}")->count();


        if($check_name) {
           
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Já existe uma Materia cadastrada com esse Nome!"
            ]);

            return;
        }

        


        $Materia = (new Materia())->findById($Id);
        $Materia->Name = $Name;
        $Materia->Turma = $Turma;



        $Materia->save();
        

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Materia salva com sucesso!"
        ]);
    }

    
    function delMateria($data): void {
        $data = json_decode(file_get_contents('php://input'));
        $MateriaId = intval($data->Id);



        if (!$MateriaId) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informar dados válidos."
            ]);

            return;
        }
        $Materia = (new Materia())->findById($MateriaId);
        if(!$Materia) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Materia não encontrada!"
            ]);

            return;
        }



        if($Materia->destroy()) {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Materia excluida com sucesso!"
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "error",
            "message" => "Erro ao tentar excluir Materia!"
        ]);
    }
    function delMessage($data): void {
        $data = json_decode(file_get_contents('php://input'));
        $MessageId = intval($data->Id);



        if (!$MessageId) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Favor informar dados válidos."
            ]);

            return;
        }
        $Message = (new Message())->findById($MessageId);
        if(!$Message) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Mensagem não encontrada!"
            ]);

            return;
        }


        if(isset($data->Own)) {

            if($Message->Autor != getSessionUser()->Id) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Mensagem não cadastrada em seu nome!"
                ]);
    
                return;
            }

        }


        if($Message->destroy()) {
            echo $this->ajaxResponse("message", [
                "type" => "success",
                "message" => "Mensagem excluida com sucesso!"
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "error",
            "message" => "Erro ao tentar excluir Mensagem!"
        ]);
    }


}

