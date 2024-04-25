<?php
    $access_front = DB::table('access_fronts')
    ->first();  
?>
<style>

    body , html{
        background-color: <?=$access_front->color_fondo_access?> !important;
    }
    .container{
        box-shadow: 1px 1px 108.8px 19.2px <?=$access_front->color_card_border_access?> ;
    }
    a{
        text-decoration: none !important;
        color:<?=$access_front->color_card_enlace_access?> !important;
    }
    .container{ 
        background-color: <?=$access_front->color_card_access?>;
        border-radius: 9px;
        border-top: 10px solid <?=$access_front->color_card_line_access?>;
        border-bottom: 10px solid <?=$access_front->color_card_line_access?>; 
        }
        .typcn { 
            color: <?=$access_front->color_card_line_access?>;
            opacity: 0.7;
            margin-right:5px;
        }      
        .typcn.active {
            color:<?=$access_front->color_card_hover_access?>;
            opacity: 0.6;
        }
        .rmb { 
            color: <?=$access_front->color_card_text_access?>;
        }
        .btn1 { 
            background: <?=$access_front->color_card_line_access?>;
            color: <?=$access_front->color_card_text_access?>;
            box-shadow: 1px 1px 1px 1px <?=$access_front->color_card_hover_access?>;
        }

        .btn1:hover {
            background: <?=$access_front->color_card_hover_access?>;
            color: <?=$access_front->color_card_text_hover_access?>;
        }

        .box input[type = "text"],.box input[type = "password"] { 
            background: <?=$access_front->color_fondo_access?>;
            color: <?=$access_front->color_card_text_access?>;
        
        } 
        ::-webkit-input-placeholder {
            color: <?=$access_front->color_card_text_access?>;
        }
        .box input[type = "text"],.box input[type = "password"] {
            border-bottom: 1px solid #6977838c !important;
        }
        .box input[type = "text"]:focus,.box input[type = "password"]:focus {
            border: 1px solid <?=$access_front->color_card_text_access?>;
        }

        .dnthave{
            background: <?=$access_front->color_card_hover_access?>;
            color: <?=$access_front->color_card_text_hover_access?> !important;
            padding: 5px;
            border-radius: 10px;
        }
        .forgetpass{
            font-size:14px;
        }

</style>