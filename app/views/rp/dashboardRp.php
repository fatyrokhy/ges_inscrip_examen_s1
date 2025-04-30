<div class="p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex items-center space-x-4">
                <i class="ri-building-2-line text-3xl text-red-500"></i>
                <div>
                    <p class="text-gray-500">Total Classes</p>
                    <p id="total_classe" class="text-xl font-bold "><?= $totalClassActif ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex items-center space-x-4">
                <i class="ri-user-line text-3xl text-pink-600"></i>
                <div>
                    <p class="text-gray-500">Professeurs Actifs</p>
                    <p id="total_proff" class="text-xl font-bold"><?= $totalProfActif ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex items-center space-x-4">
                <i class="ri-user-line text-3xl text-pink-600"></i>
                <div>
                    <p class="text-gray-500"> Professeurs Archivés</p>
                    <p id="total_proff" class="text-xl font-bold"><?= $totalProfArchiver ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Cours par professeur</h2>
            <canvas id="profChart"></canvas>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Cours par classe</h2>
            <canvas id="classChart"></canvas>
        </div>
    </div>

    <!-- Nouvelle section Liste des Professeurs -->
    <!-- <div class="bg-white rounded-2xl shadow-md p-6 mt-10">
                    <h2 class="text-lg font-semibold mb-6">Liste des professeurs</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prénom</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Spécialité</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Diop</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Mamadou</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Développement Web</td>
                                    <td class="px-6 py-4 whitespace-nowrap">mamadou.diop@iibs.sn</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Fall</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Aminata</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Réseaux</td>
                                    <td class="px-6 py-4 whitespace-nowrap">aminata.fall@iibs.sn</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Ndoye</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Cheikh</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Base de données</td>
                                    <td class="px-6 py-4 whitespace-nowrap">cheikh.ndoye@iibs.sn</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
</div>

<script>
    const coursParClasse = <?= json_encode($dataCoursParClasse) ?>;
    const ctxClasse = document.getElementById('classChart').getContext('2d');
    const labelsClasse = coursParClasse.map(item => item.libelle);
    const dataClasse = coursParClasse.map(item => item.total);
    console.log(dataClasse);
    console.log(labelsClasse);

    const classChart = new Chart(ctxClasse, {
        type: 'bar', // ou 'line' pour courbe
        data: {
            labels: labelsClasse,
            datasets: [{
                label: 'Nombre de cours par classe',
                data: dataClasse,
                backgroundColor: 'rgba(244, 114, 182, 0.7)', // rose fuchsia avec opacité
                borderColor: 'rgba(236, 72, 153, 0.7)', // même couleur sans opacité
                borderWidth: 1,
                borderRadius: 8,
                barPercentage: 0.6,
                categoryPercentage: 0.8,
                hoverBackgroundColor: 'rgba(236, 72, 153, 1)', // hover un peu plus foncé
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                    }
                }
            }
        }
    });

    const coursParProf = <?= json_encode($dataCoursParProf) ?>;
    const ctxProf = document.getElementById('profChart').getContext('2d');
    const labelsprof = coursParProf.map(item => item.libelle);
    const dataprof = coursParProf.map(item => item.total);
    console.log(dataprof);
    console.log(labelsprof);

    const profChart = new Chart(ctxProf, {
        type: 'bar', // ou 'line' pour courbe
        data: {
            labels: labelsprof,
            datasets: [{
                label: 'Nombre de cours par classe',
                data: dataprof,
                backgroundColor: 'rgba(244, 114, 182, 0.7)', // rose fuchsia avec opacité
                borderColor: 'rgba(236, 72, 153, 0.7)', // même couleur sans opacité
                borderWidth: 1,
                borderRadius: 8,
                barPercentage: 0.6,
                categoryPercentage: 0.8,
                hoverBackgroundColor: 'rgba(236, 72, 153, 1)', // hover un peu plus foncé
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                    }
                }
            }
        }
    });

</script>;