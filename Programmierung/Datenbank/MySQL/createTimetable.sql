create table SchoolHour(
	Hour int not null,
	Begin_Hour time not null,
	End_Hour time not null,
	Primary Key (Hour)
);

create table Subject (
	Subject_Description varchar(255) not null,
	Primary Key(Subject_Description)
);

-- Der Lehrer besitzt einen Namen, in welchem der Vor und Nachname abgespeichert werden
create table Teacher (
	Teacher_Name varchar(255) not null,
	Password varchar(255),
	Credit int not null default 0,
	Primary Key(Teacher_Name)
);

create table SchoolClass (
	SchoolClass_Description varchar(255) not null,
	Primary Key(SchoolClass_Description)
);

create table Timetable(
	Subject_Description varchar(255) not null,
	SchoolClass_Description varchar(255) not null,
	Teacher_Name varchar(255) not null,
	SchoolDay ENUM('Montag', 'Dienstag', 'Mitwoch', 'Donnerstag', 'Freitag') not null,
	SchoolHour int not null,
	Foreign Key (Subject_Description) references Subject(Subject_Description),
	Foreign Key (SchoolClass_Description) references SchoolClass(SchoolClass_Description),
	Foreign Key (Teacher_Name) references Teacher(Teacher_Name),
	Foreign Key (SchoolHour) references SchoolHour(Hour),
	Primary Key (SchoolDay, SchoolHour, Teacher_Name) -- Um zu verhindern, dass ein Lehrer zugleich in mehreren Klassen arbeiten kann
);

create table TeachedBy(
	Subject_Description varchar(255) not null,
	Teacher_Name varchar(255) not null,
	Foreign Key (Subject_Description) references Subject(Subject_Description),
	Foreign Key (Teacher_Name) references Teacher(Teacher_Name),
	Primary Key (Subject_Description, Teacher_Name)
);

create table Event(
	Event_ID int not null auto_increment,
	Titel varchar(255) not null,
	Description text,
	Date date not null,
	Person varchar(255) not null,
	Begin_Hour int not null,
	End_Hour int not null,
	Foreign Key (Begin_Hour) references SchoolHour(Hour),
	Foreign Key (End_Hour) references SchoolHour(Hour),
	Primary Key (Event_ID)
);

create table EventwithTeacher(
	Event_ID int not null,
	Teacher_Name varchar(255) not null,
	Foreign Key (Teacher_Name) references Teacher(Teacher_Name),
	Foreign Key (Event_ID) references Event(Event_ID),
	Primary Key (Event_ID, Teacher_Name)
);

create table EventwithSchoolClass(
	Event_ID int not null,
	SchoolClass_Description varchar(255) not null,
	Foreign Key (SchoolClass_Description) references SchoolClass(SchoolClass_Description),
	Foreign Key (Event_ID) references Event(Event_ID),
	Primary Key (Event_ID, SchoolClass_Description)
);

insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (1, "07:50:00", "08:40:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (2, "08:40:00", "09:30:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (3, "09:35:00", "10:25:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (4, "10:25:00", "11:15:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (5, "11:30:00", "12:20:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (6, "12:20:00", "13:10:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (7, "14:10:00", "15:00:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (8, "15:00:00", "15:50:00");
insert into SchoolHour (Hour, Begin_Hour, End_Hour) values (9, "15:50:00", "16:40:00");

