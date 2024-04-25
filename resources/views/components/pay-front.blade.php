

<?php 
$configs = DB::table('configs')
 ->first();  
?>

<style> 
.preloader.is-active{
    display: none !important;
}
        iframe {
            height: inherit;
        }
    .accordion-item{
        background-color: #ffffff;
        border-radius:.4rem; 
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
        .pay_mercado{
           max-height:5rem !important;
       }

       .pay_entrega{
           max-height:10rem !important;
       }

       .pay_card{
           max-height:20rem !important;
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
    /* .accordion-item:target .answer{
        max-height:5rem;
    }
    .accordion-item:target .answer.pay_entrega{
        max-height:5rem;
    }
    .accordion-item:target .answer.pay_card{
        max-height:30rem;
    }
    .accordion-item:target .accordion-link .far.fa-circle{
        display: none;
    }
    .accordion-item:target .accordion-link .fas.fa-circle{
        display: block;
    } */
    .fas.fa-circle{ 
        color: #1b7c15;
    }
 </style>