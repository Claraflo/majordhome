#ifndef APP1_INIT_H
#define APP1_INIT_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

#include "structures.h"
#include "authentication.h"
#include"error.h"



GtkWidget* creatWindow();
void displayContainWelcomPage(t_program* t_program);
void ValidationAuthentication(GtkWidget *button, t_program* t_program);
t_pageAuth* creatStructPageAuth(t_program* program, GtkWidget* usernameEntry, GtkWidget* passwordEntry,GtkWidget* vbox);
t_program* initProgram();


#endif //APP1_INIT_H


