<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LocalMind')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9ffdd5c604.js" crossorigin="anonymous"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4361ee',
                        secondary: '#3a0ca3',
                        accent: '#4cc9f0',
                        light: '#f8f9fa',
                        dark: '#212529',
                        success: '#4CAF50',
                        danger: '#e63946',
                        warning: '#ffb703',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    boxShadow: {
                        'custom': '0 4px 12px rgba(0, 0, 0, 0.1)',
                        'custom-lg': '0 10px 25px rgba(0, 0, 0, 0.15)',
                    },
                    borderRadius: {
                        'xl': '12px',
                        '2xl': '16px',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7ff 0%, #e3e8ff 100%);
        }
        
        .input-focus:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #4361ee, #4cc9f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
        }
        
        .btn-primary {
            background: linear-gradient(90deg, #4361ee, #3a0ca3);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #3a0ca3, #4361ee);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center">

    @yield('content')

</body>
</html>