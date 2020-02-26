#ifndef APP1_ADDDATABASE_H
#define APP1_ADDDATABASE_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>
#include <windows.h>
#include <mysql.h>


#include "structures.h"
#include"error.h"


void addInputInDB(t_program* t_program);
void returnForm(t_program* t_program);
char *str_replace(char *orig, char *rep, char *with);
gchar* verificationString(t_program* t_program,gchar* text);
int verificationBirthday(t_program* t_program,gchar* dateBirthday);
int verificationPhone(t_program* t_program,gchar* phone);


#endif //APP1_ADDDATABASE_H

