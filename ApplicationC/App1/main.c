//
// Created by Group 4 on 02/02/2020.
//Main App1 provider management
// Use Copyright (c) Project Nayuki. (MIT License)
//

#include "main.h"


// The main application program.
int main(void) {

    unsigned int sizeInput = 5;

    char *input = malloc(sizeof(input) * sizeInput);

    if (input == NULL) {
        return EXIT_FAILURE;
    }

    printf("Entrez le numero d'id en 5 caracteres :  ");
    fgets(input, 6, stdin);

    doBasicQrCode(input);


    free(input);

    return EXIT_SUCCESS;
}

