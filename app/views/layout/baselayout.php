<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-white text-black font-serif">
    <div class="grid grid-cols-1 sm:grid-cols-[15%_auto] gap-3 p-2">
        <!-- Sidebar -->
        <div class="hidden h-[38rem] sm:block bg-gradient-to-b from-red-500 to-pink-600 text-white p-4 rounded-lg space-y-10">
            <div class="bg-white h-14 w-14 rounded-full mx-auto"></div>
            <ul class="space-y-6">
                <li>
                    <a href="<?= PAGE ?>controller=etudiantController&page=coursEtudiant" class="flex items-center gap-3 hover:text-yellow-200">
                        <i class="ri-home-5-line text-2xl"></i>
                        <span class="text-lg">Mes cours</span>
                    </a>
                </li>
                <li>
                    <a href="<?= PAGE ?>controller=etudiantController&page=absenceEtudiant" class="flex items-center gap-3 hover:text-yellow-200">
                        <i class="ri-calendar-schedule-line text-2xl"></i>
                        <span class="text-lg">Mes absences</span>
                    </a>
                </li>
                <li>
                    <a href="<?= PAGE ?>controller=etudiantController&page=justifyAbsence" class="flex items-center gap-3 hover:text-yellow-200">
                        <i class="ri-money-dollar-circle-line text-2xl"></i>
                        <span class="text-lg">Justificatifs</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="w-full space-y-6">
        <?= $contenu ?> 
        </div>
    </div>
</body>

</html>
