<div class="  p-8 max-w-[70%] bg-white rounded-lg shadow-md mx-auto  mt-12">
    <h3 class="font-bold text-lg">Planifier un cours</h3>
    <form method="POST" action="">
        <input type="hidden" name="controller" value="rpController">
        <input type="hidden" name="page" value="formCours">
        <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">
        <p class="text-red-500" name="erreur" id="niveauError"><?= $errors["erreur"] ?? '' ?></p>
        <div class="form-control mb-4">
            <select name="module" id=""
                class="niveau mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                <option value="">Sélectionnez un module</option>
                <?php foreach ($module as $valu): ?>
                    <option value="<?= $valu["id"] ?>"<?= (isset($cours['id_module']) && $cours['id_module'] == $valu["id"]) ? 'selected' : '' ?>><?= $valu["libelle"] ?></option>
                <?php endforeach ?>
            </select>
            <p class="text-red-500" id="niveauError"><?= $errors["module"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <select name="prof" id=""
                class="filiere mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                <option value="">Sélectionnez un proffessseur</option>
                <?php foreach ($prof as $val): ?>
                    <option value="<?= $val["id"] ?>" <?= (isset($cours['id_prof']) && $cours['id_prof'] == $val["id"]) ? 'selected' : '' ?>><?= $val["prenom"] ?> <?= $val["nom"] ?> </option>
                <?php endforeach ?>
            </select>
            <p class="text-red-500" id="filiereError"><?= $errors["prof"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Semestre</span>
            </label>
            <select name="semestre" id=""
            class="input input-bordered    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
                <option value="">Sélectionnez un semestre</option>
                <option value="S1" <?= (isset($cours['semestre']) && $cours['semestre']  == 'S1') ? 'selected' : ''?>>Semestre 1</option>
                <option value="S2" <?= (isset($cours['semestre']) && $cours['semestre']  == 'S2') ? 'selected' : ''?>>Semestre 2</option>
            </select>
            <p class="text-red-500"><?= $errors["semestre"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Date prévue</span>
            </label>
            <input type="date" name="date" value="<?= $cours['date'] ?? '' ?>" placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500"><?= $errors["date"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Heure de début</span>
            </label>
            <input type="time" name="hd" value="<?= $cours['heure_debut'] ?? '' ?>" placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500"><?= $errors["hd"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Heure de fin</span>
            </label>
            <input type="time" name="hf" value="<?= $cours['heure_fin'] ?? '' ?>" placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500"><?= $errors["hf"] ?? '' ?></p>
        </div>
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text text-sm font-medium text-gray-700">Nombre D'heure</span>
            </label>
            <input type="text" name="nbre_heure" value="<?= $cours['nbre_heure'] ?? '' ?>" placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
            <p class="text-red-500"><?= $errors["nbre_heure"] ?? '' ?></p>
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
                          <?= (isset($cours['classes']) && in_array($val["id"], $cours['classes'])) ? 'checked' : '' ?>
                          
                         class="form-checkbox text-pink-600">
                        <span><?= $val['libelle'] ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <p class="text-red-500"><?= $errors["classe"] ?? '' ?></p>
        </div>

        <div class="flex items-center justify-between">
            <button type="button" class="btn w-40 bg-gray-400 text-white py-2 rounded-lg hover:bg-gray-700"><a href="<?= PAGE ?>?controller=rpController&page=classe">Annuler</a></button>
            <button name="addCours" type="submit" class="btn w-40 bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700">Enregistrer</button>
        </div>
    </form>
</div>