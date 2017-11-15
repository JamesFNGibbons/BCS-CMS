CREATE TABLE IF NOT EXISTS Pages (
  ID INT AUTO_INCREMENT,
  Title TEXT,
  Subtitle TEXT,
  Content TEXT,
  Created DATE,
  Updated DATE,
  Author_ID INT,
  Author_Name TEXT,
  URI TEXT,
  Feature_Image TEXT,
  Template TEXT,

  PRIMARY KEY(ID)
)
