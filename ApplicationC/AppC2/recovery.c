
#include "recovery.h"
#include <dirent.h>
#include <stdlib.h>
#include <string.h>


char ** listFiles(char * path, char * extension){

    int i = 0;
    int count;
    struct dirent *lecture;
    DIR * rep;
    char * foundExtension;
    char * lastDot;
    char ** listFilesSql;


    count = countFiles(path, extension);

    listFilesSql = malloc(sizeof(char *) * count);

    rep = opendir(path);

    while ((lecture = readdir(rep))) {
        lastDot = lecture->d_name;

        while ( (lastDot = strchr(lastDot, '.')) != NULL) {

            foundExtension = lastDot;
            lastDot+=1;
        }

        if (strcmp(foundExtension, extension) == 0) {

            listFilesSql[i] = malloc(sizeof(char) * 255);
            strcpy(listFilesSql[i], lecture->d_name);
            i++;
        }
    }

    closedir(rep);
    return listFilesSql;

}

int countFiles(char * path, char * extension){

    int count = 0;
    struct dirent *lecture;
    DIR * rep;

    char * foundExtension;
    char * lastDot;

    rep = opendir(path);

    while ((lecture = readdir(rep))) {

        lastDot = lecture->d_name;

        while ( (lastDot = strchr(lastDot, '.')) != NULL) {

            foundExtension = lastDot;
            lastDot+=1;


        }

        if (strcmp(foundExtension, extension) == 0) {
            count++;
        }
    }

    closedir(rep);
    return count;

}
