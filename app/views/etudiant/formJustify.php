<?php // if ($etudiant != null): ?>
            <div class="flex justify-between items-center bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-lg">
                <div>
                    <p class="text-sm">Bienvenue sur votre espace étudiant</p>
                </div>
                <div class="">
                <h1 class="text-3xl font-bold"><?php //$etudiant["prenom"] ?>  <?php //$etudiant["nom"] ?></h1>
                <h1><?php //$etudiant["libelle"] ?></div></h1>
</div>

<form action="" method="POST"  class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow-md space-y-4">
 
<div>
    <label for="nom" class="block mb-1 text-sm font-medium text-gray-700">Motif</label>
    <input type="text" id="motif" name="motif" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
  </div>

  <!-- Bouton -->
   <div class="flex gap-4">
   <button type="submit" class="w-full bg-gray-200 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
    Annuler
  </button>
<button type="submit" name="addjustify" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
    Envoyer
  </button>
   </div>
  
</form>
