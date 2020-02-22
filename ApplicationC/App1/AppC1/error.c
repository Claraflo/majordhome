
#include"error.h"

void errorMessage(t_program* pWindow, char* message,char* title){

  GtkWidget *dialog;
  dialog = gtk_message_dialog_new(GTK_WINDOW(pWindow),
            GTK_DIALOG_DESTROY_WITH_PARENT,
            GTK_MESSAGE_WARNING,
            GTK_BUTTONS_OK,
            message);
  gtk_window_set_title(GTK_WINDOW(dialog), title);
  gtk_dialog_run(GTK_DIALOG(dialog));
  gtk_widget_destroy(dialog);

}


