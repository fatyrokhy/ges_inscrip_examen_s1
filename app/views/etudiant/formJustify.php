

<form action="" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow-md space-y-4">
<input type="hidden" name="controller" value="etudiantController">
<input type="hidden" name="page" value="formJustify">
  <!-- Nom -->
  <div>
    <label for="nom" class="block mb-1 text-sm font-medium text-gray-700">Motif</label>
    <input type="text" id="motif" name="motif" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
  </div>

  <!-- Fichier -->
  <!-- <div>
    <label for="fichier" class="block mb-1 text-sm font-medium text-gray-700">Téléverser un fichier</label>
    <input type="file" id="fichier" name="fichier" class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white file:bg-blue-600 hover:file:bg-blue-700" required>
  </div> -->

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
