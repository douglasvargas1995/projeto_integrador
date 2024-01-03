PRAGMA foreign_keys=OFF; 

CREATE TABLE api_error( 
      id  INTEGER    NOT NULL  , 
      classe varchar  (255)   , 
      metodo varchar  (255)   , 
      url varchar  (500)   , 
      dados varchar  (5000)   , 
      erro_message varchar  (5000)   , 
      created_at datetime   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE banner( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   , 
      foto text   , 
      descricao text   , 
      valor_total double   , 
      status text   , 
      longitude text   , 
      latitude text   , 
      obs text   , 
      mes varchar  (2)   , 
      ano varchar  (4)   , 
      mes_ano varchar  (8)   , 
      created_at datetime   , 
      update_at datetime   , 
      delete_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE categoria( 
      id  INTEGER    NOT NULL  , 
      tipo_conta_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_conta_id) REFERENCES tipo_conta(id)) ; 

CREATE TABLE causa( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cep_cache( 
      id  INTEGER    NOT NULL  , 
      cep varchar  (10)   , 
      rua varchar  (255)   , 
      cidade varchar  (255)   , 
      bairro varchar  (255)   , 
      codigo_ibge varchar  (100)   , 
      uf varchar  (2)   , 
      cidade_id int   , 
      estado_id int   , 
      created_at datetime   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cidade( 
      id  INTEGER    NOT NULL  , 
      estado_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      codigo_ibge varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(estado_id) REFERENCES estado(id)) ; 

CREATE TABLE conta( 
      id  INTEGER    NOT NULL  , 
      tipo_conta_id int   NOT NULL  , 
      categoria_id int   NOT NULL  , 
      forma_pagamento_id int   NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      ordem_servico_id int   , 
      data_vencimento date   , 
      data_emissao date   , 
      data_pagamento date   , 
      valor double   , 
      parcela int   , 
      obs text   , 
      created_at datetime   , 
      updated_at datetime   , 
      deleted_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_conta_id) REFERENCES tipo_conta(id),
FOREIGN KEY(categoria_id) REFERENCES categoria(id),
FOREIGN KEY(forma_pagamento_id) REFERENCES forma_pagamento(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id),
FOREIGN KEY(ordem_servico_id) REFERENCES ordem_servico(id)) ; 

CREATE TABLE estado( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      sigla varchar  (2)   NOT NULL  , 
      codigo_ibge varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE forma_pagamento( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_pessoa( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE item_banner_postagem( 
      id  INTEGER    NOT NULL  , 
      tipo_postagem_id int   NOT NULL  , 
      banner_id int   NOT NULL  , 
      pessoa_id int   , 
      valor double   , 
      data_inicio datetime   , 
      data_fim datetime   , 
      foto text   , 
      obs text   , 
      status text   , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_postagem_id) REFERENCES tipo_postagem(id),
FOREIGN KEY(banner_id) REFERENCES banner(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE ordem_servico( 
      id  INTEGER    NOT NULL  , 
      cliente_id int   NOT NULL  , 
      descricao text   NOT NULL  , 
      data_inicio date   , 
      data_fim date   , 
      data_prevista date   , 
      valor_total double   , 
      mes char  (2)   , 
      ano char  (4)   , 
      mes_ano char  (8)   , 
      inserted_at datetime   , 
      updated_at datetime   , 
      deleted_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(cliente_id) REFERENCES pessoa(id)) ; 

CREATE TABLE ordem_servico_atendimento( 
      id  INTEGER    NOT NULL  , 
      tecnico_id int   NOT NULL  , 
      ordem_servico_id int   NOT NULL  , 
      solucao_id int   , 
      causa_id int   , 
      problema_id int   , 
      data_atendimento date   , 
      horario_inicial text   , 
      horario_final text   , 
      obs text   , 
 PRIMARY KEY (id),
FOREIGN KEY(ordem_servico_id) REFERENCES ordem_servico(id),
FOREIGN KEY(solucao_id) REFERENCES solucao(id),
FOREIGN KEY(causa_id) REFERENCES causa(id),
FOREIGN KEY(problema_id) REFERENCES problema(id),
FOREIGN KEY(tecnico_id) REFERENCES pessoa(id)) ; 

CREATE TABLE ordem_servico_item( 
      id  INTEGER    NOT NULL  , 
      ordem_servico_id int   NOT NULL  , 
      produto_id int   NOT NULL  , 
      quantidade double   , 
      desconto double   , 
      valor double   , 
      valor_total double   , 
 PRIMARY KEY (id),
FOREIGN KEY(ordem_servico_id) REFERENCES ordem_servico(id),
FOREIGN KEY(produto_id) REFERENCES produto(id)) ; 

CREATE TABLE pessoa( 
      id  INTEGER    NOT NULL  , 
      tipo_cliente_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      documento varchar  (20)   NOT NULL  , 
      observacao varchar  (500)   , 
      telefone varchar  (20)   , 
      email varchar  (255)   , 
      created_at datetime   , 
      updated_at datetime   , 
      deleted_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_cliente_id) REFERENCES tipo_cliente(id)) ; 

CREATE TABLE pessoa_contato( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      nome varchar  (255)   , 
      email varchar  (255)   , 
      telefone varchar  (20)   , 
      observacao varchar  (500)   , 
      ramal varchar  (100)   , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE pessoa_endereco( 
      id  INTEGER    NOT NULL  , 
      cidade_id int   NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      principal varchar  (1)     DEFAULT 'F', 
      cep varchar  (10)   NOT NULL  , 
      rua varchar  (255)   NOT NULL  , 
      numero varchar  (100)   NOT NULL  , 
      bairro varchar  (255)   NOT NULL  , 
      complemento varchar  (255)   , 
 PRIMARY KEY (id),
FOREIGN KEY(cidade_id) REFERENCES cidade(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE pessoa_grupo( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      grupo_pessoa_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id),
FOREIGN KEY(grupo_pessoa_id) REFERENCES grupo_pessoa(id)) ; 

CREATE TABLE problema( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produto( 
      id  INTEGER    NOT NULL  , 
      tipo_produto_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      preco double   NOT NULL  , 
      obs text   , 
      foto text   , 
      inserted_at datetime   , 
      deleted_at datetime   , 
      updated_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_produto_id) REFERENCES tipo_produto(id)) ; 

CREATE TABLE solucao( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_cliente( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_conta( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_postagem( 
      id  INTEGER    NOT NULL  , 
      descricao text   , 
      cor text   , 
      created_at datetime   , 
      update_at datetime   , 
      delete_at datetime   , 
      icone text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_produto( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 