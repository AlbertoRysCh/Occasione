<div class="infp active content-infp -mt-10 text-gray-700">
   
    <div class="detail-infp mb-2">
        <h2 class="font-bold">Detalle de producto</h2>
        
        <x-arrow-down size="20" color="#ffffff" />

    </div>
    <div class="sub-detail-infp desc">
        <div class="features-box-section">
                 
            @if($especification->modelo != null)
                <div class="feature">
                <div class="title">Modelo</div>
                <div itemprop="sku">{{$especification->modelo}}</div>
                </div>
            @endif 

            @if($especification->production_country != null)
                <div class="feature">
                    <div class="title">País de Origen</div>
                    <div>
                        <?php 
                           echo DB::table('pais_products')->where([
                            ['id', '=', $especification->production_country],
                            ])->value('name');    
                        ?>
                    </div>
                </div>
            @endif

            @if($especification->package_weight != null)
                <div class="feature">
                    <div class="title">Peso (kg)</div>
                    <div>
                        {{$especification->package_weight}}
                    </div>
                </div>
            @endif

            @if($especification->filter_color != null)
                <div class="feature">
                    <div class="title">Color</div>
                    <div>
                        <?php
                        echo DB::table('colors')->where([
                        ['id', '=', $especification->filter_color],
                        ])->value('name');  
                        ?>
                    </div>
                </div>
            @endif

            @if($especification->main_material != null)
                <div class="feature">
                    <div class="title">Material</div>
                    <div>{{$especification->main_material}}</div>
                </div>
            @endif

            @if($especification->condition_type != null)
                <div class="feature">
                    <div class="title">Condición del producto</div>
                    <div> 
                    <?php 
                    echo DB::table('condition_types')->where([
                    ['id', '=', $especification->condition_type],
                    ])->value('name'); 
                    ?>
                    </div>
                </div>
            @endif


            @if($especification->belt_material != null)
                <div class="feature">
                    <div class="title">Material de correa</div>
                    <div>
                        <?php 
                        echo DB::table('belt_materials')->where([
                        ['id', '=', $especification->belt_material],
                        ])->value('name');
                        ?>
                    </div>
                </div>
            @endif

            @if($especification->type_reloj != null)
                <div class="feature">
                    <div class="title">Tipo de reloj</div>
                    <div>
                        <?php 
                        echo DB::table('type_relojs')->where([
                        ['id', '=', $especification->type_reloj],
                        ])->value('name');
                        ?>
                    </div>
                </div>
            @endif

            @if($especification->box_shape != null)
                <div class="feature">
                    <div class="title">Forma de la caja</div>
                    <div>
                        <?php 
                        echo DB::table('box_shapes')->where([
                        ['id', '=', $especification->box_shape],
                        ])->value('name');
                        ?>
                    </div>
                </div> 
            @endif
            
            @if($especification->condition_type_note != null)
                <div class="feature">
                    <div class="title">Detalle condición física del producto</div>
                    <div>{{$especification->condition_type_note}}</div>
                </div>
            @endif

            @if( $especification->other_details_content != null)
                <div class="feature">
                    <div class="title">Qué hay en la caja</div>
                    <div> <?=$especification->other_details_content?></div>
                </div>
            @endif

            
            @if($especification->other_details_warranty != null)
                <div class="feature">
                    <div class="title">Garantía del producto</div>
                    <div><?=$especification->other_details_warranty?></div>
                </div>
            @endif

        </div>
    </div> 
</div>
