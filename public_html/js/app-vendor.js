var preloader = document.getElementById("loading"); 

function myFunction(){
    preloader.style.display = 'none';
};


 const info_product = document.querySelectorAll(".infp");
    info_product.forEach(infp => {
        infp.addEventListener("click", () => {
            infp.classList.toggle("active");
        });
    })