
#include "authentication.h"



MYSQL* connection()
{

    MYSQL* sock;
    sock = mysql_init(0);


    char* host = "localhost";
    char* user = "root";
    char* pass = "root";
    char* db = "majord'home";
    int port = 3306;

    if(mysql_real_connect(sock,host,user,pass,db,port,NULL,0))
    {

        return sock;

    }
    else
    {

        return NULL;
    }

}

void authentication(t_program* program)
{


    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;

    gchar* conversionUsernameUTF8 = NULL;
    gchar* conversionPasswordUTF8 = NULL;
    gchar* requestAuth = NULL;

    conversionUsernameUTF8 = allocateString(conversionUsernameUTF8,50,0,program);
    conversionPasswordUTF8 = allocateString(conversionPasswordUTF8,50,0,program);
    requestAuth = allocateString(requestAuth,150,0,program);


    conversionUsernameUTF8 = g_convert(gtk_entry_get_text(GTK_ENTRY(program->pageAuth->username)),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    conversionPasswordUTF8 = g_convert(gtk_entry_get_text(GTK_ENTRY(program->pageAuth->password)),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    requestAuth = g_strconcat("SELECT prenom from personne WHERE prenom = '",conversionUsernameUTF8,NULL);
    requestAuth = g_strconcat(requestAuth,"' AND mdp = '",NULL);
    requestAuth = g_strconcat(requestAuth,conversionPasswordUTF8,NULL);
    requestAuth = g_strconcat(requestAuth,"'",NULL);

    mysql_query(program->sock,requestAuth);

    res = mysql_use_result(program->sock);
    row = mysql_fetch_row(res);

    if(row)
    {

        gtk_widget_hide(program->pageAuth->vbox);
        displayMenu(program);

    }
    else if(!row)
    {
        errorMessage(program,"Erreur dans l'id ou le mot de passe.","Fenetre d'erreur",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
    }

    free(conversionUsernameUTF8);
    free(conversionPasswordUTF8);
    free(requestAuth);
    mysql_free_result(res);
}

