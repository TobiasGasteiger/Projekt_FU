insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (1, "07:50:00", "08:40:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (2, "08:40:00", "09:30:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (3, "09:35:00", "10:25:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (4, "10:25:00", "11:15:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (5, "11:30:00", "12:20:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (6, "12:20:00", "13:10:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (7, "14:10:00", "15:00:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (8, "15:00:00", "15:50:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (9, "15:50:00", "16:40:00");

insert into SchoolDay values(0, 'Montag');
insert into SchoolDay values(1, 'Dienstag');
insert into SchoolDay values(2, 'Mittwoch');
insert into SchoolDay values(3, 'Donnerstag');
insert into SchoolDay values(4, 'Freitag');

insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Deutsch', '5BT', 'Brunner Ulrike', 0, 1);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Deutsch', '5BT', 'Brunner Ulrike', 0, 2);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Englisch', '5BT', 'Egger Alexandra', 0, 3);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Informatik', '5BT', 'Plank Josef', 0, 4);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Informatik', '5BT', 'Plank Josef', 0, 5);
insert into Timetable (Subject_Description, SchoolClass_Description, Teacher_Name, SchoolDay, SchoolHour) values ('Italienisch', '5BT', 'Russo Anni', 0, 6);

insert into TeachedBy (Subject_Description, Teacher_Name) values ('Deutsch','Brunner Ulrike');
insert into TeachedBy (Subject_Description, Teacher_Name) values ('Englisch','Egger Alexandra');
insert into TeachedBy (Subject_Description, Teacher_Name) values ('Informatik','Plank Josef');
insert into TeachedBy (Subject_Description, Teacher_Name) values ('Italienisch','Russo Anni');

insert into Event (Titel, Description, Date, Person, Begin_Hour, End_Hour) values ('Kochen', 'Kochen mit Lebensmittel', '2017-04-28', 'Koch', 1, 2);
insert into Event (Titel, Description, Date, Person, Begin_Hour, End_Hour) values ('Kochen 2', 'Kochen mit nichts', '2017-04-29', 'Koch 2', 1, 2);


insert into EventwithTeacher values (3, 'Brunner Ulrike');
insert into EventwithTeacher values (3, 'Plank Josef');

3, 6 --> 6-3 +1 = 4
1, 7 --> 7-1 +1 = 7
