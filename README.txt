Manual do desenvolvedor


Introdução
	Este é um sistema de gerenciamento dos conteudos e usuarios de um jogo de perguntas e respostas.



- Estrutura dos arquivos
	- CRUD
	Cada tabela tem 4 arquivos php para executar as funções de adicioanr, editar, deletar e visualizar. Do arquivo de visualiar existem links para todas as outras partes do CRUD
		
		- Area
			area.php (visualizar tabela)
			new_area.php (adicionar)
			update_area.php (editar)
			delete_area.php (delete)

		- Usuarios
			users.php (visualizar tabela)
			new_user.php (adicionar)
			update_user.php (editar)
			delete_user.php (delete)
		
		- Assunto
			assunto.php (visualizar tabela)
			new_assunto.php (adicionar)
			update_assunto.php (editar)
			delete_assunto.php (delete)
		
		- Tipo Questão
			tipo_questao.php (visualizar tabela)
	
	- Conexão com o banco de dados
		A conexão com o banco de dados é feita no arquivo /integracao/database.php/. O banco de dados é SQL Server.

	- Login/Logout
		login.php e logout.php
		Na ação de login são declaradas alguns indices da $_SESSION	que serão utilizados no resto das paginas para checar se o usuario esta logado, seu tipo e nome.

	- Menu e checagem de autenticação
		O arquivo menu.php mostra o menu caso o indice showMenu da $_SESSION esteja declarado. 
		/integracao/loginFunc.php/ realiza a checagem de autenticação. 


