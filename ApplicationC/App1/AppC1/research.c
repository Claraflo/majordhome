#include"research.h"
#include <gtk/gtk.h>

enum
{
    ID_COLUMN = 0,
    JOB_COLUMN,
    NAME_COLUMN,
    FIRSTNAME_COLUMN,
    BIRTHDAY_COLUMN,
    PHONE_COLUMN,
    MAIL_COLUMN,
    ADRESS_COLUMN,
    CITY_COLUMN,
    PC_COLUMN,
    NUM_COLS
};


GtkTreeModel * create_and_fill_model (t_program* program,gchar* request, int statut)
{
    GtkListStore  *store= NULL;
    GtkTreeIter    iter;
    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;


    mysql_query(program->sock,request);

        res = mysql_use_result(program->sock);

        if(res){

            if(statut == 0)
            {
                store = gtk_list_store_new (NUM_COLS,G_TYPE_STRING, G_TYPE_STRING,G_TYPE_STRING, G_TYPE_STRING,G_TYPE_STRING, G_TYPE_STRING,G_TYPE_STRING, G_TYPE_STRING,G_TYPE_STRING, G_TYPE_STRING);

                while ((row = mysql_fetch_row(res)))
                {
                    /* Append a row and fill in some data */
                    gtk_list_store_append (store, &iter);
                    gtk_list_store_set (store, &iter,
                                        ID_COLUMN,g_locale_to_utf8(row[0], -1, NULL, NULL, NULL),
                                        JOB_COLUMN,g_locale_to_utf8(row[1], -1, NULL, NULL, NULL),
                                        NAME_COLUMN,g_locale_to_utf8(row[2], -1, NULL, NULL, NULL),
                                        FIRSTNAME_COLUMN,g_locale_to_utf8(row[3], -1, NULL, NULL, NULL),
                                        BIRTHDAY_COLUMN,g_locale_to_utf8(row[4], -1, NULL, NULL, NULL),
                                        PHONE_COLUMN,g_locale_to_utf8(row[5], -1, NULL, NULL, NULL),
                                        MAIL_COLUMN,g_locale_to_utf8(row[6], -1, NULL, NULL, NULL),
                                        ADRESS_COLUMN,g_locale_to_utf8(row[7], -1, NULL, NULL, NULL),
                                        CITY_COLUMN,g_locale_to_utf8(row[8], -1, NULL, NULL, NULL),
                                        PC_COLUMN,g_locale_to_utf8(row[9], -1, NULL, NULL, NULL),-1);

                }
            }
            else if(statut == 1)
            {

                GtkTreeModel *model = NULL;
                store = GTK_LIST_STORE(gtk_tree_view_get_model(GTK_TREE_VIEW(program->pageResearch->view)));
                model = gtk_tree_view_get_model(GTK_TREE_VIEW(program->pageResearch->view));

                if (gtk_tree_model_get_iter_first(model, &iter) == FALSE)
                {
                    return;
                }

                gtk_list_store_clear(store);

                while ((row = mysql_fetch_row(res)))
                {
                    /* Append a row and fill in some data */
                    gtk_list_store_append (store, &iter);
                    gtk_list_store_set (store, &iter,
                                        ID_COLUMN,g_locale_to_utf8(row[1], -1, NULL, NULL, NULL),
                                        JOB_COLUMN,g_locale_to_utf8(row[12], -1, NULL, NULL, NULL),
                                        NAME_COLUMN,g_locale_to_utf8(row[2], -1, NULL, NULL, NULL),
                                        FIRSTNAME_COLUMN,g_locale_to_utf8(row[3], -1, NULL, NULL, NULL),
                                        BIRTHDAY_COLUMN,g_locale_to_utf8(row[5], -1, NULL, NULL, NULL),
                                        PHONE_COLUMN,g_locale_to_utf8(row[6], -1, NULL, NULL, NULL),
                                        MAIL_COLUMN,g_locale_to_utf8(row[4], -1, NULL, NULL, NULL),
                                        ADRESS_COLUMN,g_locale_to_utf8(row[7], -1, NULL, NULL, NULL),
                                        CITY_COLUMN,g_locale_to_utf8(row[8], -1, NULL, NULL, NULL),
                                        PC_COLUMN,g_locale_to_utf8(row[9], -1, NULL, NULL, NULL),-1);
                }

            }

        }else{
            errorMessage(program,"Le programme ne peut afficher les informations.","Erreur resultat BDD",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            endProgram(program);
        }

    mysql_free_result(res);

    return GTK_TREE_MODEL (store);
}

GtkWidget * create_view_and_model (t_program* program)
{
    GtkCellRenderer     *renderer= NULL;
    GtkTreeModel        *model= NULL;
    GtkWidget           *view= NULL;



    view = gtk_tree_view_new ();

    /* --- Column #1 --- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "IdCode",
            renderer,
            "text", ID_COLUMN,
            NULL);

    /* --- Column #2 --- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Nom",
            renderer,
            "text", NAME_COLUMN,
            NULL);


    /* --- Column #3 --- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Prenom",
            renderer,
            "text", FIRSTNAME_COLUMN,
            NULL);

    /* --- Column #4 --- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Date naissance",
            renderer,
            "text", BIRTHDAY_COLUMN,
            NULL);


    /* --- Column #5--- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Metier",
            renderer,
            "text", JOB_COLUMN,
            NULL);

    /* --- Column #6--- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Telephone",
            renderer,
            "text", PHONE_COLUMN,
            NULL);


    /* --- Column #7 --- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Mail",
            renderer,
            "text", MAIL_COLUMN,
            NULL);
    /* --- Column #8 --- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Adresse",
            renderer,
            "text", ADRESS_COLUMN,
            NULL);

    /* --- Column #9 --- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Ville",
            renderer,
            "text", CITY_COLUMN,
            NULL);

    /* --- Column #10 --- */

    renderer = gtk_cell_renderer_text_new();
    gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
            -1,
            "Code Postal",
            renderer,
            "text", PC_COLUMN,
            NULL);



    model = create_and_fill_model (program,"SELECT idCode,FK_metier,nom,prenom,dateNaissance,tel,mail,adresse,ville,codePostal FROM personne WHERE statut = 1",0);

    gtk_tree_view_set_model (GTK_TREE_VIEW (view), model);

    g_object_unref (model);
    return view;
}

void initResearch(t_program* program)
{

    GtkWidget *sw= NULL;
    GtkWidget *view= NULL;

    GtkWidget *remove= NULL;
    GtkWidget *add= NULL;
    GtkWidget *all= NULL;
    GtkWidget *modify= NULL;
    GtkWidget *research= NULL;
    GtkWidget *menu= NULL;
    GtkWidget *entry= NULL;

    GtkWidget *vbox= NULL;
    GtkWidget *hbox= NULL;

    GtkTreeSelection *selection= NULL;
    t_pageResearch* pageResearch = NULL;


    sw = gtk_scrolled_window_new(NULL, NULL);
    view = create_view_and_model (program);

    gtk_container_add(GTK_CONTAINER(sw), view);

    gtk_scrolled_window_set_policy(GTK_SCROLLED_WINDOW(sw),GTK_POLICY_AUTOMATIC, GTK_POLICY_AUTOMATIC);

    gtk_scrolled_window_set_shadow_type(GTK_SCROLLED_WINDOW(sw),GTK_SHADOW_ETCHED_IN);

    gtk_scrolled_window_set_min_content_width(GTK_SCROLLED_WINDOW(sw),900);
    gtk_scrolled_window_set_min_content_height(GTK_SCROLLED_WINDOW(sw),200);

    vbox = gtk_box_new(GTK_ORIENTATION_VERTICAL, 0);
    gtk_box_pack_start(GTK_BOX(vbox), sw, TRUE, TRUE, 5);

    hbox = gtk_box_new(GTK_ORIENTATION_HORIZONTAL, 5);

    add = gtk_button_new_with_label("Ajouter");
    research = gtk_button_new_with_label("Recherche");
    all = gtk_button_new_with_label("Tout afficher");
    modify = gtk_button_new_with_label("Modifier");
    remove = gtk_button_new_with_label("Supprimer");
    menu = gtk_button_new_with_label("Menu");
    entry = gtk_entry_new();
    gtk_entry_set_max_length(GTK_ENTRY(entry),255);

    gtk_box_pack_start(GTK_BOX(hbox), research, FALSE, TRUE, 3);
    gtk_box_pack_start(GTK_BOX(hbox), entry, FALSE, TRUE, 3);
    gtk_box_pack_start(GTK_BOX(hbox), all, FALSE, TRUE, 3);
    gtk_box_pack_start(GTK_BOX(hbox), add, FALSE, TRUE, 3);
    gtk_box_pack_start(GTK_BOX(hbox), modify, FALSE, TRUE, 3);
    gtk_box_pack_start(GTK_BOX(hbox), remove, FALSE, TRUE, 3);
    gtk_box_pack_start(GTK_BOX(hbox), menu, FALSE, TRUE, 3);

    gtk_box_pack_start(GTK_BOX(vbox), hbox, FALSE, TRUE, 3);
    gtk_container_add(GTK_CONTAINER(program->pbox), vbox);


    selection = gtk_tree_view_get_selection(GTK_TREE_VIEW(view));
    pageResearch = creatStructPageResearch(program, vbox,selection,view,entry);

    g_signal_connect(G_OBJECT(add), "clicked",G_CALLBACK(appendItem),program);
    g_signal_connect(G_OBJECT(research), "clicked",G_CALLBACK(researchItem), program);
    g_signal_connect(G_OBJECT(modify), "clicked",G_CALLBACK(modifyItem), program);
    g_signal_connect(G_OBJECT(menu), "clicked",G_CALLBACK(GoBackMenu), program);
    g_signal_connect(G_OBJECT(remove), "clicked",G_CALLBACK(removeItem), program);
    g_signal_connect(G_OBJECT(all), "clicked",G_CALLBACK(displayAll), program);



    gtk_widget_show_all(vbox);

}

t_pageResearch* creatStructPageResearch(t_program* program,GtkWidget* vboxResearch,GtkTreeSelection *selection,GtkWidget* view,GtkWidget* entry)
{

    t_pageResearch* pageResearch = malloc(sizeof(t_pageResearch));

    if(!pageResearch)
    {
        errorMessage(program,"Le programme ne parvient pas a etablir de connexion avec la BDD.  Fermez la fenetre d'accueil et verrifiez la connexion avant d'ouvrir a nouveau le programme.","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(program);
        return NULL;
    }

    pageResearch->entry = malloc(sizeof(GtkWidget*)*9);

    for(int i =0; i<9; i++)
    {
        pageResearch->entry[i] = malloc(sizeof(GtkWidget));
        pageResearch->entry[i] = NULL;
    }

    pageResearch->vbox =  vboxResearch;
    pageResearch->modifyBox =  NULL;
    pageResearch->buttonBox =  NULL;
    pageResearch->combo =  NULL;
    pageResearch->idCode = malloc(sizeof(char)*12);
    pageResearch->selection= selection;
    pageResearch->view= view;
    pageResearch->entrySearch=entry;
    program->pageResearch = pageResearch;


    return pageResearch;
}

void displayAll(GtkWidget *pWidget, t_program* program)
{

    GtkTreeModel *model;
    model = create_and_fill_model (program,"SELECT idCode,FK_metier,nom,prenom,dateNaissance,tel,mail,adresse,ville,codePostal FROM personne WHERE statut = 1",0);

    gtk_tree_view_set_model (GTK_TREE_VIEW (program->pageResearch->view), model);

    g_object_unref (model);
}


void appendItem(GtkWidget *pWidget, t_program* program)
{
    gtk_widget_hide(program->pageResearch->vbox);

    gtk_widget_hide(program->pageResearch->vbox);
    if(program->pageForm)
    {
        gtk_widget_show_all(program->pageForm->vbox);
    }
    else
    {
        displayForm(program);
    }

}

void researchItem(GtkWidget *pWidget, t_program* program)
{

    GtkListStore *store=NULL;
    GtkTreeModel *model=NULL;
    GtkTreeIter  iter;

    gchar* conversionEntry = NULL;
    conversionEntry = allocateString(conversionEntry,255,0,program);


    conversionEntry = g_convert(gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entrySearch)),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);
    conversionEntry = str_replace(conversionEntry, "\'", "\\\'");

    if(strlen(conversionEntry)!=0)
    {

        gchar* requestResearch = allocateString(conversionEntry,3000,0,program);
        requestResearch = "SELECT * FROM `personne` WHERE statut = 1 && (idCode = '";
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || nom = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || prenom = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || mail = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || tel = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || dateNaissance = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || adresse = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || ville = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || codePostal = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"' || FK_metier = '",NULL);
        requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
        requestResearch = g_strconcat(requestResearch,"')",NULL);

        model = create_and_fill_model (program,requestResearch,1);

        free(requestResearch);

    }

    free(conversionEntry);
}

void modifyItem(GtkWidget *pWidget, t_program* program)
{
    int i = 0;
    GtkListStore *store=NULL;
    GtkTreeModel *model=NULL;
    GtkTreeIter  iter;

    store = GTK_LIST_STORE(gtk_tree_view_get_model(GTK_TREE_VIEW(program->pageResearch->view)));
    model = gtk_tree_view_get_model(GTK_TREE_VIEW(program->pageResearch->view));


    if (gtk_tree_model_get_iter_first(model, &iter) == FALSE)
    {
        return;
    }

    if (gtk_tree_selection_get_selected(GTK_TREE_SELECTION(program->pageResearch->selection),
                                        &model, &iter))
    {


        MYSQL_ROW row = NULL;
        MYSQL_RES* res = NULL;
        GtkWidget* hbox;
        GtkWidget **vbox;
        GtkWidget **label;
        GtkWidget **entry;
        GtkWidget *combo;
        GtkWidget* buttonValidForm;
        GtkWidget* buttonExit;
        GtkWidget* boxButton;


        gchar *idCode = NULL;
        idCode =allocateString(idCode,12,0,program);
        if(!idCode){
            endProgram(program);
        }
        gtk_tree_model_get (model, &iter, ID_COLUMN, &idCode, -1);

        gchar* requestRemove =NULL;

        requestRemove =allocateString(requestRemove,60,0,program);

        requestRemove = "SELECT * FROM personne WHERE idCode ='";
        requestRemove = g_strconcat(requestRemove,idCode,NULL);
        requestRemove = g_strconcat(requestRemove,"'",NULL);

        mysql_query(program->sock,requestRemove);

        res = mysql_use_result(program->sock);

        if(res)
        {

            label = malloc(sizeof(GtkWidget *)*9);
            for(i=0; i<9; i++)
            {
                label[i]= malloc(sizeof(GtkWidget));
            }

            entry = malloc(sizeof(GtkWidget *)*9);
            for(i=0; i<9; i++)
            {
                entry[i]= malloc(sizeof(GtkWidget));
            }

            vbox = malloc(sizeof(GtkWidget *)*9);
            for(i=0; i<9; i++)
            {
                vbox[i]= malloc(sizeof(GtkWidget));
            }



            //Creation of Widgets

            label[0] = gtk_label_new("Nom :");
            label[1] = gtk_label_new("Prenom :");
            label[2] = gtk_label_new("Email :");
            label[3] = gtk_label_new("Date de naissance (AAAA-MM-JJ) :");
            label[4] = gtk_label_new("Telephone :");
            label[5] = gtk_label_new("Adresse :");
            label[6] = gtk_label_new("Ville :");
            label[7] = gtk_label_new("Code Postal :");
            label[8] = gtk_label_new("Metier :");

            for(i =0; i<9; i++)
            {

                entry[i]=gtk_entry_new();

                if(i== 0)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),80);
                }
                else if(i == 1)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),80);
                }
                else if(i == 2)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),255);
                }
                else if(i == 5)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),255);
                }
                else if(i==3)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),10);
                }
                else if(i== 4)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),10);
                }
                else if(i == 6)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),100);
                }
                else if(i == 7)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),5);
                }
                else if(i == 8)
                {
                    gtk_entry_set_max_length(GTK_ENTRY(entry[i]),50);
                }
            }

            while ((row = mysql_fetch_row(res)))
            {
                gtk_entry_set_text(GTK_ENTRY(entry[0]),row[2]);
                gtk_entry_set_text(GTK_ENTRY(entry[1]),row[3]);
                gtk_entry_set_text(GTK_ENTRY(entry[2]),row[4]);
                gtk_entry_set_text(GTK_ENTRY(entry[5]),row[7]);
                gtk_entry_set_text(GTK_ENTRY(entry[3]),row[5]);
                gtk_entry_set_text(GTK_ENTRY(entry[4]),row[6]);
                gtk_entry_set_text(GTK_ENTRY(entry[6]),row[8]);
                gtk_entry_set_text(GTK_ENTRY(entry[7]),row[9]);
                gtk_entry_set_text(GTK_ENTRY(entry[8]),row[12]);
            }
        }


        for(i =0; i<9; i++)
        {

            vbox[i]=gtk_box_new(GTK_ORIENTATION_VERTICAL,5);
        }

        hbox=gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);

        //Add Widgets in the page
        for(i =0; i<9; i++)
        {
            gtk_box_pack_start(GTK_BOX(vbox[i]), label[i], TRUE, FALSE, 2);
            gtk_box_pack_start(GTK_BOX(vbox[i]), entry[i], TRUE, FALSE, 2);
            gtk_box_pack_start(GTK_BOX(hbox), vbox[i], FALSE, FALSE, 2);
        }

        gtk_box_pack_start(GTK_BOX(program->pageResearch->vbox), hbox, TRUE, FALSE, 2);

        buttonValidForm = gtk_button_new_from_stock(GTK_STOCK_ADD);
        buttonExit = gtk_button_new_from_stock(GTK_STOCK_CANCEL);
        boxButton=gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
        combo = creatCombo(program);
        gtk_box_pack_start(GTK_BOX(boxButton), combo, FALSE, FALSE, 2);
        gtk_box_pack_start(GTK_BOX(boxButton), buttonValidForm, FALSE, FALSE, 2);
        gtk_box_pack_start(GTK_BOX(boxButton), buttonExit, FALSE, FALSE, 2);
        gtk_box_pack_start(GTK_BOX(program->pageResearch->vbox), boxButton, FALSE, FALSE, 2);

        gtk_widget_show_all(program->pageResearch->vbox);

        program->pageResearch->modifyBox = hbox;
        program->pageResearch->buttonBox = boxButton;
        program->pageResearch->combo = combo;
         strcpy(program->pageResearch->idCode,idCode);

        for(int i =0; i<9; i++)
        {
            program->pageResearch->entry[i] = entry[i];
        }

        g_signal_connect(G_OBJECT(buttonValidForm), "clicked",G_CALLBACK(modification), program);
        g_signal_connect(G_OBJECT(buttonExit), "clicked",G_CALLBACK(cancelModification), program);

        mysql_free_result(res);
        free(idCode);
        free(requestRemove);
    }

}


void modification(GtkWidget *pWidget,t_program* program)
{

    int i,countEmpty=0;
    char** conv;
    char** label;
    gchar* requestProvider = NULL;
    gchar* requestJob = NULL;

    MYSQL_ROW row = NULL;
    MYSQL_RES* res = NULL;

    requestProvider = allocateString(requestProvider,1200,0,program);
    requestJob = allocateString(requestJob,100,0,program);


    //Check if inputs are not empty
    for(i=0; i<9; i++)
    {
        if(strlen(gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[i])))== 0)
        {
            countEmpty ++;
        }
        if(gtk_combo_box_text_get_active_text(GTK_COMBO_BOX_TEXT(program->pageResearch->combo)) == NULL)
        {
            countEmpty ++;
        }
    }

    if(countEmpty != 0)
    {
        errorMessage(program,"ERREUR : Champ(s) vide(s)","ERREUR FORMULAIRE",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
    }
    else
    {

        conv=malloc(sizeof(char*)*9);
        for(i=0; i<9; i++)
        {
            conv[i]=malloc(sizeof(char)*400);
        }

        if(!conv)
        {
            errorMessage(program,"Le programme rencontre un probleme. ERREUR: Malloc conv ","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            endProgram(program);
        }

        conv[0] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[0])));//name
        conv[1] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[1])));//firstname
        conv[2] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[2])));//mail
        conv[3] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[3])));//Birthday
        conv[4] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[4])));//Phone
        conv[5] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[5])));//Adress
        conv[6] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[6])));//Town
        conv[7] = verificationString(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[7])));//Post Code
        conv[8] = verificationJob(program,gtk_entry_get_text(GTK_ENTRY(program->pageResearch->entry[8])));//Job

        label=malloc(sizeof(char*)*9);
        for(i=0; i<9; i++)
        {
            label[i]=malloc(sizeof(char)*20);
        }

        if(!label)
        {
            errorMessage(program,"Le programme rencontre un probleme. ERREUR: Malloc Label ","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            endProgram(program);
        }


        label[0] = "nom";
        label[1] = "prenom";
        label[2] = "mail";
        label[3] = "dateNaissance";
        label[4] = "tel";
        label[5] = "adresse";
        label[6] = "ville";
        label[7] = "codePostal";
        label[8] = "FK_metier";


        if(verificationBirthday(program,conv[3]) && verificationPhone(program,conv[4]) && verificationMail(program,conv[2],1)&& verificationPC(program,conv[7]))
        {



            //Check if the job already exists in DB if not it's created
            requestJob= g_strconcat("SELECT nom from metier WHERE nom = '",conv[8],NULL);
            requestJob = g_strconcat(requestJob,"'",NULL);

            mysql_query(program->sock,requestJob);

            res = mysql_use_result(program->sock);
            row = mysql_fetch_row(res);


            if(!row)
            {
                requestJob = "INSERT INTO metier (nom,FK_type) VALUES ('";
                requestJob = g_strconcat(requestJob,conv[8],NULL);
                requestJob = g_strconcat(requestJob,"','",NULL);
                requestJob = g_strconcat(requestJob,str_replace(gtk_combo_box_text_get_active_text(GTK_COMBO_BOX_TEXT(program->pageResearch->combo)),"\'","\\\'"),NULL);
                requestJob = g_strconcat(requestJob,"')",NULL);
                mysql_query(program->sock,requestJob);


            }

            mysql_free_result(res);
            //Request of insert new provider


            requestProvider = g_strconcat("UPDATE personne SET nom ='",conv[0],NULL);
            for(int i =1; i<9; i++)
            {
                requestProvider = g_strconcat(requestProvider,"' , ",NULL);
                requestProvider = g_strconcat(requestProvider,label[i],NULL);
                requestProvider = g_strconcat(requestProvider," = '",NULL);
                requestProvider = g_strconcat(requestProvider,conv[i],NULL);
            }
            requestProvider = g_strconcat(requestProvider,"'",NULL);

            requestProvider = g_strconcat(requestProvider," WHERE idCode = '",NULL);
            requestProvider = g_strconcat(requestProvider,program->pageResearch->idCode,NULL);
            requestProvider = g_strconcat(requestProvider,"'",NULL);


            mysql_query(program->sock,requestProvider);

        }



    }


    free(conv);
    free(requestProvider);
    free(requestJob);


}

void cancelModification(GtkWidget *pWidget,t_program*program)
{

    gtk_widget_destroy(program->pageResearch->modifyBox);
    gtk_widget_destroy(program->pageResearch->buttonBox);

}

void GoBackMenu(GtkWidget *pWidget, t_program* program)
{

    gtk_widget_hide(program->pageResearch->vbox);
    gtk_widget_show_all(program->pageMenu->vbox);

}

void removeItem(GtkWidget *pWidget, t_program* program)
{

    GtkListStore *store;
    GtkTreeModel *model;
    GtkTreeIter  iter;

    store = GTK_LIST_STORE(gtk_tree_view_get_model(GTK_TREE_VIEW(program->pageResearch->view)));
    model = gtk_tree_view_get_model(GTK_TREE_VIEW(program->pageResearch->view));

    if (gtk_tree_model_get_iter_first(model, &iter) == FALSE)
    {
        return;
    }

    if (gtk_tree_selection_get_selected(GTK_TREE_SELECTION(program->pageResearch->selection),
                                        &model, &iter))
    {

        gchar *idCode = allocateString(idCode,12,0,program);
        gtk_tree_model_get (model, &iter, ID_COLUMN, &idCode, -1);

        gchar* requestRemove = NULL;
        requestRemove = allocateString(requestRemove,60,0,program);

        requestRemove = "DELETE FROM personne WHERE idCode ='";
        requestRemove = g_strconcat(requestRemove,idCode,NULL);
        requestRemove = g_strconcat(requestRemove,"'",NULL);


        mysql_query(program->sock,requestRemove);
        // Test connexion


        free(requestRemove);
        g_free(idCode);
        gtk_list_store_remove(store, &iter);
    }

}



