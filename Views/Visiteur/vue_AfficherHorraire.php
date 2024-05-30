</br></br>

<div class="row">
<div class="col-sm-2 bg-dark">
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <?php 
                foreach($lesSecteurs as $secteur)
                {
                    echo    '<li class="nav-item">
                                <a class="nav-link active" href="/afficherhorraire/'.$secteur->nosecteur.'">'.$secteur->nom.'</a>
                            </li>';
                }
                ?>
            </ul>
        <div>
    </nav>
</div>
<div class="col-sm-6">
</br>    
    <form action="<?= current_url() ?>" method="post">
        <select name="liaisons" id="liaisons">
        <?php
            if(isset($lesLiaisons))
            {
                foreach($lesLiaisons as $liaison)
                {
                    echo  "<option value=".$liaison->noliaison."'>".$liaison->port_depart.' - '.$liaison->port_arrivee."</option>";
                }
            }
        ?>
        </select></br>
        <input type="date" id="date" name="date" required>
        <input type="submit" value="Afficher">
    </form>
        </br>
    <?php if(isset($lesHorraires)): ?>
        <class='container mt-3'>
             <table class="table table-dark table-striped">
        <?php foreach($lesHorraires as $uneHorraire): ?>
            <?php $heure = explode(' ', $uneHorraire['heure']); ?>
                <tr>
                    <td><?= anchor('reserver/'.$uneHorraire['noTraversee'], $uneHorraire['noTraversee']) ?></td>
                    <td><?= $heure[1] ?></td>
                    <td><?= $uneHorraire['bateau'] ?></td>
                    <td><?= $uneHorraire['categorie'] ?></td>
                    <td><?= $uneHorraire['placeRestante'] ?></td>
                </tr>
        <?php endforeach ?>
            </table>
        </br></br>
    <?php endif ?>
        </div>
</div>
