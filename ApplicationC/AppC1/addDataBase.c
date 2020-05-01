
#include "addDataBase.h"


void addInputInDB(t_program* program)
{
    int i,countEmpty=0;
    char** conv= NULL;
    char* idCode= NULL;
    gchar* requestProvider = NULL;
    gchar* requestJob =   NULL;
    gchar* requestInsertJob =   NULL;
    gchar* requestIdCode=  NULL;
    gchar* idCategorie= NULL;

    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;

    requestProvider = allocateString(requestProvider,1000,0,program);
    requestJob =  allocateString(requestJob,100,0,program);
    requestInsertJob = allocateString(requestInsertJob,100,0,program);
    requestIdCode= allocateString(requestIdCode,100,0,program);
    idCategorie = allocateString(idCategorie,4,0,program);

    //Check if inputs are not empty
    for(i=0;i<9;i++){
        if(strlen(gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[i])))== 0){
             countEmpty ++;
        }
        if(gtk_combo_box_text_get_active_text(GTK_COMBO_BOX_TEXT(program->pageForm->combo)) == NULL){
            countEmpty ++;
        }
    }

    if(countEmpty != 0){
        errorMessage(program,"ERREUR : Champ(s) vide(s)","ERREUR FORMULAIRE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
    }else{

        conv=malloc(sizeof(char*)*9);
        for(i=0;i<9;i++){
            conv[i]=malloc(sizeof(char)*400);
        }

        if(!conv){
            errorMessage(program,"Le programme rencontre un probleme. ERREUR: Malloc conv ","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            endProgram(program);
        }

        conv[0] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[0])));//name
        conv[1] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[1])));//firstname
        conv[2] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[2])));//mail
        conv[3] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[3])));//Birthday
        conv[4] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[4])));//Phone
        conv[5] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[5])));//Adress
        conv[6] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[6])));//Town
        conv[7] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[7])));//Post Code
        conv[8] = verificationJob(program,gtk_entry_get_text(GTK_ENTRY(program->pageForm->entry[8])));//Job


        if(verificationBirthday(program,conv[3]) && verificationPhone(program,conv[4]) && verificationMail(program,conv[2],0)&& verificationPC(program,conv[7])){


            //CREATE idCode for QRCode
            idCode = createIdCode(program,idCode,conv);

            requestIdCode = g_strconcat("SELECT idCode from personne WHERE idCode = '",idCode,NULL);
            requestIdCode = g_strconcat(requestIdCode,"'",NULL);

            mysql_query(program->sock,requestIdCode);
            res = mysql_use_result(program->sock);
            row = mysql_fetch_row(res);

            while(row){
                idCode = createIdCode(program,idCode,conv);
                requestIdCode = requestJob= g_strconcat("SELECT idCode from personne WHERE idCode = '",idCode,NULL);
                requestIdCode = g_strconcat(requestIdCode,"'",NULL);

                mysql_query(program->sock,requestIdCode);
                res = mysql_use_result(program->sock);
                row = mysql_fetch_row(res);
            }

            //Check if the job already exists in DB if not it's created
            requestJob = g_strconcat("SELECT nom from metier WHERE nom = '",conv[8],NULL);
            requestJob = g_strconcat(requestJob,"'",NULL);
            mysql_query(program->sock,requestJob);

            res = mysql_use_result(program->sock);
            row = mysql_fetch_row(res);

            if(!row){

                idCategorie = searchCategoryID(program,res);

                requestInsertJob = "INSERT INTO metier (nom,FK_categorie) VALUES ('";
                requestInsertJob = g_strconcat(requestInsertJob,conv[8],NULL);
                requestInsertJob = g_strconcat(requestInsertJob,"',",NULL);
                requestInsertJob = g_strconcat(requestInsertJob,idCategorie,NULL);
                requestInsertJob = g_strconcat(requestInsertJob,")",NULL);

                mysql_query(program->sock,requestInsertJob);

                if(!mysql_error(program->sock)){
                    errorMessage(program,"Prestataire non ajoute. Erreur BDD(categorie).","AJOUT PRESTATAIRE",GTK_MESSAGE_INFO,GTK_BUTTONS_OK);
                }

            }


            //Request of insert new provider
            requestProvider = g_strconcat("INSERT INTO personne (nom, prenom,mail,dateNaissance,telephone,adresse,ville,codePostal,FK_metier,idCode,mdp,statut) VALUES ('",conv[0],NULL);
            for(i =1; i<9;i++){
                requestProvider = g_strconcat(requestProvider,"','",NULL);
                requestProvider = g_strconcat(requestProvider,conv[i],NULL);
            }

            requestProvider = g_strconcat(requestProvider,"','",NULL);
            requestProvider = g_strconcat(requestProvider,idCode,NULL);
            requestProvider = g_strconcat(requestProvider,"','0000','1')",NULL);

            //mysql_free_result(res);
            mysql_query(program->sock,requestProvider);
            createQRC(program,idCode);

            if(!mysql_error(program->sock)){
                errorMessage(program,"Prestataire non ajoute. Erreur logiciel.","AJOUT PRESTATAIRE",GTK_MESSAGE_INFO,GTK_BUTTONS_OK);
            }else{
                errorMessage(program,"Ajout reussi","AJOUT PRESTATAIRE",GTK_MESSAGE_INFO,GTK_BUTTONS_OK);
                for(i=0;i<9;i++){
                     gtk_entry_set_text(GTK_ENTRY(program->pageForm->entry[i]),"");

                }
            }

        }



    }

    //mysql_free_result(res);
    free(conv);
    free(idCode);
    free(requestProvider);
    free(requestJob);
    free(requestInsertJob);
    free(requestIdCode);
    free(idCategorie);
}


gchar* verificationString(t_program* program, const gchar* text){

    text = g_convert(text,-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    text = str_replace(text, "\'", "\\\'");

return text;
}


int verificationMail(t_program* program,gchar* mail,int statut){

    int i,posArob=0,countArob= 0,countDot =0,len = strlen(mail);
    char forbiddenChar[15] = "()<>,;:\"[]|ç%&";
    char email[len];
    gchar* requestMail = NULL;
    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;


    requestMail =allocateString(requestMail,300,0,program);
    strcpy(email,mail);


    if(strpbrk(email,forbiddenChar) != NULL){
        errorMessage(program,"ERREUR : Caracteres speciaux interdit dans mail. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    if(strchr(mail,' ')){
        errorMessage(program,"ERREUR : Espace dans mail interdit. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
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
            errorMessage(program,"ERREUR : Le mail ne peut pas commencer par une arobase. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }

        if(email[posArob-1] == '.'){
            errorMessage(program,"ERREUR : L'arobase ne peut pas etre precede d'un point. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }

        if(email[posArob+1] == '.'){
            errorMessage(program,"ERREUR : L'arobase ne peut pas etre suivi d'un point. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }

    }else{
        errorMessage(program,"ERREUR : Le mail ne doit contenir qu'une seule arobase. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }


    if(email[len-1] == '.'){
           errorMessage(program,"ERREUR : Le mail ne peut pas finir par un point. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
           return 0;
    }

    for(i=posArob;i<len;i++){
        if(email[i] == '.'){
            countDot = i;
        }
    }

    if(countDot == 0){
        errorMessage(program,"ERREUR : Il manque le point avant l'extention. Format : xxxx@xxx.xxx","ERREUR MAIL",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    //Check if mail already exists in BD
    requestMail = g_strconcat("SELECT mail from personne WHERE mail= '",email,NULL);
    requestMail = g_strconcat(requestMail,"'",NULL);

    mysql_query(program->sock,requestMail);

    res = mysql_use_result(program->sock);
    row = mysql_fetch_row(res);

    if(row && statut == 0){
        errorMessage(program,"ERREUR : Le prestataire existe deja. S'il est necessaire de l'inscrire 2 fois renseignez 2 mails differents.","ERREUR",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        mysql_free_result(res);
        free(requestMail);
        return 0;
    }

    mysql_free_result(res);
    free(requestMail);

return 1;
}



int verificationPhone(t_program* program,gchar* phone){

    int i =0;
    char numPhone[10];

    strcpy(numPhone,phone);

    if(strlen(phone)!=10){
        errorMessage(program,"ERREUR : Format numero de telephone errone. Format : 0XXXXXXXXX","ERREUR NUMERO TELEPHONE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    for(i=0;i<10;i++){
        if(!isdigit(numPhone[i])){
            errorMessage(program,"ERREUR : Numero de telephone invalide. Format : 0XXXXXXXXX ","ERREUR NUMERO TELEPHONE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }else if(numPhone[i] == ' '){
            errorMessage(program,"ERREUR : Entrez un numero de telephone sans espace. Format : 0XXXXXXXXX ","ERREUR NUMERO TELEPHONE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
        }
    }

    if( (numPhone[0]-'0') != 0){
        errorMessage(program,"ERREUR : Numero de telephone invalide. N'utilisez pas le format commencant par : +33. Format : 0XXXXXXXXX ","ERREUR NUMERO TELEPHONE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

return 1;
}



int verificationBirthday(t_program* program,gchar* dateBirthday){

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
        errorMessage(program,"ERREUR : La longueur de la date ne convient pas. Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;

    }

    // Check the validity of the year
    for(i=0;i<4;i++){
        if(!isdigit(date[i])){
           errorMessage(program,"ERREUR : L'annee saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
           free(t);
           return 0;

        }else{
            yearInt = yearInt + (date[i]-'0')*mul;
            mul = mul/10;
        }
    }

    if(yearInt<1900 || yearInt>currentYear ){
        errorMessage(program,"ERREUR : L'annee saisie n'est pas valide (Non comprise entre 1900 et l'annee en cours). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

      // Check the validity of the month

    if(date[4] != '-' || !isdigit(date[5])){
        errorMessage(program,"ERREUR : format non respecte. Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    if(date[6] != '-' && date[7] != '-'){
        errorMessage(program,"ERREUR : format non respecte. Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    if(date[6] == '-'){
        monthInt = date[5]-'0';
        marker = 6;
    }else{
        if(!isdigit(date[6])){
            errorMessage(program,"ERREUR : Le mois saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            free(t);
            return 0;
        }else{
            monthInt = (date[5]-'0')*10 + (date[6]-'0');
            marker = 7;
        }
    }

    if(monthInt<=0 || monthInt>12){
        errorMessage(program,"ERREUR : Le mois saisie n'est pas valide(NOMBRE SUPERIEUR A 12 OU NEGATIF). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    if(yearInt == currentYear &&  monthInt>t->tm_mon){
        errorMessage(program,"ERREUR : Date invalide (MOIS SAISI SUPERIEUR AU MOIS EN COURS). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    // Check the validity of the day

    if(marker == 6){
        if(!isdigit(date[7])){
            errorMessage(program,"ERREUR : Le jour saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            free(t);
            return 0;
        }
        if(len == 8){
            dayInt = (date[7]-'0');
        }else if (len == 9){
            if(!isdigit(date[8])){
                errorMessage(program,"ERREUR : Le jour saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
                free(t);
                return 0;
            }else{
                dayInt = (date[7]-'0')*10 + (date[8]-'0');
            }
        }
    }

        if(marker == 7){
        if(!isdigit(date[8])){
            errorMessage(program,"ERREUR : Le jour saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            free(t);
            return 0;
        }
        if(len == 9){
            dayInt = (date[8]-'0');
        }else if (len == 10){
            if(!isdigit(date[9])){
                errorMessage(program,"ERREUR : Le jour saisie n'est pas valide(NON EGAL A UN NOMBRE). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
                free(t);
                return 0;
            }else{
                dayInt = (date[8]-'0')*10 + (date[9]-'0');
            }
        }
    }

    if(dayInt<=0 || dayInt>31){
        errorMessage(program,"ERREUR : Le jour saisie n'est pas valide(NOMBRE SUPERIEUR A 31 OU NEGATIF). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        free(t);
        return 0;
    }

    if(yearInt == currentYear && monthInt == t->tm_mon && dayInt>t->tm_mday){
        errorMessage(program,"ERREUR : Date invalide (JOUR SAISI SUPERIEUR A LA DATE DU JOURS). Format : AAAA-MM-JJ","ERREUR DATE NAISSANCE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
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


gchar* verificationJob(t_program* program,gchar * job){

    int i = 0;
    job = verificationString(program,job);
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

int verificationPC(t_program* program,gchar * postCode){

    char arrayCP[5];
    strcpy(arrayCP,postCode);

    if(strlen(postCode) != 5){
        errorMessage(program,"ERREUR : Le code postal est trop court. (NON EGAL 5). Format : xxxxx","ERREUR Code Postal",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        return 0;
    }

    for(int i = 0; i<5;i++){
         if(!isdigit(arrayCP[i])){
            errorMessage(program,"ERREUR : Le code postal ne doit contenir que des chiffres. Format : xxxxx","ERREUR Code Postal",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            return 0;
         }
    }

return 1;
}

char* createIdCode(t_program* program,char* idCode,gchar* conv[]){

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

char* allocateString(char* string,int size,int count,t_program* program){

    string=malloc(sizeof(char)*size);

    if(!string){
        free(string);
        allocateString(string,size,++count, program);
        if(count == 3){
            errorMessage(program,"Le programme rencontre un probleme. ERREUR: Malloc string","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            endProgram(program);
        }
    }
return string;

}

char* searchCategoryID(t_program* program,MYSQL_RES* res){


    MYSQL_ROW row = NULL;
    gchar* requestCategory = NULL;
    requestCategory = allocateString(requestCategory,100,0,program);

    requestCategory ="SELECT idCategorie from categorie where nom= '";
    requestCategory = g_strconcat(requestCategory,str_replace(gtk_combo_box_text_get_active_text(GTK_COMBO_BOX_TEXT(program->pageForm->combo)),"\'", "\\\'"),NULL);
    requestCategory = g_strconcat(requestCategory,"'",NULL);

    mysql_query(program->sock,requestCategory);
    res = mysql_store_result(program->sock);

    row = mysql_fetch_row(res);

    if(!mysql_error(program->sock)){
        errorMessage(program,"Prestataire non ajoute. Erreur BDD(categorie).","AJOUT PRESTATAIRE",GTK_MESSAGE_INFO,GTK_BUTTONS_OK);
    }

    free(requestCategory);

    return row[0];
}
