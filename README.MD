## MANAGER BOOK APPLICATION

#### Descrição Geral

<p>
    Este é uma aplicação desenvolvida para gerenciar livros, incluindo o cadastro, edição, leitura e exclusão de registros. A aplicação também apresenta 2 perfils de usuário: cliente e administrador. Cada perfil possui privilégios e restrições sendo definidos da seguinte forma:
</p>

* ADMIN - ADD, PUT, DELETE, READ
* CLIENT - ADD, PUT, DELETE, READ para os registros cadastrados pelo mesmo usuário do tipo CLIENT
* CLIENT - READ para os registros cadastrados por outros usuários

#### Stack Utilizada
* PHP para o backend versão 8.0.0
* HTML, CSS, JS e Bootstrap para o frontend
* Banco de dados MYSQL

#### Deploy da aplicação
* A aplicação roda em ambiente APACHE, software XAMPP com suporte para versão 8.0.0
* Salvar a aplicação no dir default XAMPP C:\xampp\htdocs (caso WINDOWS)
* Root url da aplicação 'managerbooks/public'
* Arquivo de configurações da aplicação 'src/Config.php'

#### Banco de dados
* Criar um banco de dados vazio mysql com o nome 'techlead'
* Importar arquivo 'db_dump.SQL' para criar tabelas e relacionamentos
* Usuário admin é criado assim que a aplicação é acessada a primeira vez
* Credenciais do admin estão salvas no arquivo 'src/Config.php'

