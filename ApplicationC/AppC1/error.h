#ifndef APP1_ERROR_H
#define APP1_ERROR_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>
#include <windows.h>
#include <mysql.h>


#include "structures.h"

void errorMessage(t_program* t_program, char* message,char* title,GtkMessageType messageType, GtkButtonsType buttons);

#endif //APP1_AUTHENTICATION_H

