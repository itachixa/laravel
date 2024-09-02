<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }
        header {
            margin-bottom: 20px;
        }
        .navbar-dark .navbar-nav .nav-link {
            color: #ffffff;
        }
        .hero {
            background: url('https://i.pinimg.com/564x/6a/fd/44/6afd449620d9c1568335634922593d20.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 50px;
            margin-bottom: 20px;
            color: #f5f5f5;
        }
        .services {
            padding: 60px 0;
            background: #fff;
        }
        .service-item {
            text-align: center;
            margin-bottom: 30px;
        }
        .service-item .icon {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 20px;
        }
        .testimonials {
            padding: 60px 0;
            background: #007bff;
            color: white;
        }
        .testimonial-item {
            text-align: center;
            margin-bottom: 30px;
        }
        .testimonial-item img {
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .contact {
            padding: 60px 0;
            background: #f8f9fa;
        }
        footer {
            margin-top: 40px;
        }
        img{
            width:300px;
            height: 240px;
        }
    </style>
</head>
<body>
    
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('about') }}">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('advice') }}">Conseil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('services') }}">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('Acceuil') }}">Paramètre</a>
                    </li>
                </ul>
            </div>
        </nav>
    
    <div class="hero">
        <h1>Bienvenue sur notre Site Web</h1>
        <p>Nous offrons des services exceptionnels pour vous aider à atteindre vos objectifs.</p>
        <a href="{{ url('services') }}" class="btn btn-primary btn-lg">Voir Nos Services</a>
    </div>

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-4 service-item">
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <h3>Marketing Digital</h3>
                    <p>Nous offrons un service de qualité supérieure pour répondre à vos besoins techniques.</p>
                </div>
                <div class="col-md-4 service-item">
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <h3> Support Technique</h3>
                    <p>Notre équipe est spécialisée dans le conseil pour améliorer vos performances.</p>
                </div>
                <div class="col-md-4 service-item">
                    <div class="icon">
                        <i class="fa fa-lightbulb-o"></i>
                    </div>
                    <h3>Formation</h3>
                    <p>Innovation et créativité sont au cœur de tout ce que nous faisons.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="text-center">Ce que nos clients disent</h2>
            <div class="row">
                <div class="col-md-4 testimonial-item">
                    <img src="{{ asset('img/temoin2.jpg') }}" alt="Client 1">
                    <p>"Le service était excellent et je suis extrêmement satisfait des résultats."</p>
                    <h5> Mariam Traoré</h5>
                </div>
                <div class="col-md-4 testimonial-item">
                    <img src="{{ asset('img/temoin1.jpg') }}" alt="Client 2">
                    <p>"L'équipe a surpassé mes attentes et a livré un travail de qualité."</p>
                    <h5> Charles Kouyaté</h5>
                </div>
                <div class="col-md-4 testimonial-item">
                    <img src="img/temoin3.jpg" alt="Client 3">
                    <p>"Je recommande vivement cette entreprise pour son professionnalisme."</p>
                    <h5> Camille Dupont</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact">
        <div class="container">
            <h2 class="text-center">Contactez-nous</h2>
            <p class="text-center">Nous sommes ici pour vous aider. Envoyez-nous un message et nous vous répondrons rapidement.</p>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="{{ url('contact') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom :</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message :</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; {{ date('Y') }} Laravel Application. Tous droits réservés.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
