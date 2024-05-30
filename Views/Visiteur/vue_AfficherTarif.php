</br></br></br>

<div class='container mt-3'>
    <table class="table table-dark table-striped">
        <?php foreach($lesTarifs as $tarif): ?>
        <tr>
           <td><?= $tarif->LETTRECATEGORIE.$tarif->NOTYPE ?></td>
           <td><?= $tarif->LIBELLE ?></td>
           <td><?= $tarif->NOTYPE ?></td>
           <td><?= $tarif->libelleType ?></td>
           <td><?= $tarif->TARIF ?></td>
           <td><?= $tarif->DATEDEBUT ?></td>
           <td><?= $tarif->DATEFIN ?></td>
           <td><?= $tarif->portDepart ?></td>
           <td><?= $tarif->portArrivee ?></td>
        </tr>
        <?php endforeach ?>
    </table>

    </br></br></br>