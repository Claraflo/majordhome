#ifndef APP1_STRUCTURES_H
#define APP1_STRUCTURES_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>
#include <windows.h>
#include <mysql.h>

#include "qrcodegen.h"
#include "qrCode.h"

typedef struct
{

    GtkWidget* username;
    GtkWidget* password;
    GtkWidget* vbox;


}t_pageAuth;

typedef struct
{
    GtkWidget* entry[8];
    GtkWidget* vbox;

}t_pageForm;

typedef struct
{
    GtkWidget* vbox;

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
    t_pageAuth* t_pageAuth;
    t_pageMenu* t_pageMenu;
    t_pageForm* t_pageForm;

} t_program;



#endif //APP1_STRUCTURES_H



