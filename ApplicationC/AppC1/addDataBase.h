#ifndef APP1_ADDDATABASE_H
#define APP1_ADDDATABASE_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>
#include <windows.h>
#include <mysql.h>
#include <time.h>
#include <ctype.h>

#include "structures.h"
#include "error.h"
#include "endProgram.h"
#include "qrCode.h"


void addInputInDB(t_program* program);
char *str_replace(char *orig, char *rep, char *with);
gchar* verificationString(t_program* program,const gchar* text);
int verificationBirthday(t_program* program,gchar* dateBirthday);
int verificationPhone(t_program* program,gchar* phone);
int verificationMail(t_program* program,gchar* mail,int statut);
gchar* verificationJob(t_program* program,gchar * job);
int verificationPC(t_program* program,gchar * postCode);
char* createIdCode(t_program* program,char* idCode,gchar* conv[]);
char* allocateString(char* string,int size,int count,t_program* program);
char* searchCategoryID(t_program* program,MYSQL_RES* res);

#endif //APP1_ADDDATABASE_H

