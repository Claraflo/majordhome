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
    GtkWidget* pWindow; // main window

} t_program;

typedef struct
{

    GtkWidget* username;
    GtkWidget* password;
    GtkWidget* vbox;
    t_program* t_program;

}t_pageAuth;

#endif //APP1_STRUCTURES_H



