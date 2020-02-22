#ifndef APP1_AUTHENTICATION_H
#define APP1_AUTHENTICATION_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <gtk/gtk.h>
#include <windows.h>
#include <mysql.h>
#include <wchar.h>

#include "structures.h"


void authentication(t_pageAuth* inputData);
MYSQL* connection(MYSQL* sock);

#endif //APP1_AUTHENTICATION_H
