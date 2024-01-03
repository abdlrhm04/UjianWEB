<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>Document</title>
</head>
<body>
<!--Main Navigation-->
<header>
    <!-- Section: Split screen -->
    <section class="">
      <!-- Grid -->
      <div class="grid h-screen grid-cols-2">
        <!-- First column -->
        <div class="h-screen flex items-center justify-center font-inter">
            <img src="assets/Logo.png" alt="" class="w-1/3">
        </div>
        <!-- First column -->
  
        <!-- Second column -->
        <div class="h-screen flex flex-col items-center justify-center font-inter ">
            <img src="assets/Logo.png" alt="" class="w-1/12">
            <p class="text-lg font-bold p-4">Register</p>
            <form class="max-w-sm mx-auto w-1/3">
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-semibold  text-gray-900 ">Nama*</label>
                    <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Anda" required>
                  </div>
                <div class="mb-5">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email*</label>
                  <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="email@gmail.com" required>
                </div>
                <div class="mb-5">
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password*</label>
                  <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="password" required>
                </div>
                <button type="submit" class="text-white bg-[#34a853] hover:bg-[#4ebe6c] focus:ring-1 focus:outline-none focus:ring-[#317c45] font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
              </form>
              <a href="/" class="pt-2 hover:text-green-200">Sudah memiliki akun? Login</a>
              
        </div>
        <!-- Second column -->
      </div>
      <!-- Grid -->
    </section>
    <!-- Section: Split screen -->
  </header>
  <!--Main Navigation-->
    
</body>
</html><?php /**PATH A:\Codingan\Project Kuliah\Pemrograman Web\sistem-ta\resources\views/register.blade.php ENDPATH**/ ?>