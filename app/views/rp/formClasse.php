<div class="  p-8 max-w-[60%] bg-white rounded-lg shadow-md mx-auto  mt-12">
           <h3 class="font-bold text-lg">Ajouter une nouvelle classe</h3>
           <!-- Formulaire à l'intérieur du modal -->
           <form method="POST" action="">
           <input type="hidden" name="controller" value="rpController">
           <input type="hidden" name="page" value="formClasse">
           <input type="hidden" name="id" value="<?= $_GET['edit']??''?>">
           <p class="text-red-500" name="erreur" id="niveauError"><?=$errors["erreur"]??''?></p>

               <div class="form-control mb-4">
                   <label class="label">
                       <span class="label-text text-sm font-medium text-gray-700">Libelle</span>
                   </label>
                   <input type="text" name="libelle"   value="<?= $class['libelle'] ?? '' ?>"  placeholder="" class="input input-bordered 
                    mt-1 block w-full px-3 py-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 ">
                   <p class="text-red-500"><?=$errors["libelle"]??''?></p>
               </div>
               <div class="form-control mb-4">
                   <select name="niveau" id="" 
                       class="niveau mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                       <option value="">Sélectionnez un niveau</option>
                       <?php foreach ($niveaux as $valu): ?>
                           <option value="<?= $valu["id"] ?>" <?= (isset($class['niveau']) && $class['niveau']  == $valu["libelle"]) ? 'selected' : '' ?>><?= $valu["libelle"] ?></option>
                       <?php endforeach ?>
                   </select>
                   <p class="text-red-500" id="niveauError"><?=$errors["niveau"]??''?></p>
               </div>
               <div class="form-control mb-4">
                   <select name="filiere" id="" 
                       class="filiere mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                       <option value="">Sélectionnez une filière</option>
                       <?php foreach ($filieres as $val): ?>
                           <option value="<?= $val["id"] ?>" <?= (isset($class['filiere'])&& $class['filiere']  == $val["libelle"]) ? 'selected' : '' ?>><?= $val["libelle"] ?></option>
                       <?php endforeach ?>
                   </select>
                   <p class="text-red-500" id="filiereError"><?=$errors["filiere"]??''?></p>
               </div>
               <div class="modal-action flex items-center gap-6">
                   <button type="button"  class="btn w-full bg-gray-400 text-white py-2 rounded-lg hover:bg-gray-700"><a href="<?= PAGE ?>?controller=rpController&page=classe">Annuler</a></button>
                   <button name="addClasse" type="submit" class="btn w-full bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700">Enregistrer</button>
               </div>
           </form>
       </div>
