#include"endProgram.h"

void endProgram(t_program* program)
{

    gtk_main_quit();

    if(program->pageAuth)
    {

        gtk_widget_destroy(program->pageAuth->password);
        gtk_widget_destroy(program->pageAuth->username);
        gtk_widget_destroy(program->pageAuth->vbox);
        free(program->pageAuth);
    }

    if(program->pageMenu)
    {
        gtk_widget_destroy(program->pageMenu->vbox);
        free(program->pageMenu);
    }

    if(program->pageForm)
    {

        gtk_widget_destroy(program->pageForm->combo);
        free(program->pageForm->entry);
        gtk_widget_destroy(program->pageForm->vbox);
        free(program->pageForm);
    }

    if(program->pageResearch)
    {

        gtk_widget_destroy(program->pageResearch->selection);
        gtk_widget_destroy(program->pageResearch->view);
        gtk_widget_destroy(program->pageResearch->vbox);
        free(program->pageResearch->idCode);
        free(program->pageResearch);
    }

    if(program)
    {

        gtk_widget_destroy(program->pWindow);
        if(program->sock)
        {
            mysql_close(program->sock);
        }
        free(program);
    }

}
