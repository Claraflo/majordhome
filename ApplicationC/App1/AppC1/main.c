//
// Created by Group 4 on 02/02/2020.
//Main App1 provider management
// Use Copyright (c) Project Nayuki. (MIT License)
//

#include "main.h"


// The main application program.
int main(int argc, char** argv)
{
    printf("m1");
    //Initialization
    gtk_init(&argc,&argv);
    printf("m2");
    t_program* t_program = initProgram();
    printf("m3");
    //Event Close
    g_signal_connect(G_OBJECT(t_program->pWindow), "destroy", G_CALLBACK(OnDestroy), t_program);

    printf("m4");
    // Loop GTK
    gtk_main();
    printf("m5");
    return EXIT_SUCCESS;
}


void OnDestroy(GtkWidget *pWidget, t_program* t_program)
{

    endProgram(t_program);
}


