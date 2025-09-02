DROP TABLE IF EXISTS itensdacompra;
DROP TABLE IF EXISTS produto;
DROP TABLE IF EXISTS categoria;
DROP TABLE IF EXISTS compra;
DROP TABLE IF EXISTS cliente;

/*usuário*/
CREATE TABLE cliente(
    idcliente SERIAL,
    nome VARCHAR (50),
    sobrenome VARCHAR (50),
    email VARCHAR (50) UNIQUE,
    senha VARCHAR (50),
	administrador BOOLEAN,
    excluido BOOLEAN,
    rua VARCHAR (100),
    bairro VARCHAR(70),
    complemento VARCHAR(50),
    cidade VARCHAR (50),
    estado CHAR (2),
    
	PRIMARY KEY(idcliente)
);

/*produtos*/
CREATE TABLE categoria(
    idcategoria SERIAL,
    nome_categoria VARCHAR(100),
    PRIMARY KEY (idcategoria)
);

CREATE TABLE produto(
    idproduto SERIAL,
    nome VARCHAR(100),
    modelo VARCHAR(100),
    cor VARCHAR(100),
    idcategoria SERIAL,
    preco NUMERIC(5,2),
    qtde INTEGER NOT NULL,
    imagem VARCHAR(50),
    excluido BOOLEAN,
    PRIMARY KEY (idproduto),
    FOREIGN KEY (idcategoria) REFERENCES categoria(idcategoria)
);

/*compra*/
CREATE TABLE compra(
    idcompra SERIAL,
    idcliente SERIAL,
    valor_final DECIMAL(10,2),
    datacompra DATE,
    PRIMARY KEY (idcompra),
    FOREIGN KEY (idcliente) REFERENCES cliente(idcliente)
);

/*essa eh a chave composta, uma terceira tabela para listar os produtos selecionados*/
CREATE TABLE itensdacompra(
    idcompra SERIAL,
    idproduto SERIAL,
    qtd INTEGER,
    preco DECIMAL (5,2),
    CONSTRAINT pk_itensdacompra PRIMARY KEY(idcompra,idproduto), --CHAVE PRIMARIA COMPOSTA
    FOREIGN KEY (idcompra) REFERENCES compra(idcompra),
    FOREIGN KEY (idproduto) REFERENCES produto(idproduto)
);

INSERT INTO cliente VALUES(DEFAULT, 'Principal', 'Administrador', 'padpadscti@gmail.com', 'fefc0053f04524a9b5f9ecc99e1ff210','t','f');

/*para teste*/
INSERT INTO categoria VALUES (DEFAULT,'Basicos');
-- INSERT INTO produto(idproduto,nome,idcategoria,preco,excluido,qtde) VALUES (DEFAULT,'Bicicleta Caloi',1,250.00,'f',33);
-- INSERT INTO produto(idproduto,nome,idcategoria,preco,excluido,qtde) VALUES (DEFAULT,'iPhone 6s',1,142.00,'f',33);
-- INSERT INTO produto(idproduto,nome,idcategoria,preco,excluido,qtde) VALUES (DEFAULT,'Micro-ondas Electrolux',1,214.20,'f',33);
-- INSERT INTO produto(idproduto,nome,idcategoria,preco,excluido,qtde) VALUES (DEFAULT,'Notebook Dell Inspiron',1,180.00,'f',33);