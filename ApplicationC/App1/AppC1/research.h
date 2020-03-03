#ifndef APP1_RESEARCH_H
#define APP1_RESEARCH_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

#include "structures.h"
#include "form.h"
#include"error.h"

void initResearch(t_program* t_program);
t_pageResearch* creatStructPageResearch(t_program* t_program, t_pageResearch* t_pageResearch,GtkWidget* vboxResearch,GtkTreeSelection *selection,GtkWidget* view,GtkWidget* entry);
GtkTreeModel * create_and_fill_model (t_program* t_program,gchar* request,int statut);
GtkWidget * create_view_and_model (t_program* t_program);
void appendItem(GtkWidget *pWidget, t_program* t_program);
void researchItem(GtkWidget *pWidget, t_program* t_program);
void modifyItem(GtkWidget *pWidget, t_program* t_program);
void GoBackMenu(GtkWidget *pWidget, t_program* t_program);
void removeItem(GtkWidget *pWidget, t_program* t_program);
void displayAll(GtkWidget *pWidget, t_program* t_program);


#endif //APP1_RESEARCH_H
