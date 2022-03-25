CREATE TABLE `produto` (
  `codigo` int(6) NOT NULL,
  `codigoSubcategoria` int(6) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `subcategoria` (
  `codigo` int(6) NOT NULL,
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigo`);

ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`codigo`);

ALTER TABLE `produto`
  MODIFY `codigo` int(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `subcategoria`
  MODIFY `codigo` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;