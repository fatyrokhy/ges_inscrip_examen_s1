<div class="  p-8 max-w-[40%] bg-white rounded-lg shadow mx-auto mt-40 ">
    <form action="" method="get">
    <input type="hidden" name="controller" value="prof">
    <input type="hidden" name="page" value="archiverProf">
    <input type="hidden" name="action" value="traiterArchive">
    <input type="hidden" name="id" value="<?= $_GET['delete'] ?? '' ?>">
        <h1 class="font-medium text-lg mb-4">Etes-vous sure de vouloir archiver ce professeur</h1>
        <div class="flex items-center justify-center gap-6">
            <button type="submit" name="choice" value="oui" class="px-2 py-1 bg-pink-800 text-white text-lg rounded">OUI</button>
            <button type="submit" name="choice" value="non" class="px-2 py-1 bg-gray-400 text-white text-lg rounded">NON</button>
        </div>
    </form>
</div>