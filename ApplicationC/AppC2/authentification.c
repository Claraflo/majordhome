#include "authentification.h"


MYSQL * databaseAuth(){


    MYSQL * sock;


    char * host = "localhost";
    char * user = "root";
    char * pass = "";
    char * databaseName = "majord'home";

    sock = mysql_init(0);


    if (mysql_real_connect(sock,host,user,pass,databaseName,0,NULL,0)){

           return sock;
    }else{
           return NULL;
    }


}
