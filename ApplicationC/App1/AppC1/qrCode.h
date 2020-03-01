
#ifndef APP1_QRCODE_H
#define APP1_QRCODE_H

#include <stdbool.h>
#include <stddef.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include "qrcodegen.h"
#include "structures.h"



// Function prototypes
void doBasicQrCode(char* input);
void printQr(const uint8_t qrcode[],char* input);
FILE* openFile(char* input);
void createQRC(t_program* t_program,char* idCode);


#endif //APP1_QRCODE_H
