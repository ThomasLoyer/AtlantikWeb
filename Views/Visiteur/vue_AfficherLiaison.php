</br></br></br>

<div class='container mt-3'>
    <table class="table table-dark table-striped">
        <tr>
            <td>Secteur</td>
            <td>Code Liaison</td>
            <td>Distance</td>
            <td>Port de départ</td>
            <td>Port d'arrivée</td>
        </tr>
        <?php $nom_courant = ""; ?>
        <?php foreach($lesLiaisons as $liaison): ?>
            <tr>
            <?php 
            if($liaison->nom==$nom_courant){
                echo '<td>    </td>';
            }
            else{
                echo '<td>'.$liaison->nom.'</td>';
            } ?>
                
                <td><?= anchor('tarifliaison/'.$liaison->noliaison, $liaison->noliaison) ?></td>
                <td><?= $liaison->distance ?></td>
                <td><?= $liaison->Port_depart ?></td>
                <td><?= $liaison->Port_arrivee ?></td>
            </tr>
            <?php $nom_courant = $liaison->nom; ?>
        <?php endforeach ?>
    </table>
</div>