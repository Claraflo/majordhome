#include"endProgram.h"

void endProgram(t_program* t_program)
{

    gtk_main_quit();

    if(t_program->t_pageAuth)
    {

        gtk_widget_destroy(t_program->t_pageAuth->password);
        gtk_widget_destroy(t_program->t_pageAuth->username);
        gtk_widget_destroy(t_program->t_pageAuth->vbox);
        free(t_program->t_pageAuth);
    }

    if(t_program->t_pageMenu)
    {
        gtk_widget_destroy(t_program->t_pageMenu->vbox);
        free(t_program->t_pageMenu);
    }

    if(t_program->t_pageForm)
    {

        gtk_widget_destroy(t_program->t_pageForm->combo);
        free(t_program->t_pageForm->entry);
        gtk_widget_destroy(t_program->t_pageForm->vbox);
        free(t_program->t_pageForm);
    }

    if(t_program->t_pageResearch)
    {

        gtk_widget_destroy(t_program->t_pageResearch->selection);
        gtk_widget_destroy(t_program->t_pageResearch->view);
        gtk_widget_destroy(t_program->t_pageResearch->vbox);
        free(t_program->t_pageResearch->idCode);
        free(t_program->t_pageResearch);
    }

    if(t_program)
    {

        gtk_widget_destroy(t_program->pWindow);
        if(t_program->sock)
        {
            mysql_close(t_program->sock);
        }
        free(t_program);
    }

}
