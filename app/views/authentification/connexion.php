<div class="flex items-center justify-center min-h-screen">
<div class="mx-auto rounded-lg shadow-lg  max-h-screen flex ">
    <div class="max-w-md h-full">
    <img src="./image/image.png"  class="w-full h-full object-cover" alt="">
</div>
  <div class="bg-white p-8  w-full max-w-md rounded-lg py-20">
    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Connexion</h2>
    <form action="" method="POST" class="space-y-4">
    <input type="hidden" name="controller" value="security">
    <input type="hidden" name="page" value="connexion">
    <div class="mt-1 text-red-500 text-sm  peer-invalid:block"><?= $errors['global'] ?? '' ?></div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 ">Adresse e-mail</label>
        <input type="email" name="email" id="email"  placeholder="Entrez votre adresse mail" class="mt-1 shadow h-12 bg-white border-none w-full px-4 text-xs py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <div class="mt-1 text-red-500 text-sm  peer-invalid:block"><?= $errors['email'] ?? '' ?></div>
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" name="pass" id="password" placeholder="Entrez votre mot de passe"  class="mt-1 shadow bg-white border-none text-xs w-full px-4 h-12 py-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <div class="mt-1 text-red-500 text-sm  peer-invalid:block"><?= $errors['pass'] ?? '' ?></div>
    </div>
      <button type="submit" name="add" class="w-full bg-[#9E0E40]  text-white py-2 rounded-md hover:bg-[#9E0E40] hover:opacity-50 transition">Se connecter</button>
    </form>
    <p class="mt-4 text-center text-sm text-gray-600">
      Vous n'avez pas de compte ?
      <a href="inscription.php" class="text-[#9E0E40] hover:underline">Inscrivez-vous</a>
    </p>
  </div>

  </div>