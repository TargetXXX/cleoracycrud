<?php

define("ROOT", realpath(dirname(__FILE__)));

define("SITE", [
    "name" => "Colégio Cleoracy",
    "desc" => "Cleoracy",
    "domain" => "",
    "locale" => "pt-BR",
    "root" => "http://localhost/cleoracy"
]);

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "escola",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define("MAIL", [
    "host" => "smtp.hostinger.com",
    "port" => "587",
    "user" => "secretaria@cleoracy.online",
    "password" => "",
    "from_name" => "Secretaria",
    "from_email" => "secretaria@cleoracy.online"
]);

// Criação das tabelas caso não existam
try {
    $pdo = new PDO(
        DATA_LAYER_CONFIG['driver'] . ':host=' . DATA_LAYER_CONFIG['host'] . ';port=' . DATA_LAYER_CONFIG['port'] . ';dbname=' . DATA_LAYER_CONFIG['dbname'],
        DATA_LAYER_CONFIG['username'],
        DATA_LAYER_CONFIG['passwd'],
        DATA_LAYER_CONFIG['options']
    );

    // Tabela calendarevents
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS calendarevents (
            Id INT AUTO_INCREMENT PRIMARY KEY,
            Name VARCHAR(100) NOT NULL,
            Date DATE NOT NULL,
            Description VARCHAR(100) NOT NULL,
            Type VARCHAR(100) NOT NULL,
            everyYear TINYINT(1) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Tabela cardapios
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cardapios (
            Id INT AUTO_INCREMENT PRIMARY KEY,
            Name VARCHAR(100) NOT NULL,
            Image VARCHAR(100) NOT NULL,
            Descricao VARCHAR(100) NOT NULL,
            Date DATE NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Tabela galeria
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS galeria (
            Id INT AUTO_INCREMENT PRIMARY KEY,
            Text VARCHAR(1000) NOT NULL,
            Image VARCHAR(10000) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Tabela horarios
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS horarios (
            Id INT AUTO_INCREMENT PRIMARY KEY,
            Turma INT NOT NULL,
            Day VARCHAR(100) NOT NULL,
            StartTime TIME NOT NULL,
            EndTime TIME NOT NULL,
            Professor INT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Tabela materias
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS materias (
            Id INT AUTO_INCREMENT PRIMARY KEY,
            Name VARCHAR(100) NOT NULL,
            Turma INT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Tabela mensagens
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS mensagens (
            Id INT AUTO_INCREMENT PRIMARY KEY,
            Assunto VARCHAR(100) NOT NULL,
            Message VARCHAR(1000) NOT NULL,
            Autor INT NOT NULL,
            Anon TINYINT(1) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Tabela turmas
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS turmas (
            Id INT AUTO_INCREMENT PRIMARY KEY,
            Name VARCHAR(100) NOT NULL,
            Description VARCHAR(100) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Tabela usuarios
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            Id INT AUTO_INCREMENT PRIMARY KEY,
            First_Name VARCHAR(100) NOT NULL,
            Last_Name VARCHAR(100) NOT NULL,
            Username VARCHAR(100) NOT NULL,
            Password VARCHAR(100) NOT NULL,
            Email VARCHAR(100) NOT NULL,
            Grupo VARCHAR(100) DEFAULT NULL,
            forget VARCHAR(200) DEFAULT NULL,
            Verified VARCHAR(10) NOT NULL,
            verify_code VARCHAR(200) DEFAULT NULL,
            Avatar VARCHAR(100) NOT NULL,
            Turma INT DEFAULT NULL,
            MateriasTurma VARCHAR(1000) DEFAULT NULL,
            NotaMateria VARCHAR(2000) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
    ");

    $pdo->exec("
        INSERT INTO usuarios (Id, First_Name, Last_Name, Username, Password, Email, Grupo, forget, Verified, verify_code, Avatar, Turma, MateriasTurma, NotaMateria) VALUES
        (1, 'Eduardo\r\n', 'Oliveira', 'teste', '$2y$10$6gRftGsdpzCU72Vcy/4LyembYN92uGUl186iYJFckB2vMGf3xHOyu', 'eduardo.oliveira@gazin.com.br', 'Owner', 'ec41499104ae24f219a639dc59b5e99d', 'true', NULL, '/source/Client/Files/Images/Usuarios/perfil.jpeg', NULL, NULL, '');
    ");

    echo "Tabelas criadas e dados inseridos com sucesso!";
} catch (PDOException $e) {
    die("Erro ao criar as tabelas: " . $e->getMessage());
}

