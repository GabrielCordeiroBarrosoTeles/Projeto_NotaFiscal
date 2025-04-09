<style>
    .carrossel {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 350px;
        margin-bottom: 40px;
    }

    .carrossel > h1 {
        font-size: 50px;
    }

    .carrossel > h3 {
        font-size: 16px;
        color: #929191;
    }

    .slider {
        margin-top: 10px;
        position: relative;
        padding: 15px;
        max-width: 700px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .marcas-wrapper {
        overflow: hidden
    }

    .marcas {
        display: flex;
        flex-flow: row nowrap;
    }

    .item {
        height: 140px;
        width: 140px;
        flex-shrink: 0;
        opacity: 0.6;
        transition: all 600ms ease-in-out;
        background-color: transparent; /* Remover o fundo branco */
        
    }

    .current-item {
        opacity: 1;
        height: 170px;
        width: 170px;
    }

    .arrow-left,
    .arrow-right {
        display: flex;
        border-radius: 15px;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        left: 0;
        right: 50;
        bottom: 0;
        font-size: 20px;
        height: 200px;
        width: 35px;
        color: #fff;
        cursor: pointer;
        border: none;
        box-shadow: none;
        text-align: center;
        line-height: 250px;
        background: linear-gradient(to left, transparent 0%, #011730 200%);
        opacity: 0.3;
        transition: all 600ms ease-in-out;
    }

    .arrow-right {
        left: auto;
        right: 0;
        background: linear-gradient(to right, transparent 0%, #011730 200%);
    }

    .arrow-left:hover,
    .arrow-right:hover {
        opacity: 1;
    }.container {
  max-width: 100%;
  overflow: hidden;
}

.slider {
  max-width: 100%;
}

.marcas-wrapper {
  overflow: hidden;
}

.marcas {
  display: flex;
  flex-wrap: nowrap;
}

.marcas img {
  width: -1%;
  height: auto;

}
</style>
<div class="carrossel">
        <h1>Fornecedores</h1>
        <h3>Trabalhamos com multimarcas</h3>
        <!--
         Fornecedores
Bartofil distribuidora 

RBL medicamento 

Rebanho Suplementos e sal mineral 

Distrivet medicamentos animais grande porte é pequeno porte 

Nestlé Racões para pets 

TT distribuidora Racões para Pet

Mix Racões para aves, Pet 

Rei da aves Racões para passaros 

Cantoninho Racões para pássaros 

Dourado Racões para animais de grande porte 

Vetnil suplementos para Pet e animais de grande porte
        -->
<div class="container d-flex align-items-center justify-content-center">
        <div class="slider">
            
          <button class="arrow-left control " aria-label="Previous image"><span style="color:black;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
</svg></span></button>
          <button class="arrow-right control" aria-label="Next image"><span style="color:black;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
</svg></span></button>
          <div class="marcas-wrapper">
              <div class="marcas">
                  <img src="img/fornecedores/vetnil.jpg"
                  class="item current-item" style="background-color: transparent;">
                  <img src="img/fornecedores/Distrivet.webp"
                  class="item" style="background-color: transparent;">
                  <img src="img/fornecedores/douradoracoes.png"
                  class="item" style="background-color: transparent;">
                  <img src="img/fornecedores/Nestle.webp"
                  class="item" style="background-color: transparent;">
                  <img src="img/fornecedores/RBL.png"
                  class="item" style="background-color: transparent;">
              </div>
          </div>
      </div>
      </div>
</div>      
      
      
      
      
      
      
      
      
      <script>
    const controls = document.querySelectorAll(".control");
    let currentItem = 0;
    const items = document.querySelectorAll(".item");
    const maxItems = items.length;

    controls.forEach((control) => {
        control.addEventListener("click", () => {
            isLeft = control.classList.contains("arrow-left");

            if (isLeft) {
                currentItem -= 1;
            } else {
                currentItem += 1;
            }

            if (currentItem >= maxItems) {
                currentItem = 0;
            }

            if (currentItem < 0) {
                currentItem = maxItems - 1;
            }

            items.forEach(item => item.classList.remove("current-item"));
            items[currentItem].scrollIntoView({
                inline: "center",
                behavior: "smooth",
                block: "nearest"
            })
            items[currentItem].classList.add("current-item");
        })
    })

    let autoScrollInterval = setInterval(() => {
        currentItem += 1;

        if (currentItem >= maxItems) {
            currentItem = 0;
        }

        items.forEach(item => item.classList.remove("current-item"));
        items[currentItem].scrollIntoView({
            inline: "center",
            behavior: "smooth",
            block: "nearest"
        })
        items[currentItem].classList.add("current-item");
    }, 900000);

    window.addEventListener('load', function() {
  // Impede que o carrossel receba o foco
  document.querySelector('.slider').setAttribute('tabindex', '-1');
});
</script>


