<div class="  p-4 max-w-[60%] bg-white rounded-lg shadow-md ml-52  my-8">
    <h3 class="font-bold text-lg">Ajouter un proffesseur</h3>
    <form method="POST" action="">
        <input type="hidden" name="controller" value="inscrit">
        <input type="hidden" name="page" value="formInscrit">
        <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">
        <p class="text-red-500" name="erreur" id="niveauError"><?= $errors["erreur"] ?? '' ?></p>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Nom</span>
            </label>
            <input type="text" name="nom" value="<?= $prof['nom'] ?? $student['nom'] ?? '' ?>
            <?= isset($student['nom']) ?'readonly' :''?> 
               " placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="nomError"><?= $errors["nom"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Prénom</span>
            </label>
            <input type="text" name="prenom" value="<?= $prof['prenom'] ?? $student['prenom'] ?? '' ?>" placeholder=""
            <?= isset($student['prenom']) ?'readonly' :''?> class="input input-bordered mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="prenomError"><?= $errors["prenom"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Email</span>
            </label>
            <input type="text" name="email" value="<?= $prof['email'] ?? $student['email'] ?? '' ?>"  placeholder="" 
            class=" mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 "
            <?= (isset($prof['email']) || isset($student['email'])) ? 'readonly' : '' ?>  >
            <p class="text-red-500" id="emailError" ><?= $errors["email"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Matricule</span>
            </label>
            <input type="text" name="matricule" value="<?= $prof['matricule'] ?? $student['matricule'] ?? '' ?>"
             <?= isset($prof['matricule']) || isset($student['matricule']) ?'readonly' :'' ?> placeholder=""
              class="input input-bordered mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="matriculeError"><?= $errors["matricule"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Adresse</span>
            </label>
            <input type="text" name="adresse" value="<?= $prof['adresse'] ?? $student['adresse'] ?? '' ?>" 
             placeholder="" class="input input-bordered  mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="adresseError"><?= $errors["adresse"] ?? '' ?></p>
        </div>    
            <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Mot de pass</span>
            </label>
            <input type="text" name="pass" value="<?= $prof['pass'] ?? $student['pass'] ?? '' ?>" 
             placeholder="" class="input input-bordered mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 "
                <?= isset($prof['pass']) || isset($student["pass"]) ?'readonly' :''?> >
            <p class="text-red-500" id="passError"><?= $errors["pass"] ?? '' ?></p>
        </div>
    <div class="space-x-8">
        <label for="">Sexe</label>
    <label>
        <input type="radio" name="sexe" value="M" <?= (isset($prof) && $prof["sexe"] == "M") ||(isset($student) && $student["sexe"] =="M")? "checked" : "" ?>
        <?= isset($student['sexe']) ?'readonly' :''?>>
        Masculin
    </label>
    <label>
        <input type="radio" name="sexe" value="F" <?= (isset($prof) && $prof["sexe"] == "F") ||(isset($student) && $student["sexe"] =="F") ? "checked" : "" ?>
        <?= isset($student['sexe']) ?'readonly' :''?>>
        Féminin
    </label>
</div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Sélectionner une classe</span>
            </label>
            <div class="w-full flex overflow-x-auto p-2 space-x-2">
                <?php
                foreach ($classe as $val): ?>
                    <label class="flex items-center space-x-2">
                        <input type="radio"  name="check"  value="<?= $val["id"] ?>"
                          <?= (isset($prof['id_classe']) && $prof['id_classe']== $val["id"]) || (isset($student['id_classe']) && $student['id_classe']== $val["id"]) ? 'checked' : '' ?>
                         class="form-checkbox text-pink-600">
                        <span><?= $val['libelle'] ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <p class="text-red-500"><?= $errors["check"] ?? '' ?></p>
        </div>

        <div class="flex items-center justify-between">
            <button type="button" class="btn w-40 bg-gray-400 text-white py-2 rounded-lg hover:bg-gray-700"><a href="<?= PAGE ?>?controller=inscrit&page=listeInscrits">Annuler</a></button>
            <button name="addEtudiant" type="submit" class="btn w-40 bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700">Enregistrer</button>
        </div>
    </form>
</div>