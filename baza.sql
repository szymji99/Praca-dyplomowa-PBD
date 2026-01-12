
CREATE TABLE loginy(
	ID INT PRIMARY KEY AUTO_INCREMENT
	, login VARCHAR(30)
	, password VARCHAR(30)
	, email varchar(30)
);

INSERT INTO loginy (login,password,email) VALUES 
	('admin','admin','szymji@gmail.com')
	,('testuser','test','szymji@gmail.com');

CREATE TABLE IF NOT EXISTS Notes (	
	 NoteDay INT,
	 NoteMonth INT,
	 NoteYear INT,
	 NoteText TINYTEXT,
	 IDOwner INT

	,FOREIGN KEY (IDOwner) REFERENCES loginy(ID) ON DELETE CASCADE

);
