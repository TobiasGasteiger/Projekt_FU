-- TRIGGER:

-- TRIGGER 1: Guthaben aktualisieren, wenn der Lehrer eine Stunde hat oder nicht
delimiter //
create trigger has_teacher_lesson after insert on EventwithTeacher for each row
	begin
		declare guthaben int;
		declare teacherName varchar(255);
		declare nowHour int;
		declare hours int;
		set teacherName = New.Teacher_Name;
		set nowHour = (select Begin_Hour from Event where Event_ID = New.Event_ID);
		set hours = (select (End_Hour - Begin_Hour + 1) from Event where Event_ID = New.Event_ID);
		set guthaben = hours;
		while hours >= 0 do 
			if teacherName = any(select Teacher_Name as tn from EventwithTeacher as et natural join Event as e natural join 
			Timetable as tt where tt.SchoolHour = nowHour and tt.SchoolDay = weekday(e.Date))
			then set guthaben = guthaben - 1;
			end if;
			set hours = hours - 1;
			set nowHour = nowHour + 1;
		end while;
		update Teacher set Credit = Credit + guthaben where Teacher.Teacher_Name = teacherName;
		insert into TeacherGotCredit(Event_ID, Teacher_Name, CreditChange) values(New.Event_ID, teacherName, guthaben);
	end;//
delimiter ;

-- TRIGGER 2: Guthaben aktualisieren, wenn der Lehrer Unterricht haben müsste und anwesend oder nicht
DELIMITER $$
create trigger is_teacher_present after insert on EventwithSchoolClass for each row
	begin
		DECLARE teacher_finished INTEGER DEFAULT 0;
		DECLARE teacherName varchar(255) DEFAULT "";
		DECLARE guthaben int; 
		-- Cursor für alle Lehrer welche zu einer gewissen Zeit in der gewissen Klasse unterichten (während des Event)
		DEClARE teacher_cursor CURSOR FOR 
		select distinct Teacher_Name from Timetable where SchoolDay = (select weekday(Date) from Event natural join EventwithSchoolClass where Event_ID = New.Event_ID)
			and SchoolHour between (select Begin_Hour from Event natural join EventwithSchoolClass where Event_ID = New.Event_ID) 
			and (select End_Hour from Event natural join EventwithSchoolClass where Event_ID = New.Event_ID);
	 
		-- declare NOT FOUND handler
		DECLARE CONTINUE HANDLER 
			FOR NOT FOUND SET teacher_finished = 1;
	 
	 
		OPEN teacher_cursor;
		get_teacher: LOOP
			FETCH teacher_cursor INTO teacherName;
			IF teacher_finished = 1 THEN 
				LEAVE get_teacher;
			END IF;
			-- Wenn der Lehrer nicht in der Tablelle enthalten ist, wo die Lehrer enthalten sind, welche beim FÜ die Aufsicht haben
			if teacherName not in(select Teacher_Name from Event natural join EventwithTeacher where Event_ID = new.Event_ID)
			then 
				set guthaben = (select Anzahl_Stunden from 
							(select Teacher_Name, count(Teacher_Name) as Anzahl_Stunden from Timetable where SchoolDay = (select weekday(Date) from Event natural join EventwithSchoolClass where Event_ID = new.Event_ID)
							and SchoolHour between (select Begin_Hour from Event natural join EventwithSchoolClass where Event_ID = new.Event_ID) 
							and (select End_Hour from Event natural join EventwithSchoolClass where Event_ID = new.Event_ID)  
							and Teacher_name = teacherName group by Teacher_Name) as stundenundlehrer
							where Teacher_Name = teacherName);
			update Teacher set Credit = Credit - guthaben where Teacher.Teacher_Name = teacherName;
			insert into TeacherGotCredit(Event_ID, Teacher_Name, CreditChange) values(New.Event_ID, teacherName, guthaben*(-1));
			END if;
	 END LOOP get_teacher;
	 CLOSE teacher_cursor; 
END;$$
DELIMITER ;
	
-- TRIGGER 3: Wenn Eevent gelöscht wird Guthaben zuruücksetzen und Werte aus TeacherGotCreadit löschen
DELIMITER $$
create trigger is_event_deleted before delete on Event for each row
	BLOCK1: BEGIN
		DECLARE teacher_finished INTEGER DEFAULT 0;
		DECLARE teacherName varchar(255);
		DECLARE credit_Change INTEGER;
		-- Cursor für alle Lehrer wo sich der Credit durch das Event gändert hat
		DEClARE teacher_cursor CURSOR FOR
			select Teacher_Name from TeacherGotCredit where Event_ID = old.Event_ID;
		-- declare NOT FOUND handler
		DECLARE CONTINUE HANDLER 
			FOR NOT FOUND SET teacher_finished = 1;
			
		OPEN teacher_cursor;
			get_teacher: LOOP
				FETCH teacher_cursor INTO teacherName;
				IF teacher_finished = 1 THEN 
					LEAVE get_teacher;
				END IF;
				
				BLOCK2: BEGIN
					DECLARE teacherCreditChange_finished INTEGER DEFAULT 0;
					-- Cursor für alle Guthabeneinträge welche eingetragen wurden
					DEClARE teacherCreditChange_cursor CURSOR FOR
						select CreditChange from TeacherGotCredit where Event_ID = old.Event_ID and Teacher_Name = teacherName;
					-- declare NOT FOUND handler
					DECLARE CONTINUE HANDLER 
						FOR NOT FOUND SET teacherCreditChange_finished = 1;
					
					OPEN teacherCreditChange_cursor;
					get_CreditChange: LOOP
						FETCH teacherCreditChange_cursor INTO credit_Change;
						IF teacherCreditChange_finished = 1 THEN 
							LEAVE get_CreditChange;
						END IF;
						update Teacher set Credit = Credit - credit_Change where Teacher_Name = teacherName;
					END LOOP get_CreditChange;
					CLOSE teacherCreditChange_cursor;
				END BLOCK2;
			END LOOP get_teacher;
		CLOSE teacher_cursor;
		delete from TeacherGotCredit where Event_ID = old.Event_ID;
	END BLOCK1; $$
DELIMITER ;