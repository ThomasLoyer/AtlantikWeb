</br></br></br>
<div class="card col-sm-2">
    <div class="card-body bg-dark text-light">
<?php
helper('form');

echo form_open("creercompte");
echo csrf_field();
echo form_label("Nom :").'</br>';
echo form_input("txtNom").'</br>';
echo form_label("Prenom :").'</br>';
echo form_input("txtPrenom").'</br>';
echo form_label("Adresse :").'</br>';
echo form_input("txtAdresse").'</br>';
echo form_label("Code Postale :").'</br>';
echo form_input("txtCP").'</br>';
echo form_label("Ville :").'</br>';
echo form_input("txtVille").'</br>';
echo form_label("n° Téléphone fixe :").'</br>';
echo form_input("txtNoTelFixe").'</br>';
echo form_label("n° Téléphone Portable").'</br>';
echo form_input("txtNoTelPort").'</br>';
echo form_label("Adresse mail :").'</br>';
echo form_input("txtMel").'</br>';
echo form_label("Mot de passe :").'</br>';
echo form_password("txtMdp").'</br>';
echo form_submit("btnOK", "Créer le Compte");
?>
    </div>
</div>