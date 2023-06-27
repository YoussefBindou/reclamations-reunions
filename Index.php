<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="logo.webp" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      background-image: url("https://static.lematin.ma/files/lematin/images/articles/2020/11/b0115925ca3726086e213968364e8ce3.jpg");
      background-size: cover;
      flex-direction: column;
      align-items: center;
      background-color: #f1f1f1;
      padding: 0px;
      margin: 05px;
      font-family: Arial, sans-serif;
    }

    .content {
      text-align: center;
      margin-bottom: 20px;
    }

    .content h1 {
      font-size: 36px;
      color: #333;
      font-weight: bold;
      margin-top: 0;
    }

    .content p {
      font-size: 18px;
      color: #333;
    }

    .location-card {
      background-color: #fff;
      padding: 10px;
      border-radius: 10px;
      width: 350px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .location-card h2 {
      font-size: 24px;
      color: #333;
      font-weight: bold;
      margin-top: 0;
      margin-bottom: 10px;
    }

    .location-card p {
      font-size: 16px;
      color: #333;
      margin-top: 0;
      margin-bottom: 10px;
    }

    .map-container {
      width: 100%;
      max-width: 600px;
      height: 450px;
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
    }

    .map-container iframe {
      width: 100%;
      height: 100%;
      border: 0;
    }

    .flex-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 200px;
    }

    @media (max-width: 768px) {
      .flex-container {
        flex-direction: column;
        align-items: center;
      }
    }
    
    .button-container {
      display: flex;
      justify-content: center;
      margin-top:40px;
    }

    .button-container button {
      padding: 10px 20px;
      margin: 0 10px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color: #333;
      color: #fff;
      transition: background-color 0.3s ease;
    }

    .button-container button:hover {
      background-color: #555;
    }
    
    .icon {
      margin-right: 5px;
      font-size: 24px;
    }

    .footer-icons {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 10px;
    }

    .footer-icons a {
      margin-right: 10px;
    }

    .footer-icons a i {
      font-size: 24px;
      color: #fff;
    }
  </style>
  <title>Page Home</title>
</head>
<body>
  <div class="content">
   <img src="0.png" alt="logo" srcset="" style ="width: 620px;">
  </div>
  <div class="flex-container">
  <div class="location-card">
  <h2><i class="fas fa-map-marker-alt icon"></i> Informations sur l'emplacement :</h2>
  <p>
    <i class="fas fa-home icon"></i> <strong>Adresse :</strong><br>
    AREF DAKHLA OUED EDDAHAB AVENUE MED FADEL SEMLALI<br>
    73000 DAKHLA
  </p>
  <p>
    <i class="far fa-clock icon"></i> <strong>Horaires d'ouverture :</strong><br>
    Lundi : 9h00 - 16h30<br>
    Mardi : 9h00 - 16h30<br>
    Mercredi : 9h00 - 16h30<br>
    Jeudi : 9h00 - 16h30<br>
    Vendredi : 9h00 - 16h30<br>
    Samedi : Fermé<br>
    Dimanche : Fermé
  </p>
  <p>
    <i class="fas fa-phone icon"></i> <strong>Téléphone :</strong><br>
    +212 5289-31234
  </p>
  <p>
    <i class="fas fa-envelope icon"></i> <strong>Email :</strong><br>
    Arefdoe@gmail.com
  </p>
  <p>
    <i class="fas fa-cogs icon"></i> <strong>Services disponibles :</strong><br>
     ouverte le samedi<br>
    Résoudre les problèmes de l'homme de l'éducation<br>
    Résoudre les problèmes des étudiants
  </p>
</div>

    
    <div class="map-container">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1627.4162816658045!2d-15.944117271588269!3d23.696468574196636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc2249317bee19cd%3A0xf2492e124fa194e7!2z2KPZg9in2K_ZitmF2Kkg2KfZhNiq2LHYqNmK2Kkg2YjYp9mE2KrYudmE2YrZhQ!5e0!3m2!1sar!2sma!4v1686011997794!5m2!1sar!2sma" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
  <div class="button-container">
    <button onclick="location.href='sing/login.php';"><i class="button"></i>Espace pour les employés du ministère</button>
    <button onclick="location.href='sing/form_req.php';"><i class="button"></i> Si vous souhaitez contacter l'Académie , cliquez ici</button>
  </div>
  <div class="footer-icons">
    
  <a href="https://www.youtube.com/channel/UCp72FcXsc2e6aRB4-8LDaXg"><i class="fab fa-youtube"></i></a>
  <a href="https://aref-do.men.gov.ma/ar/Pages/Accueil.aspx"><i class="fas fa-globe"></i></a>
  <a href="https://www.facebook.com/AREFDOE/?locale=ar_AR"><i class="fab fa-facebook"></i></a>
  <a href="https://www.instagram.com/arefdoe/"><i class="fab fa-instagram"></i></a>
  <a href="https://twitter.com/arefdoe?lang=ar"><i class="fab fa-twitter"></i></a>
</div>

</body>
</html>
<style>
  .footer-icons a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #333;
  margin-right: 10px;
  
  text-decoration: none;

}

</style>
