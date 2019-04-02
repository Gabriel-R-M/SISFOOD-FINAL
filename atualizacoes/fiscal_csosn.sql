--
-- Estrutura para tabela `fiscal_relacao_csosn`
--

CREATE TABLE `fiscal_relacao_csosn` (
  `id` int(10) NOT NULL,
  `csosn_usado` int(10) NOT NULL,
  `cfop_usado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `fiscal_relacao_csosn`
--

INSERT INTO `fiscal_relacao_csosn` (`id`, `csosn_usado`, `cfop_usado`) VALUES
(1, 102, 5102),
(2, 500, 5405);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `fiscal_relacao_csosn`
--
ALTER TABLE `fiscal_relacao_csosn`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `fiscal_relacao_csosn`
--
ALTER TABLE `fiscal_relacao_csosn`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
