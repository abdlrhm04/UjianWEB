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
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 80%;
        }

        .logo {
            width: 80px;
            margin-bottom: 20px;
        }

        .login-text {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .error-message {
            color: #e53e3e;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #d2d6dc;
            border-radius: 4px;
            font-size: 14px;
        }

        .submit-button {
            background-color: #34a853;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-button:hover {
            background-color: #4ebe6c;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1 class="text-5xl font-bold mb-4">RAR</h1>
        <img src="assets/PDF/Logo.png" alt="logo" class="logo">
        <p class="login-text">Login</p>
        <?php if(Session::has('status')): ?>
        <div class="error-message">
            <span class="font-medium">Login Gagal!</span> Email dan Password Salah
        </div>
        <?php endif; ?>
        <form class="login-form" action="<?php echo e(route('actionlogin')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <input type="email" id="email" name="email" class="form-input" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-input" placeholder="Password" required>
            </div>
            <button type="submit" class="submit-button">Login</button>
        </form>
    </div>
</body>

</html>
<?php /**PATH C:\Users\Rezandy Kusbiantoro\TB\sistem-ta\resources\views/login.blade.php ENDPATH**/ ?>