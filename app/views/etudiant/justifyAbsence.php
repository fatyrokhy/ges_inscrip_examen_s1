<div class="grid grid-cols-[30%_auto] gap-4">
    <h1>Liste de vos cours</h1>
    <form method="get" class="bg-white p-6 rounded-xl shadow-md grid grid-cols-[70%_auto] gap-4">
    <input type="hidden" name="controller" value="etudiantController">
    <input type="hidden" name="page" value="coursEtudiant">
        <div>
            <select id="semestre" name="semestre" class="block w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Sélectionnez --</option>
                <option value="S1">Semestre 1</option>
                <option value="S2">Semestre 2</option>
            </select>
        </div>
        <button type="submit" class=" bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
            Valider
        </button>
    </form>
</div>
<div class="flex-grow  bg-white rouded-md  ">
    <?php if ($justifications != null):   ?>
        <table class='table-auto w-full  border border-none rounded-full'>
            <thead class="text-center text-gray-700 font-bold border-b-2 bg-slate-200">
                <tr>
                    <th class="rounded-l-md">Date du cours</th>
                    <th>Modules</th>
                    <th>Date de justification d'absence</th>
                    <th>motif</th>
                    <th>statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($justifications as $value): ?>
                    <tr class="text-center text-gray-700 p-2 border-b-1 odd:bg-white even:bg-gray-50 hover:bg-slate-100 cursor-pointer">
                        <td class="p-2"><?= $value['date'] ?></td>
                        <td class="p-2"><?= $value['libelle'] ?></td>
                        <td class="p-2"><?= $value['date_justification'] ?></td>
                        <td class="p-2"><?= $value['motif'] ?></td>
                        <td class="p-2"><?= $value['statut'] ?></td>
                        <td class="p-2">
                        <a class="text-blue-400   font-medium px-2 py-1 rounded-md place-self-center"
                            href="<?= PAGE ?>controller=etudiantController&page=formJustify&absence-id=<?= $value['id'] ?>">
                            Envoyer
                        </a>
   
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
</div>
<?php else: echo "Aucun absence pour le moment";
    endif ?>