//
// Created by Group 4 on 02/02/2020.
//Main App1 provider management
// Use Copyright (c) Project Nayuki. (MIT License)
//

#include "main.h"


int main(int argc, char** argv)
{


    //Initialization
    gtk_init(&argc,&argv);
    t_program* program = initProgram();

    //Event Close
    g_signal_connect(G_OBJECT(program->pWindow), "destroy", G_CALLBACK(OnDestroy), program);


    // Loop GTK
    gtk_main();

    return EXIT_SUCCESS;
}


void OnDestroy(GtkWidget *pWidget, t_program* program)
{

    endProgram(program);
}


