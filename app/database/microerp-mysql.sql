CREATE TABLE api_error( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `classe` varchar  (255)   , 
      `metodo` varchar  (255)   , 
      `url` varchar  (500)   , 
      `dados` varchar  (5000)   , 
      `erro_message` varchar  (5000)   , 
      `created_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE banner( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `pessoa_id` int   , 
      `foto` text   , 
      `descricao` text   , 
      `valor_total` double   , 
      `status` text   , 
      `longitude` text   , 
      `latitude` text   , 
      `obs` text   , 
      `mes` varchar  (2)   , 
      `ano` varchar  (4)   , 
      `mes_ano` varchar  (8)   , 
      `created_at` datetime   , 
      `update_at` datetime   , 
      `delete_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE categoria( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_conta_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE causa( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE cep_cache( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `cep` varchar  (10)   , 
      `rua` varchar  (255)   , 
      `cidade` varchar  (255)   , 
      `bairro` varchar  (255)   , 
      `codigo_ibge` varchar  (100)   , 
      `uf` varchar  (2)   , 
      `cidade_id` int   , 
      `estado_id` int   , 
      `created_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE cidade( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `estado_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `codigo_ibge` varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE conta( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_conta_id` int   NOT NULL  , 
      `categoria_id` int   NOT NULL  , 
      `forma_pagamento_id` int   NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `ordem_servico_id` int   , 
      `data_vencimento` date   , 
      `data_emissao` date   , 
      `data_pagamento` date   , 
      `valor` double   , 
      `parcela` int   , 
      `obs` text   , 
      `created_at` datetime   , 
      `updated_at` datetime   , 
      `deleted_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE estado( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `sigla` varchar  (2)   NOT NULL  , 
      `codigo_ibge` varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE forma_pagamento( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE grupo_pessoa( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE item_banner_postagem( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_postagem_id` int   NOT NULL  , 
      `banner_id` int   NOT NULL  , 
      `pessoa_id` int   , 
      `valor` double   , 
      `data_inicio` datetime   , 
      `data_fim` datetime   , 
      `foto` text   , 
      `obs` text   , 
      `status` text   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE ordem_servico( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `cliente_id` int   NOT NULL  , 
      `descricao` text   NOT NULL  , 
      `data_inicio` date   , 
      `data_fim` date   , 
      `data_prevista` date   , 
      `valor_total` double   , 
      `mes` char  (2)   , 
      `ano` char  (4)   , 
      `mes_ano` char  (8)   , 
      `inserted_at` datetime   , 
      `updated_at` datetime   , 
      `deleted_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE ordem_servico_atendimento( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tecnico_id` int   NOT NULL  , 
      `ordem_servico_id` int   NOT NULL  , 
      `solucao_id` int   , 
      `causa_id` int   , 
      `problema_id` int   , 
      `data_atendimento` date   , 
      `horario_inicial` time   , 
      `horario_final` time   , 
      `obs` text   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE ordem_servico_item( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `ordem_servico_id` int   NOT NULL  , 
      `produto_id` int   NOT NULL  , 
      `quantidade` double   , 
      `desconto` double   , 
      `valor` double   , 
      `valor_total` double   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pessoa( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_cliente_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `documento` varchar  (20)   NOT NULL  , 
      `observacao` varchar  (500)   , 
      `telefone` varchar  (20)   , 
      `email` varchar  (255)   , 
      `created_at` datetime   , 
      `updated_at` datetime   , 
      `deleted_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pessoa_contato( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `nome` varchar  (255)   , 
      `email` varchar  (255)   , 
      `telefone` varchar  (20)   , 
      `observacao` varchar  (500)   , 
      `ramal` varchar  (100)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pessoa_endereco( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `cidade_id` int   NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `principal` varchar  (1)     DEFAULT 'F', 
      `cep` varchar  (10)   NOT NULL  , 
      `rua` varchar  (255)   NOT NULL  , 
      `numero` varchar  (100)   NOT NULL  , 
      `bairro` varchar  (255)   NOT NULL  , 
      `complemento` varchar  (255)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pessoa_grupo( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `grupo_pessoa_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE problema( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE produto( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_produto_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `preco` double   NOT NULL  , 
      `obs` text   , 
      `foto` text   , 
      `inserted_at` datetime   , 
      `deleted_at` datetime   , 
      `updated_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE solucao( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_cliente( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_conta( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_postagem( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `descricao` text   , 
      `cor` text   , 
      `created_at` datetime   , 
      `update_at` datetime   , 
      `delete_at` datetime   , 
      `icone` text   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_produto( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
  
 ALTER TABLE banner ADD CONSTRAINT fk_banner_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE categoria ADD CONSTRAINT fk_categoria_1 FOREIGN KEY (tipo_conta_id) references tipo_conta(id); 
ALTER TABLE cidade ADD CONSTRAINT fk_cidade_1 FOREIGN KEY (estado_id) references estado(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_1 FOREIGN KEY (tipo_conta_id) references tipo_conta(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_2 FOREIGN KEY (categoria_id) references categoria(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_3 FOREIGN KEY (forma_pagamento_id) references forma_pagamento(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_4 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_5 FOREIGN KEY (ordem_servico_id) references ordem_servico(id); 
ALTER TABLE item_banner_postagem ADD CONSTRAINT fk_item_banner_postagem_1 FOREIGN KEY (tipo_postagem_id) references tipo_postagem(id); 
ALTER TABLE item_banner_postagem ADD CONSTRAINT fk_item_banner_postagem_2 FOREIGN KEY (banner_id) references banner(id); 
ALTER TABLE item_banner_postagem ADD CONSTRAINT fk_item_banner_postagem_3 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE ordem_servico ADD CONSTRAINT fk_ordem_servico_1 FOREIGN KEY (cliente_id) references pessoa(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_2 FOREIGN KEY (ordem_servico_id) references ordem_servico(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_3 FOREIGN KEY (solucao_id) references solucao(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_4 FOREIGN KEY (causa_id) references causa(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_5 FOREIGN KEY (problema_id) references problema(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_5 FOREIGN KEY (tecnico_id) references pessoa(id); 
ALTER TABLE ordem_servico_item ADD CONSTRAINT fk_ordem_servico_item_1 FOREIGN KEY (ordem_servico_id) references ordem_servico(id); 
ALTER TABLE ordem_servico_item ADD CONSTRAINT fk_ordem_servico_item_2 FOREIGN KEY (produto_id) references produto(id); 
ALTER TABLE pessoa ADD CONSTRAINT fk_pessoa_1 FOREIGN KEY (tipo_cliente_id) references tipo_cliente(id); 
ALTER TABLE pessoa_contato ADD CONSTRAINT fk_pessoa_contato_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_endereco ADD CONSTRAINT fk_pessoa_endereco_1 FOREIGN KEY (cidade_id) references cidade(id); 
ALTER TABLE pessoa_endereco ADD CONSTRAINT fk_pessoa_endereco_2 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_grupo ADD CONSTRAINT fk_pessoa_grupo_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_grupo ADD CONSTRAINT fk_pessoa_grupo_2 FOREIGN KEY (grupo_pessoa_id) references grupo_pessoa(id); 
ALTER TABLE produto ADD CONSTRAINT fk_produto_1 FOREIGN KEY (tipo_produto_id) references tipo_produto(id); 
