<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<style>
  .carousel-img {
    width: 100%;
    height: 852px;
    width: auto;
  }
  
  .carousel-container {
    max-width: 100%; /* Adjust the maximum width as needed */
    max-height: 852px;
    margin: 0 auto;
    overflow: hidden;
  }
  @media (max-width:606px) {
    .carousel-img {
      width: 100%;
      height: 450px;
      width: auto;
    }
  }
</style>
<div class="container">
  <div class="carousel-container">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="false">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./img/projeto1.png" class="d-block w-100 carousel-img" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./img/projeto2.png" class="d-block w-100 carousel-img" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./img/projeto3.png" class="d-block w-100 carousel-img" alt="...">
        </div>


      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<br>