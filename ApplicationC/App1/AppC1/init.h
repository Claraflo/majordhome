#ifndef APP1_INIT_H
#define APP1_INIT_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

#include "structures.h"
#include "authentication.h"



GtkWidget* creatWindow(GtkWidget* pWindow);
void displayContainWelcomPage(GtkWidget* pWindow);
void ValidationAuthentication(GtkWidget *button, t_pageAuth* inputData);
t_pageAuth* creatStructInput(t_pageAuth* inputData, GtkWidget* usernameEntry, GtkWidget* passwordEntry,GtkWidget* vbox);
char** creatArrayInput(char** arrayDataInput);

#endif //APP1_INIT_H


