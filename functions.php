<?php

declare(strict_types=1); // <- a nivel de archivo y arriba del todo

function render_template(string $template, array $data = [])
{
  extract($data);
  require "templates/$template.php";
}

function get_data(string $url): array
{
  $result = file_get_contents($url); // si solo quieres hacer un GET de una API
  $data = json_decode($result, true);
  return $data;
}

function get_until_message(int $days): string
{
  return match (true) {
    $days === 0    => "¡Hoy se estrena! 🥳",
    $days === 1    => "Mañana se estrena 🚀",
    $days < 7      => "Esta semana se estrena 🫢",
    $days < 30     => "Este mes se estrena... 🗓️",
    default        => "$days días hasta el estreno 🗓️",
  };
}

function getMovies(): array {
  // datos de la API
  $data = get_data(API_URL);

  // array para almacenar todas las pelis
  $allData = [];

  // mientras exista un tittle lo anadimos al array
  while (isset($data['title'])) {
      $allData[] = $data;
      
      if (!isset($data['following_production'])) {
          break;
      }
      $data = $data['following_production'];
  }
  // limitamos a 2 producciones
  $allData = array_slice($allData, 0, 2);

  // pasamos los datos de una pelicaula a un objeto Movie 
  $movies = [];
  foreach ($allData as $item) {
      $movies[] = new Movie(
          $item['title'] ?? '',
          $item['poster_url'] ?? '',
          $item['days_until'] ?? 0,
          $item['release_date'] ?? '',
          $item['following_production'] ?? null
      );
  }

  return $movies;
}