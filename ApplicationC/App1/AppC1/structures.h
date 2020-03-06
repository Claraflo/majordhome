#ifndef APP1_STRUCTURES_H
#define APP1_STRUCTURES_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>
#include <windows.h>
#include <mysql.h>


typedef struct
{

    GtkWidget* username;
    GtkWidget* password;
    GtkWidget* vbox;


}t_pageAuth;

typedef struct
{
    GtkWidget** entry;
    GtkWidget* combo;
    GtkWidget* vbox;

}t_pageForm;

typedef struct
{
    GtkWidget* vbox;
    GtkWidget* modifyBox;
    GtkWidget* buttonBox;
    char* idCode;
    GtkWidget **entry;
    GtkWidget *view;
    GtkWidget* combo;
    GtkWidget* entrySearch;
    GtkTreeSelection* selection;

}t_pageResearch;


typedef struct
{
    GtkWidget* vbox;

}t_pageMenu;


typedef struct
{
    GtkWidget* pWindow; // main window
    GtkWidget* pbox;    // main box
    MYSQL* sock;
    t_pageAuth* pageAuth;
    t_pageMenu* pageMenu;
    t_pageForm* pageForm;
    t_pageResearch* pageResearch;

} t_program;



#endif //APP1_STRUCTURES_H



