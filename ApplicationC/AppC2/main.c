
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "main.h"
#include <windows.h>
#include <mysql.h>
#include <dirent.h>



int main(int argc, const char * argv[]) {

    FILE * fp;
    FILE * fp2;
    char getLine[2000];
    char path[200];
    char ** getFilesSql;

    int i ;
    int getNumberFiles;
    char insertLine[2000];

    MYSQL * sock;

    sock = databaseAuth();

    getFilesSql = listFiles("./export" , ".sql");
    getNumberFiles = countFiles("./export",".sql");

    fp2 = fopen("./backup/newBddParis.sql", "w");

    for (i = 0; i < getNumberFiles; i++) {

        strcpy(path,"./export/" );
        strcat(path, getFilesSql[i]);

        fp = fopen(path, "rb");

            if (fp != NULL ) {

                while(fgets(getLine, 2000, fp) != NULL) {
                    if (strstr(getLine, "INSERT")) {
                        fprintf(fp2,"%s",getLine);


                        while(strchr(getLine, ';') == NULL) {

                            fgets(getLine, 2000, fp);
                          fprintf(fp2,"%s",getLine);

                        }


                    }
                }

                fputc('\n',fp2);

            }

        else{
            printf("Impossible d'ouvrir le fichier");
        }

        fclose(fp);

    }

    fclose(fp2);
    free(getFilesSql);

    mysql_query(sock,"DELETE FROM Personne WHERE statut = 1");

    fp2 = fopen("./backup/newBddParis.sql", "r");

    insertDatabase(sock,fp2);

    return 0;

}
