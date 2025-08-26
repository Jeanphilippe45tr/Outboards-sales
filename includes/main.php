<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Component</title>
<style>
    body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }

  .hero {
    position: relative;
    height: 100vh;
    width: 100%;
    background: url('/../assets/images/products/hero.jpg') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
  }

  .hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
  }

  .hero-content {
    position: relative;
    z-index: 1;
    max-width: 700px;
    padding: 20px;
  }

  /* Badge */
  .badge {
    display: inline-block;
    background: orange;
    color: white;
    font-size: 0.9rem;
    padding: 6px 12px;
    border-radius: 20px;
    margin-bottom: 1rem;
  }

  .badge i {
    margin-right: 6px;
  }

  /* Title */
  .hero h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
    line-height: 1.2;
  }

  .title-white {
    color: white;
  }

  .title-blue {
    color: #0ea5e9; /* sky blue */
  }

  /* Subtitle */
  .subtitle {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: #white;
  }

  /* Buttons */
  .btn-container {
    display: flex;
    gap: 20px;
    justify-content: center;
  }

  .btn {
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    cursor: pointer;
    transition: 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .btn-shop {
    background-color: #0ea5e9; /* sky blue */
    color: white;
  }

  .btn-shop:hover {
    background-color: #0284c7;
  }

  .btn-learn {
    background-color: white;
    color: black;
    border: 2px solid #d1d5db;
  }

  .btn-learn:hover {
    background-color: #f9fafb;
  }

 /* Hero Section Responsive */
@media (max-width: 1024px) {
  .hero h1 {
    font-size: 2.5rem;
  }
  .subtitle {
    font-size: 1.1rem;
  }
  .badge {
    font-size: 0.85rem;
    padding: 5px 10px;
  }
  .btn {
    padding: 10px 20px;
    font-size: 0.95rem;
  }
}

@media (max-width: 768px) {
  .hero h1 {
    font-size: 2rem;
  }
  .subtitle {
    font-size: 1rem;
  }
  .badge {
    font-size: 0.8rem;
    padding: 4px 8px;
  }
  .btn-container {
    flex-direction: column;
    gap: 12px;
  }
  .btn {
    width: 80%;
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .hero {
    padding: 20px;
  }
  .hero h1 {
    font-size: 1.6rem;
  }
  .subtitle {
    font-size: 0.9rem;
  }
  .badge {
    font-size: 0.75rem;
    padding: 3px 6px;
  }
  .btn {
    width: 100%;
    padding: 10px;
    font-size: 0.9rem;
  }
}

</style>
</head>
<body>
  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">

      <!-- Top Badge -->
      <div class="badge">
        <i class="fas fa-water"></i> Premium Marine Engine
      </div>

      <!-- Title -->
      <h1>
        <span class="title-white">Power Your</span><br>
        <span class="title-blue">Ocean Adventures</span>
      </h1>

      <!-- Subtitle -->
      <p class="subtitle">
        Discover premium outboard engines designed for performance, reliability, 
        and endless adventures on the water.
      </p>

      <!-- Buttons -->
      <div class="btn-container">
        <a href="shop.php" class="btn btn-shop">
          Shop Engine <i class="fas fa-arrow-right"></i>
        </a>
        <a href="learn.php" class="btn btn-learn">Learn More</a>
      </div>
    </div>
  </section>


</body>
</html>
