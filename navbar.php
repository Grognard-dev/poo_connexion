
<nav class="bg-blue-500 px-4 pt-2 py-4 shadow-md flex   ">
    
    <?php if(isset($_SESSION["Pseudo"])): ?>
    <li class="no-underline text-grey-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold  py-3 mr-8 "><span>Bonjour <?php echo $_SESSION["Pseudo"];?></span>
        <br>
        <a class="no-underline text-teal-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold  py-3 mr-8 " href="index.php">
            Accueil
        </a>
        <a class="no-underline text-grey-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold  py-3 mr-8 " href="logout.php">déconnexion</a>
        <?php if(isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]):?>
        <a class="no-underline text-grey-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold  py-3 mr-8 " href="admin.php">Admin</a>
        <?php endif?>
    </li>
    
    <?php else:?>
    <li class=" no-underline text-grey-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold  py-3 mr-8 "><a href="inscription.php">S'inscrire </a></li>
    <li class="no-underline text-grey-dark text-white border-b-2 border-transparent uppercase tracking-wide font-bold  py-3 mr-8"><a href="connexion.php">Se connecter</a></li>
    <?php endif?>
    
</nav>