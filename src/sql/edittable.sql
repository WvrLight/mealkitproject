DELETE FROM Orders
WHERE id > 1;

ALTER SEQUENCE orders_id_seq RESTART WITH 2