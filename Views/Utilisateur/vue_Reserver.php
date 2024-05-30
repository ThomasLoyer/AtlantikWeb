</br></br></br>
<div class="col-sm-6">

Nom : <?= $infoClient[0]->nom;?></br>
Adresse : <?php echo $infoClient[0]->adresse;?></br>
CP : <?php echo $infoClient[0]->codepostal;?> Ville : <?php echo $infoClient[0]->ville;?></br></br>

<form method="post" action="/traiterreservation">
    <table class="table table-dark table-striped" style="width:75%">
<?php foreach($lesTarifs as $index => $tarif): ?>
        <tr>
            <td><label><?php echo $tarif->libelle ?></label></td>
            <td><label><?php echo $tarif->tarif?></label></td>
            <td><input type="number" id='<?php echo $tarif->lettrecategorie ?>_<?php echo $tarif->notype ?>' name="<?php echo $tarif->lettrecategorie ?>_<?php echo $tarif->notype ?>"  min="0" max="10"></td>
        </tr>
<?php endforeach?>
                <input type="hidden" id='noTraversee' name="noTraversee" value="<?php echo $noTraversee ?>">
    </table>
    <input type="submit" value="Valider">
</form>