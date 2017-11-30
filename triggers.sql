DELIMITER $$
CREATE TRIGGER `t1`
BEFORE INSERT ON `ClassesWork`
FOR EACH ROW
BEGIN
    IF 100.00 != ( SELECT SUM(`weight`) FROM `WeightOfGrades` WHERE `cid` = `new`.`cid` ) THEN
        SIGNAL SQLSTATE '45000' SET message_text = 'Class must total to 100% before a student can do any work';
    END IF;
END$$
DELIMITER ;
