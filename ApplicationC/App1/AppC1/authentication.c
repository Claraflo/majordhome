
#include "authentication.h"



MYSQL* connection(MYSQL* sock){


    sock = mysql_init(0);


    char* host = "localhost";
    char* user = "root";
    char* pass = "root";
    char* db = "majord'home";
    int port = 3306;

    if(mysql_real_connect(sock,host,user,pass,db,port,NULL,0)){

        return sock;

    }else{

        return NULL; // Message d'erreur
    }

}

void authentication(t_pageAuth* inputData){

    MYSQL* sock;
    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;

    sock = connection(sock);


    gchar* conversionUsernameUTF8 = g_convert(gtk_entry_get_text(GTK_ENTRY(inputData->username)),gtk_entry_get_text_length(GTK_ENTRY(inputData->username))*2,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    gchar* conversionPasswordUTF8 = g_convert(gtk_entry_get_text(GTK_ENTRY(inputData->password)),gtk_entry_get_text_length(GTK_ENTRY(inputData->password))*2,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    gchar* requestAuth = g_strconcat("SELECT prenom from personne WHERE prenom = '",conversionUsernameUTF8,NULL);
    requestAuth = g_strconcat(requestAuth,"' AND pwd = '",NULL);
    requestAuth = g_strconcat(requestAuth,conversionPasswordUTF8,NULL);
    requestAuth = g_strconcat(requestAuth,"'",NULL);

    printf("\n%s",requestAuth);
    mysql_query(sock,requestAuth);

    res = mysql_use_result(sock);
    row = mysql_fetch_row(res);

    if(row){
        gtk_widget_hide(inputData->vbox);

    }else if(!row){
        printf("N'existe pas");
    }

    mysql_free_result(res);
    mysql_close(sock);
}
