   <!-- Filtres -->
   <div class="bg-white shadow p-4 flex justify-between items-center rounded-bl-3xl rounded-tr-3xl m-6">
       <h2 class="text-xl font-semibold">Liste des Proffesseurs</h2>
       <form id="filterForm" method="get" class="flex items-center space-x-4">
           <input type="hidden" name="controller" value="prof">
           <input type="hidden" name="page" value="prof">
           <select name="specialite" onchange="document.getElementById('filterForm').submit()"
            class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
            <option value="">Filtrer par spécialité..</option>
            <?php foreach($specialite as $val):?>
                <option value="<?= $val['id'] ?>" <?= (isset($_GET['specialite']) && $_GET['specialite'] == $val['id']) ? 'selected' : '' ?>><?= $val['libelle'] ?></option>
                <?php endforeach ?>
                    </select>
                    </form>
                    <form id="rechercheProf" method="get" class="flex items-center space-x-4">
                    <input type="hidden" name="controller" value="prof">
                     <input type="hidden" name="page" value="prof">
                    <input  type="text" name="prof" onchange="document.getElementById('rechercheProf').submit()" placeholder="Rechercher par prof..."
               class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
       </form>
       <button type="submit"
           class="bg-pink-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
           <a href="<?= PAGE ?>controller=prof&page=formProf">
           <i class="ri-user-add-line text-xl"></i>
           <span>Ajouter un professeur</span></a></button>
   </div>
   <!-- Liste des classes en cards -->
   <?php if ($prof != null): ?>
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
           <?php foreach ($prof as $value): ?>
               <div class="bg-white border rounded-xl flex-col shadow-md p-4 hover:shadow-lg transition">
                   <div class="flex justify-between">
                       <h3 class="text-red-700 font-bold text-lg mb-2"><?= $value['prenom'] ?>  <?= $value['nom'] ?></h3>
                       <div class="flex gap-1">
                           <a href="<?= PAGE ?>?controller=prof&page=formProf&edit=<?= $value["id"] ?>" class="text-gray-700 hover:text-pink-600 rounded-lg ">
                               <i class="ri-pencil-line text-medium"></i>
                           </a>
                           <a href="<?= PAGE ?>?controller=prof&page=archiverProf&delete=<?= $value["id"] ?>"
                               class="text-gray-700 hover:text-pink-600 rounded-lg">
                               <i class="ri-delete-bin-line text-medium "></i>
                           </a>
                       </div>
                   </div>
                   <p><span class="font-medium">Email:</span> <?= $value['email'] ?></p>
                   <p><span class="font-medium">Specialite:</span> <?= $value['specialite'] ?></p>
                   <p><span class="font-medium">Grade:</span> <?= $value['grade'] ?></p>
                   <button class="w-full ml-32">
                   <a href="<?= PAGE ?>?controller=prof&page=voirClasseProf&voire=<?= $value["id"] ?>"
                           class=" text-white  rounded px-2 py-1 bg-pink-600 hover:bg-pink-800">
                           Classes
                           </a></button>
               </div>
           <?php endforeach ?>
       <?php else: ?>
           <p class="text-center text-gray-500 col-span-full">Aucun proffesseur actif .</p>
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