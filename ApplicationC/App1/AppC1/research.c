#include"research.h"
#include <gtk/gtk.h>

enum {
  ID_COLUMN = 0,
  JOB_COLUMN,
  NAME_COLUMN,
  FIRSTNAME_COLUMN,
  BIRTHDAY_COLUMN,
  PHONE_COLUMN,
  MAIL_COLUMN,
  ADRESS_COLUMN,
  CITY_COLUMN,
  PC_COLUMN,
  NUM_COLS
};


GtkTreeModel * create_and_fill_model (t_program* t_program,gchar* request, int statut)
{
  int i =0;
  GtkListStore  *store;
  GtkTreeIter    iter;
  MYSQL_ROW row = NULL;
  MYSQL_RES* res = NULL;


  mysql_query(t_program->sock,request);
  // Test connexion

  res = mysql_use_result(t_program->sock);
  //test res

  if(statut == 0){
      store = gtk_list_store_new (NUM_COLS,G_TYPE_STRING, G_TYPE_STRING,G_TYPE_STRING, G_TYPE_STRING,G_TYPE_STRING, G_TYPE_STRING,G_TYPE_STRING, G_TYPE_STRING,G_TYPE_STRING, G_TYPE_STRING);

      while ((row = mysql_fetch_row(res)))
      {
      /* Append a row and fill in some data */
      gtk_list_store_append (store, &iter);
      gtk_list_store_set (store, &iter,
                          ID_COLUMN,row[0],
                          JOB_COLUMN,row[1],
                          NAME_COLUMN,row[2],
                          FIRSTNAME_COLUMN,row[3],
                          BIRTHDAY_COLUMN,row[4],
                          PHONE_COLUMN,row[5],
                          MAIL_COLUMN,row[6],
                          ADRESS_COLUMN,row[7],
                          CITY_COLUMN,row[8],
                          PC_COLUMN,row[9],-1);
      }
  }else if(statut == 1){

      GtkTreeModel *model;
      store = GTK_LIST_STORE(gtk_tree_view_get_model(GTK_TREE_VIEW(t_program->t_pageResearch->view)));
      model = gtk_tree_view_get_model(GTK_TREE_VIEW(t_program->t_pageResearch->view));

      if (gtk_tree_model_get_iter_first(model, &iter) == FALSE) {
          return;
      }

      gtk_list_store_clear(store);

      while ((row = mysql_fetch_row(res)))
      {
      /* Append a row and fill in some data */
      gtk_list_store_append (store, &iter);
      gtk_list_store_set (store, &iter,
                          ID_COLUMN,row[1],
                          JOB_COLUMN,row[12],
                          NAME_COLUMN,row[2],
                          FIRSTNAME_COLUMN,row[3],
                          BIRTHDAY_COLUMN,row[5],
                          PHONE_COLUMN,row[6],
                          MAIL_COLUMN,row[4],
                          ADRESS_COLUMN,row[7],
                          CITY_COLUMN,row[8],
                          PC_COLUMN,row[9],-1);
      }

  }

  mysql_free_result(res);

  return GTK_TREE_MODEL (store);
}

GtkWidget * create_view_and_model (t_program* t_program)
{
  GtkCellRenderer     *renderer;
  GtkTreeModel        *model;
  GtkWidget           *view;

  view = gtk_tree_view_new ();

 /* --- Column #1 --- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "IdCode",
                                               renderer,
                                               "text", ID_COLUMN,
                                               NULL);

  /* --- Column #2 --- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Nom",
                                               renderer,
                                               "text", NAME_COLUMN,
                                               NULL);


 /* --- Column #3 --- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Prenom",
                                               renderer,
                                               "text", FIRSTNAME_COLUMN,
                                               NULL);

 /* --- Column #4 --- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Date naissance",
                                               renderer,
                                               "text", BIRTHDAY_COLUMN,
                                               NULL);


   /* --- Column #5--- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Metier",
                                               renderer,
                                               "text", JOB_COLUMN,
                                               NULL);

   /* --- Column #6--- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Telephone",
                                               renderer,
                                               "text", PHONE_COLUMN,
                                               NULL);


   /* --- Column #7 --- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Mail",
                                               renderer,
                                               "text", MAIL_COLUMN,
                                               NULL);
   /* --- Column #8 --- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Adresse",
                                               renderer,
                                               "text", ADRESS_COLUMN,
                                               NULL);

   /* --- Column #9 --- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Ville",
                                               renderer,
                                               "text", CITY_COLUMN,
                                               NULL);

   /* --- Column #10 --- */

  renderer = gtk_cell_renderer_text_new();
  gtk_tree_view_insert_column_with_attributes (GTK_TREE_VIEW (view),
                                               -1,
                                               "Code Postal",
                                               renderer,
                                               "text", PC_COLUMN,
                                               NULL);



  model = create_and_fill_model (t_program,"SELECT idCode,FK_metier,nom,prenom,dateNaissance,tel,mail,adresse,ville,codePostal FROM personne WHERE statut = 1",0);

  gtk_tree_view_set_model (GTK_TREE_VIEW (view), model);

  g_object_unref (model);
  return view;
}

void initResearch(t_program* t_program) {

  GtkWidget *sw;
  GtkWidget *view;

  GtkWidget *remove;
  GtkWidget *add;
  GtkWidget *all;
  GtkWidget *modify;
  GtkWidget *research;
  GtkWidget *menu;
  GtkWidget *entry;

  GtkWidget *vbox;
  GtkWidget *hbox;

  GtkTreeSelection *selection;

  sw = gtk_scrolled_window_new(NULL, NULL);
  view = create_view_and_model (t_program);

  gtk_container_add(GTK_CONTAINER(sw), view);

  gtk_scrolled_window_set_policy(GTK_SCROLLED_WINDOW(sw),GTK_POLICY_AUTOMATIC, GTK_POLICY_AUTOMATIC);

  gtk_scrolled_window_set_shadow_type(GTK_SCROLLED_WINDOW(sw),GTK_SHADOW_ETCHED_IN);

  gtk_scrolled_window_set_min_content_width(GTK_SCROLLED_WINDOW(sw),900);
  gtk_scrolled_window_set_min_content_height(GTK_SCROLLED_WINDOW(sw),200);

  vbox = gtk_vbox_new(FALSE, 0);
  gtk_box_pack_start(GTK_BOX(vbox), sw, TRUE, TRUE, 5);

  hbox = gtk_hbox_new(FALSE, 5);

  add = gtk_button_new_with_label("Ajouter");
  research = gtk_button_new_with_label("Recherche");
  all = gtk_button_new_with_label("Tout afficher");
  modify = gtk_button_new_with_label("Modifier");
  remove = gtk_button_new_with_label("Supprimer");
  menu = gtk_button_new_with_label("Menu");
  entry = gtk_entry_new();
  gtk_entry_set_max_length(entry,255);

  gtk_box_pack_start(GTK_BOX(hbox), research, FALSE, TRUE, 3);
  gtk_box_pack_start(GTK_BOX(hbox), entry, FALSE, TRUE, 3);
  gtk_box_pack_start(GTK_BOX(hbox), all, FALSE, TRUE, 3);
  gtk_box_pack_start(GTK_BOX(hbox), add, FALSE, TRUE, 3);
  gtk_box_pack_start(GTK_BOX(hbox), modify, FALSE, TRUE, 3);
  gtk_box_pack_start(GTK_BOX(hbox), remove, FALSE, TRUE, 3);
  gtk_box_pack_start(GTK_BOX(hbox), menu, FALSE, TRUE, 3);

  gtk_box_pack_start(GTK_BOX(vbox), hbox, FALSE, TRUE, 3);

  gtk_container_add(GTK_CONTAINER(t_program->pbox), vbox);

  selection = gtk_tree_view_get_selection(GTK_TREE_VIEW(view));
  t_pageResearch* t_pageResearch = creatStructPageResearch(t_program,t_pageResearch, vbox,selection,view,entry);

  g_signal_connect(G_OBJECT(add), "clicked",G_CALLBACK(appendItem),t_program);
  g_signal_connect(G_OBJECT(research), "clicked",G_CALLBACK(researchItem), t_program);
  g_signal_connect(G_OBJECT(modify), "clicked",G_CALLBACK(modifyItem), t_program);
  g_signal_connect(G_OBJECT(menu), "clicked",G_CALLBACK(GoBackMenu), t_program);
  g_signal_connect(G_OBJECT(remove), "clicked",G_CALLBACK(removeItem), t_program);
  g_signal_connect(G_OBJECT(all), "clicked",G_CALLBACK(displayAll), t_program);

  gtk_widget_show_all(vbox);

}

t_pageResearch* creatStructPageResearch(t_program* t_program, t_pageResearch* t_pageResearch,GtkWidget* vboxResearch,GtkTreeSelection *selection,GtkWidget* view,GtkWidget* entry){

  t_pageResearch = malloc(sizeof(t_pageResearch));

        if(!t_pageResearch){
            printf("erreur malloc pageResarch");
            return NULL;
        }

    t_pageResearch->vbox =  vboxResearch;
    t_pageResearch->selection= selection;
    t_pageResearch->view= view;
    t_pageResearch->entry= entry;
    t_program->t_pageResearch = t_pageResearch;


return t_pageResearch;
}

void displayAll(GtkWidget *pWidget, t_program* t_program){

  GtkTreeModel *model;
  model = create_and_fill_model (t_program,"SELECT idCode,FK_metier,nom,prenom,dateNaissance,tel,mail,adresse,ville,codePostal FROM personne WHERE statut = 1",0);

  gtk_tree_view_set_model (GTK_TREE_VIEW (t_program->t_pageResearch->view), model);
}


void appendItem(GtkWidget *pWidget, t_program* t_program){
    gtk_widget_hide(t_program->t_pageResearch->vbox);

        gtk_widget_hide(t_program->t_pageResearch->vbox);
    if(t_program->t_pageForm){
        gtk_widget_show_all(t_program->t_pageForm->vbox);
    }else{
        displayForm(t_program);
    }

}

void researchItem(GtkWidget *pWidget, t_program* t_program){

  GtkListStore *store;
  GtkTreeModel *model;
  GtkTreeIter  iter;

  gchar* conversionEntry = allocateString(conversionEntry,255,0);


  conversionEntry = g_convert(gtk_entry_get_text(GTK_ENTRY(t_program->t_pageResearch->entry)),-1,"ISO-8859-1","UTF-8", NULL, NULL, NULL);

  if(strlen(conversionEntry)!=0){

  gchar* requestResearch = allocateString(conversionEntry,3000,0);
  requestResearch = "SELECT * FROM `personne` WHERE idCode = '";
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || nom = '",NULL);
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || prenom = '",NULL);
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || mail = '",NULL);
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || tel = '",NULL);
    requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || dateNaissance = '",NULL);
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || adresse = '",NULL);
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || ville = '",NULL);
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || codePostal = '",NULL);
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"' || FK_metier = '",NULL);
  requestResearch = g_strconcat(requestResearch,conversionEntry,NULL);
  requestResearch = g_strconcat(requestResearch,"'",NULL);

  model = create_and_fill_model (t_program,requestResearch,1);

  free(requestResearch);

  }

  free(conversionEntry);
}

void modifyItem(GtkWidget *pWidget, t_program* t_program){

}

void GoBackMenu(GtkWidget *pWidget, t_program* t_program){

    gtk_widget_hide(t_program->t_pageResearch->vbox);
    gtk_widget_show_all(t_program->t_pageMenu->vbox);

}

void removeItem(GtkWidget *pWidget, t_program* t_program){

  GtkListStore *store;
  GtkTreeModel *model;
  GtkTreeIter  iter;

  store = GTK_LIST_STORE(gtk_tree_view_get_model(GTK_TREE_VIEW(t_program->t_pageResearch->view)));
  model = gtk_tree_view_get_model(GTK_TREE_VIEW(t_program->t_pageResearch->view));

  if (gtk_tree_model_get_iter_first(model, &iter) == FALSE) {
      return;
  }

  if (gtk_tree_selection_get_selected(GTK_TREE_SELECTION(t_program->t_pageResearch->selection),
         &model, &iter)) {

    gchar *idCode = allocateString(idCode,12,0);
    gtk_tree_model_get (model, &iter, ID_COLUMN, &idCode, -1);

    gchar* requestRemove = allocateString(requestRemove,60,0);

    requestRemove = "DELETE FROM personne WHERE idCode ='";
    requestRemove = g_strconcat(requestRemove,idCode,NULL);
    requestRemove = g_strconcat(requestRemove,"'",NULL);

    printf("%s",requestRemove);
    mysql_query(t_program->sock,requestRemove);
      // Test connexion


    free(requestRemove);
    g_free(idCode);
    gtk_list_store_remove(store, &iter);
  }

}



