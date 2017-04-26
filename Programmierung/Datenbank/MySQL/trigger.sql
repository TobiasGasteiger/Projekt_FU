TRIGGER:

Wenn Prof. FÜ eingetragen ist -> Hat Prof. da Unterricht oder nicht -> Count 0 oder +1

delimiter //
create trigger has_teacher_lesson after insert on EventwithTeacher for each row
	begin
		declare guthaben int = 1;
		declare tname varchar(255) = New.EventwithTeacher.Teacher_Name;
		if tname = any(select Teacher_Name as tn from EventwithTeacher as et natural join Event as e natural join 
			Timetable as tt where e.Begin_Hour <= t.SchoolHour and where e.End_Hour >= t.SchoolHour and where t.SchoolDay = weekday(e.Date)
			then set guthaben = 0;
		end if;
		update Teacher set Credit = Credit + guthaben where tname like Teacher.Teacher_Name;
	end;//
delimiter ;
		

Wenn FÜ Stunde eingetragen ist -> ist Prof. der Unterricht haben müsste anwesend oder nicht -> Count -1 oder 0

delimiter //
create trigger is_teacher_present after insert on Event for each row
	begin 
		