<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suisco - Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/styles1.css') }}">
</head>
<body>
    <header>
        <div class="container"> <img src="{{ asset('images/image.webp') }}" alt="Suisco Logo" class="logo">
            <h1>Suisco</h1>
            <nav>
                <ul>
                    <li><a href="#home">Accueil</a></li>
                    <li><a href="#courses">Cours</a></li>
                    <li><a href="#about">À Propos</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="container">
            <h2>Bienvenue chez Suisco</h2>
            <p>Votre partenaire d'apprentissage en ligne pour une éducation de qualité, accessible et innovante.</p>
            <a href="#courses" class="btn-primary">Explorez nos cours</a>
        </div>
    </section>

    <section id="courses" class="courses">
        <div class="container">
            <h2>Cours Populaires</h2>
            <div class="course-list">
                <div class="course-item">
                    <h3>Introduction à la Programmation</h3>
                    <p>Apprenez les bases de la programmation avec ce cours introductif.</p>
                </div>
                <div class="course-item">
                    <h3>Développement Web</h3>
                    <p>Découvrez les techniques de développement web modernes.</p>
                </div>
                <div class="course-item">
                    <h3>Data Science</h3>
                    <p>Explorez le monde de la science des données et des statistiques.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <h2>À Propos de Suisco</h2>
            <p>Chez Suisco, nous croyons que l'éducation est la clé de la réussite. Fondée en 2020, notre plateforme d'e-learning vise à rendre l'apprentissage accessible à tous, partout. Nous proposons une large gamme de cours dans des domaines variés tels que la programmation, le développement web, et la science des données, conçus par des experts de l'industrie.</p>
            <p>Notre mission est de fournir une éducation de qualité, à la pointe de la technologie, pour vous aider à atteindre vos objectifs professionnels et personnels. Rejoignez-nous pour découvrir des opportunités d'apprentissage flexibles et enrichissantes.</p>
        </div>
    </section>

    <footer>
        <div class="container">
      
