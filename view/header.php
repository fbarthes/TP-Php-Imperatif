    <header>
        <nav class="navbar navbar-expand-lg" >
        <div class="container-fluid justify-content-center">

            <ul class="navbar-nav">
                <li class="navbar-item"><a class="nav-link" href="<?php echo generateUrl('simpleDatas','displayAll'); ?>">Liste des données</a></li>
                <?php if(is_connected()): ?>
                <li class="navbar-item"><a class="nav-link" href="<?php echo generateUrl('simpleDatas','createData'); ?>">Ajouter</a></li>
                <?php endif; ?>
                <li class="navbar-item"><a class="nav-link" href="<?php echo generateUrl('multiplie','displayMultiplie'); ?>">Tables de multiplication</a></li>
                <?php 
                    if(!is_connected()):
                ?>
                <li class="navbar-item"><a class="nav-link" href="<?php echo generateUrl('security','login'); ?>">Se connecter</a></li>
                <li class="navbar-item"><a class="nav-link" href="<?php echo generateUrl('security','registration'); ?>">S'enregistrer</a></li>
                <?php
                    else:
                ?>
                <li class="navbar-item"><a class="nav-link" href="<?php echo generateUrl('avatar','loadAvatar'); ?>">Téléchargez votre avatar</a></li>
                <li class="navbar-item"><a class="nav-link" href="<?php echo generateUrl('security','disconnect'); ?>">Se déconnecter</a></li>
                <?php
                    endif;
                ?>
            </ul>
        </div>
        </nav>
    </header>
