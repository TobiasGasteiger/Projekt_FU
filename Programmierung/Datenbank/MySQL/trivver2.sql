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
			END if;
	 END LOOP get_teacher;
	 CLOSE teacher_cursor; 
END;$$
DELIMITER ;


 