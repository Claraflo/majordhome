
#ifndef APP1_MAIN_H
#define APP1_MAIN_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>
#include <windows.h>
#include <mysql.h>

#include "qrcodegen.h"
#include "qrCode.h"
#include "init.h"
#include "endProgram.h"


void OnDestroy(GtkWidget *pWidget, t_program* t_program);

#endif //APP1_MAIN_H
