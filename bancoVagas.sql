CREATE DATABASE vagas;

USE vagas;

CREATE TABLE tb_vaga (
    IDVAGA INT PRIMARY KEY AUTO_INCREMENT,
    funcao VARCHAR(70) NOT NULL,
    tipo ENUM('T', 'E') NOT NULL,
    localTrab VARCHAR(30) NOT NULL,
    escolaridade VARCHAR(70),
    horario VARCHAR(100),
    beneficios VARCHAR(100),
    descricao VARCHAR(480),
    ID_CLIENTE INT NOT NULL,
    dataCriacao DATE NOT NULL,
    fechamento ENUM('A', 'P', 'C', 'F') NOT NULL,
    dataAlteracao DATETIME
);

CREATE TABLE tb_cliente (
    IDCLIENTE INT PRIMARY kEY AUTO_INCREMENT,
    nomeCliente VARCHAR(100) NOT NULL,
    endereco VARCHAR(100),
    bairro VARCHAR(30),
    cidade VARCHAR(30),
    estado CHAR(2),
    CNPJ CHAR(14),
    contato VARCHAR(30),
    email VARCHAR(70),
    telefone VARCHAR(11)
);

CREATE TABLE tb_candidato (
    IDCANDIDATO INT PRIMARY KEY AUTO_INCREMENT,
    nomeCandidato VARCHAR(70) NOT NULL,
    email VARCHAR(70),
    telefone VARCHAR(11)
);

CREATE TABLE cand_vaga (
    ID_CANDIDATO INT,
    ID_VAGA INT,
    PRIMARY KEY(ID_CANDIDATO,ID_VAGA)
);

ALTER TABLE tb_vaga ADD CONSTRAINT FK_CLIENTE_VAGA
FOREIGN KEY(ID_CLIENTE) REFERENCES tb_cliente(IDCLIENTE);

ALTER TABLE cand_vaga ADD CONSTRAINT FK_CANDIDATO
FOREIGN KEY(ID_CANDIDATO) REFERENCES tb_candidato(IDCANDIDATO);

ALTER TABLE cand_vaga ADD CONSTRAINT FK_VAGA
FOREIGN KEY(ID_VAGA) REFERENCES tb_vaga(IDVAGA);

INSERT INTO tb_cliente VALUES(null,"Andromeda Terceirização de Mão de Obra e Servicos Ltda","Rua Marcelino Dantas, 117","Vila Alzira","Santo Andre","SP","17237955000160","Jean","jeanmarcel@cygnusrh.com.br","1144383622");

INSERT INTO tb_vaga VALUES(null, 'Contato Comercial', 'T', 'Santo André', 'Ensino Médio Completo', 'Seg. a Sex. 07:30 as 17:00', 'Vale-Trasnporte, Vale-Refeição e Vale-Alimentação', 'Experiência em vendas na área de serviços, atendimento a clientes, Habilitação Cat B. Desejável conhecimentos na área de Recursos Humanos', 1, now(),'A', null);

SELECT V.funcao, C.nomecliente FROM tb_vaga AS V
INNER JOIN tb_cliente AS C
ON V.ID_CLIENTE = C.IDCLIENTE;

SELECT nomeCliente, count(*) FROM tb_cliente
INNER JOIN tb_vaga
ON ID_CLIENTE = IDCLIENTE
GROUP BY(ID_CLIENTE);

SELECT c.nomeCliente, count(v.ID_CLIENTE) FROM tb_cliente as c
LEFT JOIN tb_vaga as v
ON v.ID_CLIENTE = c.IDCLIENTE
WHERE v.fechamento LIKE '%%' 
GROUP BY(c.IDCLIENTE);

CREATE TABLE tb_user (
    IDUSUARIO INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    passwd VARCHAR(100) NOT NULL UNIQUE,
    nome_usuario VARCHAR(100) NOT NULL,
    permissoes CHAR(1)
);

INSERT INTO tb_user VALUES (null, 'jean', MD5('aczf0704'), 'Jean Marcel', null);

ALTER TABLE tb_vaga ADD COLUMN destaque char(1) ;

UPDATE tb_vaga SET destaque = 'S' WHERE IDVAGA=33;
