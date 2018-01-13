DROP PROCEDURE IF EXISTS create_tables;
DROP PROCEDURE IF EXISTS find_user_by_email;
DROP PROCEDURE IF EXISTS create_user;

DELIMITER |
CREATE PROCEDURE create_tables () 
BEGIN 
    CREATE TABLE users (id INT PRIMARY KEY AUTO_INCREMENT, email VARCHAR(50), username VARCHAR(50) UNIQUE);
END
|
CREATE PROCEDURE find_user_by_email
(IN email_str VARCHAR(100))
BEGIN
    SELECT * FROM users WHERE email=email_str;
END
|

CREATE PROCEDURE create_user
(IN email_str VARCHAR(100), IN password_str VARCHAR(100))
BEGIN
    INSERT INTO users VALUES (email_str, password_str);
END |
DELIMITER ;


CALL create_tables();