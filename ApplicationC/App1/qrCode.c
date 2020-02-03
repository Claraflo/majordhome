#include "qrCode.h"


// Creates a single QR Code, then prints it to the console.
void doBasicQrCode(char* input) {
    const char *text = input;                // User-supplied text
    enum qrcodegen_Ecc errCorLvl = qrcodegen_Ecc_LOW;  // Error correction level

    // Make and print the QR Code symbol
    uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
    uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
    bool ok = qrcodegen_encodeText(text, tempBuffer, qrcode, errCorLvl,
                                   qrcodegen_VERSION_MIN, qrcodegen_VERSION_MAX, qrcodegen_Mask_AUTO, true);
    if (ok)
        printQr(qrcode, input);
}


/*---- Utilities ----*/

// Prints the given QR Code to the console.
void printQr(const uint8_t qrcode[],char* input) {
    int size = qrcodegen_getSize(qrcode);
    int border = 4;

    FILE* pf = openFile(input);

    for (int y = -border; y < size + border; y++) {
        for (int x = -border; x < size + border; x++) {
            fputs((qrcodegen_getModule(qrcode, x, y) ? "##" : "  "), pf);

        }
        fputs("\n", pf);
    }
    fputs("\n", pf);
    fclose(pf);
}

FILE* openFile(char* input){

    char path[30] = "..\\qrCode\\"; //12
    char ext[5] = ".txt";

    strcat(path,input);
    strcat(path,ext);

    FILE* pf;
    pf = fopen(path,"r+");

    if (pf==NULL){
        pf = fopen(path,"a+");
    }

    return pf;
}