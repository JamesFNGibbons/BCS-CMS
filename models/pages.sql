CREATE TABLE IF NOT EXISTS Pages (
  ID INT AUTO_INCREMENT,
  Title TEXT,
  Content TEXT,
  Created DATE,
  Updated DATE,
  Author_ID INT,
  Author_Name TEXT,
  URI TEXT,

  PRIMARY KEY(ID)
)
