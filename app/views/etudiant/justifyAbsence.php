<div class="bg-white shadow p-4 flex justify-between items-center rounded-bl-3xl rounded-tr-3xl m-6">
     <h2 class="text-xl font-semibold">Liste de vos justifications</h2>
     <form method="get" class="flex items-center gap-4">
    <input type="hidden" name="controller" value="etudiantController">
    <input type="hidden" name="page" value="justifyAbsence">
        <div>
            <select id="statut" name="statut" class="block w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Filtrer par statut--</option>
                <option value="EN_ATTENTE">En attente</option>
                <option value="ACCEPTEE">Acceptée</option>
                <option value="REFUSEE">Refuser</option>
            </select>
        </div>
        <button type="submit" class="bg-pink-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
            Valider
        </button>
    </form>
</div>
 <!-- Liste des cours en cards -->
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
     <?php if ($justifications != null): ?>
         <?php foreach ($justifications as $value): ?>
             <div class="bg-white border rounded-xl shadow-md p-4 hover:shadow-lg transition">
                 <h3 class="text-red-700 font-bold text-lg mb-2"><?= $value['date'] ?></h3>
                 <p><span class="font-semibold">Modules:</span> <?= $value['libelle'] ?></p>
                 <p><span class="font-semibold">Date de justification:</span> <?= $value['date_justification'] ?></p>
                 <p><span class="font-semibold">motif:</span> <?= $value['motif'] ?> </p>
                 <p><span class="font-semibold">statut:</span> <?= $value['statut'] ?> </p>
             </div>
         <?php endforeach ?>
     <?php else: ?>
         <p class="text-center text-gray-500 col-span-full">Vous n'avez pas encore de justifications pour ce filtre  .</p>
     <?php endif ?>
 </div>

 <!-- Pagination (exemple simple à adapter selon besoin) -->
 <div class="flex justify-center mt-6">
     <nav class="inline-flex rounded-md shadow-sm isolate" aria-label="Pagination">
         <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-gray-300 rounded-l-md hover:bg-gray-100">Précédent</a>
         <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-gray-300 hover:bg-red-700">1</a>
         <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-gray-300 hover:bg-gray-100">2</a>
         <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-gray-300 rounded-r-md hover:bg-gray-100">Suivant</a>
     </nav>
 </div>

