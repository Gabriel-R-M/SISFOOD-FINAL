
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