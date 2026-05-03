<div class="container-fluid px-0 mt-3">

  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="assets/img/slide1.png" class="d-block w-100" style="height:300px; object-fit:cover;" alt="Slide 1">
      </div>

      <div class="carousel-item">
        <img src="assets/img/slide2.png" class="d-block w-100" style="height:300px; object-fit:cover;" alt="Slide 2">
      </div>

      <div class="carousel-item">
        <img src="assets/img/slide3.png" class="d-block w-100" style="height:300px; object-fit:cover;" alt="Slide 3">
      </div>

    </div>

    <!-- tombol -->
    <button class="carousel-control-prev" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

  const carouselEl = document.querySelector('#carouselExample');

  if (carouselEl) {
    new bootstrap.Carousel(carouselEl, {
      interval: 3000,
      ride: 'carousel'
    });
  }

});
</script>