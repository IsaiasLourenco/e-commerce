-- **************************
-- ALTERAÇÕES TABELA VENDAS
-- **************************
ALTER TABLE venda ADD COLUMN status_venda VARCHAR(20);
ALTER TABLE venda MODIFY COLUMN valor DECIMAL(10,2);

ALTER TABLE venda DROP COLUMN usuario;
ALTER TABLE venda ADD COLUMN cliente INT(11);


SELECT constraint_name 
FROM information_schema.KEY_COLUMN_USAGE 
WHERE table_name = 'venda' 
AND column_name = 'usuario';


#ALTER TABLE venda DROP FOREIGN KEY venda_ibfk_3;


ALTER TABLE venda 
ADD CONSTRAINT fk_vendas_clientes  FOREIGN KEY (cliente) REFERENCES clientes(id) 
ON DELETE CASCADE;

ALTER TABLE venda MODIFY column status_venda VARCHAR(20) AFTER cliente

-- **************************
-- ALTERAÇÕES TABELA CLIENTES
-- **************************

ALTER TABLE clientes ADD column perfil INT(11);

ALTER TABLE clientes 
ADD CONSTRAINT fk_clientes_perfil  FOREIGN KEY (perfil) REFERENCES perfil(id) 
ON DELETE CASCADE;

UPDATE clientes SET perfil = 2

-- ************************** 
--     SCRIPTS DASHBOARD
-- **************************

--INDICADORES
SELECT 
    sum(valor) AS FATURAMENTO,  
    (SELECT count(*) FROM venda) AS totalvendas, 
    (sum(valor) / nullif((SELECT count(*) FROM venda), 0)) AS ticketmedio
FROM venda;  

-- PRODUTOS MAIS VENDidOS

SELECT 
    p.id, 
    p.nome, 
    sum(i.quantidade) AS quantidade
FROM itens_venda I  
inner join produto p on p.id = i.produto
GROUP BY 1,2 
ORDER BY 3 DESC
LIMIT 10;


-- VENDAS POR MÊS
SELECT 
    sum(valor) AS total, 
    DATE(datavenda) AS data_venda
FROM venda
GROUP BY data_venda
ORDER BY total DESC;

-- CATEGORIAS MAIS VENDidAS
SELECT  
    p.categoria, 
    c.descricao, 
    sum(i.quantidade) AS total
FROM itens_venda I  
INNER JOIN produto p ON p.id = i.produto  
INNER JOIN categoria C ON c.id = p.categoria
GROUP BY 1,2
ORDER BY 3 DESC;
