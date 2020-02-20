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

    t_inputAuth* inputData = creatStructInput(inputData,usernameEntry,passwordEntry);

    g_signal_connect(G_OBJECT(okButton), "clicked", G_CALLBACK(ValidationAuthentication),inputData);

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



   }

t_inputAuth* creatStructInput(t_inputAuth* inputData, GtkWidget* usernameEntry, GtkWidget* passwordEntry){

    inputData = malloc(sizeof(t_inputAuth));

        if(!inputData){
            // créer fonction erreur
            return NULL;
        }
    inputData->username = usernameEntry;
    inputData->password = passwordEntry;

return inputData;
}

void ValidationAuthentication(GtkWidget *button, t_inputAuth* inputData){

    printf("%s",gtk_entry_get_text(GTK_ENTRY(inputData->username)));
    printf("\n%s",gtk_entry_get_text(GTK_ENTRY(inputData->password)));

    free(inputData);

}
