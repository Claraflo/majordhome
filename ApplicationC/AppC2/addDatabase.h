#ifndef ADDDATABASE_H_INCLUDED
#define ADDDATABASE_H_INCLUDED

#include <windows.h>
#include <mysql.h>
#include <stdlib.h>

#include <stdio.h>

void insertDatabase(MYSQL * sock, FILE * fp);

#endif // ADDDATABASE_H_INCLUDED
