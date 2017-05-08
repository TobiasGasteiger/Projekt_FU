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

Alle Lehrer finden, welche während dieser Zeit(Stunden, Wochentag) in der Klasse unterricht hätten
--select weekday(Date) from Event natural join EventwithSchoolClass where Event_ID = 2;
select Teacher_Name from Timetable where SchoolDay = (select weekday(Date) from Event natural join EventwithSchoolClass where Event_ID = 2)
	and SchoolHour between (select Begin_Hour from Event natural join EventwithSchoolClass where Event_ID = 2)
				   and (select End_Hour from Event natural join EventwithSchoolClass where Event_ID = 2)
Alle Lehrer finden welche im FÜ enthalten sind
select Teacher_Name from Event natural join EventwithTeacher where Event_ID = 2;
Ist ein Lehrer nicht in FÜ und müsste zu einer gewissen Stunde unterrichten -1
Ansonsten nichts ändern



delimiter //
create trigger is_teacher_present after insert on EventwithSchoolClass for each row
	begin
		declare guthaben int;
		declare nowHour int;
		declare hours int;
		set nowHour = (select Begin_Hour from Event where Event_ID = New.Event_ID);
		set hours = (select (End_Hour - Begin_Hour + 1) from Event where Event_ID = New.Event_ID);
		set guthaben = hours * (-1);
		while hours >= 0 do 
			if (select Teacher_Name from EventwithTeacher natural join Event as e natural join Timetable as tt where SchoolClass_Description = new.SchoolClass_Description 
			and tt.SchoolHour = nowHour)
			then set guthaben = guthaben + 1;
			end if;
			set hours = hours - 1;
			set nowHour = nowHour + 1;
		end while;
		update Teacher set Credit = Credit + guthaben where Teacher.Teacher_Name = teacherName;
	end;//
delimiter ;

select Teacher_Name from EventwithTeacher natural join Event as e natural join Timetable as tt where SchoolClass_Description = new.SchoolClass_Description 
	and tt.SchoolHour between e.Begin_Hour and e.End_Hour
	
select Teacher_Name from Event natural join EventwithSchoolClass natural join Timetable where SchoolClass_Description = new.SchoolClass_Description
	and 
	
	
	
	
	FÜ			Unterricht
	abrim		alper
	abrim		abrim
	apler		abrim
	
