#ifndef APP1_RESEARCH_H
#define APP1_RESEARCH_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

#include "structures.h"
#include"error.h"

void initResearch(t_program* t_program);
void append_item(GtkWidget *widget, gpointer entry);
void remove_item(GtkWidget *widget, gpointer selection);
void remove_all(GtkWidget *widget, gpointer selection);
void init_list(GtkWidget *list);


#endif //APP1_RESEARCH_H
