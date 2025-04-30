   <!-- Filtres -->
   <div class="bg-slate-50 shadow p-4 flex justify-between items-center rounded-bl-xl rounded-tr-xl">
       <h2 class="text-xl font-semibold">Liste des Absences</h2>
       <form id="filterForm" method="get" class="flex items-center space-x-4">
           <input type="hidden" name="controller" value="justify">
           <input type="hidden" name="page" value="justify">
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
           <span>Inscription</span></a>
        </button>
   </div>
   <!-- Liste des classes en cards -->
   <?php if ($justify != null): ?>
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
           <?php foreach ($justify as $value): ?>
               <div class="bg-white border rounded-lg flex-col shadow-md p-4 hover:shadow-lg transition">
                   <div class="flex justify-between">
                       <h3 class="text-red-700 font-bold text-lg mb-2"><?= $value['prenom'] ?>  <?= $value['nom'] ?></h3>
                       <div class="flex gap-1">
                           <a href="<?= PAGE ?>?controller=absence&page=absence&edit=<?= $value["id"] ?>" class="text-gray-700 hover:text-pink-600 rounded-lg ">
                               <i class="ri-pencil-line text-medium"></i>
                           </a>
                           <a href="<?= PAGE ?>?controller=absence&page=absence&delete=<?= $value["id"] ?>"
                               class="text-gray-700 hover:text-pink-600 rounded-lg">
                               <i class="ri-delete-bin-line text-medium "></i>
                           </a>
                       </div>
                   </div>
                   <p><span class="font-medium">Matricule : </span> <?= $value['matricule'] ?></p>
                   <p><span class="font-medium">Classe : </span> <?= $value['classe'] ?></p>
                   <p><span class="font-medium">Cours : </span> <?= $value['module'] ?></p>
                   <p><span class="font-medium">Date  d'absence :</span> <?= $value['dates'] ?></p>
                   <p><span class="font-medium">Date de Justification : </span> <?= $value['date_justification'] ?></p>
                   <p><span class="font-medium">Motif :</span> <?= $value['motif'] ?></p>
                   <p><span class="font-medium">Statut :</span> <?= $value['statut'] ?></p>
                   <button class="w-full ml-24">
                        <a href="<?= PAGE ?>?controller=insrit&page=formInscrit&voire=<?= $value["id"] ?>"
                            class=" text-white  rounded px-2 py-1 bg-pink-600 hover:bg-pink-800">
                            Réinscription
                        </a>
                    </button>
               </div>
           <?php endforeach ?>
       <?php else: ?>
           <p class="text-center text-gray-500 col-span-full">Aucune absence pour le moment .</p>
       </div>
   <?php endif ?>
   </div>
   <!-- Pagination (exemple simple à adapter selon besoin) -->
   <div class="flex justify-center mt-6">
       <nav class="inline-flex rounded-md shadow-sm isolate" aria-label="Pagination">
           <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-pink-600 bg-white border border-gray-300 rounded-l-md hover:bg-gray-100">Précédent</a>
           <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-pink-600 border border-gray-300 hover:bg-pink-700">1</a>
           <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-pink-600 bg-white border border-gray-300 hover:bg-gray-100">2</a>
           <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-pink-600 bg-white border border-gray-300 rounded-r-md hover:bg-gray-100">Suivant</a>
       </nav>
   </div>
