CREATE TABLE empresas (
       ID INT NOT NULL AUTO_INCREMENT
      ,CNPJ VARCHAR(18) NOT NULL
      ,NOME_FANTASIA VARCHAR(255) NOT NULL
      ,RAZAO_SOCIAL VARCHAR(255) NOT NULL
      ,ENDERECO TEXT NOT NULL
      ,BAIRRO VARCHAR(50) NOT NULL
      ,CIDADE VARCHAR(50) NOT NULL
      ,UF CHAR(2) NOT NULL
      ,CEP VARCHAR(10) NOT NULL
      ,TELEFONE_COMERCIAL VARCHAR(14) NOT NULL
      ,TELEFONE_FAX VARCHAR(14) NULL
      ,TELEFONE_CELULAR VARCHAR(14) NULL
      ,REPRESENTANTE_LEGAL VARCHAR(255) NOT NULL
      ,RG_REPRESENTANTE_LEGAL VARCHAR(14) NULL
      ,ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL VARCHAR(14) NULL
      ,CPF_REPRESENTANTE_LEGAL VARCHAR(14) NULL
      ,CARGO_REPRESENTANTE_LEGAL VARCHAR(255) NULL
      ,EMAIL_REPRESENTANTE_LEGAL VARCHAR(255) NOT NULL
      ,TIPO_EMPRESA CHAR(1) NULL
      ,PORTE CHAR(1) NULL
      ,BENEFICIOS_DISPONIVEIS TEXT NULL
      ,HORARIO_SER_CUMPRIDO TIME NULL
      ,HORAS_DIARIAS TIME NULL
      ,HORAS_SEMANAIS TIME NULL
      ,DATA_CADASTRO DATE NOT NULL
      ,EMAIL VARCHAR(255) NOT NULL
      ,SENHA VARCHAR(30) NOT NULL
      ,PRIMARY KEY (ID,CNPJ)
) ENGINE=MyISAM;


CREATE TABLE vagas (
       ID INT NOT NULL AUTO_INCREMENT
      ,ID_EMPRESA INT NOT NULL
      ,TITULO VARCHAR(255) NOT NULL
      ,DESCRICAO TEXT NOT NULL
      ,CARGO VARCHAR(255) NOT NULL
      ,CARGA_HORARIA VARCHAR(255) NOT NULL
      ,ATIVIDADES TEXT NOT NULL
      ,PERFIL_DESEJADO TEXT NOT NULL
      ,SALARIO DECIMAL(5,2) NOT NULL
      ,BENEFICIOS TEXT NOT NULL
      ,DATA_CADASTRO DATE NOT NULL
      ,DATA_INICIO_VIGENCIA DATETIME NOT NULL
      ,DATA_FINAL_VIGENCIA DATETIME NOT NULL
      ,STATUS CHAR(1) NOT NULL
      ,PRIMARY KEY (ID)
) ENGINE=MyISAM;


CREATE TABLE curriculos (
       ID INT NOT NULL AUTO_INCREMENT
      ,NOME VARCHAR(255) NOT NULL
      ,SEXO CHAR(1) NOT NULL
      ,ENDERECO TEXT NOT NULL
      ,BAIRRO VARCHAR(50) NOT NULL
      ,CIDADE VARCHAR(50) NOT NULL
      ,UF CHAR(2) NOT NULL
      ,CEP VARCHAR(10) NOT NULL
      ,TELEFONE_FIXO VARCHAR(14) NOT NULL
      ,TELEFONE_CELULAR VARCHAR(14) NOT NULL
      ,EMAIL VARCHAR(255) NOT NULL
      ,DATA_NASCIMENTO DATE NOT NULL
      ,CIDADE_NASCIMENTO VARCHAR(50) NOT NULL
      ,UF_NASCIMENTO CHAR(2) NOT NULL
      ,ESTADO_CIVIL VARCHAR(50) NOT NULL
      ,RG VARCHAR(14) NOT NULL
      ,ORGAO_EXPEDIDOR VARCHAR(14) NOT NULL
      ,DATA_EXPEDICAO_RG DATE NOT NULL
      ,CPF VARCHAR(14) NOT NULL
      ,CARTEIRA_RESERVISTA VARCHAR(14) NULL
      ,PIS_PASEP VARCHAR(14) NULL
      ,DATA_CADASTRO_PIS_PASEP DATE NULL
      ,TITULO_ELEITOR VARCHAR(14) NULL
      ,ZONA VARCHAR(14) NULL
      ,SECAO VARCHAR(14) NULL
      ,HABILITACAO VARCHAR(14) NULL
      ,CATEGORIA VARCHAR(14) NULL
      ,VALIDADE DATE NULL
      ,AREA_INTERESSE  VARCHAR(255) NOT NULL
      ,OBJETIVO_PROFISSIONAL TEXT NULL
      ,DISPONIBILIDADE_HORARIO CHAR(1) NULL
      ,MSN VARCHAR(255) NULL
      ,TWITTER VARCHAR(255) NULL
      ,FACEBOOK VARCHAR(255) NULL
      ,DATA_CADASTRO DATE NOT NULL
      ,PRIMARY KEY (ID,CPF)
) ENGINE=MyISAM;

/* BASE DE DADOS */
ALTER DATABASE `ipecon1_oportunidade` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci; 

/* TABELAS */
ALTER TABLE `empresas` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `vagas` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci; 

/* CAMPOS DA TABELA EMPRESAS */
ALTER TABLE `empresas` CHANGE `CNPJ` `CNPJ` VARCHAR(18) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `NOME_FANTASIA` `NOME_FANTASIA` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `RAZAO_SOCIAL` `RAZAO_SOCIAL` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `ENDERECO` `ENDERECO` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `BAIRRO` `BAIRRO` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `CIDADE` `CIDADE` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `UF` `UF` CHAR(2) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `CEP` `CEP` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `TELEFONE_COMERCIAL` `TELEFONE_COMERCIAL` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `TELEFONE_FAX` `TELEFONE_FAX` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `TELEFONE_CELULAR` `TELEFONE_CELULAR` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `REPRESENTANTE_LEGAL` `REPRESENTANTE_LEGAL` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL` `ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `CPF_REPRESENTANTE_LEGAL` `CPF_REPRESENTANTE_LEGAL` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `CARGO_REPRESENTANTE_LEGAL` `CARGO_REPRESENTANTE_LEGAL` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `EMAIL_REPRESENTANTE_LEGAL` `EMAIL_REPRESENTANTE_LEGAL` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `TIPO_EMPRESA` `TIPO_EMPRESA` CHAR(1) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `PORTE` `PORTE` CHAR(1) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `BENEFICIOS_DISPONIVEIS` `BENEFICIOS_DISPONIVEIS` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `EMAIL` `EMAIL` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `empresas` CHANGE `SENHA` `SENHA` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_general_ci; 

/* CAMPOS DA TABELA VAGAS */
ALTER TABLE `vagas` CHANGE `TITULO` `TITULO` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `vagas` CHANGE `DESCRICAO` `DESCRICAO` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `vagas` CHANGE `CARGO` `CARGO` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `vagas` CHANGE `CARGA_HORARIA` `CARGA_HORARIA` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `vagas` CHANGE `ATIVIDADES` `ATIVIDADES` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `vagas` CHANGE `PERFIL_DESEJADO` `PERFIL_DESEJADO` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `vagas` CHANGE `BENEFICIOS` `BENEFICIOS` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `vagas` CHANGE `STATUS` `STATUS` CHAR(1) CHARACTER SET latin1 COLLATE latin1_general_ci; 

/* CAMPOS DA TABELA CURRICULOS */
ALTER TABLE `curriculos` CHANGE `NOME` `NOME` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `SEXO` `SEXO` CHAR(1) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `ENDERECO` `ENDERECO` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `BAIRRO` `BAIRRO` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `CIDADE` `CIDADE` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `UF` `UF` CHAR(2) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `CEP` `CEP` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `TELEFONE_FIXO` `TELEFONE_FIXO` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `TELEFONE_CELULAR` `TELEFONE_CELULAR` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `EMAIL` `EMAIL` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `CIDADE_NASCIMENTO` `CIDADE_NASCIMENTO` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `UF_NASCIMENTO` `UF_NASCIMENTO` CHAR(2) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `ESTADO_CIVIL` `ESTADO_CIVIL` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `RG` `RG` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `ORGAO_EXPEDIDOR` `ORGAO_EXPEDIDOR` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `CPF` `CPF` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `CARTEIRA_RESERVISTA` `CARTEIRA_RESERVISTA` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `PIS_PASEP` `PIS_PASEP` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `TITULO_ELEITOR` `TITULO_ELEITOR` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `ZONA` `ZONA` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `SECAO` `SECAO` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `HABILITACAO` `HABILITACAO` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `CATEGORIA` `CATEGORIA` VARCHAR(14) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `AREA_INTERESSE` `AREA_INTERESSE` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `OBJETIVO_PROFISSIONAL` `OBJETIVO_PROFISSIONAL` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `DISPONIBILIDADE_HORARIO` `DISPONIBILIDADE_HORARIO` CHAR(1) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `MSN` `MSN` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `TWITTER` `TWITTER` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci; 
ALTER TABLE `curriculos` CHANGE `FACEBOOK` `FACEBOOK` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci;