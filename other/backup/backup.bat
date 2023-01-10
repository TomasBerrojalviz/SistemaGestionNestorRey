echo off
C:\xampp\mysql\bin\mysqldump -h127.0.0.1 -ubackup -pbackup sgnr > C:\xampp\htdocs\SistemaGestionNestorRey\other\backup\sgnrDB_BackUp_%date:~-10,2%-%date:~-7,2%-%date:~-4,4%.sql
exit