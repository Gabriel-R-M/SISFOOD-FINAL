
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
