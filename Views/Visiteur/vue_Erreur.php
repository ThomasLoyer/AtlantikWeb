</br></br></br>

<?php if (!empty($erreur)) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($erreur as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>