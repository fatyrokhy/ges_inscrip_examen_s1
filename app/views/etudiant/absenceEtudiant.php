
<div class="bg-white shadow p-4 flex justify-between items-center rounded-bl-3xl rounded-tr-3xl m-6">
    <h2 class="text-xl font-semibold">Liste de vos absences</h2>
     <form method="get" class="flex items-center gap-4">
         <input type="hidden" name="controller" value="etudiantController">
         <input type="hidden" name="page" value="absenceEtudiant">
         <div>
             <select id="etat" name="etat" class=" w-full px-4 py-2 border border-gray-300 rounded-lg">
                 <option value="">Fitrer par état --</option>
                 <option value="oui" <?= (isset($_GET['etat']) && $_GET['etat'] === 'oui') ? 'selected' : '' ?>>OUI </option>
                 <option value="non" <?= (isset($_GET['etat']) && $_GET['etat'] === 'non') ? 'selected' : '' ?>>NON</option>
             </select>
         </div>
         <button type="submit" class="bg-pink-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
             Valider
         </button>
     </form>
 </div>
 <!-- Liste des cours en cards -->
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
     <?php if ($absence != null): ?>
         <?php foreach ($absence as $value): ?>
             <div class="bg-white border rounded-xl shadow-md p-4 hover:shadow-lg transition">
                 <h3 class="text-red-700 font-bold text-lg mb-2"><?= $value['date'] ?></h3>
                 <p><span class="font-semibold">Modules:</span> <?= $value['libelle'] ?></p>
                 <p><span class="font-semibold">Horaire:</span> <?= $value['heure_debut'] ?> - <?= $value['heure_fin'] ?></p>
                 <p><span class="font-semibold">Justifié:</span> <?= $value['justification'] ?> </p>
                 <a class="bg-blue-400 text-white  font-medium px-2 py-1 rounded-md place-self-center"
                     href="<?= PAGE ?>controller=etudiantController&page=absenceEtudiant&absence-id=<?= $value['id'] ?>"
                     onclick="event.preventDefault(); document.getElementById('my_modal_2').showModal();" >
                     Justifier
                 </a>
             </div>
         <?php endforeach ?>
     <?php else: ?>
         <p class="text-center text-gray-500 col-span-full">Vous n'avez pas d'absence pour le moment.</p>
     <?php endif ?>
 </div>


 <!-- Pagination (exemple simple à adapter selon besoin) -->
 <div class="flex justify-center mt-6 ">
     <nav class="inline-flex rounded-md shadow-sm isolate" aria-label="Pagination">
         <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-gray-300 rounded-l-md hover:bg-gray-100">Précédent</a>
         <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-gray-300 hover:bg-red-700">1</a>
         <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-gray-300 hover:bg-gray-100">2</a>
         <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-gray-300 rounded-r-md hover:bg-gray-100">Suivant</a>
     </nav>
 </div>
 <!-- popup formulaire -->
 <dialog id="my_modal_2" class="modal">
  <form method="POST" action="" class="modal-box max-w-md mx-auto bg-white p-6 rounded-xl shadow-md space-y-4">
    <h3 class="text-lg font-bold mb-4">Justification</h3>

    <input type="hidden" name="controller" value="etudiantController">
    <input type="hidden" name="page" value="absenceEtudiant">

    <!-- Motif -->
    <div>
      <label for="motif" class="block mb-1 text-sm font-medium text-gray-700">Motif</label>
      <input type="text" id="motif" name="motif" 
             class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
    </div>

    <!-- Boutons -->
    <div class="flex gap-4 pt-4">
      <button type="button" onclick="document.getElementById('my_modal_2').close();" 
              class="w-full bg-gray-300 text-black py-2 px-4 rounded-lg hover:bg-gray-400">
        Annuler
      </button>

      <button type="submit" name="addjustify" 
              class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
        Envoyer
      </button>
    </div>
  </form>
</dialog> <?php //else: echo "Aucun absence pour le moment";
    //endif 
    ?>