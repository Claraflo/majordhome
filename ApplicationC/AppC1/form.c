
#include "form.h"

void displayForm(t_program* program)
{

    int i=0;
    //Initialization of Widgets

    GtkWidget *vBoxForm=NULL,*boxButton=NULL, *boxJob=NULL;
    GtkWidget **label;
    GtkWidget **entry;
    GtkWidget *buttonValidForm=NULL,*buttonExit=NULL;
    GtkWidget *combo=NULL;

    label = malloc(sizeof(GtkWidget *)*9);
    if(!label){

        errorMessage(program,"Le programme rencontre un probleme et doit fermer. (ERREUR : malloc label form)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(program);
    }

    for(i=0; i<9; i++)
    {
        label[i]= malloc(sizeof(GtkWidget));
        if(!label[i]){
            errorMessage(program,"Le programme rencontre un probleme et doit fermer. (ERREUR : malloc label form)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            endProgram(program);
        }
    }

    entry = malloc(sizeof(GtkWidget *)*9);
    if(!entry){
        errorMessage(program,"Le programme rencontre un probleme et doit fermer. (ERREUR : malloc entry form)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(program);
    }
    for(i=0; i<9; i++)
    {
        entry[i]= malloc(sizeof(GtkWidget));
            if(!entry[i]){
                errorMessage(program,"Le programme rencontre un probleme et doit fermer. (ERREUR : malloc entry form)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
                endProgram(program);
    }
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

        if(i== 0 || i == 1)
        {
            gtk_entry_set_max_length(GTK_ENTRY(entry[i]),80);
        }
        else if(i == 2 || i == 5)
        {
            gtk_entry_set_max_length(GTK_ENTRY(entry[i]),255);
        }
        else if(i==3 || i== 4)
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

    buttonValidForm = gtk_button_new_from_stock(GTK_STOCK_ADD);
    buttonExit = gtk_button_new_from_stock(GTK_STOCK_CANCEL);


    vBoxForm=gtk_box_new(GTK_ORIENTATION_VERTICAL,5);
    boxButton=gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);

    //Add Widgets in the page
    for(i =0; i<9; i++)
    {
        gtk_box_pack_start(GTK_BOX(vBoxForm), label[i], TRUE, FALSE, 2);
        if(i != 8)
        {
            gtk_box_pack_start(GTK_BOX(vBoxForm), entry[i], TRUE, FALSE, 2);
        }
    }

    combo = creatCombo(program);

    boxJob = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,2);
    gtk_box_pack_start(GTK_BOX(boxJob), entry[8], TRUE, TRUE, 2);
    gtk_box_pack_start(GTK_BOX(boxJob), combo, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(vBoxForm), boxJob, TRUE, FALSE, 2);

    gtk_box_pack_start(GTK_BOX(boxButton), buttonValidForm, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(boxButton), buttonExit, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(vBoxForm), boxButton, TRUE, FALSE, 5);

    gtk_container_add(GTK_CONTAINER(program->pbox), vBoxForm);

    //Display Window
    gtk_widget_show_all(vBoxForm);

    t_pageForm* pageForm = creatStructPageForm(program,vBoxForm,entry,combo);
    program->pageForm = pageForm;


    g_signal_connect(G_OBJECT(buttonValidForm), "clicked", G_CALLBACK(ValidationFormProviders),program);
    g_signal_connect(G_OBJECT(buttonExit), "clicked", G_CALLBACK(ValidationReturnMenu),program);

}


t_pageForm* creatStructPageForm(t_program* program,GtkWidget* vBoxForm,GtkWidget** entry,GtkWidget* combo)
{

    t_pageForm* pageForm = malloc(sizeof(t_pageForm));

    if(!pageForm)
    {
        errorMessage(program,"Le programme rencontre un probleme et doit fermer. (ERREUR : malloc pageForm)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(program);
        return NULL;
    }

    pageForm->vbox = vBoxForm ;


    pageForm->entry = malloc(sizeof(GtkWidget*)*9);
    if(!pageForm->entry){
        errorMessage(program,"Le programme rencontre un probleme et doit fermer. (ERREUR : malloc pageForm entry form)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(program);
    }

    for(int i =0; i<9; i++)
    {
        pageForm->entry[i] = malloc(sizeof(GtkWidget));
        if(!pageForm->entry[i]){
            errorMessage(program,"Le programme rencontre un probleme et doit fermer. (ERREUR : malloc pageForm entry form)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
            endProgram(program);
        }
        pageForm->entry[i] = entry[i];
    }

    pageForm->combo = combo;

    return pageForm;

}

void ValidationFormProviders(GtkWidget *buttonValidForm, t_program* program)
{

    addInputInDB(program);

}

void ValidationReturnMenu(GtkWidget *buttonExit, t_program* program)
{

    gtk_widget_hide(program->pageForm->vbox);
    gtk_widget_show_all(program->pageMenu->vbox);

}



GtkWidget* creatCombo(t_program* program)
{

    GtkWidget* combo=NULL;
    MYSQL_RES* result = NULL;

    gchar* requestCombo = "SELECT nom from categorie";

    combo = gtk_combo_box_text_new();

    if(mysql_query(program->sock,requestCombo))
    {
        gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(combo),"");
        free(requestCombo);

        return combo;
    }

    result = mysql_use_result(program->sock);

    if(result)
    {

        int num_fields = mysql_num_fields(result);

        MYSQL_ROW row;

        while ((row = mysql_fetch_row(result)))
        {
            for(int i = 0; i < num_fields; i++)
            {
                if(row[i])
                {
                    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(combo),g_locale_to_utf8(row[i],-1,NULL, NULL, NULL));
                }
                else
                {
                    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(combo),"");
                }
            }
        }
    }
    else
    {
        gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(combo),"");
    }

    free(requestCombo);
    mysql_free_result(result);

    return combo;
}
