
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

void authentication(t_program* t_program)
{


    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;

    gchar* conversionUsernameUTF8 = NULL;
    gchar* conversionPasswordUTF8 = NULL;
    gchar* requestAuth = NULL;

    conversionUsernameUTF8 = allocateString(conversionUsernameUTF8,50,0,t_program);
    conversionPasswordUTF8 = allocateString(conversionPasswordUTF8,50,0,t_program);
    requestAuth = allocateString(requestAuth,150,0,t_program);


    conversionUsernameUTF8 = g_convert(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageAuth->username)),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    conversionPasswordUTF8 = g_convert(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageAuth->password)),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    requestAuth = g_strconcat("SELECT prenom from personne WHERE prenom = '",conversionUsernameUTF8,NULL);
    requestAuth = g_strconcat(requestAuth,"' AND pwd = '",NULL);
    requestAuth = g_strconcat(requestAuth,conversionPasswordUTF8,NULL);
    requestAuth = g_strconcat(requestAuth,"'",NULL);

    mysql_query(t_program->sock,requestAuth);

    res = mysql_use_result(t_program->sock);
    row = mysql_fetch_row(res);

    if(row)
    {

        gtk_widget_hide(t_program->t_pageAuth->vbox);
        displayMenu(t_program);

    }
    else if(!row)
    {
        errorMessage(t_program,"Erreur dans l'id ou le mot de passe.","Fenetre d'erreur",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
    }

    free(conversionUsernameUTF8);
    free(conversionPasswordUTF8);
    free(requestAuth);
    mysql_free_result(res);
}

