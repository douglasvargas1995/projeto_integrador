CREATE TABLE api_error( 
      id  SERIAL    NOT NULL  , 
      classe varchar  (255)   , 
      metodo varchar  (255)   , 
      url varchar  (500)   , 
      dados varchar  (5000)   , 
      erro_message varchar  (5000)   , 
      created_at timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE banner( 
      id  SERIAL    NOT NULL  , 
      pessoa_id integer   , 
      foto text   , 
      descricao text   , 
      valor_total float   , 
      status text   , 
      longitude text   , 
      latitude text   , 
      obs text   , 
      mes varchar  (2)   , 
      ano varchar  (4)   , 
      mes_ano varchar  (8)   , 
      created_at timestamp   , 
      update_at timestamp   , 
      delete_at timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE categoria( 
      id  SERIAL    NOT NULL  , 
      tipo_conta_id integer   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE causa( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cep_cache( 
      id  SERIAL    NOT NULL  , 
      cep varchar  (10)   , 
      rua varchar  (255)   , 
      cidade varchar  (255)   , 
      bairro varchar  (255)   , 
      codigo_ibge varchar  (100)   , 
      uf varchar  (2)   , 
      cidade_id integer   , 
      estado_id integer   , 
      created_at timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cidade( 
      id  SERIAL    NOT NULL  , 
      estado_id integer   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      codigo_ibge varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE conta( 
      id  SERIAL    NOT NULL  , 
      tipo_conta_id integer   NOT NULL  , 
      categoria_id integer   NOT NULL  , 
      forma_pagamento_id integer   NOT NULL  , 
      pessoa_id integer   NOT NULL  , 
      ordem_servico_id integer   , 
      data_vencimento date   , 
      data_emissao date   , 
      data_pagamento date   , 
      valor float   , 
      parcela integer   , 
      obs text   , 
      created_at timestamp   , 
      updated_at timestamp   , 
      deleted_at timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE estado( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      sigla varchar  (2)   NOT NULL  , 
      codigo_ibge varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE forma_pagamento( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_pessoa( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE item_banner_postagem( 
      id  SERIAL    NOT NULL  , 
      tipo_postagem_id integer   NOT NULL  , 
      banner_id integer   NOT NULL  , 
      pessoa_id integer   , 
      valor float   , 
      data_inicio timestamp   , 
      data_fim timestamp   , 
      foto text   , 
      obs text   , 
      status text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ordem_servico( 
      id  SERIAL    NOT NULL  , 
      cliente_id integer   NOT NULL  , 
      descricao text   NOT NULL  , 
      data_inicio date   , 
      data_fim date   , 
      data_prevista date   , 
      valor_total float   , 
      mes char  (2)   , 
      ano char  (4)   , 
      mes_ano char  (8)   , 
      inserted_at timestamp   , 
      updated_at timestamp   , 
      deleted_at timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ordem_servico_atendimento( 
      id  SERIAL    NOT NULL  , 
      tecnico_id integer   NOT NULL  , 
      ordem_servico_id integer   NOT NULL  , 
      solucao_id integer   , 
      causa_id integer   , 
      problema_id integer   , 
      data_atendimento date   , 
      horario_inicial time   , 
      horario_final time   , 
      obs text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ordem_servico_item( 
      id  SERIAL    NOT NULL  , 
      ordem_servico_id integer   NOT NULL  , 
      produto_id integer   NOT NULL  , 
      quantidade float   , 
      desconto float   , 
      valor float   , 
      valor_total float   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa( 
      id  SERIAL    NOT NULL  , 
      tipo_cliente_id integer   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      documento varchar  (20)   NOT NULL  , 
      observacao varchar  (500)   , 
      telefone varchar  (20)   , 
      email varchar  (255)   , 
      created_at timestamp   , 
      updated_at timestamp   , 
      deleted_at timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_contato( 
      id  SERIAL    NOT NULL  , 
      pessoa_id integer   NOT NULL  , 
      nome varchar  (255)   , 
      email varchar  (255)   , 
      telefone varchar  (20)   , 
      observacao varchar  (500)   , 
      ramal varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_endereco( 
      id  SERIAL    NOT NULL  , 
      cidade_id integer   NOT NULL  , 
      pessoa_id integer   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      principal varchar  (1)     DEFAULT 'F', 
      cep varchar  (10)   NOT NULL  , 
      rua varchar  (255)   NOT NULL  , 
      numero varchar  (100)   NOT NULL  , 
      bairro varchar  (255)   NOT NULL  , 
      complemento varchar  (255)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_grupo( 
      id  SERIAL    NOT NULL  , 
      pessoa_id integer   NOT NULL  , 
      grupo_pessoa_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE problema( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produto( 
      id  SERIAL    NOT NULL  , 
      tipo_produto_id integer   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      preco float   NOT NULL  , 
      obs text   , 
      foto text   , 
      inserted_at timestamp   , 
      deleted_at timestamp   , 
      updated_at timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE solucao( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_cliente( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_conta( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_postagem( 
      id  SERIAL    NOT NULL  , 
      descricao text   , 
      cor text   , 
      created_at timestamp   , 
      update_at timestamp   , 
      delete_at timestamp   , 
      icone text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_produto( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
  
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
