   <!-- Filtres -->
   <div class="bg-white shadow p-4 flex justify-between items-center rounded-bl-3xl rounded-tr-3xl m-6">
       <h2 class="text-xl font-semibold">Liste des classes</h2>
       <form id="filterForm" method="get" class="flex items-center space-x-4">
           <input type="hidden" name="controller" value="rpController">
           <input type="hidden" name="page" value="voirEtudiantClasse">
           <select name="filtre_niveau" onchange="document.getElementById('filterForm').submit()"
               class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
               <option value="">Filtrez par Niveau</option>
               <?php foreach ($niveau as $valu): ?>
                   <option value="<?= $valu["libelle"] ?>" <?= (isset($_GET['filtre_niveau']) && $_GET['filtre_niveau'] == $valu["libelle"]) ? 'selected' : '' ?>><?= $valu["libelle"] ?></option>
               <?php endforeach ?>
           </select>
           <!-- <form method="get" class="flex items-center space-x-4"> -->
           <input type="hidden" name="controller" value="rpController">
           <input type="hidden" name="page" value="classe">
           <select name="filtre_filiere" onchange="document.getElementById('filterForm').submit()"
               class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
               <option value="">Filtrez par filière</option>
               <?php foreach ($filiere as $val): ?>
                   <option value="<?= $val["libelle"] ?>" <?= (isset($_GET['filtre_filiere']) && $_GET['filtre_filiere'] == $val["libelle"]) ? 'selected' : '' ?>><?= $val["libelle"] ?></option>
               <?php endforeach ?>
           </select>
           <!-- <button type="submit" class="bg-pink-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">ok</button> -->
       </form>
   </div>
   <!-- Liste des classes en cards -->
   <?php if ($student != null): ?>
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
           <?php foreach ($student as $value): ?>
               <div class="bg-white border rounded-xl shadow-md p-4 hover:shadow-lg transition">
                   <div class="flex justify-between">
                       <h3 class="text-red-700 font-bold text-lg mb-2"><?= $value['prenom'] ?> <?= $value['nom'] ?></h3>
                   </div>
                   <p><span class="font-semibold">Email:</span> <?= $value['email'] ?></p>
                   <p><span class="font-semibold">Matricule:</span> <?= $value['matricule'] ?></p>
               </div>
           <?php endforeach ?>
       <?php else: ?>
           <p class="text-center text-gray-500 col-span-full">Aucun etudiant pour cette classe pour le moment.</p>
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