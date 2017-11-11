create table if not exists Blog_Posts (
  ID INT AUTO_INCREMENT,
  Title TEXT,
  Content TEXT,
  Published DATE,
  Feature_Image TEXT,
  Creator TEXT,
  Uri TEXT,

  primary key(ID)
)
