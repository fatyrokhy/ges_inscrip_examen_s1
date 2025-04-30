   <!-- Filtres -->
   <div class="bg-white shadow p-4 flex justify-between items-center rounded-bl-3xl rounded-tr-3xl m-6">
       <h2 class="text-xl font-semibold">Liste des cours</h2>
       <form id="filterForm" method="get" class="flex items-center space-x-4">
           <input type="hidden" name="controller" value="rpController">
           <input type="hidden" name="page" value="coursPlannifier">
           <select name="filtre_date" onchange="document.getElementById('filterForm').submit()"
            class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <option value="jour" <?= (isset($_GET['filtre_date']) && $_GET['filtre_date'] === 'jour') ? 'selected' : '' ?>>Aujourd'hui</option>
                        <option value="semaine" <?= (isset($_GET['filtre_date']) && $_GET['filtre_date'] === 'semaine') ? 'selected' : '' ?>>Cette semaine</option>
                        <option value="mois" <?= (isset($_GET['filtre_date']) && $_GET['filtre_date'] === 'mois') ? 'selected' : '' ?>>Ce mois</option>
             </select>
           <input  type="text" name="prof" onchange="document.getElementById('filterForm').submit()" placeholder="Rechercher par prof..."
               class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
       </form>
       <button type="submit"
           class="bg-pink-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
           <a href="<?= PAGE ?>controller=rpController&page=formCours">Planifier un cours</a></button>
   </div>
   <!-- Liste des classes en cards -->
   <?php if ($cours != null): ?>
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
           <?php foreach ($cours as $value): ?>
               <div class="bg-white border rounded-xl flex-col shadow-md p-4 hover:shadow-lg transition">
                   <div class="flex justify-between">
                       <h3 class="text-red-700 font-bold text-lg mb-2"><?= $value['libelle'] ?></h3>
                       <div class="flex gap-1">
                           <a href="<?= PAGE ?>?controller=rpController&page=formCours&edit=<?= $value["id"] ?>" class="text-gray-700 hover:text-pink-600 rounded-lg ">
                               <i class="ri-pencil-line text-medium"></i>
                           </a>
                           <a href="<?= PAGE ?>?controller=rpController&page=annulerCours&delete=<?= $value["id"] ?>"
                               class="text-gray-700 hover:text-pink-600 rounded-lg">
                               <i class="ri-delete-bin-line text-medium "></i>
                           </a>
                       </div>
                   </div>
                   <p><span class="font-medium">Date:</span> <?= $value['date'] ?></p>
                   <p><span class="font-medium">Horaires:</span> <?= $value['heure_debut'] ?>  - <?= $value['heure_fin'] ?></p>
                   <p><span class="font-medium">Proffesseur:</span> <?= $value['prenom'] ?>  <?= $value['nom'] ?></p>
                   <p><span class="font-medium">Grade:</span> <?= $value['grade'] ?></p>
                   <button class="w-full ml-32">
                   <a href="<?= PAGE ?>?controller=rpController&page=voirClasse&voire=<?= $value["id"] ?>"
                           class=" text-white  rounded px-2 py-1 bg-pink-600 hover:bg-pink-800">
                           Classes
                           </a></button>
               </div>
           <?php endforeach ?>
       <?php else: ?>
           <p class="text-center text-gray-500 col-span-full">Aucun cours planifié .</p>
       </div>
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