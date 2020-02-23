
#include "addDataBase.h"


void addInputInDB(t_program* t_program)
{

    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;
//    conversionUTF8(t_program);

//    verificationMail();
//    verificationBirthday();
//    verificationPhone();
//    verificationCodeCity();

gchar* conv[8];

conv[0] = g_convert(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[0])),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
conv[1] = g_convert(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[1])),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
conv[2] = g_convert(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[2])),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
conv[3] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[3]));
conv[4] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[4]));
conv[5] = g_convert(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[5])),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
conv[6] = g_convert(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[6])),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
conv[7] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[7]));

gchar* requestAuth = g_strconcat("INSERT INTO personne (nom, prenom,mail,dateNaissance,tel,adresse,ville,codePostal,pwd,statut) VALUES ('",conv[0],NULL);

for(int i =1; i<8;i++){
    requestAuth = g_strconcat(requestAuth,"','",NULL);
    requestAuth = g_strconcat(requestAuth,conv[i],NULL);
}
requestAuth = g_strconcat(requestAuth,"','0000','1')",NULL);

printf("%s",requestAuth);

mysql_query(t_program->sock,requestAuth);

returnForm(t_program);

}


void returnForm(t_program* t_program){



}
