--
-- Estrutura para tabela `adicioinais por categoria`
--

CREATE TABLE `opcionais_categorias_relacao` (
  `id` int(11) NOT NULL,
  `id_opcional` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `opcionais_categorias_relacao`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `opcionais_categorias_relacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT; 

--
-- Estrutura para tabela `horarios de funcionamento`
--

CREATE TABLE `horarios_funcionamento` (
  `id` int(10) NOT NULL,
  `dia` int(10) NOT NULL,
  `abre` time NOT NULL,
  `fecha` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `horarios_funcionamento` (`id`, `dia`, `abre`, `fecha`) VALUES
(2, 1, '00:00:00', '00:00:00'),
(3, 2, '00:00:00', '00:00:00'),
(4, 3, '00:00:00', '00:00:00'),
(5, 4, '00:00:00', '00:00:00'),
(6, 5, '00:00:00', '00:00:00'),
(7, 6, '00:00:00', '00:00:00'),
(8, 7, '00:00:00', '00:00:00');

ALTER TABLE `horarios_funcionamento`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `horarios_funcionamento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;  



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
  `tipo_tempo_entrega` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `dados_loja_internet` (`id`, `nome_loja`, `tipo_comida`, `endereco_linha1`, `endereco_linha2`, `telefones_loja`, `imagem_topo`, `logo_topo`, `favicon_topo`, `facebook`, `instagram`, `google`, `sobre`, `tempo_retirada`, `tipo_tempo_retirada`, `tempo_entrega`, `tipo_tempo_entrega`) VALUES
(1, 'Nome do Estabelecimento', 'Tipos de Produtos', 'Endereço', 'Bairro, Cidade', 'Telefones', 'topo.jpg', 'logo.jpg', 'favicon.png', 'face', 'insta', 'google', 'Descrição do Estabelecimento', '00', 'minutos', '00:00', 'horas');


ALTER TABLE `dados_loja_internet`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `dados_loja_internet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT; 


--
-- Estrutura para tabela `pontuacao`
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


--
-- Estrutura para tabela `fiscal`
--

CREATE TABLE `fiscal` (
  `id` int(10) NOT NULL,
  `chave_sat` text NOT NULL,
  `cnpj_desenvolvedor` varchar(99) NOT NULL,
  `versao_cfe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `fiscal` (`id`, `chave_sat`, `cnpj_desenvolvedor`, `versao_cfe`) VALUES
(1, '', '', '');


ALTER TABLE `fiscal`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `fiscal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;


--
-- Estrutura para tabela `categorias_despesas`
--

CREATE TABLE `categorias_despesas` (
  `id` int(10) NOT NULL,
  `categoria` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `categorias_despesas` (`id`, `categoria`) VALUES
(1, 'MERCADO'),
(2, 'OUTROS'),
(3, 'FUNCIONÁRIOS');


ALTER TABLE `categorias_despesas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categorias_despesas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;


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


ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `despesas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;



--
-- ingredientes
--

CREATE TABLE `ingredientes` (
  `id` int(10) NOT NULL,
  `ingrediente` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `ingredientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;



--
-- ingredientes produtos
--

CREATE TABLE `ingredientes_lanches` (
  `id` int(10) NOT NULL,
  `id_produto` int(10) NOT NULL,
  `id_ingrediente` int(10) NOT NULL,
  `ordem` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `ingredientes_lanches`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `ingredientes_lanches`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;
