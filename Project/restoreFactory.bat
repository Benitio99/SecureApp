../../../mysql/bin/mysql.exe -u root

drop USER 'SADUSER'@'localhost' from mysql.USER;
exit

../../../mysql/bin/mysql.exe -u root

DROP DATABASE access;


exit
