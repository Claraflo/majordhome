
#include "form.h"

void displayForm(t_program* t_program){

    int i=0;
    //Initialization of Widgets

    GtkWidget *vBoxForm,*boxButton, *boxJob;
    GtkWidget **label;
    GtkWidget **entry;
    GtkWidget *buttonValidForm,*buttonExit;
    GtkWidget *combo;

    label = malloc(sizeof(GtkWidget *)*10);
    for(i=0;i<10;i++){
        label[i]= malloc(sizeof(GtkWidget));
    }

    entry = malloc(sizeof(GtkWidget *)*10);
    for(i=0;i<10;i++){
        entry[i]= malloc(sizeof(GtkWidget));
    }

  //Creation of Widgets

    label[0] = gtk_label_new("Nom :");
    label[1] = gtk_label_new("Prenom :");
    label[2] = gtk_label_new("Email :");
    label[3] = gtk_label_new("Date de naissance (AAAA-MM-JJ) :");
    label[4] = gtk_label_new("Telephone :");
    label[5] = gtk_label_new("Telephone pro :");
    label[6] = gtk_label_new("Adresse :");
    label[7] = gtk_label_new("Ville :");
    label[8] = gtk_label_new("Code Postal :");
    label[9] = gtk_label_new("Metier :");


    for(i =0; i<10;i++){

        entry[i]=gtk_entry_new();

        if(i== 0 || i == 1){
            gtk_entry_set_max_length(GTK_ENTRY(entry[i]),80);
        }else if(i == 2 || i == 6){
            gtk_entry_set_max_length(GTK_ENTRY(entry[i]),400);
        }else if(i==3 || i== 4 ||i==5){
            gtk_entry_set_max_length(GTK_ENTRY(entry[i]),10);
        }else if(i == 7){
            gtk_entry_set_max_length(GTK_ENTRY(entry[i]),100);
        }else if(i == 8){
            gtk_entry_set_max_length(GTK_ENTRY(entry[i]),5);
        }else if(i == 9){
            gtk_entry_set_max_length(GTK_ENTRY(entry[i]),50);
        }
    }

    buttonValidForm = gtk_button_new_from_stock(GTK_STOCK_ADD);
    buttonExit = gtk_button_new_from_stock(GTK_STOCK_CANCEL);


    vBoxForm=gtk_box_new(GTK_ORIENTATION_VERTICAL,5);
    boxButton=gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);

    //Add Widgets in the page
    for(i =0; i<10;i++){
        gtk_box_pack_start(GTK_BOX(vBoxForm), label[i], TRUE, FALSE, 2);
        if(i != 9){
            gtk_box_pack_start(GTK_BOX(vBoxForm), entry[i], TRUE, FALSE, 2);
        }
    }

    combo = creatCombo(t_program,combo);

    boxJob = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,2);
    gtk_box_pack_start(GTK_BOX(boxJob), entry[9], TRUE, TRUE, 2);
    gtk_box_pack_start(GTK_BOX(boxJob), combo, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(vBoxForm), boxJob, TRUE, FALSE, 2);

    gtk_box_pack_start(GTK_BOX(boxButton), buttonValidForm, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(boxButton), buttonExit, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(vBoxForm), boxButton, TRUE, FALSE, 5);

    gtk_container_add(GTK_CONTAINER(t_program->pbox), vBoxForm);

    //Display Window
    gtk_widget_show_all(vBoxForm);

    t_pageForm* t_pageForm = creatStructPageForm(t_pageForm,vBoxForm,entry,combo);
    t_program->t_pageForm = t_pageForm;


    g_signal_connect(G_OBJECT(buttonValidForm), "clicked", G_CALLBACK(ValidationFormProviders),t_program);
    g_signal_connect(G_OBJECT(buttonExit), "clicked", G_CALLBACK(ValidationReturnMenu),t_program);

}


t_pageForm* creatStructPageForm(t_pageForm* t_pageForm,GtkWidget* vBoxForm,GtkWidget** entry,GtkWidget* combo){

    t_pageForm = malloc(sizeof(t_pageForm));

        if(!t_pageForm){
            printf("erreur malloc pageForm");
            return NULL;
        }

    t_pageForm->vbox = vBoxForm ;


    t_pageForm->entry = malloc(sizeof(GtkWidget*)*10);

    for(int i =0; i<10;i++){
        t_pageForm->entry[i] = malloc(sizeof(GtkWidget));
        t_pageForm->entry[i] = entry[i];
    }

    t_pageForm->combo = combo;

return t_pageForm;

}

void ValidationFormProviders(GtkWidget *buttonValidForm, t_program* t_program){

    addInputInDB(t_program);

}

void ValidationReturnMenu(GtkWidget *buttonExit, t_program* t_program){

    gtk_widget_hide(t_program->t_pageForm->vbox);
    gtk_widget_show_all(t_program->t_pageMenu->vbox);

}



GtkWidget* creatCombo(t_program* t_program,GtkWidget* combo){


    MYSQL_RES* result = NULL;

    gchar* requestCombo = "SELECT nom from type";

    combo = gtk_combo_box_text_new();

    if(mysql_query(t_program->sock,requestCombo)){
        gtk_combo_box_text_append_text(GTK_COMBO_BOX(combo),"");
        free(requestCombo);
        printf("Erreur envoie requete");
        return combo;
    }

    result = mysql_use_result(t_program->sock);

    if(result){

        int num_fields = mysql_num_fields(result);

        MYSQL_ROW row;

        while ((row = mysql_fetch_row(result)))
          {
            for(int i = 0; i < num_fields; i++)
            {
                if(row[i]){
                    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(combo),row[i]);
                }else{
                    printf("Erreur avec row");
                }
            }
        }
    }else{
    printf("Erreur dans l'init de result");
    gtk_combo_box_text_append_text(GTK_COMBO_BOX(combo),"");

    }

    free(requestCombo);
    mysql_free_result(result);

  return combo;
}
