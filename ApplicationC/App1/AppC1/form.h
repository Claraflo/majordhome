#ifndef APP1_FORM_H
#define APP1_FORM_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

#include "structures.h"
#include "error.h"
#include "endProgram.h"
#include "addDataBase.h"

void displayForm(t_program* program);
t_pageForm* creatStructPageForm(t_program* program,GtkWidget* vBoxForm,GtkWidget** entry,GtkWidget* combo);
void ValidationFormProviders(GtkWidget *buttonValidForm, t_program* program);
void ValidationReturnMenu(GtkWidget *buttonExit, t_program* program);
GtkWidget* creatCombo(t_program* program);

#endif //APP1_FORM_H
