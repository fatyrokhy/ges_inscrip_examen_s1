<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membres</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-white  text-black  w-full  overflow-x-hidden font-serif h-auto">
    <div class="grid grid-cols-1 sm:grid-cols-[15%_auto] flex items-start gap-6 sm:gap-3 p-3 sm:p-2 ">
        <!-- sidebaar -->
        <div
            class="  grid grid-cols-1 sm:h-[650px]  sm:p-2 lg:p-5 sm:space-y-12 hidden sm:block flex items-center bg-gradient-to-r from-[#f00020] to-[#da0760] ">
            <div class="bg-white h-14 w-14 rounded-full font-semibold mx-auto"></div>
            <ul class="grid grid-cols-1 space-y-4 sm:mx-auto hidden sm:block">
                <li class=" text-white   sm:text-base lg:text-2xl">
                    <a class="rounded-lg   flex flex-nowwrap gap-3 items-center 
                    focus:outline-none focus:ring focus:ring-violet-400" href="<?= PAGE ?>controller=etudiantController&page=coursEtudiant">
                        <i class="ri-home-5-line text-2xl sm:text-xs md:text-xl lg:text-2xl"></i>
                        <p class=" font-semibold sm:text-xs lg:text-lg ">Mes cours</p>
                    </a>
                </li>
                <li class="text-white ">
                    <a class="flex flex-nowwrap gap-3 sm:gap-2 items-center rounded-lg 
                    focus:outline-none focus:ring focus:ring-violet-400" href="<?= PAGE ?>controller=etudiantController&page=absenceEtudiant">
                        <i class="ri-calendar-schedule-line text-2xl sm:text-xs md:text-xl lg:text-2xl"></i>
                        <p class=" font-semibold sm:text-xs lg:text-lg ">Mes absences</p>
                    </a>
                </li>
                <li class=" text-white  ">
                    <a class="flex flex-nowwrap gap-3 items-center rounded-lg
                        focus:outline-none focus:ring focus:ring-violet-400" href="<?= PAGE ?>controller=etudiantController&page=justifyAbsence">
                        <i class="ri-money-dollar-circle-line text-2xl sm:text-xs md:text-xl lg:text-2xl"></i>
                        <p class=" font-semibold sm:text-xs lg:text-lg ">Justificatifs</p>
                    </a>
                </li>
            </ul>
        </div>
        <!--corpemembre  -->
        <div class="w-full grid grid-cols-1  gap-5 sm:gap-5  mt-0 ">
            <!-- navbaar -->
             <div class=" p-2 grid grid-cols-[80%_auto] flex items-center bg-gradient-to-r from-[#f00020] to-[#da0760] text-white font-semibold">
                <div class=" items-center">
                <h1 class="text-3xl">Bonjour </h1>
                <h1></h1>
                </div>
                <img src="" class="w-['60%'] h-20 rounded-lg bg-gray-100" alt="" srcset="">

             </div>
             <?php // endif ?>

             <!-- contenu -->
            <div class="grid grid-cols-1 gap-3 mt-24 sm:mt-0 mb-10   sm:mb-0 bg-white rounded-lg">
             <?= $contenu ?>  
            </div>
        </div>
    </div>
</body>

</html>     




<div class=02.../div>.0.






