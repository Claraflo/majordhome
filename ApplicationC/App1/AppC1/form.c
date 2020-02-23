
#include "form.h"

void displayForm(t_program* t_program){

    int i=0;
    //Initialization of Widgets

    GtkWidget *vBoxForm,*boxButton;
    GtkWidget *label[8];//labelName,*labelFirstName,*labelMail,*labelBirthday,*labelPhone,*labelAdress,*labelCity,*labelCodeCity;
    GtkWidget *entry[8];//*entryName,*entryFirstName,*entryMail,*entryBirthday,*entryPhone,*entryAdress,*entryCity,*entryCodeCity;
    GtkWidget *buttonValidForm,*buttonExit;

  //Creation of Widgets

    label[0] = gtk_label_new("Nom :");
    label[1] = gtk_label_new("Prenom :");
    label[2] = gtk_label_new("Email :");
    label[3] = gtk_label_new("Date de naissance :");
    label[4] = gtk_label_new("Telephone :");
    label[5] = gtk_label_new("Adresse :");
    label[6] = gtk_label_new("Ville :");
    label[7] = gtk_label_new("Code Postal :");


    for(i =0; i<8;i++){

        entry[i]=gtk_entry_new();
        if(i!=5){
            gtk_entry_set_max_length(entry[i],50);
        }else{
            gtk_entry_set_max_length(entry[i],400);
        }
    }


    buttonValidForm = gtk_button_new_from_stock(GTK_STOCK_ADD);
    buttonExit = gtk_button_new_from_stock(GTK_STOCK_CANCEL);

    vBoxForm=gtk_box_new(GTK_ORIENTATION_VERTICAL,5);
    boxButton=gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);

    //Add Widgets in the page
    for(i =0; i<8;i++){
    gtk_box_pack_start(GTK_BOX(vBoxForm), label[i], TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(vBoxForm), entry[i], TRUE, FALSE, 5);
    }

    gtk_box_pack_start(GTK_BOX(boxButton), buttonValidForm, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(boxButton), buttonExit, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(vBoxForm), boxButton, TRUE, FALSE, 5);

    gtk_container_add(GTK_CONTAINER(t_program->pbox), vBoxForm);

    //Display Window
    gtk_widget_show_all(vBoxForm);


    t_pageForm* t_pageForm = creatStructPageForm(t_pageForm,vBoxForm);
    t_program->t_pageForm = t_pageForm;

    g_signal_connect(G_OBJECT(buttonValidForm), "clicked", G_CALLBACK(ValidationFormProviders),t_program);
    g_signal_connect(G_OBJECT(buttonExit), "clicked", G_CALLBACK(ValidationReturnMenu),t_program);

}

t_pageForm* creatStructPageForm(t_pageForm* t_pageForm,GtkWidget* vBoxForm){

    t_pageForm = malloc(sizeof(t_pageForm));

        if(!t_pageForm){
            //fenetre erreur;
            return NULL;
        }

    t_pageForm->vbox = vBoxForm ;

return t_pageForm;

}

void ValidationFormProviders(GtkWidget *buttonValidForm, t_program* t_program){

    gtk_widget_hide(t_program->t_pageForm->vbox);
}

void ValidationReturnMenu(GtkWidget *buttonExit, t_program* t_program){

    gtk_widget_hide(t_program->t_pageForm->vbox);
    gtk_widget_show_all(t_program->t_pageMenu->vbox);

}
