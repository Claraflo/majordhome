#include "menu.h"


void displayMenu(t_program* t_program){


  //Initialization of Widgets

    GtkWidget *vBoxMenu;
    GtkWidget *labelBox,*labelMenu;
    GtkWidget *buttonForm,*buttonSelect,*buttonExit;
    GtkWidget *buttonFormBox,*buttonSelectBox,*buttonExitBox;

  //Creation of Widgets

    labelMenu = gtk_label_new("Menu");

    buttonForm = gtk_button_new_with_label("Formulaire");
    buttonSelect = gtk_button_new_with_label("Recherche");
    buttonExit = gtk_button_new_with_label("Deconnexion");

    vBoxMenu = gtk_box_new(GTK_ORIENTATION_VERTICAL,60);
    labelBox = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    buttonFormBox  = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    buttonSelectBox  = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    buttonExitBox  = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);


    gtk_box_pack_start(GTK_BOX(labelBox), labelMenu, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(buttonFormBox), buttonForm, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(buttonSelectBox), buttonSelect, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(buttonExitBox), buttonExit, TRUE, FALSE, 5);

    gtk_box_pack_start(GTK_BOX(vBoxMenu), labelBox, FALSE, FALSE, 2);
    gtk_box_pack_start(GTK_BOX(vBoxMenu), buttonFormBox, FALSE, FALSE, 2);
    gtk_box_pack_start(GTK_BOX(vBoxMenu), buttonSelectBox, FALSE, FALSE, 2);
    gtk_box_pack_start(GTK_BOX(vBoxMenu), buttonExitBox, FALSE, FALSE, 2);

    gtk_container_add(GTK_CONTAINER(t_program->pbox), vBoxMenu);

    //Display Window
    gtk_widget_show_all(vBoxMenu);


    t_pageMenu* t_pageMenu = creatStructPageMenu(t_pageMenu,vBoxMenu);
    t_program->t_pageMenu = t_pageMenu;
}



t_pageMenu* creatStructPageMenu(t_pageMenu* t_pageMenu,GtkWidget* vbox){

    t_pageMenu = malloc(sizeof(t_pageMenu));

        if(!t_pageMenu){
            //fenetre erreur;
            return NULL;
        }

    t_pageMenu->vbox = vbox ;

return t_pageMenu;

}
