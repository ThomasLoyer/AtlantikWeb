</br></br>
<div class="card col-sm-2">
    <div class="card-body bg-dark text-light">
        <?php
            helper('form');
            echo csrf_field();
            echo form_open('authentification');
            echo form_label('Identifiant :');
            echo form_input('txtIdentifiant');
            echo form_label('Mot de passe :');
            echo form_password('txtMotDePasse');
            echo form_submit('btnOK', 'Connexion');
            echo form_close();
        ?>
    </div>
</div>