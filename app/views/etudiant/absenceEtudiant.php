 <!-- Navbar -->
 <?php // if ($etudiant != null): ?>
            <div class="flex justify-between items-center bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-lg">
                <div>
                    <p class="text-sm">Bienvenue sur votre espace étudiant</p>
                </div>
                <div class="">
                <h1 class="text-3xl font-bold"><?php //$etudiant["prenom"] ?>  <?php //$etudiant["nom"] ?></h1>
                <h1><?php //$etudiant["libelle"] ?></div></h1>
</div>

<div class="grid grid-cols-[30%_auto] gap-4">
    <h1>Liste de vos cours</h1>
    <form method="get" class="bg-white p-6 rounded-xl shadow-md grid grid-cols-[70%_auto] gap-4">
    <input type="hidden" name="controller" value="etudiantController">
    <input type="hidden" name="page" value="absenceEtudiant">
        <div>
            <select id="etat" name="etat" class="block w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Fitrer par état --</option>
                <option value="oui"<?= (isset($_GET['etat']) && $_GET['etat'] === 'oui') ? 'selected' : '' ?>>OUI </option>
                <option value="non"<?= (isset($_GET['etat']) && $_GET['etat'] === 'non') ? 'selected' : '' ?>>NON</option>
            </select>
        </div>
        <button type="submit" class=" bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
            Valider
        </button>
    </form>
</div>
<div class="flex-grow  bg-white rouded-md  ">
    <?php if ($absence != null):   ?>
        <table class='table-auto w-full  border border-none rounded-full'>
            <thead class="text-center text-gray-700 font-bold border-b-2 bg-slate-200">
                <tr>
                    <th class="rounded-l-md">Date</th>
                    <th>Modules</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Justifié</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absence as $value): ?>
                    <tr class="text-center text-gray-700 p-2 border-b-1 odd:bg-white even:bg-gray-50 hover:bg-slate-100 cursor-pointer">
                        <td class="p-2"><?= $value['date'] ?></td>
                        <td class="p-2"><?= $value['libelle'] ?></td>
                        <td class="p-2"><?= $value['heure_debut'] ?></td>
                        <td class="p-2"> <?= $value['heure_fin'] ?></td>
                        <td class="p-2"><?= $value['justification'] ?></td>
                        <td class="p-2">
                        <a class="text-blue-400   font-medium px-2 py-1 rounded-md place-self-center"
                            href="<?= PAGE ?>controller=etudiantController&page=formJustify&absence-id=<?= $value['id'] ?>">
                            Envoyer
                        ++</a>
   
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
</div>
<?php else: echo "Aucun absence pour le moment";
    endif ?>