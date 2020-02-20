
#include "authentication.h"

void authentification(t_inputAuth* inputData){

    MYSQL* sock;
    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;

    sock = mysql_init(0);


    char* host = "localhost";
    char* user = "root";
    char* pass = "root";
    char* db = "majord'home";
    int port = 3306;

    if(mysql_real_connect(sock,host,user,pass,db,port,NULL,0)){




    }else{

         //Fenetre d'erreur
    }


}
