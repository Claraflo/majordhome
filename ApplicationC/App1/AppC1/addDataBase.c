
#include "addDataBase.h"


void addInputInDB(t_program* t_program)
{

    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;


char* conv[8];

conv[0] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[0])));
conv[1] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[1])));
conv[2] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[2])));
conv[3] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[3]));
conv[4] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[4]));
conv[5] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[5]));
conv[6] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[6])));
conv[7] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[7])));
conv[8] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[8]));
conv[9] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[9])));

gchar* requestAuth = g_strconcat("INSERT INTO personne (nom, prenom,mail,dateNaissance,tel,telPro,adresse,ville,codePostal,pwd,statut) VALUES ('",conv[0],NULL);


if(verificationBirthday(t_program,conv[3]) && verificationPhone(t_program,conv[4]) && verificationPhone(t_program,conv[5])){

    for(int i =1; i<9;i++){
        requestAuth = g_strconcat(requestAuth,"','",NULL);
        requestAuth = g_strconcat(requestAuth,conv[i],NULL);
    }
    requestAuth = g_strconcat(requestAuth,"','0000','1')",NULL);

    printf("%s",requestAuth);

    mysql_query(t_program->sock,requestAuth);
}

}


gchar* verificationString(t_program* t_program,gchar* text){

    text = g_convert(text,-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    text = str_replace(text, "\'", "\\\'");

    return text;

}

int verificationPhone(t_program* t_program,gchar* phone){
    int i =0;
    char numPhone[10];
    strcpy(numPhone,phone);

    if(strlen(phone)!=10){
        errorMessage(t_program,"ERREUR : Format numero de telephone errone. Format : 0XXXXXXXXX","ERREUR NUMERO TELEPHONE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    for(i=0;i<10;i++){
        if(!isdigit(numPhone[i])){
            errorMessage(t_program,"ERREUR : Numero de telephone invalide. Format : 0XXXXXXXXX ","ERREUR NUMERO TELEPHONE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }else if(numPhone[i] == ' '){
            errorMessage(t_program,"ERREUR : Entrez un numero de telephone sans espace. Format : 0XXXXXXXXX ","ERREUR NUMERO TELEPHONE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }
    }

    if( (numPhone[0]-'0') != 0){
        errorMessage(t_program,"ERREUR : Numero de telephone invalide. N'utilisez pas le format commencant par : +33. Format : 0XXXXXXXXX ","ERREUR NUMERO TELEPHONE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }


return 1;
}



int verificationBirthday(t_program* t_program,gchar* dateBirthday){

    int len = strlen(dateBirthday);
    int mul = 1000;
    int i = 0;
    char date[10];
    int yearInt = 0, monthInt = 0 , dayInt = 0;
    int marker = 0;

    strcpy(date,dateBirthday);

    time_t timestamp;
    struct tm * t;

    t = malloc(sizeof(t));
    timestamp = time(NULL);
    t = localtime(&timestamp);
    int currentYear = 1900 + t->tm_year;

    // Check the length of input
   if(len != 8 && len != 9 && len != 10){
        errorMessage(t_program,"ERREUR : La longueur de la date ne convient pas. Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;

    }

    // Check the validity of the year
    for(i=0;i<4;i++){
        if(!isdigit(date[i])){
           errorMessage(t_program,"ERREUR : L'annee saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
           free(t);
           return 0;

        }else{
            yearInt = yearInt + (date[i]-'0')*mul;
            mul = mul/10;
        }
    }

    if(yearInt<1900 || yearInt>currentYear ){
        errorMessage(t_program,"ERREUR : L'annee saisie n'est pas valide (Non comprise entre 1900 et l'annee en cours). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

      // Check the validity of the month

    if(date[4] != '-' || !isdigit(date[5])){
        errorMessage(t_program,"ERREUR : format non respecte. Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    if(date[6] != '-' && date[7] != '-'){
        errorMessage(t_program,"ERREUR : format non respecte. Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    if(date[6] == '-'){
        monthInt = date[5]-'0';
        marker = 6;
    }else{
        if(!isdigit(date[6])){
            errorMessage(t_program,"ERREUR : Le mois saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            free(t);
            return 0;
        }else{
            monthInt = (date[5]-'0')*10 + (date[6]-'0');
            marker = 7;
        }
    }

    if(monthInt<=0 || monthInt>12){
        errorMessage(t_program,"ERREUR : Le mois saisie n'est pas valide(NOMBRE SUPERIEUR A 12 OU NEGATIF). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    if(yearInt == currentYear &&  monthInt>t->tm_mon){
        errorMessage(t_program,"ERREUR : Date invalide (MOIS SUPERIEUR AU MOIS EN COURS). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    // Check the validity of the day

    if(marker == 6){
        if(!isdigit(date[7])){
            errorMessage(t_program,"ERREUR : Le jour saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            free(t);
            return 0;
        }
        if(len == 8){
            dayInt = (date[7]-'0');
        }else if (len == 9){
            if(!isdigit(date[8])){
                errorMessage(t_program,"ERREUR : Le jour saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
                free(t);
                return 0;
            }else{
                dayInt = (date[7]-'0')*10 + (date[8]-'0');
            }
        }
    }

        if(marker == 7){
        if(!isdigit(date[8])){
            errorMessage(t_program,"ERREUR : Le jour saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            free(t);
            return 0;
        }
        if(len == 9){
            dayInt = (date[8]-'0');
        }else if (len == 10){
            if(!isdigit(date[9])){
                errorMessage(t_program,"ERREUR : Le jour saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
                free(t);
                return 0;
            }else{
                dayInt = (date[8]-'0')*10 + (date[9]-'0');
            }
        }
    }

    if(dayInt<=0 || dayInt>31){
        errorMessage(t_program,"ERREUR : Le jour saisie n'est pas valide(NOMBRE SUPERIEUR A 31 OU NEGATIF). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    if(yearInt == currentYear &&  dayInt>t->tm_mday){
        errorMessage(t_program,"ERREUR : Date invalide (JOUR SUPERIEUR AU MOIS EN COURS). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    free(t);
    return 1;

}

char *str_replace(char *orig, char *rep, char *with) {

    char *result; // the return string
    char *ins;    // the next insert point
    char *tmp;    // varies
    int len_rep;  // length of rep (the string to remove)
    int len_with; // length of with (the string to replace rep with)
    int len_front; // distance between rep and end of last rep
    int count;    // number of replacements

    // sanity checks and initialization
    if (!orig || !rep)
        return NULL;
    len_rep = strlen(rep);
    if (len_rep == 0)
        return NULL; // empty rep causes infinite loop during count
    if (!with)
        with = "";
    len_with = strlen(with);

    // count the number of replacements needed
    ins = orig;
    for (count = 0; tmp = strstr(ins, rep); ++count) {
        ins = tmp + len_rep;
    }

    tmp = result = malloc(strlen(orig) + (len_with - len_rep) * count + 1);

    if (!result)
        return NULL;

    // first time through the loop, all the variable are set correctly
    // from here on,
    //    tmp points to the end of the result string
    //    ins points to the next occurrence of rep in orig
    //    orig points to the remainder of orig after "end of rep"
    while (count--) {
        ins = strstr(orig, rep);
        len_front = ins - orig;
        tmp = strncpy(tmp, orig, len_front) + len_front;
        tmp = strcpy(tmp, with) + len_with;
        orig += len_front + len_rep; // move to next "end of rep"
    }
    strcpy(tmp, orig);
    return result;
}


void returnForm(t_program* t_program){



}
