

<?php 
$configs = DB::table('configs')
 ->first();  
?>

<style> 
    .accordion-item{
        background-color: #ffffff;
        border-radius:.1rem;
        margin-bottom: 1rem;
        padding:1rem;
        box-shadow: .2rem 2px .2rem rgba(0,0,0,.1);
    }
    
    .accordion-link{
        font-size: 1rem;
        color: rgba(0, 0, 0, 0.8);
        text-decoration: none;
        background-color: #ffffff;
        width: 100%;
        display: flex;
        align-items: center;
        /* justify-content:space-between; */
        justify-content:flex-start;
        padding: 1rem 0;
    }
    .accordion-link i{
        color: #e7d5ff;
        padding: .5rem;
    }
    .accordion-item .fas.fa-circle{
        display: none;
    }
    .answer{
        position: relative;
        background-color: #fff;
        transition: max-height 50ms;
    }
    .answer.card_active{
        max-height: 0;
        overflow: hidden;
    }
    .answer::before{
        content: '';
        position: absolute;
        width: .6rem;
        height: 90%;
        background-color: #8fc460;
        top: 50%;
        left: 0 ;
        transform: translateY(-50%);
    }
    .answer p{
        color: rgba(0, 0, 0, 0.6);
        font-size: 1rem;
    }
    .answer .p_contract{
        padding: 2rem;
    }
    .answer .p_card{
        padding: .5rem;
    }
    .answer .p_mercado_pago{
        padding: .5rem; 
    }

        .card_info_product{
           max-height:100% !important;
       }
        .card_especification{
           max-height:100% !important;
       } 
       .card_envio{
           max-height:100% !important;
       }
 

       .accordion-item.active .accordion-link .far.fa-circle{
           display: none;
       }
       .accordion-item.active .accordion-link .fas.fa-circle{
           display: block;
       }

       .p_mercado_pago button{
            width: 80%;
            justify-content: center;
            margin: 0 30px;
       } 
    .fas.fa-circle{ 
        color: #1b7c15;
    }
 </style>

<script> 
    const c=0;
    const id_especification = document.getElementById('q_especification');
    const id_envio = document.getElementById('q_envio');
    const id_info_product = document.getElementById('q_info_product');

    id_especification.addEventListener('click', (e)=>{
        e.preventDefault(); 
        
            document.getElementById('q_especification').classList.add("active");
            document.getElementById('q_envio').classList.remove("active");
            document.getElementById('q_info_product').classList.remove("active");
    
            document.getElementById('card_especification').classList.add("card_especification");
            document.getElementById('card_envio').classList.remove("card_envio");
            document.getElementById('card_info_product').classList.remove("card_info_product");
           
    }); 
    id_envio.addEventListener('click', (e)=>{
        e.preventDefault(); 
        
            document.getElementById('q_especification').classList.remove("active");
            document.getElementById('q_envio').classList.add("active");
            document.getElementById('q_info_product').classList.remove("active");
    
            document.getElementById('card_especification').classList.remove("card_especification");
            document.getElementById('card_envio').classList.add("card_envio");
            document.getElementById('card_info_product').classList.remove("card_info_product");
           
    }); 
    id_info_product.addEventListener('click', (e)=>{
        e.preventDefault(); 
        
            document.getElementById('q_especification').classList.remove("active");
            document.getElementById('q_envio').classList.remove("active");
            document.getElementById('q_info_product').classList.add("active");
    
            document.getElementById('card_especification').classList.remove("card_especification");
            document.getElementById('card_envio').classList.remove("card_envio");
            document.getElementById('card_info_product').classList.add("card_info_product");

    });
    </script>
