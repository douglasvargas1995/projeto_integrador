INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (1,2,'Vendas de mercadorias'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (2,2,'Vendas de produtos'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (3,2,'Vendas de insumos'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (4,2,'Serviços de manutenção'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (5,2,'Receitas financeiras'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (6,1,'Compras de matérias primas'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (7,1,'Aluguel'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (8,1,'Compras de mercadoria'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (9,1,'Energia Elétrica'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (10,1,'Despesas comerciais'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (11,1,'Despesas adminstrativas'); 

INSERT INTO causa (id,nome) VALUES (1,'Prego no radiador'); 

INSERT INTO causa (id,nome) VALUES (2,'Falta de manutenção preventiva'); 

INSERT INTO causa (id,nome) VALUES (3,'Falta de troca de bateria'); 

INSERT INTO causa (id,nome) VALUES (4,'Falta de troca de óleo'); 

INSERT INTO causa (id,nome) VALUES (5,'Desgaste natural de componentes'); 

INSERT INTO causa (id,nome) VALUES (6,'Acidente'); 

INSERT INTO causa (id,nome) VALUES (7,'Pane elétrica'); 

INSERT INTO causa (id,nome) VALUES (8,'Pane mecânica'); 

INSERT INTO causa (id,nome) VALUES (9,'Pane hidráulica'); 

INSERT INTO cidade (id,estado_id,nome,codigo_ibge) VALUES (1,1,'Lajeado','4311403'); 

INSERT INTO conta (id,tipo_conta_id,categoria_id,forma_pagamento_id,pessoa_id,ordem_servico_id,data_vencimento,data_emissao,data_pagamento,valor,parcela,obs,created_at,updated_at,deleted_at) VALUES (1,1,1,1,4,null,'2022-07-22','2022-07-10',null,150,1,'',null,null,null); 

INSERT INTO conta (id,tipo_conta_id,categoria_id,forma_pagamento_id,pessoa_id,ordem_servico_id,data_vencimento,data_emissao,data_pagamento,valor,parcela,obs,created_at,updated_at,deleted_at) VALUES (2,1,7,1,4,null,'2022-07-18','2022-07-01',null,1500,null,'',null,null,null); 

INSERT INTO conta (id,tipo_conta_id,categoria_id,forma_pagamento_id,pessoa_id,ordem_servico_id,data_vencimento,data_emissao,data_pagamento,valor,parcela,obs,created_at,updated_at,deleted_at) VALUES (3,1,9,1,4,null,'2022-07-01','2022-07-01','2022-07-01',300,null,'',null,null,null); 

INSERT INTO estado (id,nome,sigla,codigo_ibge) VALUES (1,'Rio Grande do Sul','RS','43'); 

INSERT INTO forma_pagamento (id,nome) VALUES (1,'Dinheiro'); 

INSERT INTO forma_pagamento (id,nome) VALUES (2,'Boleto'); 

INSERT INTO forma_pagamento (id,nome) VALUES (3,'Cartão de crédito'); 

INSERT INTO grupo_pessoa (id,nome) VALUES (1,'Clientes'); 

INSERT INTO grupo_pessoa (id,nome) VALUES (2,'Vendedores'); 

INSERT INTO grupo_pessoa (id,nome) VALUES (3,'Fornecedores'); 

INSERT INTO grupo_pessoa (id,nome) VALUES (4,'Técnicos'); 

INSERT INTO pessoa (id,tipo_cliente_id,nome,documento,observacao,telefone,email,created_at,updated_at,deleted_at) VALUES (1,1,'Cliente 01','111111111','','(51) 9 9999-9999','cliente@gmail.com','2022-01-01 10:00','2022-06-01 12:00',null); 

INSERT INTO pessoa (id,tipo_cliente_id,nome,documento,observacao,telefone,email,created_at,updated_at,deleted_at) VALUES (2,1,'Vendedor 01','111111111','','','',null,null,null); 

INSERT INTO pessoa (id,tipo_cliente_id,nome,documento,observacao,telefone,email,created_at,updated_at,deleted_at) VALUES (3,1,'Técnico 01','9999999','','','',null,null,null); 

INSERT INTO pessoa (id,tipo_cliente_id,nome,documento,observacao,telefone,email,created_at,updated_at,deleted_at) VALUES (4,2,'Fornecedor 01','123123123','','','',null,null,null); 

INSERT INTO pessoa_contato (id,pessoa_id,nome,email,telefone,observacao,ramal) VALUES (1,1,'João das Neves','joaodasneves@gmail.com','(51) 9 9999-9999','Teste','Ramal 225'); 

INSERT INTO pessoa_endereco (id,cidade_id,pessoa_id,nome,principal,cep,rua,numero,bairro,complemento) VALUES (1,1,1,'Principal','T','95900-626','General Flores da Cunha','530','Florestal','Ap 01'); 

INSERT INTO pessoa_grupo (id,pessoa_id,grupo_pessoa_id) VALUES (1,1,1); 

INSERT INTO pessoa_grupo (id,pessoa_id,grupo_pessoa_id) VALUES (2,3,4); 

INSERT INTO problema (id,nome) VALUES (1,'Radiador furado'); 

INSERT INTO problema (id,nome) VALUES (2,'Vazamento de oléo no carter'); 

INSERT INTO problema (id,nome) VALUES (3,'Não dá partida no motor'); 

INSERT INTO problema (id,nome) VALUES (4,'Roda solta'); 

INSERT INTO problema (id,nome) VALUES (5,'Óleo baixo'); 

INSERT INTO problema (id,nome) VALUES (6,'Surdina furada'); 

INSERT INTO problema (id,nome) VALUES (7,'Motor batendo'); 

INSERT INTO problema (id,nome) VALUES (8,'Motor perdendo óleo'); 

INSERT INTO problema (id,nome) VALUES (9,'Amortecedor quebrado'); 

INSERT INTO problema (id,nome) VALUES (10,'Bateria esgotada'); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (1,2,'Hora técnica',100,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (2,1,'Oléo',25,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (3,1,'Filtro de ar',50,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (4,1,'Filtro de oléo',30,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (5,1,'Amortecedor',400,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (6,1,'Rolamento',200,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (7,1,'Mangueira de arrefecimento',150,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (8,1,'Bateria',250,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (9,2,'Retifica de motor',500,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (10,2,'Balanceamento e geometria',120,'','',null,null,null); 

INSERT INTO solucao (id,nome) VALUES (1,'Reparo'); 

INSERT INTO solucao (id,nome) VALUES (2,'Troca de peça'); 

INSERT INTO solucao (id,nome) VALUES (3,'Troca de componente mecânico'); 

INSERT INTO solucao (id,nome) VALUES (4,'Troca de componente elétrico'); 

INSERT INTO solucao (id,nome) VALUES (5,'Troca de bateria'); 

INSERT INTO solucao (id,nome) VALUES (6,'Troca de filtros'); 

INSERT INTO solucao (id,nome) VALUES (7,'Troca do motor'); 

INSERT INTO solucao (id,nome) VALUES (8,'Troca da distribuição'); 

INSERT INTO solucao (id,nome) VALUES (9,'Troca de outras peças'); 

INSERT INTO solucao (id,nome) VALUES (10,'Troca de bateria'); 

INSERT INTO solucao (id,nome) VALUES (11,'Troca de óleo'); 

INSERT INTO solucao (id,nome) VALUES (12,'Troca de outros fluidos'); 

INSERT INTO tipo_cliente (id,nome) VALUES (1,'Física'); 

INSERT INTO tipo_cliente (id,nome) VALUES (2,'Jurídica'); 

INSERT INTO tipo_conta (id,nome) VALUES (1,'Pagar'); 

INSERT INTO tipo_conta (id,nome) VALUES (2,'Receber'); 

INSERT INTO tipo_produto (id,nome) VALUES (1,'Mercadoria'); 

INSERT INTO tipo_produto (id,nome) VALUES (2,'Serviço'); 
