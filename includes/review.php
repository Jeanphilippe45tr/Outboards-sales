<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .review-section {
  background-color: #F5F5F5;
  padding: 60px 20px;
}

.review-container {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  gap: 30px;
  max-width: 1200px;
  margin: 0 auto;
  text-align: center;
}

.review-item {
  flex: 1 1 200px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}

.review-icon {
  background-color: #0ea5e9; /* sky blue */
  color: white;
  font-size: 2rem;
  width: 70px;
  height: 70px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
}

.review-item h2 {
  color: #0ea5e9; /* sky blue */
  font-size: 1.5rem;
  margin: 0;
}

.review-item p {
  color: #6b7280; /* gray */
  font-size: 1rem;
  margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .review-container {
    flex-direction: column;
    gap: 40px;
  }

  .review-item {
    flex: 1 1 auto;
  }
}

  </style>
</head>
<body>
<section class="review-section">
  <div class="review-container">

    <div class="review-item">
      <div class="review-icon">
        <i class="fas fa-motorcycle"></i>
      </div>
      <h2>10,000+</h2>
      <p>Engines Sold</p>
    </div>

    <div class="review-item">
      <div class="review-icon">
        <i class="fas fa-briefcase"></i>
      </div>
      <h2>50+</h2>
      <p>Years Experience</p>
    </div>

    <div class="review-item">
      <div class="review-icon">
        <i class="fas fa-smile"></i>
      </div>
      <h2>98%</h2>
      <p>Customer Satisfaction</p>
    </div>

    <div class="review-item">
      <div class="review-icon">
        <i class="fas fa-headset"></i>
      </div>
      <h2>24/7</h2>
      <p>Support Available</p>
    </div>

  </div>
</section>
  
</body>
</html>