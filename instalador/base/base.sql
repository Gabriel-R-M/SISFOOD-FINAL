-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/04/2019 às 14:59
-- Versão do servidor: 10.1.32-MariaDB
-- Versão do PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `a_banco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin_mensagens_sistema`
--

CREATE TABLE `admin_mensagens_sistema` (
  `id` int(10) NOT NULL,
  `mensagem` text NOT NULL,
  `importante` int(1) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `aguarda_venda`
--

CREATE TABLE `aguarda_venda` (
  `id` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `md5_usuario` varchar(99) NOT NULL,
  `finalizada` int(1) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_caixa` int(10) NOT NULL,
  `valor_produtos` double(10,2) NOT NULL,
  `valor_acrescimos` double(10,2) NOT NULL,
  `valor_total` double(10,2) NOT NULL,
  `valor_entrega` double(10,2) NOT NULL,
  `id_mesa` int(10) NOT NULL,
  `entrega` int(10) NOT NULL,
  `valor_desconto` double(10,2) NOT NULL,
  `valor_final_venda` double(10,2) NOT NULL,
  `aguarde` int(10) NOT NULL,
  `tipo_desc` varchar(99) NOT NULL,
  `val_desc` double(10,2) NOT NULL,
  `pedido_inicio` time NOT NULL,
  `data_pedido` date NOT NULL,
  `levar_troco` double(10,2) NOT NULL,
  `troco_para` double(10,2) NOT NULL,
  `entregador` int(10) NOT NULL,
  `levar_maquina_cartao` int(10) NOT NULL,
  `pre_tipo_pagamento` int(10) NOT NULL,
  `embala_viagem` int(10) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `pedido_entregue` time NOT NULL,
  `ocupou_mesa` int(10) NOT NULL,
  `pedido_saiu_entrega` time NOT NULL,
  `pedido_internet` int(10) NOT NULL,
  `cliente_internet` int(10) NOT NULL,
  `venda_fiscal` int(1) NOT NULL,
  `xml_fiscal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixa`
--

CREATE TABLE `caixa` (
  `id` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `data_abertura` date NOT NULL,
  `hora_abertura` time NOT NULL,
  `valor_inicial` double(10,2) NOT NULL,
  `data_fechamento` date NOT NULL,
  `hora_fechamento` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `categoria` varchar(999) NOT NULL,
  `ativo` int(1) NOT NULL,
  `ordem` int(10) NOT NULL,
  `meio_meio` int(1) NOT NULL,
  `adicionais` int(10) NOT NULL,
  `impressao` varchar(99) NOT NULL,
  `imprime_codigo` int(10) NOT NULL,
  `ncm_categoria` varchar(99) NOT NULL,
  `cst_categoria` varchar(99) NOT NULL,
  `cfop_categoria` varchar(99) NOT NULL,
  `csosn_categoria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias_despesas`
--

CREATE TABLE `categorias_despesas` (
  `id` int(10) NOT NULL,
  `categoria` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) NOT NULL,
  `cartao` int(11) NOT NULL,
  `nome` varchar(999) NOT NULL,
  `ddd` varchar(999) NOT NULL,
  `telefone` varchar(99) NOT NULL,
  `celular` varchar(99) NOT NULL,
  `endereco` varchar(999) NOT NULL,
  `numero` varchar(999) NOT NULL,
  `cep` varchar(99) NOT NULL,
  `complemento` varchar(999) NOT NULL,
  `bairro` varchar(99) NOT NULL,
  `cidade` varchar(99) NOT NULL,
  `venda_avulsa` int(1) NOT NULL,
  `data_cadastro` date NOT NULL,
  `obs` text NOT NULL,
  `senha` varchar(99) NOT NULL,
  `internet` int(1) NOT NULL,
  `hash` varchar(200) NOT NULL,
  `codigo_renova_senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(10) NOT NULL,
  `senha_cancelamento` varchar(99) NOT NULL,
  `impressora_principal` varchar(99) NOT NULL,
  `impressora_secundaria` varchar(99) NOT NULL,
  `primeira_impressao` varchar(99) NOT NULL,
  `dividir_mesa_pessoas` int(10) NOT NULL,
  `modulo_internet` int(10) NOT NULL,
  `imprimir_endereco_entrega_cozinha` int(10) NOT NULL,
  `aviso_atualizacoes` int(10) NOT NULL,
  `modulo_fiscal` int(1) NOT NULL,
  `modulo_entregas` int(1) NOT NULL,
  `modulo_pontuacao` int(1) NOT NULL,
  `valor_real_ponto` double(10,2) NOT NULL,
  `valor_ponto_troca` double(10,2) NOT NULL,
  `dias_expira_pontos` int(10) NOT NULL,
  `escolhe_motoqueiro` int(10) NOT NULL,
  `impressao_avulsa_item` varchar(99) NOT NULL,
  `ordem_exibicao_produtos` varchar(20) NOT NULL,
  `categorias_mobile` int(1) NOT NULL,
  `fiscal_sempre_ativo` int(1) NOT NULL,
  `modulo_entregas_pedidos` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contas_clientes`
--

CREATE TABLE `contas_clientes` (
  `id` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_venda` int(10) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `valor_recebe` double(10,2) NOT NULL,
  `troco_passado` double(10,2) NOT NULL,
  `forma_pagamento` int(10) NOT NULL,
  `tipo` int(10) NOT NULL COMMENT '0=Debito, 1=Recebe',
  `data_pgto` datetime NOT NULL,
  `data_debito` datetime NOT NULL,
  `id_caixa_recebe` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_loja`
--

CREATE TABLE `dados_loja` (
  `id` int(10) NOT NULL,
  `cabecalho_linha01` varchar(999) NOT NULL,
  `cabecalho_linha02` varchar(99) NOT NULL,
  `cabecalho_linha03` varchar(999) NOT NULL,
  `razao` varchar(99) NOT NULL,
  `cnpj` varchar(30) NOT NULL,
  `inscricao_estadual` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_loja_internet`
--

CREATE TABLE `dados_loja_internet` (
  `id` int(10) NOT NULL,
  `nome_loja` varchar(99) NOT NULL,
  `tipo_comida` varchar(99) NOT NULL,
  `endereco_linha1` varchar(99) NOT NULL,
  `endereco_linha2` varchar(99) NOT NULL,
  `telefones_loja` varchar(99) NOT NULL,
  `imagem_topo` varchar(99) NOT NULL,
  `logo_topo` varchar(99) NOT NULL,
  `favicon_topo` varchar(99) NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `google` text NOT NULL,
  `sobre` text NOT NULL,
  `tempo_retirada` varchar(20) NOT NULL,
  `tipo_tempo_retirada` varchar(99) NOT NULL,
  `tempo_entrega` varchar(20) NOT NULL,
  `tipo_tempo_entrega` varchar(99) NOT NULL,
  `tipo_abertura_loja` varchar(25) NOT NULL,
  `loja_aberta_manual` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(10) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` int(10) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` int(10) NOT NULL,
  `valor` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dias_promocoes`
--

CREATE TABLE `dias_promocoes` (
  `id` int(10) NOT NULL,
  `dia` int(10) NOT NULL,
  `promocao` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos_clientes`
--

CREATE TABLE `enderecos_clientes` (
  `id` int(11) NOT NULL,
  `endereco` varchar(999) NOT NULL,
  `numero` varchar(99) NOT NULL,
  `complemento` varchar(999) NOT NULL,
  `bairro` varchar(999) NOT NULL,
  `cidade` varchar(999) NOT NULL,
  `cliente` int(10) NOT NULL,
  `tipo` varchar(99) NOT NULL,
  `data_cadastro` date NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `padrao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `entregadores`
--

CREATE TABLE `entregadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(999) NOT NULL,
  `telefone` varchar(999) NOT NULL,
  `ativo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fiscal`
--

CREATE TABLE `fiscal` (
  `id` int(10) NOT NULL,
  `chave_sat` text NOT NULL,
  `cnpj_desenvolvedor` varchar(99) NOT NULL,
  `versao_cfe` varchar(20) NOT NULL,
  `ncm_sistema` varchar(99) NOT NULL,
  `cst_sistema` varchar(99) NOT NULL,
  `cfop_sistema` varchar(99) NOT NULL,
  `caminho_acbr` varchar(999) NOT NULL,
  `csosn_sistema` varchar(10) NOT NULL,
  `impressora_fiscal` varchar(99) NOT NULL,
  `email_envio_xml` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fiscal_ncm`
--

CREATE TABLE `fiscal_ncm` (
  `id` int(10) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `imposto_nacional_federal` double(10,2) NOT NULL,
  `imposto_importados` double(10,2) NOT NULL,
  `imposto_estadual` double(10,2) NOT NULL,
  `versao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fiscal_relacao_csosn`
--

CREATE TABLE `fiscal_relacao_csosn` (
  `id` int(10) NOT NULL,
  `csosn_usado` int(10) NOT NULL,
  `cfop_usado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `formas_pagamento`
--

CREATE TABLE `formas_pagamento` (
  `id` int(10) NOT NULL,
  `forma` varchar(99) NOT NULL,
  `icone` varchar(99) NOT NULL,
  `ativo` int(10) NOT NULL,
  `convenio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `horarios_funcionamento`
--

CREATE TABLE `horarios_funcionamento` (
  `id` int(10) NOT NULL,
  `dia` int(10) NOT NULL,
  `abre` time NOT NULL,
  `fecha` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int(10) NOT NULL,
  `ingrediente` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingredientes_lanches`
--

CREATE TABLE `ingredientes_lanches` (
  `id` int(10) NOT NULL,
  `id_produto` int(10) NOT NULL,
  `id_ingrediente` int(10) NOT NULL,
  `ordem` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lanches`
--

CREATE TABLE `lanches` (
  `id` int(10) NOT NULL,
  `produto` varchar(999) NOT NULL,
  `foto` varchar(999) NOT NULL,
  `categoria` int(10) NOT NULL,
  `codigo` varchar(90) NOT NULL,
  `ativo` int(1) NOT NULL,
  `preco_composto` varchar(10) NOT NULL,
  `ncm` varchar(99) NOT NULL,
  `cst` varchar(99) NOT NULL,
  `cfop` varchar(99) NOT NULL,
  `csosn` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lanches_tamanhos_valores`
--

CREATE TABLE `lanches_tamanhos_valores` (
  `id` int(10) NOT NULL,
  `id_tamanho` int(10) NOT NULL,
  `id_produto` int(10) NOT NULL,
  `preco` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mesas`
--

CREATE TABLE `mesas` (
  `id` int(10) NOT NULL,
  `mesa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcionais`
--

CREATE TABLE `opcionais` (
  `id` int(10) NOT NULL,
  `opcional` varchar(999) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `ativo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcionais2`
--

CREATE TABLE `opcionais2` (
  `id` int(10) NOT NULL,
  `id_categoria` varchar(99) NOT NULL,
  `id_produto` text NOT NULL,
  `opcional2` varchar(99) NOT NULL,
  `valor_opcional2` double(10,2) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcionais_categorias_relacao`
--

CREATE TABLE `opcionais_categorias_relacao` (
  `id` int(11) NOT NULL,
  `id_opcional` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcionais_produtos_venda`
--

CREATE TABLE `opcionais_produtos_venda` (
  `id` int(10) NOT NULL,
  `id_venda` int(10) NOT NULL,
  `id_produto` varchar(99) NOT NULL,
  `id_opcional` int(11) NOT NULL,
  `valor_opcional` double(10,2) NOT NULL,
  `id_controle` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcionais_produtos_venda2`
--

CREATE TABLE `opcionais_produtos_venda2` (
  `id` int(10) NOT NULL,
  `id_venda` int(10) NOT NULL,
  `id_produto` varchar(99) NOT NULL,
  `id_opcional` int(11) NOT NULL,
  `valor_opcional` double(10,2) NOT NULL,
  `id_controle` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos_vendas`
--

CREATE TABLE `pagamentos_vendas` (
  `id` int(10) NOT NULL,
  `id_venda` int(10) NOT NULL,
  `forma_pagamento` int(10) NOT NULL,
  `valor_pagamento` double(10,2) NOT NULL,
  `troco_passado` double(10,2) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `id_caixa` int(10) NOT NULL,
  `valor_caixa_real` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pontuacao_usada`
--

CREATE TABLE `pontuacao_usada` (
  `id` int(10) NOT NULL,
  `data` date NOT NULL,
  `valor` double(10,2) NOT NULL,
  `equivalencia_ponto` double(10,2) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `qtd_pontos` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_caixa` int(10) NOT NULL,
  `id_venda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos_venda`
--

CREATE TABLE `produtos_venda` (
  `id` int(10) NOT NULL,
  `id_venda` int(10) NOT NULL,
  `id_produtos` varchar(99) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `observacoes` text NOT NULL,
  `quantidade` double(10,2) NOT NULL,
  `tamanho` int(10) NOT NULL,
  `categoria_produto` int(10) NOT NULL,
  `nome_cliente_divisao` varchar(99) NOT NULL,
  `impresso` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `promocoes`
--

CREATE TABLE `promocoes` (
  `id` int(10) NOT NULL,
  `produto` int(10) NOT NULL,
  `preco` double(10,2) NOT NULL,
  `ativo` int(1) NOT NULL,
  `categoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `saidas_caixa`
--

CREATE TABLE `saidas_caixa` (
  `id` int(10) NOT NULL,
  `id_caixa` int(10) NOT NULL,
  `valor_saida` double(10,2) NOT NULL,
  `motivo` varchar(999) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema`
--

CREATE TABLE `sistema` (
  `id` int(10) NOT NULL,
  `data_servidor` date NOT NULL,
  `versao` varchar(10) NOT NULL,
  `mensagem_retorno` text NOT NULL,
  `url_servidor` varchar(999) NOT NULL,
  `url_servidor_pedidos` varchar(999) NOT NULL,
  `aviso_update_internet` int(1) NOT NULL,
  `data_update_internet` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tamanhos`
--

CREATE TABLE `tamanhos` (
  `id` int(10) NOT NULL,
  `tamanho` varchar(99) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `opcao_obrigatoria` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_entrega`
--

CREATE TABLE `tipos_entrega` (
  `id` int(10) NOT NULL,
  `entrega` varchar(999) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `ativo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nome` varchar(999) NOT NULL,
  `usuario` varchar(999) NOT NULL,
  `senha` varchar(999) NOT NULL,
  `ativo` int(1) NOT NULL,
  `nivel` int(3) NOT NULL COMMENT '1=normal, 3= full',
  `online` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_admin`
--

CREATE TABLE `usuarios_admin` (
  `id` int(10) NOT NULL,
  `usuario` varchar(99) NOT NULL,
  `senha` varchar(99) NOT NULL,
  `nome` varchar(99) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `admin_mensagens_sistema`
--
ALTER TABLE `admin_mensagens_sistema`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `aguarda_venda`
--
ALTER TABLE `aguarda_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias_despesas`
--
ALTER TABLE `categorias_despesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contas_clientes`
--
ALTER TABLE `contas_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dados_loja`
--
ALTER TABLE `dados_loja`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dados_loja_internet`
--
ALTER TABLE `dados_loja_internet`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dias_promocoes`
--
ALTER TABLE `dias_promocoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `enderecos_clientes`
--
ALTER TABLE `enderecos_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `entregadores`
--
ALTER TABLE `entregadores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fiscal`
--
ALTER TABLE `fiscal`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fiscal_ncm`
--
ALTER TABLE `fiscal_ncm`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fiscal_relacao_csosn`
--
ALTER TABLE `fiscal_relacao_csosn`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `horarios_funcionamento`
--
ALTER TABLE `horarios_funcionamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ingredientes_lanches`
--
ALTER TABLE `ingredientes_lanches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lanches`
--
ALTER TABLE `lanches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lanches_tamanhos_valores`
--
ALTER TABLE `lanches_tamanhos_valores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `opcionais`
--
ALTER TABLE `opcionais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `opcionais2`
--
ALTER TABLE `opcionais2`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `opcionais_categorias_relacao`
--
ALTER TABLE `opcionais_categorias_relacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `opcionais_produtos_venda`
--
ALTER TABLE `opcionais_produtos_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `opcionais_produtos_venda2`
--
ALTER TABLE `opcionais_produtos_venda2`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pagamentos_vendas`
--
ALTER TABLE `pagamentos_vendas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos_venda`
--
ALTER TABLE `produtos_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `promocoes`
--
ALTER TABLE `promocoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `saidas_caixa`
--
ALTER TABLE `saidas_caixa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tamanhos`
--
ALTER TABLE `tamanhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipos_entrega`
--
ALTER TABLE `tipos_entrega`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `admin_mensagens_sistema`
--
ALTER TABLE `admin_mensagens_sistema`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `aguarda_venda`
--
ALTER TABLE `aguarda_venda`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias_despesas`
--
ALTER TABLE `categorias_despesas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas_clientes`
--
ALTER TABLE `contas_clientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dados_loja`
--
ALTER TABLE `dados_loja`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dados_loja_internet`
--
ALTER TABLE `dados_loja_internet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dias_promocoes`
--
ALTER TABLE `dias_promocoes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `enderecos_clientes`
--
ALTER TABLE `enderecos_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fiscal`
--
ALTER TABLE `fiscal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fiscal_ncm`
--
ALTER TABLE `fiscal_ncm`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fiscal_relacao_csosn`
--
ALTER TABLE `fiscal_relacao_csosn`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `horarios_funcionamento`
--
ALTER TABLE `horarios_funcionamento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ingredientes_lanches`
--
ALTER TABLE `ingredientes_lanches`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lanches`
--
ALTER TABLE `lanches`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lanches_tamanhos_valores`
--
ALTER TABLE `lanches_tamanhos_valores`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `opcionais`
--
ALTER TABLE `opcionais`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `opcionais2`
--
ALTER TABLE `opcionais2`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `opcionais_categorias_relacao`
--
ALTER TABLE `opcionais_categorias_relacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `opcionais_produtos_venda`
--
ALTER TABLE `opcionais_produtos_venda`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `opcionais_produtos_venda2`
--
ALTER TABLE `opcionais_produtos_venda2`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamentos_vendas`
--
ALTER TABLE `pagamentos_vendas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos_venda`
--
ALTER TABLE `produtos_venda`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `promocoes`
--
ALTER TABLE `promocoes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `saidas_caixa`
--
ALTER TABLE `saidas_caixa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sistema`
--
ALTER TABLE `sistema`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tamanhos`
--
ALTER TABLE `tamanhos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipos_entrega`
--
ALTER TABLE `tipos_entrega`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `usuarios_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
