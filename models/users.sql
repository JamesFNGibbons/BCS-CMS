CREATE TABLE IF NOT EXISTS Users (
	ID INT AUTO_INCREMENT,
	Username TEXT,
	Password TEXT,
	Name TEXT,
	Email TEXT,

	PRIMARY KEY(ID)
);

/**
  * Add the Last_Login column to the table.
*/
ALTER TABLE Users ADD Last_Login DATE; 