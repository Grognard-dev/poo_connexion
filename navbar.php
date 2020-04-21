
    <nav class="bg-blue-500 px-4 pt-2 py-4 shadow-md flex justify-center hover-article ">
         <a class="no-underline text-teal-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold  py-3 mr-8 hover-article " href="index.php">
             Accueil
         </a>
         <a class="no-underline text-grey-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold py-3 mr-8 hover-article " href="inscritption.php">
             inscritption
         </a>
         <a class="no-underline text-grey-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold  py-3 mr-8 hover-article" href="connexion.php">
             connexion
         </a>
     </div>
      <?php if(isset($_SESSION["Pseudo"])): ?>
      <li class="px-4 py-2 m-2 text-white"><span>Bonjour <?php echo $_SESSION["Pseudo"];?></span>
    
        <a href="logout.php">déconnexion</a>
          <?php endif?>
</nav>