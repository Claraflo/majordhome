#include "menu.h"


void displayMenu(t_program* program)
{


    //Initialization of Widgets

    GtkWidget *vBoxMenu = NULL;
    GtkWidget *labelBox,*labelMenu = NULL;
    GtkWidget *buttonForm= NULL,*buttonSelect= NULL,*buttonExit= NULL;
    GtkWidget *buttonFormBox= NULL,*buttonSelectBox= NULL,*buttonExitBox= NULL;

    //Creation of Widgets

    labelMenu = gtk_label_new("Menu");

    buttonForm = gtk_button_new_with_label("Formulaire");
    buttonSelect = gtk_button_new_with_label("Recherche");
    buttonExit = gtk_button_new_from_stock(GTK_STOCK_QUIT);


    vBoxMenu = gtk_box_new(GTK_ORIENTATION_VERTICAL,60);
    labelBox = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    buttonFormBox  = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    buttonSelectBox  = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    buttonExitBox  = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);


    gtk_box_pack_start(GTK_BOX(labelBox), labelMenu, TRUE, FALSE, 5);
    gtk_box_pack_start(GTK_BOX(buttonFormBox), buttonForm, TRUE, TRUE, 5);
    gtk_box_pack_start(GTK_BOX(buttonSelectBox), buttonSelect, TRUE, TRUE, 5);
    gtk_box_pack_start(GTK_BOX(buttonExitBox), buttonExit, TRUE, TRUE, 5);

    gtk_box_pack_start(GTK_BOX(vBoxMenu), labelBox, FALSE, FALSE, 2);
    gtk_box_pack_start(GTK_BOX(vBoxMenu), buttonFormBox, FALSE, FALSE, 2);
    gtk_box_pack_start(GTK_BOX(vBoxMenu), buttonSelectBox, FALSE, FALSE, 2);
    gtk_box_pack_start(GTK_BOX(vBoxMenu), buttonExitBox, FALSE, FALSE, 2);

    gtk_container_add(GTK_CONTAINER(program->pbox), vBoxMenu);

    //Display Window
    gtk_widget_show_all(vBoxMenu);


    t_pageMenu* pageMenu = creatStructPageMenu(program,vBoxMenu);

    program->pageMenu = pageMenu;


    g_signal_connect(G_OBJECT(buttonForm), "clicked", G_CALLBACK(ValidationForm),program);
    g_signal_connect(G_OBJECT(buttonSelect), "clicked", G_CALLBACK(ValidationSelect),program);
    g_signal_connect(G_OBJECT(buttonExit), "clicked", G_CALLBACK(ValidationExit),program);

}


t_pageMenu* creatStructPageMenu(t_program* program,GtkWidget* vbox)
{

    t_pageMenu* pageMenu = malloc(sizeof(t_pageMenu));

    if(!pageMenu)
    {
        errorMessage(program,"Le programme rencontre un probleme et doit fermer. (ERREUR : malloc menu)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(program);
        return NULL;
    }

    pageMenu->vbox = vbox ;



    return pageMenu;

}

void ValidationForm(GtkWidget *buttonForm, t_program* program)
{

    gtk_widget_hide(program->pageMenu->vbox);
    displayForm(program);

}

void ValidationSelect(GtkWidget *buttonSelect, t_program* program)
{

    gtk_widget_hide(program->pageMenu->vbox);
    initResearch(program);

}

void ValidationExit(GtkWidget *buttonExit, t_program* program)
{

    returnAuth(program);
}

void returnAuth(t_program* program)
{

    gtk_widget_hide(program->pageMenu->vbox);
    gtk_entry_set_text (GTK_ENTRY(program->pageAuth->username),"");
    gtk_entry_set_text (GTK_ENTRY(program->pageAuth->password),"");
    gtk_widget_show_all(program->pageAuth->vbox);

}
