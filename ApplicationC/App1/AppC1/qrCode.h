
#ifndef APP1_QRCODE_H
#define APP1_QRCODE_H

#include <stdbool.h>
#include <stddef.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include "qrcodegen.h"



// Function prototypes
void doBasicQrCode(char* input);
void printQr(const uint8_t qrcode[],char* input);
FILE* openFile(char* input);


#endif //APP1_QRCODE_H
