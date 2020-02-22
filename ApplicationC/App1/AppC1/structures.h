#ifndef APP1_STRUCTURES_H
#define APP1_STRUCTURES_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>

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

}t_pageMenu;


typedef struct
{
    GtkWidget* pWindow; // main window
    t_pageAuth* t_pageAuth;
    t_pageMenu* t_pageMenu;

} t_program;



#endif //APP1_STRUCTURES_H



