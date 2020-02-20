#ifndef APP1_INIT_H
#define APP1_INIT_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

#include "structures.h"
#include "qrcodegen.h"
#include "qrCode.h"



GtkWidget* creatWindow(GtkWidget* pWindow);
void displayContainWelcomPage(GtkWidget* pWindow);
void ValidationAuthentication(GtkWidget *button, t_inputAuth* inputData);
t_inputAuth* creatStructInput(t_inputAuth* inputData, GtkWidget* usernameEntry, GtkWidget* passwordEntry);
char** creatArrayInput(char** arrayDataInput);

#endif //APP1_INIT_H


