<div class="  p-8 max-w-[50%] bg-white rounded-lg shadow-md mx-auto  my-12">
    <h3 class="font-bold text-lg">Ajouter un proffesseur</h3>
    <form method="POST" action="">
        <input type="hidden" name="controller" value="prof">
        <input type="hidden" name="page" value="formProf">
        <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">
        <p class="text-red-500" name="erreur" id="niveauError"><?= $errors["erreur"] ?? '' ?></p>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Nom</span>
            </label>
            <input type="text" name="nom" value="<?= $prof['nom'] ?? '' ?>" placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="nomError"><?= $errors["nom"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Prénom</span>
            </label>
            <input type="text" name="prenom" value="<?= $prof['prenom'] ?? '' ?>" placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="prenomError"><?= $errors["prenom"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Email</span>
            </label>
            <input type="text" name="email" value="<?= $prof['email'] ?? '' ?>"  placeholder="" class="input input-bordered 
                  <?= $prof['email'] ?'readonly' :'' ?>  mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="emailError" ><?= $errors["email"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Grade</span>
            </label>
            <input type="text" name="grade" value="<?= $prof['grade'] ?? '' ?>" placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="gradeError"><?= $errors["grade"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Mot de pass</span>
            </label>
            <input type="text" name="pass" value="<?= $prof['mot_de_passe'] ?? '' ?>"  placeholder="" class="input input-bordered 
                    <?= $prof['mot_de_passe'] ?'readonly' :'' ?> mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500" id="passError"><?= $errors["pass"] ?? '' ?></p>
        </div>

        <div class="form-control mb-4">
            <select name="sexe" id=""
            class="input input-bordered    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
                <option value="">Sexe</option>
                <option value="M" <?= (isset($prof['sexe']) && $prof['sexe']  == 'M') ? 'selected' : ''?>>Masculin</option>
                <option value="F" <?= (isset($prof['sexe']) && $prof['sexe']  == 'F') ? 'selected' : ''?>>Feminin</option>
            </select>
            <p class="text-red-500" id="sexe"><?= $errors["sexe"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <select name="specialite" id=""
                class="filiere mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                <option value="">Sélectionnez une spécialité</option>
            <?php foreach($specialite as $val):?>
                <option value="<?= $val['id'] ?>" <?= (isset($prof['id_special']) && $prof['id_special'] == $val['id']) ? 'selected' : '' ?>><?= $val['libelle'] ?></option>
                <?php endforeach ?>
            </select>
            <p class="text-red-500" id="specialiteError"><?= $errors["specialite"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Sélectionner une classe</span>
            </label>
            <div class="w-full flex overflow-x-auto p-2 space-x-2">
                <?php
                foreach ($classe as $val): ?>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox"
                         name="check[]"
                          value="<?= $val["id"] ?>"
                          <?= (isset($prof['id_classe']) && in_array($val["id"], $prof['classes'])) ? 'checked' : '' ?>
                          
                         class="form-checkbox text-pink-600">
                        <span><?= $val['libelle'] ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <p class="text-red-500"><?= $errors["classe"] ?? '' ?></p>
        </div>

        <div class="flex items-center justify-between">
            <button type="button" class="btn w-40 bg-gray-400 text-white py-2 rounded-lg hover:bg-gray-700"><a href="<?= PAGE ?>?controller=prof&page=prof">Annuler</a></button>
            <button name="addProf" type="submit" class="btn w-40 bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700">Enregistrer</button>
        </div>
    </form>
</div>