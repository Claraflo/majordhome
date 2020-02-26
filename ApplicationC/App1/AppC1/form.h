#ifndef APP1_FORM_H
#define APP1_FORM_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

#include "structures.h"
#include "error.h"
#include "addDataBase.h"

void displayForm(t_program* t_program);
t_pageForm* creatStructPageForm(t_pageForm* t_pageForm,GtkWidget* vBoxForm,GtkWidget** entry,GtkWidget* combo);
void ValidationFormProviders(GtkWidget *buttonValidForm, t_program* t_program);
void ValidationReturnMenu(GtkWidget *buttonExit, t_program* t_program);
GtkWidget* creatCombo(t_program* t_program,GtkWidget* combo);

#endif //APP1_FORM_H
