<?php

require_once 'consts.php';
require_once 'classes/classes.php';
require_once 'functions.php';

$movies = getMovies();
?>

<!DOCTYPE html>
<html lang="es">
<?php include 'templates/head.php'; ?>
<body>
  <div class="container my-5">
    <h1 class="text-center mb-4">Próximas Películas de Marvel</h1>
    
    <!-- Grid de tarjetas para películas -->
    <div class="row justify-content-center">
      <?php if (!empty($movies)): ?>
        <?php foreach ($movies as $movie): ?>
          <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
              <img 
                src="<?= $movie->poster_url ?>" 
                class="card-img-top" 
                alt="Poster de <?= $movie->title ?>" 
                style="max-height:450px; object-fit:cover;">
              <div class="card-body">
                <h5 class="card-title"><?= $movie->title ?></h5>
                <!-- mostramos mensajes desde la funcion -->
                <p class="card-text"><?= get_until_message((int)$movie->days_until) ?></p>
                <p class="card-text">
                  <small class="text-muted">Fecha de estreno: <?= $movie->release_date ?></small>
                </p>
                <?php if ($movie->following_production): ?>
                  <p class="card-text">Siguiente peli: <?= $movie->following_production['title'] ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <p class="text-center">No hay películas disponibles.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

