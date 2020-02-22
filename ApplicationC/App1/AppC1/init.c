#include "init.h"


GtkWidget* creatWindow(GtkWidget* pWindow){

    pWindow = gtk_window_new(GTK_WINDOW_TOPLEVEL);


    gtk_window_set_position(GTK_WINDOW(pWindow), GTK_WIN_POS_CENTER);
    gtk_window_set_default_size(GTK_WINDOW(pWindow), 400, 300);
    gtk_window_set_title(GTK_WINDOW(pWindow), "Providers Manager");
    gtk_container_set_border_width(GTK_CONTAINER(pWindow), 15);

    displayContainWelcomPage(pWindow);

    return  pWindow;
}


void displayContainWelcomPage(GtkWidget* pWindow){

  //Initialization of Widgets

    GtkWidget *usernameLabel, *passwordLabel, *helloLabel;
    GtkWidget *usernameEntry, *passwordEntry;
    GtkWidget *icon;
    GtkWidget *okButton;
    GtkWidget *hbox0,*hbox1, *hbox2, *hboxIcon;
    GtkWidget *vbox;

  //Creation of Widgets

    helloLabel = gtk_frame_new("Bonjour !");
    gtk_frame_set_label_align(helloLabel, 0.5, 0.0);
    gtk_frame_set_shadow_type(helloLabel,GTK_SHADOW_OUT);
    usernameLabel = gtk_label_new("Identifiant:  ");
    passwordLabel = gtk_label_new("Mot de passe: ");
    usernameEntry = gtk_entry_new();
    passwordEntry = gtk_entry_new();
    gtk_entry_set_max_length(usernameEntry,50);
    gtk_entry_set_max_length(passwordEntry,50);
    gtk_entry_set_visibility(GTK_ENTRY(passwordEntry), FALSE);// Password is not display, instead, dots replace characters
    okButton = gtk_button_new_with_label("Valider");

    hboxIcon = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    hbox0 = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    hbox1 = gtk_box_new(GTK_ORIENTATION_HORIZONTAL, 5);
    hbox2 = gtk_box_new(GTK_ORIENTATION_HORIZONTAL, 5);
    vbox  = gtk_box_new(GTK_ORIENTATION_VERTICAL, 25);

    icon = gtk_image_new_from_file(".\\img\\Majord'home-icon.png");


    gtk_box_pack_start(GTK_BOX(hboxIcon), icon, TRUE, FALSE, 0);
    gtk_box_pack_start(GTK_BOX(hbox0), helloLabel, TRUE, TRUE, 0);
    gtk_box_pack_start(GTK_BOX(hbox1), usernameLabel, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(hbox1), usernameEntry, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(hbox2), passwordLabel, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(hbox2), passwordEntry, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(vbox), hboxIcon, FALSE, FALSE, 0);
    gtk_box_pack_start(GTK_BOX(vbox), hbox0, FALSE, FALSE, 0);
    gtk_box_pack_start(GTK_BOX(vbox), hbox1, FALSE, FALSE, 2);
    gtk_box_pack_start(GTK_BOX(vbox), hbox2, FALSE, FALSE, 2);
    gtk_box_pack_start(GTK_BOX(vbox), okButton, FALSE, FALSE, 2);

    gtk_container_add(GTK_CONTAINER(pWindow), vbox);

    //Display Window
    gtk_widget_show_all(pWindow);

    t_pageAuth* inputData = creatStructPageAuth(inputData,pWindow, usernameEntry,passwordEntry,vbox);
    g_signal_connect(G_OBJECT(okButton), "clicked", G_CALLBACK(ValidationAuthentication),inputData);

   }

t_pageAuth* creatStructPageAuth(t_pageAuth* inputData,GtkWidget* pWindow, GtkWidget* usernameEntry, GtkWidget* passwordEntry,GtkWidget* vbox){

    inputData = malloc(sizeof(t_pageAuth));

        if(!inputData){
            // créer fonction erreur
            return NULL;
        }

    t_program* t_program = creatStructProgram(pWindow);

    inputData->username = usernameEntry;
    inputData->password = passwordEntry;
    inputData->vbox = vbox;
    inputData->t_program = t_program;

return inputData;
}

void ValidationAuthentication(GtkWidget *button, t_pageAuth* inputData){

    authentication(inputData);

}

t_program* creatStructProgram(GtkWidget* pWindow){

    t_program* t_program  = malloc(sizeof(t_program));

        if(!t_program){
            //fenetre erreur;
            return NULL;
        }

    t_program->pWindow= pWindow;

return t_program;
}
