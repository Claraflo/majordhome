
#include "addDatabase.h"



void insertDatabase(MYSQL * sock, FILE * fp){

    char getLine[2000];
    char insertLine[2000];

    while(fgets(getLine, 2000, fp) != NULL) {

        if (strstr(getLine, "INSERT")) {
            strcpy(insertLine,getLine);

                while(strchr(getLine, ';') == NULL) {

                    fgets(getLine, 2000, fp);
                    strcat(insertLine,getLine);
                }

        }

        mysql_query(sock,insertLine);

    }

}
