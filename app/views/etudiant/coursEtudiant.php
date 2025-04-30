            <!-- Filtres -->
            <div class="bg-white shadow p-4 flex justify-between items-center rounded-bl-3xl rounded-tr-3xl m-6">
                <h2 class="text-xl font-semibold">Liste de vos cours</h2>
                <form method="get" class="flex items-center space-x-4">
                    <input type="hidden" name="controller" value="etudiantController">
                    <input type="hidden" name="page" value="coursEtudiant">
                    <select name="filtre_date" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <option value="">Filtrez par date</option>
                        <option value="jour" <?= (isset($_GET['filtre_date']) && $_GET['filtre_date'] === 'jour') ? 'selected' : '' ?>>Aujourd'hui</option>
                        <option value="semaine" <?= (isset($_GET['filtre_date']) && $_GET['filtre_date'] === 'semaine') ? 'selected' : '' ?>>Cette semaine</option>
                        <option value="mois" <?= (isset($_GET['filtre_date']) && $_GET['filtre_date'] === 'mois') ? 'selected' : '' ?>>Ce mois</option>
                    </select>
                    <button type="submit" class="bg-pink-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">Valider</button>
                </form>
            </div>


            <!-- Liste des cours en cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                <?php if ($cours != null): ?>
                    <?php foreach ($cours as $value): ?>
                        <div class="bg-white border rounded-xl shadow-md p-4 hover:shadow-lg transition">
                            <h3 class="text-red-700 font-bold text-lg mb-2"><?= $value['libelle'] ?></h3>
                            <p><span class="font-semibold">Date:</span> <?= $value['date'] ?></p>
                            <p><span class="font-semibold">Heure:</span> <?= $value['heure_debut'] ?> - <?= $value['heure_fin'] ?></p>
                            <p><span class="font-semibold">Semestre:</span> <?= $value['semestre'] ?></p>
                            <p><span class="font-semibold">Professeur:</span> <?= $value['prenom'] ?> <?= $value['nom'] ?></p>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <p class="text-center text-gray-500 col-span-full">Vous n'avez pas de cours pour cette date.</p>
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
