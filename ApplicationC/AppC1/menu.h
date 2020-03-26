#ifndef APP1_MENU_H
#define APP1_MENU_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

#include "structures.h"
#include "authentication.h"
#include "form.h"
#include "research.h"
#include "error.h"

void displayMenu(t_program* program);
t_pageMenu* creatStructPageMenu(t_program* program,GtkWidget* vbox);
void ValidationForm(GtkWidget *buttonForm, t_program* program);
void ValidationSelect(GtkWidget *buttonSelect, t_program* program);
void ValidationExit(GtkWidget *buttonExit, t_program* program);
void returnAuth(t_program* program);

#endif //APP1_MENU_H
