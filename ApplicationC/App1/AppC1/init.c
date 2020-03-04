#include "init.h"


t_program* initProgram()
{

    t_program* t_program  = malloc(sizeof(t_program));

    if(!t_program)
    {
        errorMessage(t_program,"Le programme rencontre un probleme et doit etre ferme. Fermez la fenetre d'accueil. (ERREUR : malloc program)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(t_program);
    }

    //Creation of Window
    GtkWidget* pWindow = creatWindow();

    t_program->pWindow= pWindow;
    t_program->t_pageAuth = NULL;
    t_program->t_pageMenu = NULL;
    t_program->t_pageForm = NULL;
    t_program->t_pageResearch = NULL;

    MYSQL* sock;

    sock = connection();

    if(!sock)
    {
        errorMessage(t_program,"Le programme ne parvient pas a etablir de connexion avec la BDD.  Fermez la fenetre d'accueil et verrifiez la connexion avant d'ouvrir a nouveau le programme.","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(t_program);
    }

    t_program->sock = sock;


    displayContainWelcomPage(t_program);

    return t_program;
}

GtkWidget* creatWindow()
{

    GtkWidget* pWindow = NULL;
    pWindow = gtk_window_new(GTK_WINDOW_TOPLEVEL);

    gtk_window_set_position(GTK_WINDOW(pWindow),GTK_WIN_POS_CENTER_ALWAYS);
    gtk_window_set_default_size(GTK_WINDOW(pWindow), 400, 300);
    gtk_window_set_title(GTK_WINDOW(pWindow), "Providers Manager");
    gtk_container_set_border_width(GTK_CONTAINER(pWindow), 15);

    return  pWindow;
}


void displayContainWelcomPage(t_program* t_program)
{

    //Initialization of Widgets

    GtkWidget *usernameLabel = NULL, *passwordLabel= NULL, *helloLabel=NULL;
    GtkWidget *usernameEntry=NULL, *passwordEntry=NULL;
    GtkWidget *icon=NULL;
    GtkWidget *okButton=NULL;
    GtkWidget *hbox0=NULL,*hbox1=NULL, *hbox2=NULL, *hboxIcon=NULL;
    GtkWidget *vbox=NULL, *pbox=NULL;

    t_pageAuth* t_pageAuth = NULL;

    //Creation of Widgets

    helloLabel = gtk_frame_new("Bonjour !");
    gtk_frame_set_label_align(GTK_FRAME(helloLabel), 0.5, 0.0);
    gtk_frame_set_shadow_type(GTK_FRAME(helloLabel),GTK_SHADOW_OUT);
    usernameLabel = gtk_label_new("Identifiant:  ");
    passwordLabel = gtk_label_new("Mot de passe: ");
    usernameEntry = gtk_entry_new();
    passwordEntry = gtk_entry_new();
    gtk_entry_set_max_length(GTK_ENTRY(usernameEntry),50);
    gtk_entry_set_max_length(GTK_ENTRY(passwordEntry),50);
    gtk_entry_set_visibility(GTK_ENTRY(passwordEntry), FALSE);// Password is not display, instead, dots replace characters
    okButton = gtk_button_new_with_label("Valider");

    hboxIcon = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    hbox0 = gtk_box_new(GTK_ORIENTATION_HORIZONTAL,5);
    hbox1 = gtk_box_new(GTK_ORIENTATION_HORIZONTAL, 5);
    hbox2 = gtk_box_new(GTK_ORIENTATION_HORIZONTAL, 5);
    vbox  = gtk_box_new(GTK_ORIENTATION_VERTICAL, 25);
    pbox  = gtk_box_new(GTK_ORIENTATION_VERTICAL, 5);

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
    gtk_box_pack_start(GTK_BOX(pbox), vbox, FALSE, FALSE, 0);

    gtk_container_add(GTK_CONTAINER(t_program->pWindow), pbox);

    //Display Window
    gtk_widget_show_all(t_program->pWindow);

    t_program->pbox = pbox;
    t_pageAuth = creatStructPageAuth(t_program, usernameEntry,passwordEntry,vbox);
    g_signal_connect(G_OBJECT(okButton), "clicked", G_CALLBACK(ValidationAuthentication),t_program);

}

t_pageAuth* creatStructPageAuth(t_program* t_program, GtkWidget* usernameEntry, GtkWidget* passwordEntry,GtkWidget* vbox)
{

    t_pageAuth* t_pageAuth = malloc(sizeof(t_pageAuth));

    if(!t_pageAuth)
    {
        errorMessage(t_program,"Le programme rencontre un probleme et doit etre ferme. Fermez la fenetre d'accueil. (ERREUR : malloc program)","Erreur fatale",GTK_MESSAGE_WARNING,GTK_BUTTONS_OK);
        endProgram(t_program);
        return NULL;
    }

    t_pageAuth->username = usernameEntry;
    t_pageAuth->password = passwordEntry;
    t_pageAuth->vbox = vbox;

    t_program->t_pageAuth = t_pageAuth;

    return t_pageAuth;
}

void ValidationAuthentication(GtkWidget *button, t_program* t_program)
{


    authentication(t_program);


}


