//
// Created by Group 4 on 02/02/2020.
//Main App1 provider management
// Use Copyright (c) Project Nayuki. (MIT License)
//

#include "main.h"


// The main application program.
int main(int argc, char** argv) {

    gtk_init(&argc,&argv);

    //Creation of Window
    GtkWidget* pWindow = creatWindow(pWindow);

    //Event Close
    g_signal_connect(G_OBJECT(pWindow), "destroy", G_CALLBACK(OnDestroy), NULL);



    gtk_main();



    return EXIT_SUCCESS;
}


void OnDestroy(GtkWidget *pWidget, gpointer pData)
{
    /* Arret de la boucle evenementielle */
    gtk_main_quit();
    gtk_widget_destroy(pWidget);

}

/*QRCODE
    char input[6];

    printf("Entrez le numero d'id en 5 caracteres :  ");
    fgets(input, 6, stdin);


    if(input[strlen(input)-1] == '\n'){
        input[strlen(input)-1] = '\0';
    }

    doBasicQrCode(input);



    return EXIT_SUCCESS;
*/
