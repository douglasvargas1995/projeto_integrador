CREATE TABLE api_error( 
      id number(10)    NOT NULL , 
      classe varchar  (255)   , 
      metodo varchar  (255)   , 
      url varchar  (500)   , 
      dados varchar  (5000)   , 
      erro_message varchar  (5000)   , 
      created_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE banner( 
      id number(10)    NOT NULL , 
      pessoa_id number(10)   , 
      foto varchar(3000)   , 
      descricao varchar(3000)   , 
      valor_total binary_double   , 
      status varchar(3000)   , 
      longitude varchar(3000)   , 
      latitude varchar(3000)   , 
      obs varchar(3000)   , 
      mes varchar  (2)   , 
      ano varchar  (4)   , 
      mes_ano varchar  (8)   , 
      created_at timestamp(0)   , 
      update_at timestamp(0)   , 
      delete_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE categoria( 
      id number(10)    NOT NULL , 
      tipo_conta_id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE causa( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cep_cache( 
      id number(10)    NOT NULL , 
      cep varchar  (10)   , 
      rua varchar  (255)   , 
      cidade varchar  (255)   , 
      bairro varchar  (255)   , 
      codigo_ibge varchar  (100)   , 
      uf varchar  (2)   , 
      cidade_id number(10)   , 
      estado_id number(10)   , 
      created_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cidade( 
      id number(10)    NOT NULL , 
      estado_id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      codigo_ibge varchar  (10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE conta( 
      id number(10)    NOT NULL , 
      tipo_conta_id number(10)    NOT NULL , 
      categoria_id number(10)    NOT NULL , 
      forma_pagamento_id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      ordem_servico_id number(10)   , 
      data_vencimento date   , 
      data_emissao date   , 
      data_pagamento date   , 
      valor binary_double   , 
      parcela number(10)   , 
      obs varchar(3000)   , 
      created_at timestamp(0)   , 
      updated_at timestamp(0)   , 
      deleted_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE estado( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      sigla varchar  (2)    NOT NULL , 
      codigo_ibge varchar  (10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE forma_pagamento( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_pessoa( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE item_banner_postagem( 
      id number(10)    NOT NULL , 
      tipo_postagem_id number(10)    NOT NULL , 
      banner_id number(10)    NOT NULL , 
      pessoa_id number(10)   , 
      valor binary_double   , 
      data_inicio timestamp(0)   , 
      data_fim timestamp(0)   , 
      foto varchar(3000)   , 
      obs varchar(3000)   , 
      status varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ordem_servico( 
      id number(10)    NOT NULL , 
      cliente_id number(10)    NOT NULL , 
      descricao varchar(3000)    NOT NULL , 
      data_inicio date   , 
      data_fim date   , 
      data_prevista date   , 
      valor_total binary_double   , 
      mes char  (2)   , 
      ano char  (4)   , 
      mes_ano char  (8)   , 
      inserted_at timestamp(0)   , 
      updated_at timestamp(0)   , 
      deleted_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ordem_servico_atendimento( 
      id number(10)    NOT NULL , 
      tecnico_id number(10)    NOT NULL , 
      ordem_servico_id number(10)    NOT NULL , 
      solucao_id number(10)   , 
      causa_id number(10)   , 
      problema_id number(10)   , 
      data_atendimento date   , 
      horario_inicial time   , 
      horario_final time   , 
      obs varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ordem_servico_item( 
      id number(10)    NOT NULL , 
      ordem_servico_id number(10)    NOT NULL , 
      produto_id number(10)    NOT NULL , 
      quantidade binary_double   , 
      desconto binary_double   , 
      valor binary_double   , 
      valor_total binary_double   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa( 
      id number(10)    NOT NULL , 
      tipo_cliente_id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      documento varchar  (20)    NOT NULL , 
      observacao varchar  (500)   , 
      telefone varchar  (20)   , 
      email varchar  (255)   , 
      created_at timestamp(0)   , 
      updated_at timestamp(0)   , 
      deleted_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_contato( 
      id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      nome varchar  (255)   , 
      email varchar  (255)   , 
      telefone varchar  (20)   , 
      observacao varchar  (500)   , 
      ramal varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_endereco( 
      id number(10)    NOT NULL , 
      cidade_id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      principal varchar  (1)    DEFAULT 'F' , 
      cep varchar  (10)    NOT NULL , 
      rua varchar  (255)    NOT NULL , 
      numero varchar  (100)    NOT NULL , 
      bairro varchar  (255)    NOT NULL , 
      complemento varchar  (255)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_grupo( 
      id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      grupo_pessoa_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE problema( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produto( 
      id number(10)    NOT NULL , 
      tipo_produto_id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      preco binary_double    NOT NULL , 
      obs varchar(3000)   , 
      foto varchar(3000)   , 
      inserted_at timestamp(0)   , 
      deleted_at timestamp(0)   , 
      updated_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE solucao( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_cliente( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_conta( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_postagem( 
      id number(10)    NOT NULL , 
      descricao varchar(3000)   , 
      cor varchar(3000)   , 
      created_at timestamp(0)   , 
      update_at timestamp(0)   , 
      delete_at timestamp(0)   , 
      icone varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_produto( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
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
 CREATE SEQUENCE api_error_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER api_error_id_seq_tr 

BEFORE INSERT ON api_error FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT api_error_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE banner_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER banner_id_seq_tr 

BEFORE INSERT ON banner FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT banner_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE categoria_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER categoria_id_seq_tr 

BEFORE INSERT ON categoria FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT categoria_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE causa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER causa_id_seq_tr 

BEFORE INSERT ON causa FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT causa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cep_cache_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cep_cache_id_seq_tr 

BEFORE INSERT ON cep_cache FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT cep_cache_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cidade_id_seq_tr 

BEFORE INSERT ON cidade FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT cidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE conta_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER conta_id_seq_tr 

BEFORE INSERT ON conta FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT conta_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE estado_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER estado_id_seq_tr 

BEFORE INSERT ON estado FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT estado_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE forma_pagamento_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER forma_pagamento_id_seq_tr 

BEFORE INSERT ON forma_pagamento FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT forma_pagamento_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE grupo_pessoa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER grupo_pessoa_id_seq_tr 

BEFORE INSERT ON grupo_pessoa FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT grupo_pessoa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE item_banner_postagem_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER item_banner_postagem_id_seq_tr 

BEFORE INSERT ON item_banner_postagem FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT item_banner_postagem_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ordem_servico_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ordem_servico_id_seq_tr 

BEFORE INSERT ON ordem_servico FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT ordem_servico_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ordem_servico_atendimento_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ordem_servico_atendimento_id_seq_tr 

BEFORE INSERT ON ordem_servico_atendimento FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT ordem_servico_atendimento_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ordem_servico_item_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ordem_servico_item_id_seq_tr 

BEFORE INSERT ON ordem_servico_item FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT ordem_servico_item_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_id_seq_tr 

BEFORE INSERT ON pessoa FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_contato_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_contato_id_seq_tr 

BEFORE INSERT ON pessoa_contato FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_contato_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_endereco_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_endereco_id_seq_tr 

BEFORE INSERT ON pessoa_endereco FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_endereco_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_grupo_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_grupo_id_seq_tr 

BEFORE INSERT ON pessoa_grupo FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_grupo_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE problema_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER problema_id_seq_tr 

BEFORE INSERT ON problema FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT problema_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE produto_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER produto_id_seq_tr 

BEFORE INSERT ON produto FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT produto_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE solucao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER solucao_id_seq_tr 

BEFORE INSERT ON solucao FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT solucao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_cliente_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_cliente_id_seq_tr 

BEFORE INSERT ON tipo_cliente FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT tipo_cliente_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_conta_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_conta_id_seq_tr 

BEFORE INSERT ON tipo_conta FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT tipo_conta_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_postagem_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_postagem_id_seq_tr 

BEFORE INSERT ON tipo_postagem FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT tipo_postagem_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_produto_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_produto_id_seq_tr 

BEFORE INSERT ON tipo_produto FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT tipo_produto_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 