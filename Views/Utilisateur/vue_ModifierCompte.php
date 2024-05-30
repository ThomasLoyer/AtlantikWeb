</br></br></br>
<div class="card col-sm-2">
    <div class="card-body bg-dark text-light">
<?php
helper('form');

echo form_open("modifiercompte");
echo csrf_field();
echo form_label("Nom :").'</br>';
echo form_input("txtNom", $prechargement->NOM).'</br>';
echo form_label("Prenom :").'</br>';
echo form_input("txtPrenom", $prechargement->PRENOM).'</br>';
echo form_label("Adresse :").'</br>';
echo form_input("txtAdresse", $prechargement->ADRESSE).'</br>';
echo form_label("Code Postale :").'</br>';
echo form_input("txtCP", $prechargement->CODEPOSTAL).'</br>';
echo form_label("Ville :").'</br>';
echo form_input("txtVille", $prechargement->VILLE).'</br>';
echo form_label("n° Téléphone fixe :").'</br>';
echo form_input("txtNoTelFixe", $prechargement->TELEPHONEFIXE).'</br>';
echo form_label("n° Téléphone Portable").'</br>';
echo form_input("txtNoTelPort", $prechargement->TELEPHONEMOBILE).'</br>';
echo form_label("Adresse mail :").'</br>';
echo form_input("txtMel", $prechargement->MEL).'</br>';
echo form_label("Mot de passe :").'</br>';
echo form_password("txtMdp", $prechargement->MOTDEPASSE).'</br>';
echo form_submit("btnOK", "Modifier le Compte");
echo form_close();
?>
    </div>
</div>
