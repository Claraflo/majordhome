
#include "addDataBase.h"


void addInputInDB(t_program* t_program)
{
    int i,countEmpty=0;
    char** conv;
    char* idCode;
    gchar* requestProvider = allocateString(requestProvider,1000,0);
    gchar* requestJob =  allocateString(requestJob,100,0);
    gchar* requestIdCode= allocateString(requestIdCode,100,0);

    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;

    //Check if inputs are not empty
    for(i=0;i<9;i++){
        if(strlen(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[i])))== 0){
             countEmpty ++;
        }
        if(gtk_combo_box_text_get_active_text(GTK_COMBO_BOX(t_program->t_pageForm->combo)) == NULL){
            countEmpty ++;
        }
    }

    if(countEmpty != 0){
        errorMessage(t_program,"ERREUR : Champ(s) vide(s)","ERREUR FORMULAIRE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
    }else{

        conv=malloc(sizeof(char*)*9);
        for(i=0;i<9;i++){
            conv[i]=malloc(sizeof(char)*400);
        }

        if(!conv){
            //Exit
        }

        conv[0] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[0])));//name
        conv[1] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[1])));//firstname
        conv[2] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[2])));//mail
        conv[3] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[3]));//Birthday
        conv[4] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[4]));//Phone
        conv[5] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[5])));//Adress
        conv[6] = verificationString(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[6])));//Town
        conv[7] = gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[7]));//Post Code
        conv[8] = verificationJob(t_program,gtk_entry_get_text(GTK_ENTRY(t_program->t_pageForm->entry[8])));//Job


        if(verificationBirthday(t_program,conv[3]) && verificationPhone(t_program,conv[4]) && verificationMail(t_program,conv[2])&& verificationPC(t_program,conv[7])){


            //CREATE idCode for QRCode
            idCode = createIdCode(t_program,idCode,conv);

            requestIdCode = g_strconcat("SELECT idCode from personne WHERE idCode = '",idCode,NULL);
            requestIdCode = g_strconcat(requestIdCode,"'",NULL);

            mysql_query(t_program->sock,requestIdCode);
            res = mysql_use_result(t_program->sock);
            row = mysql_fetch_row(res);

            while(row){
                idCode = createIdCode(t_program,idCode,conv);
                requestIdCode = requestJob= g_strconcat("SELECT idCode from personne WHERE idCode = '",idCode,NULL);
                requestIdCode = g_strconcat(requestIdCode,"'",NULL);

                mysql_query(t_program->sock,requestIdCode);
                res = mysql_use_result(t_program->sock);
                row = mysql_fetch_row(res);
            }



            //Check if the job already exists in DB if not it's created
            requestJob= g_strconcat("SELECT nom from metier WHERE nom = '",conv[8],NULL);
            requestJob = g_strconcat(requestJob,"'",NULL);

            mysql_query(t_program->sock,requestJob);

            res = mysql_use_result(t_program->sock);
            row = mysql_fetch_row(res);

            if(!row){
                requestJob = "INSERT INTO metier (nom,FK_type) VALUES ('";
                requestJob = g_strconcat(requestJob,conv[8],NULL);
                requestJob = g_strconcat(requestJob,"','",NULL);
                requestJob = g_strconcat(requestJob,gtk_combo_box_text_get_active_text(GTK_COMBO_BOX(t_program->t_pageForm->combo)),NULL);
                requestJob = g_strconcat(requestJob,"')",NULL);
                mysql_query(t_program->sock,requestJob);

            }


            //Request of insert new provider
            requestProvider = g_strconcat("INSERT INTO personne (nom, prenom,mail,dateNaissance,tel,adresse,ville,codePostal,FK_metier,idCode,pwd,statut) VALUES ('",conv[0],NULL);
            for(int i =1; i<9;i++){
                requestProvider = g_strconcat(requestProvider,"','",NULL);
                requestProvider = g_strconcat(requestProvider,conv[i],NULL);
            }

            requestProvider = g_strconcat(requestProvider,"','",NULL);
            requestProvider = g_strconcat(requestProvider,idCode,NULL);
            requestProvider = g_strconcat(requestProvider,"','0000','1')",NULL);

            mysql_query(t_program->sock,requestProvider);

            createQRC(t_program,idCode);

        }



    }

    mysql_free_result(res);
    free(conv);
    free(idCode);
    free(requestProvider);
    free(requestJob);
    free(requestIdCode);
}


gchar* verificationString(t_program* t_program,gchar* text){

    text = g_convert(text,-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    text = str_replace(text, "\'", "\\\'");

return text;
}


int verificationMail(t_program* t_program,gchar* mail){

    int i,posArob=0,countArob= 0,countDot =0,len = strlen(mail);
    char forbiddenChar[15] = "()<>,;:\"[]|ç%&";
    char email[len];
    gchar* requestMail = allocateString(requestMail,300,0);
    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;

    strcpy(email,mail);


    if(strpbrk(email,forbiddenChar) != NULL){
        errorMessage(t_program,"ERREUR : Caracteres speciaux interdit dans mail. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    if(strchr(mail,' ')){
        errorMessage(t_program,"ERREUR : Espace dans mail interdit. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    for(i=0;i<len;i++){

        if(email[i] == '@'){
            posArob= i;
            countArob++;
        }
    }

    if(countArob == 1){
        if(posArob == 0){
            errorMessage(t_program,"ERREUR : Le mail ne peut pas commencer par une arobase. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }

        if(email[posArob-1] == '.'){
            errorMessage(t_program,"ERREUR : L'arobase ne peut pas etre precede d'un point. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }

        if(email[posArob+1] == '.'){
            errorMessage(t_program,"ERREUR : L'arobase ne peut pas etre suivi d'un point. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }

    }else{
        errorMessage(t_program,"ERREUR : Le mail ne doit contenir qu'une seule arobase. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }


    if(email[len-1] == '.'){
           errorMessage(t_program,"ERREUR : Le mail ne peut pas finir par un point. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
           return 0;
    }

    for(i=posArob;i<len;i++){
        if(email[i] == '.'){
            countDot = i;
        }
    }

    if(countDot == 0){
        errorMessage(t_program,"ERREUR : Il manque le point avant l'extention. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    //Check if mail already exists in BD
    requestMail = g_strconcat("SELECT mail from personne WHERE mail= '",email,NULL);
    requestMail = g_strconcat(requestMail,"'",NULL);

    mysql_query(t_program->sock,requestMail);

    res = mysql_use_result(t_program->sock);
    row = mysql_fetch_row(res);

    if(row){
        errorMessage(t_program,"ERREUR : Le prestataire existe deja. S'il est necessaire de l'inscrire 2 fois renseignez 2 mails differents.","ERREUR",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        mysql_free_result(res);
        free(requestMail);
        return 0;
    }

    mysql_free_result(res);
    free(requestMail);

return 1;
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


gchar* verificationJob(t_program* t_program,gchar * job){

    int i = 0;
    job = verificationString(t_program,job);
    char arrayJob[strlen(job)];

    strcpy(arrayJob,job);


    for(i=0;i<strlen(job);i++){
        if (arrayJob[i]>=65 && arrayJob[i]<=90){
            arrayJob[i] = arrayJob[i]+32;
        }
    }

    strcpy(job,arrayJob);
    strcat(job,"\0");

return job;
}

int verificationPC(t_program* t_program,gchar * postCode){

    char arrayCP[5];
    strcpy(arrayCP,postCode);

    if(strlen(postCode) != 5){
        errorMessage(t_program,"ERREUR : Le code postal est trop court. (NON EGAL 5). Format : xxxxx","ERREUR Code Postal",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    for(int i = 0; i<5;i++){
         if(!isdigit(arrayCP[i])){
            errorMessage(t_program,"ERREUR : Le code postal ne doit contenir que des chiffres. Format : xxxxx","ERREUR Code Postal",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
         }
    }

return 1;
}

char* createIdCode(t_program* t_program,char* idCode,gchar* conv[]){

    int i =0;
    int len = strlen(conv[3]);
    char date[10];
    strcpy(date,conv[3]);

    idCode = malloc(sizeof(char)*12);
    if(!idCode){
        //ERREUR
    }

    char firstCharacter[1];
    strncpy(firstCharacter,conv[1],1);

    strcpy(idCode,"1");

    if(firstCharacter[0]>=97 && firstCharacter[0]<=122 ){
        firstCharacter[0] = firstCharacter[0] - 32;
        strncat(idCode,firstCharacter,1);
    }else{
        strncat(idCode,conv[1],1);
    }

    strncpy(firstCharacter,conv[0],1);
    if(firstCharacter[0]>=97 && firstCharacter[0]<=122 ){
        firstCharacter[0] = firstCharacter[0] - 32;
        strncat(idCode,firstCharacter,1);
    }else{
        strncat(idCode,conv[0],1);
    }

    strncat(idCode,date+2,2);

    if(date[6]=='-'){
        strcat(idCode,"0");
        strncat(idCode,date+5,1);
    }else{
        strncat(idCode,date+5,2);
    }

    if(len == 10){
        strncat(idCode,date+8,2);
    }else if(len == 8){
        strcat(idCode,"0");
        strncat(idCode,date+7,1);
    }else if(len == 9){
        if(date[6]=='-'){
            strncat(idCode,date+7,2);
        }else{
            strcat(idCode,"0");
            strncat(idCode,date+8,1);
        }
    }

    // init randomization
    srand( time( NULL ) );

    char character[2];
    for(i=0;i<2;i++){
        character[i] = (rand() % 10) + 48;
    }

    strncat(idCode,character,2);

    return idCode;
}

char* allocateString(char* string,int size,int count){

    string=malloc(sizeof(char)*size);

    if(!string){
        free(string);
        allocateString(string,size,++count);
        if(count == 3){
            //exit
        }
    }
}

void returnForm(t_program* t_program){



}
