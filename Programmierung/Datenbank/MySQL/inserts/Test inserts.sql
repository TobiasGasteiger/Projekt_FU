-- MONTAG
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Deutsch', '5B', 'Abrim Elda', 0, 1);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Deutsch', '5B', 'Abrim Elda', 0, 2);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Englisch', '5B', 'Alper Thomas', 0, 3);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Informatik', '5B', 'Amort Erich', 0, 4);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Informatik', '5B', 'Amort Erich', 0, 5);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Italienisch', '5B', 'Amplatz Werner', 0, 6);

-- DIENSTAG
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Technologie und Planung', '5B', 'Burger Rita', 1, 1);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Geschichte', '5B', 'Brunner Ulrike', 1, 2);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Projektmanagement', '5B', 'Brugger Andreas', 1, 3);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Projektmanagement', '5B', 'Brugger Andreas', 1, 4);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Religion', '5B', 'Brugger Johann', 1, 5);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Italienisch', '5B', 'Amplatz Werner', 1, 6);

-- EVENTS
insert into Event(Titel, Description, Date, Person, Begin_Hour, End_Hour) values ('Kochen', 'Kochen mit Lebensmittel', '2017-05-15', 'Koch', 1, 4);
insert into Event(Titel, Description, Date, Person, Begin_Hour, End_Hour) values ('Kochen 2', 'Kochen mit Lebensmittel 2', '2017-05-16', 'Koch', 3, 6);

-- EVENT WITH TEACHER
insert into EventwithTeacher values (3, 'Abrim Elda');
insert into EventwithTeacher values (3, 'Amort Erich');

insert into EventwithTeacher values (4, 'Abrim Elda');
insert into EventwithTeacher values (4, 'Amplatz Werner');

-- EVENT WITH CLASS
insert into EventwithSchoolClass values (3, '5B');
insert into EventwithSchoolClass values (4, '5B');

