# cleoracycrud
Crud Cleoracy

# Crud - Gerenciamente Escola

Este repositório contém o código-fonte do site de Gerenciamento Escolar, que inclui sistemas para manutenção de galeria, calendário, cardápio, notas, matérias, turmas, mensagens e usuários.


## Estrutura do Site

O site é organizado pela metodologia MVC (Model-View-Controller) e distribuido através das seguintes áreas:

- `MODELS`: Arquivos direcionados a comunicação com o banco de dados, responsáveis por gerenciar os objetos... Criado a partir do DataLayer.

- `VIEWS`: Pasta direcionada para os conteúdos visuais do site, assim como os arquivos de estilo e scripts. Dentro das views é encontrado todos os grupos de usuários do site (Public - Acesso geral, App - Acesso para usuários logados, Aluno - Acesso exclusivo para alunos onde o aluno pode conferir suas notas, Professor - Acesso para professores e administradores do sistema onde é possível atribuir notas aos alunos, Admin - Acesso exclusivo para administradores do sistema e contém todo o gerenciamento dos demais cruds, Error - Destinado aos temas de possíveis erros como o 404)

- `CONTROLLERS`: Arquivos responsáveis por fazer todo o controle das rotas do site, assim como validações e requisições aos modelos do banco de dados. Cada pasta das Views, com exceção do Error, possui 2 controllers, um responsável pelo direcionamento das rotas e outro para as requisições das páginas.

## Header

O **header** do site é a seção superior que contém o logotipo e a navegação. Ele proporciona uma identidade visual ao site e permite que os usuários naveguem facilmente entre as páginas. Cada parte do site possui uma diferente versão do Header, sempre buscando uma melhor interação de imersão do usuário. Na página principal, por exemplo, o avatar do usuário fica disponível na parte superior direita e é destinado a manutenção do perfil.

## Footer

O **footer** é a seção inferior do site, que contém informações adicionais, links úteis e créditos. No site, a maioria das páginas apresenta o footer com a logo do Colégio Cleoracy, assim suas redes sociais.

## Acessando o Site

Para visualizar o site, deve-se instalar o Xampp e  mover a pasta **Cleoracy** deste projeto para seu diretório HTDOCS, a fim de fazer sua inicialização. O banco de dados **escola** deve ser criado no MySql e suas credenciais configuradas no arquivo **config.php** dentro da pasta Source do projeto. Para iniciar o sistema de recuperação de senhas, deve-se configurar o SMTP pelo mesmo arquivo.

Após cumprir os passos apresentados anteriormente, deve-se instalar o composer no dispositivo, acessar o diretório do projeto e usar o comando **composer install** no terminal para adicionar as dependências do projeto. Logo em seguida, deve-se acessar a URL local do seu dispositivo, normalmente **localhost/cleoracy**, para acessar o site no navegador. As tabelas de dados são criadas automaticamente. Recomenda-se o uso do Google Chrome para melhor experiência.

## Créditos

Este site foi desenvolvido por Eduardo Oliveira. Para mais informações, entre em contato através do número de WhatsApp: +55 (44) 998549700.
