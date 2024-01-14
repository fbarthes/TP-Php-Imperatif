<main class="container">
    <div class="glass my-3">
        <H2 class="my-3">Affichage des données (datas.json)</H2>
    <table class="table mt-3">
    <thead>
    <th>Data</th>
    <th>Action</th>
    </thead>
    <tbody>
    <?php
        foreach($datas as $key=>$data) {
            
            echo "<tr><td>" . $data . "</td><td>";
            if(is_connected()) {
                echo "<a href='".generateUrl('simpleDatas','updateData',['cle'=>$key])."'><button class='btn btn-primary me-2'>Modifier</button></a>";
            }            
            echo "<a href='".generateUrl('simpleDatas','displayOne',['cle'=>$key])."'><button class='btn btn-primary'>Voir</button></a><br>";
        }
            echo "</td></tr>"
    ?>
    </tbody>
    </table>
    </div>
</main>