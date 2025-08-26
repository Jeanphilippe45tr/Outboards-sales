<section class="featured-collection">
  <style>
    .featured-collection {
      background-color: white; /* section background changed to white */
      color: black;
      padding: 80px 20px;
      font-family: Arial, sans-serif;
      text-align: center;
    }

    /* Header texts */
    .featured-collection small {
      color: #0ea5e9;
      font-weight: bold;
      text-transform: uppercase;
      background: skyblue;
      padding: 4px;
      border-radius: 10px;
    }

    .featured-collection h2 {
      font-size: 2.5rem;
      margin: 10px 0;
    }

    .featured-collection h2 .black-text {
      color: black;
    }

    .featured-collection h2 .blue-text {
      color: #0ea5e9;
    }

    .featured-collection p {
      color: #6b7280; /* gray subtitle */
      font-size: 1rem;
      margin: 5px 0;
    }

    /* Cards container */
    .fc-cards {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 50px;
      flex-wrap: wrap;
      align-items: stretch;
    }

    .fc-card {
      background: white;
      color: black;
      border-radius: 10px;
      overflow: hidden;
      width: 400px;
      position: relative;
      padding-bottom: 20px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1); /* subtle shadow */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .fc-card img {
      width: 100%;
      display: block;
    }

    /* Top right rating */
    .fc-card .rating-top {
      position: absolute;
      top: 10px;
      right: 10px;
      background: white;
      padding: 5px 10px;
      border-radius: 20px;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 0.9rem;
    }

    .fc-card .rating-top i {
      color: #0ea5e9;
    }

    /* Stars & review count */
    .fc-stars {
      margin: 10px 0 5px 0;
      color: #facc15; /* gold stars */
      font-size: 1.1rem;
    }

    .fc-stars span {
      color: #6b7280; /* review count */
      font-size: 0.9rem;
      margin-left: 5px;
    }

    .fc-card h3 {
      color: #0ea5e9;
      font-size: 1.3rem;
      margin: 5px 0;
    }

    .fc-card .price {
      margin: 5px 0 15px 0;
    }

    .fc-card .price .current {
      color: #0ea5e9;
      font-weight: bold;
      margin-right: 8px;
    }

    .fc-card .price .old {
      color: #6b7280;
      text-decoration: line-through;
    }

    /* Buttons */
    .fc-buttons {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 10px;
      padding: 10px;
    }

    .fc-buttons .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-weight: bold;
      border: 1px solid #0ea5e9;
    }

    .btn-view {
      background: #ffffff;
      color: black;
      flex: 1;
      justify-content: center;
      border: 2px solid #0ea5e9;
      transition: 0.3s;
    }
    .btn-view:hover {
      background: #0ea5e9;
      color: white;
    }

    .btn-cart {
      background: #0ea5e9;
      color: white;
    }

    /* View all button */
    .view-all-btn {
      margin-top: 50px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #0ea5e9;
      color: white;
      padding: 14px 28px;
      border-radius: 6px;
      font-weight: bold;
      text-decoration: none;
      cursor: pointer;
      transition: 0.3s;
    }

    .view-all-btn:hover {
      background: #0284c7;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .fc-cards {
        gap: 20px;
      }
    }

    @media (max-width: 768px) {
      .fc-cards {
        flex-direction: column;
        align-items: center;
      }

      .fc-card {
        width: 90%;
      }
    }
  </style>

  <small>Featured Collection</small>
  <h2><span class="black-text">Best Selling</span> <span class="blue-text">Engines</span></h2>
  <p>Handpicked premium outboard engines trusted by professionals and</p>
  <p>enthusiasts worldwide.</p>

  <div class="fc-cards">
    <!-- Card 1 -->
    <div class="fc-card">
      <div class="rating-top">
        <i class="fas fa-star"></i> 4.5
      </div>
      <img src="/../assets/images/products/hero.jpg" alt="Mercury 350HP Pro XS">
      <div class="fc-stars">
        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
        <span>(234)</span>
      </div>
      <h3>Mercury 350HP Pro XS</h3>
      <div class="price"><span class="current">$18,999</span> <span class="old">$19,999</span></div>
      <div class="fc-buttons">
        <a href="#" class="btn btn-view">View Details</a>
        <a href="#" class="btn btn-cart"><i class="fas fa-shopping-cart"></i></a>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="fc-card">
      <div class="rating-top">
        <i class="fas fa-star"></i> 4.8
      </div>
      <img src="/../assets/images/products/hero.jpg" alt="Yamaha F350">
      <div class="fc-stars">
        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
        <span>(198)</span>
      </div>
      <h3>Yamaha F350</h3>
      <div class="price"><span class="current">$17,499</span> <span class="old">$18,999</span></div>
      <div class="fc-buttons">
        <a href="#" class="btn btn-view">View Details</a>
        <a href="#" class="btn btn-cart"><i class="fas fa-shopping-cart"></i></a>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="fc-card">
      <div class="rating-top">
        <i class="fas fa-star"></i> 4.7
      </div>
      <img src="/../assets/images/products/hero.jpg" alt="Evinrude G2 300">
      <div class="fc-stars">
        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
        <span>(210)</span>
      </div>
      <h3>Evinrude G2 300</h3>
      <div class="price"><span class="current">$16,899</span> <span class="old">$18,499</span></div>
      <div class="fc-buttons">
        <a href="#" class="btn btn-view">View Details</a>
        <a href="#" class="btn btn-cart"><i class="fas fa-shopping-cart"></i></a>
      </div>
    </div>
  </div>

  <a href="#" class="view-all-btn">View All Products <i class="fas fa-arrow-right"></i></a>

</section>
