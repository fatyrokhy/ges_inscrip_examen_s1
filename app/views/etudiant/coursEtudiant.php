<div class="grid grid-cols-[30%_auto] gap-4">
    <h1>Liste de vos cours</h1>
    <form method="get" class="bg-white p-6 rounded-xl shadow-md grid grid-cols-[70%_auto] gap-4">
    <input type="hidden" name="controller" value="etudiantController">
    <input type="hidden" name="page" value="coursEtudiant">
        <div>
            <select id="semestre" name="semestre" class="block w-full px-4 py-2 border border-gray-300 rounded-lg" value=<?=$_GET["semestre"]?>>
            <option value="jour">Aujourd'hui</option>
            <option value="semaine">Cette semaine</option>
            <option value="mois">Ce mois</option>
            </select>
        </div>
        <button type="submit" class=" bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
            Valider
        </button>
    </form>
</div>
<div class="flex-grow  bg-white rouded-md  ">
    <?php if ($cours != null):   ?>
        <table class='table-auto w-full  border border-none rounded-full'>
            <thead class="text-center text-gray-700 font-bold border-b-2 bg-slate-200">
                <tr>
                    <th class="rounded-l-md">Date</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Semestres</th>
                    <th>Modules</th>
                    <th>Proffesseurs</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cours as $value): ?>
                    <tr class="text-center text-gray-700 p-2 border-b-1 odd:bg-white even:bg-gray-50 hover:bg-slate-100 cursor-pointer">
                        <td class="p-2"><?= $value['date'] ?></td>
                        <td class="p-2"><?= $value['heure_debut'] ?></td>
                        <td class="p-2"> <?= $value['heure_fin'] ?></td>
                        <td class="p-2"><?= $value['semestre'] ?></td>
                        <td class="p-2"><?= $value['libelle'] ?></td>
                        <td class="p-2"><?= $value['prenom'] ?> <?= $value['nom'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
</div>
<?php else: echo "Aucun proprietaire  trouvé";
    endif ?>