</br></br></br>

<table class="table table-dark table-striped">
    <tr>
        <td>n° de réservation</td>
        <td>Date de réservation</td>
        <td>Départ</td>
        <td>Arrivée</td>
        <td>Date Départ</td>
        <td>Total</td>
    </tr>
    <?php foreach($lesReservations['reservation'] as $uneReservation):?>
        <tr>
            <td><?= $uneReservation->noreservation ?></td>
            <td><?= $uneReservation->dateheure ?></td>
            <td><?= $uneReservation->depart ?></td>
            <td><?= $uneReservation->arrivee ?></td>
            <td><?= $uneReservation->datedepart ?></td>
            <td><?= $uneReservation->montanttotal ?></td>
        </tr>
    <?php endforeach ?> 
</table>

<?= $lesReservations['pager']->links() ?>