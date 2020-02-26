#include"endProgram.h"

void endProgram(t_program* t_program)
{
    gtk_main_quit();

    if(t_program->sock){
        mysql_close(t_program->sock);
    }

    if(t_program->t_pageAuth){
        free(t_program->t_pageAuth);
    }

    if(t_program->t_pageMenu){
        free(t_program->t_pageMenu);
    }


    if(t_program->t_pageForm){
        free(t_program->t_pageForm->entry);
        free(t_program->t_pageForm);
    }

    if(t_program->t_pageResearch){
        free(t_program->t_pageResearch);
    }

    gtk_widget_destroy(t_program->pWindow);
    free(t_program);

}
