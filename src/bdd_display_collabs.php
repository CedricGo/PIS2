<html>
      <head>
           <title>Table collaborateurs</title>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
           <link href="assets\css\style.css" rel="stylesheet">
      </head>
      <body>

        
          <nav class="navbar-custom navbar-fixed-top" style="background: rgb(51,122,183);">
              <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>  
                    </button>
                    <a class="navbar-brand" id=""  href="accueil.php">Acte Media - Suivi de Production</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="formulaire.php">Formulaires</a>
                        </li>
                        <li>
                            <a href="bdd_display_collabs.php">Afficher collaborateurs</a>
                        </li>
                         <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Afficher les rapports<span class="caret"></span></a>
                            <ul class="dropdown-menu" style="background: rgb(51,122,183);">
                                <li>
                                    <a  id="" class="hidden-xs"  href="">Rapport Mensuel</a>
                                    <a  id="" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse">Rapport Mensuel</a>
                                    <a  id="" class="hidden-xs"  href="">Rapport Annuel</a>
                                    <a  id="" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse">Rapport Annuel</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
              </div>
            </div>
            </nav>
        </div>
          <div class="header" id="header">
           <div class="container">
                <br />
                <br />
                <br />
                <br />
                <br />
                <div class="table-responsive">
                     <div id="live_data"></div>
                </div>
           </div>
      </body>
 </html>
 <script>
 $(document).ready(function(){
      function fetch_data()
      {
           $.ajax({
                url:"bdd_select_collab.php",
                method:"POST",
                success:function(data){
                     $('#live_data').html(data);
                }
           });
      }
      fetch_data();
      //Ajout = Ok
      $(document).on('click', '#btn_add', function(){
           var nom = $('#nom').text();
           var prenom = $('#prenom').text();
           var societe = $('#societe').text();
           var tj = $('#tj').text();
           var actif = $('#actif').text();
           if(nom == '')
           {
                alert("Entrer Nom");
                return false;
           }
           if(prenom == '')
           {
                alert("Entrer Prenom");
                return false;
           }
           $.ajax({
                url:"bdd_add_collab.php",
                method:"POST",
                data:{nom:nom, prenom:prenom, societe:societe, tj:tj, actif:actif},
                dataType:"text",
                success:function(data)
                {
                     //alert(data);
                     fetch_data();
                }
           })
      });
      //Edition = Ok
      function edit_data(id, text, column_name)
      {
           $.ajax({
                url:"bdd_edit_collab.php",
                method:"POST",
                data:{id:id, text:text, column_name:column_name},
                dataType:"text",
                success:function(data){
                     alert(data);
                }
           });
      }
      //Pour l'édition de tout les champs
      $(document).on('blur', '.nom', function(){
           var id = $(this).data("id1");
           var nom = $(this).text();
           edit_data(id, nom, "nom");
      });
      $(document).on('blur', '.prenom', function(){
           var id = $(this).data("id2");
           var prenom = $(this).text();
           edit_data(id,prenom, "prenom");
      });
      $(document).on('blur', '.societe', function(){
           var id = $(this).data("id2");
           var societe = $(this).text();
           edit_data(id,societe, "societe");
      });
      $(document).on('blur', '.tj', function(){
           var id = $(this).data("id2");
           var tj = $(this).text();
           edit_data(id,tj, "tj");
      });
      $(document).on('blur', '.actif', function(){
           var id = $(this).data("id2");
           var actif = $(this).text();
           edit_data(id,actif, "actif");
      });

      //Suppression = Ok
      $(document).on('click', '.btn_delete', function(){
           var id=$(this).data("id3");
           if(confirm("Etes-vous sure de vouloir supprimer ce collaborateur?"))
           {
                $.ajax({
                     url:"bdd_delete_collab.php",
                     method:"POST",
                     data:{id:id},
                     dataType:"text",
                     success:function(data){
                          alert("Ok");
                          fetch_data();
                     }
                });
           }
      });
 });
 </script>
