CREATE TABLE IF NOT EXISTS messages(
    id INT AUTO_INCREMENT,
    header VARCHAR(256),
    author VARCHAR(256),
    foreword VARCHAR(512),
    body VARCHAR(1024),
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS comments(
	id INT AUTO_INCREMENT,
    comment VARCHAR(512),
    message_id INT NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(message_id) REFERENCES messages(id)
);

DELIMITER $$

SET @foreword = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias neque itaque culpa, ipsam soluta omnis inventore rerum nisi ab facere, repudiandae aperiam incidunt quasi explicabo at ratione, quae labore quia!';

SET @body = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias neque itaque culpa, ipsam soluta omnis inventore rerum nisi ab facere, repudiandae aperiam incidunt quasi explicabo at ratione, quae labore quia! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias neque itaque culpa, ipsam soluta omnis inventore rerum nisi ab facere, repudiandae aperiam incidunt quasi explicabo at ratione, quae labore quia!';

SET @comment = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias neque itaque culpa, ipsam soluta omnis inventore rerum nisi ab facere, repudiandae aperiam incidunt quasi explicabo at ratione, quae labore quia!';

CREATE PROCEDURE seed()
BEGIN
    SET @i = 1;
    WHILE @i <= 10 DO
        INSERT INTO messages(header, author, foreword, body) VALUES
        (CONCAT('header', @i), CONCAT('author', @i), CONCAT(@foreword, @i), CONCAT(@body, @i));

        SET @j = 1;
        WHILE @j <= 3 DO
            INSERT INTO comments(comment, message_id) VALUES
            (CONCAT(@comment, @j, '.', @i), @i);
            SET @j = @j + 1;
        END WHILE;
        
        SET @i = @i + 1;
    END WHILE;
END$$

DELIMITER ;

CALL seed();