TRIGGER:

Wenn Prof. FÜ eingetragen ist -> Hat Prof. da Unterricht oder nicht -> Count 0 oder +1

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
	end;//
delimiter ;


Wenn FÜ Stunde eingetragen ist -> ist Prof. der Unterricht haben müsste anwesend oder nicht -> Count -1 oder 0

delimiter //
create trigger is_teacher_present after insert on Event for each row
	begin 
		declare klasse = select SchoolClass from EventwithSchoolClass where Event_ID = New.Event_ID;
		if 
		
		
