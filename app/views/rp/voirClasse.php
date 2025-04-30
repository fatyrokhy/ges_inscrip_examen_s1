   <!-- Filtres -->
   <div class="bg-white shadow p-4 flex justify-between items-center rounded-bl-3xl rounded-tr-3xl m-6">
       <h2 class="text-xl font-semibold">Liste des classes concernées</h2>
   </div>
   <!-- Liste des classes en cards -->
   <?php if ($classe != null): ?>
       <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 p-6">
           <?php foreach ($classe as $value): ?>
               <div class="bg-white border rounded-xl flex-col shadow-md p-4 hover:shadow-lg transition">
                   <div class="flex justify-between">
                       <h3 class="text-red-700 font-bold text-lg mb-2"><?= $value['libelle'] ?></h3>
                   </div>
               </div>
           <?php endforeach ?>
       <?php else: ?>
           <p class="text-center text-gray-500 col-span-full">Aucun cours planifié .</p>
       </div>
   <?php endif ?>
   </div>
