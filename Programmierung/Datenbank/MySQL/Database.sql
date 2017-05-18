create table SchoolHour(
	Hour int not null,
	Begin_Hour time not null,
	End_Hour time not null,
	Primary Key (Hour)
) ENGINE = InnoDB;

create table Subject (
	Subject_Description varchar(255) not null,
	Primary Key(Subject_Description)
) ENGINE = InnoDB;

-- Der Lehrer besitzt einen Namen, in welchem der Vor und Nachname abgespeichert werden
create table Teacher (
	Teacher_Name varchar(255) not null,
	Password varchar(255),
	Credit int not null default 0,
	Primary Key(Teacher_Name)
) ENGINE = InnoDB;

create table SchoolClass (
	SchoolClass_Description varchar(255) not null,
	Primary Key(SchoolClass_Description)
) ENGINE = InnoDB;

create table SchoolDay(
	Day int not null,
	Day_Name varchar(10) not null,
	PRIMARY key (Day)	
) ENGINE = InnoDB;

create table Timetable(
	Subject_Description varchar(255) not null,
	SchoolClass_Description varchar(255) not null,
	Teacher_Name varchar(255) not null,
	SchoolDay int not null,
	SchoolHour int not null,
	Foreign Key (Subject_Description) references Subject(Subject_Description),
	Foreign Key (SchoolDay) references SchoolDay(Day),
	Foreign Key (SchoolClass_Description) references SchoolClass(SchoolClass_Description),
	Foreign Key (Teacher_Name) references Teacher(Teacher_Name),
	Foreign Key (SchoolHour) references SchoolHour(Hour),
	Primary Key (SchoolDay, SchoolHour, Teacher_Name) -- Um zu verhindern, dass ein Lehrer zugleich in mehreren Klassen arbeiten kann
) ENGINE = InnoDB;

create table TeachedBy(
	Subject_Description varchar(255) not null,
	Teacher_Name varchar(255) not null,
	Foreign Key (Subject_Description) references Subject(Subject_Description),
	Foreign Key (Teacher_Name) references Teacher(Teacher_Name),
	Primary Key (Subject_Description, Teacher_Name)
) ENGINE = InnoDB;

create table Event(
	Event_ID int not null auto_increment,
	Titel varchar(255) not null,
	Description text,
	Date date not null,
	Person varchar(255),
	Begin_Hour int not null,
	End_Hour int not null,
	Foreign Key (Begin_Hour) references SchoolHour(Hour),
	Foreign Key (End_Hour) references SchoolHour(Hour),
	Primary Key (Event_ID)
) ENGINE = InnoDB;

create table EventwithTeacher(
	Event_ID int not null,
	Teacher_Name varchar(255) not null,
	Foreign Key (Teacher_Name) references Teacher(Teacher_Name),
	Foreign Key (Event_ID) references Event(Event_ID) ON DELETE CASCADE,
	Primary Key (Event_ID, Teacher_Name)
) ENGINE = InnoDB;

create table EventwithSchoolClass(
	Event_ID int not null,
	SchoolClass_Description varchar(255) not null,
	Foreign Key (SchoolClass_Description) references SchoolClass(SchoolClass_Description),
	Foreign Key (Event_ID) references Event(Event_ID) ON DELETE CASCADE,
	Primary Key (Event_ID, SchoolClass_Description)
) ENGINE = InnoDB;

create table TeacherGotCredit(
	TeacherGotCredit_ID int not null auto_increment,
	Event_ID int not null,
	Teacher_Name varchar(255) not null,
	CreditChange int not null,
	Foreign Key (Teacher_Name) references Teacher(Teacher_Name),
	Foreign Key (Event_ID) references Event(Event_ID),
	Primary Key (TeacherGotCredit_ID)
) ENGINE = InnoDB;

create table Admin(
	Username varchar(255) not null,
	Password varchar (255) not null,
	Primary Key(Username)
) ENGINE = InnoDB;