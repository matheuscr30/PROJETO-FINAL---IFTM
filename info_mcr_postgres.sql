-- Estrutura da tabela  cad_comentarios 
DROP TABLE IF EXISTS cad_comentarios;
CREATE TABLE IF NOT EXISTS cad_comentarios (
  codigo_receita int PRIMARY KEY,
  texto text NOT NULL,
  nome_usuario varchar(60) NOT NULL
);

-- Estrutura da tabela  cad_receitas 
DROP TABLE IF EXISTS cad_receitas;
CREATE TABLE IF NOT EXISTS cad_receitas (
  codigo_receita SERIAL PRIMARY KEY,
  nome_receita varchar(60) NOT NULL,
  tempo varchar(60) NOT NULL,
  ingredientes text NOT NULL,
  modo_preparo text NOT NULL,
  foto text NOT NULL,
  tipo_receita varchar(60) NOT NULL
);

-- Extraindo dados da tabela  cad_receitas 
INSERT INTO  cad_receitas  (nome_receita ,  tempo ,  ingredientes ,  modo_preparo ,  foto ,  tipo_receita ) VALUES
('Bolo de Chocolate Caseiro', '01h 00min', 'Massa:\r\n•4 ovos\r\n•4 colheres de sopa de chocolate em pó\r\n•2 colheres de sopa de manteiga\r\n•3 xícaras de farinha de trigo\r\n•2 xícaras de açúcar\r\n•2 colheres de chá de fermento\r\n•1 xícara de leite\r\n\r\nCalda:\r\n•2 colheres de sopa de manteiga\r\n•7 colheres de sopa de chocolate em pó\r\n•2 latas de creme de leite com soro\r\n•3 colheres de sopa de açúcar\r\ncar', 'Massa: \r\n1.Bata todos os ingredientes por 5 minutos (menos o fermento)\r\n2.Adicione o fermento e misture com uma espÃ¡tula delicadamente\r\n3.Coloque em uma forma untada e asse por 40 minutos\r\n\r\nCalda: \r\n1.AqueÃ§a a manteiga e misture o chocolate em pó que esteja homogeneo\r\n2.Acrescente o creme de leite e misture bem\r\n3.Desligue o fogo e acrescente o aÃ§Ãºcar', 'imagens/bolo-chocolate-caseiro.jpg', 'bolos e tortas'),
('Bolo de Cenoura', '01h 00min', '•1/2 xícara (chá) de óleo\n•3 cenouras médias raladas\n•4 ovos\n•2 xícaras (chá) de açúcar\n•2 e 1/2 xícaras (chá) de farinha de trigo\n•1 colher (sopa) de fermento em pó Dr. Oetker\n\nCobertura\n•1 colher (sopa) de manteiga\n•3 colheres (sopa) de chocolate em pó Dr. Oetker\n•1 xícara (chá) de açúcar\n•Se desejar uma cobertura molinha coloque 5 colheres de leite\n', 'Massa:\n1.Bata no liquidificador primeiro a cenoura com os ovos e o Ã³leo, acrescente o aÃ§Ãºcar e bata por uns 5 minutos\n2.Depois numa tigela ou na batedeira, coloque o restante dos ingredientes misturando tudo, menos o fermento\n3.Esse Ã© misturado lentamente com uma colher\n4.Asse em forno preaquecido (180Â°C) por 40 minutos\n\nPara a Cobertura:\n1.Misture todos os ingredientes, leve ao fogo, faÃ§a uma calda e coloque por cima do bolo\n2.Se o seu liquidificador for bem potente, o bolo todo pode ser feito nele\n3.VocÃª poderÃ¡ seguir ao vÃ­deo ou a receita escrita, o resultado serÃ¡ perfeito dos 2 modos\n4.Utilize cerca de 250 g de cenoura para o bolo nÃ£o solar\n', 'imagens/bolo-cenoura.jpg', 'bolos e tortas'),
('Hamburguer Gourmet da Abimapi', '20 min', '•4 pães para hambúrguer\n•4 hambúrgueres\n•4 porções de creme refrescante\n•fatias de tomate ao seu gosto\n•fatias de cebola roxa ao seu gosto\n•400 g de carne (patinho ou coxão mole) moída\n•200 g de carne fraldinha moída\n•sal e pimenta-do-reino moída na hora ao seu gosto\n•1 pepino japonês cortado em cubos bem pequenos e escorrido em peneira\n•1 colher (sopa) de folhas de hortelã bem picadas\n•2 colheres (sopa) de cebola roxa bem picada\n•1/2 dente pequeno de alho amassado\n•1 colher (chá) de suco de limão\n•sal e pimenta-do-reino branca ao seu gosto\n', '1.Misture as carnes, dívida em quatro porções, faça bolinhas e achate-as bem para dar o formato de hambúrguer\n2.Tempere com sal e pimenta ao seu gosto\n3.Asse os hambúrgueres em um grill ou frite ao seu gosto\n4.Corte os pães, coloque um hambúrguer em uma das partes, uma porção de creme refrescante, fatias de tomate a gosto, fatias de cebola e cubra com a outra parte de pão\n5.Decore ao seu gosto e sirva com salada de agrião e alface', 'imagens/hamburguer-gourmet-da-abimapi.jpg', 'carnes e peixes');

-- Estrutura da tabela  cad_usuarios 
DROP TABLE IF EXISTS cad_usuarios;
CREATE TABLE IF NOT EXISTS cad_usuarios (
  codigo SERIAL PRIMARY KEY,
  nome varchar(60) NOT NULL,
  email varchar(60) NOT NULL,
  cpf varchar(11) NOT NULL,
  senha varchar(8) NOT NULL
);

-- Extraindo dados da tabela  cad_usuarios 
INSERT INTO  cad_usuarios  ( codigo ,  nome ,  email ,  cpf ,  senha ) VALUES
(1, 'Matheus', 'matheuscunhareis30@gmail.com', '11410238652', 'tami2230');
