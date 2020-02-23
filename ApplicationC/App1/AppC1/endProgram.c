#include"endProgram.h"

void endProgram(t_program* t_program)
{
    gtk_main_quit();
    gtk_widget_destroy(t_program->pWindow);
    free(t_program->t_pageAuth);
    free(t_program->t_pageMenu);
    free(t_program->t_pageForm);
    //free(t_program->t_pageResearch);
    free(t_program);

}
