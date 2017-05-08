DELIMITER $$
create trigger is_event_deleted before delete on Event for each row
	BLOCK1 BEGIN
		DECLARE teacher_finished INTEGER DEFAULT 0;
		DECLARE teacherName varchar(255);
		DECLARE credit_Change INTEGER;
		-- Cursor für alle Lehrer wo sich der Credit durch das Event gändert hat
		DEClARE teacher_cursor CURSOR FOR
			select Techer_Name from TeacherGotCreadit where Event_ID = old.Event_ID;
		-- declare NOT FOUND handler
		DECLARE CONTINUE HANDLER 
			FOR NOT FOUND SET teacher_finished = 1;
			
		OPEN teacher_cursor;
			get_teacher: LOOP
				FETCH teacher_cursor INTO teacherName;
				IF teacher_finished = 1 THEN 
					LEAVE get_teacher;
				END IF;
				
				BLOCK2 BEGIN
					DECLARE teacherCreditChange_finished INTEGER DEFAULT 0;
					-- Cursor für alle Guthabeneinträge welche eingetragen wurden
					DEClARE teacherCreditChange_cursor CURSOR FOR
						select CreditChange from TeacherGotCreadit where Event_ID = old.Event_ID and Teacher_Name = teacherName;
					-- declare NOT FOUND handler
					DECLARE CONTINUE HANDLER 
						FOR NOT FOUND SET teacherCreditChange_finished = 1;
					
					OPEN teacherCreditChange_cursor;
					get_CreditChange: LOOP
						FETCH teacherCreditChange_cursor INTO credit_Change;
						IF teacher_finished = 1 THEN 
							LEAVE get_CreditChange;
						END IF;
						update Teacher set Creadit = Credit - credit_Change where Teacher_Name = teacherName;
					END LOOP get_CreditChange;
				END BLOCK2;
			END LOOP get_teacher;
		CLOSE teacher_cursor;		
	BLOCK1 END;$$
DELIMITER ;






