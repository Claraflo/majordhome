//
// Created by Group 4 on 02/02/2020.
//Main App1 provider management
// Use Copyright (c) Project Nayuki. (MIT License)
//

#include "main.h"


// The main application program.
int main(void) {

    char input[6];

    printf("Entrez le numero d'id en 5 caracteres :  ");
    fgets(input, 6, stdin);


    if(input[strlen(input)-1] == '\n'){
        input[strlen(input)-1] = '\0';
    }

    doBasicQrCode(input);



    return EXIT_SUCCESS;
}

