create table if not exists Nav_Items (
  ID INT AUTO_INCREMENT,
  Title TEXT,
  Link TEXT,
  Parent INT,
  Priority INT,
  Type TEXT,
  Page_ID TEXT,

  primary key(ID)
);
