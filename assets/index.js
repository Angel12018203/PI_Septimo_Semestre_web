
    // Contador de estadísticas
    const counters = document.querySelectorAll('.contador');

    function countUp(counter) {
      const target = +counter.getAttribute('data-target');
      let current = 0;
      const increment = target / 100;

      function updateCounter() {
        if (current < target) {
          current += increment;
          counter.innerText = Math.ceil(current);
          setTimeout(updateCounter, 10);
        } else {
          counter.innerText = target;
        }
      }

      updateCounter();
    }

    counters.forEach(countUp);

    // Función del carrusel infinito
    const slider = document.querySelector('.slider .imagenes');
    const arrows = document.querySelectorAll('.arrow-left, .arrow-right');
    let counter = 0;
    const imagesCount = document.querySelectorAll('.slider .imagenes img').length;
    const totalVisibleImages = 5;

    function moveSlider() {
      counter++;
      if (counter >= imagesCount / 2) {
        counter = 0;
        slider.style.transition = 'none';
        slider.style.transform = `translateX(0)`;

        setTimeout(() => {
          slider.style.transition = 'transform 1s ease';
          slider.style.transform = `translateX(-${counter * (100 / totalVisibleImages)}%)`;
        }, 50);
      } else {
        slider.style.transform = `translateX(-${counter * (100 / totalVisibleImages)}%)`;
      }
    }

    setInterval(moveSlider, 3000);

    arrows.forEach(arrow => {
      arrow.addEventListener('click', () => {
        if (arrow.classList.contains('arrow-left')) {
          counter = counter === 0 ? imagesCount / 2 - 1 : counter - 1;
        } else {
          counter = counter === imagesCount / 2 - 1 ? 0 : counter + 1;
        }
        slider.style.transform = `translateX(-${counter * (100 / totalVisibleImages)}%)`;
      });
    });
