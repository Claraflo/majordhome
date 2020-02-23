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


#endif //APP1_ADDDATABASE_H

