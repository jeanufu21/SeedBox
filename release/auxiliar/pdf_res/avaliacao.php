<?php 
    function criaParametroQuantitativo( $parametro, $obrigatorio, $observacao ) {
        if( $obrigatorio ) {
            return
                        '<tr>
                            <td class="tr1" style="width: 30%;">
                                <b>' . $parametro . '*</b>
                            </td>
                            <td class="tr1" style="width: 50%;">
                                <div class="input"></div>
                            </td>
                            <td class="tr1" style="width: 20%;" >
                                <div class="input"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr2" colspan="3" style=" width:100%;height:30px;"><span class="pequeno">' . $observacao . '</span> </td>
                        </tr>';
        }
        
        return
                        '<tr>
                            <td class="tr1" style="width: 30%;">
                                ' . $parametro . '
                            </td>
                            <td class="tr1" style="width: 50%;">
                                <div class="input"></div>
                            </td>
                            <td class="tr1" style="width: 20%;" >
                                <div class="input"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr2" colspan="3" style="width:100%;height:30px;"><span class="pequeno">' . $observacao . '</span></td>
                        </tr>';
        
    }
    
    function criaParametroQualitativo( $parametro, $obrigatorio, $observacao ) {
        if( $obrigatorio ) {
            return
                        '<tr>
                            <td class="tr1" style="width: 30%;">
                                <b>' . $parametro . '*</b>
                            </td>
                            <td class="tr1" style="width: 50%;">
                                <table align="center" style="width:80%;">
                                    <tr>
                                        <td style="width:10%;border:none; "><span class="pequeno">  1</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                        <td style="width:10%;border:none; "><span class="pequeno">  2</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                        <td style="width:10%;border:none; "><span class="pequeno">  3</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                        <td style="width:10%;border:none; "><span class="pequeno">  4</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                        <td style="width:10%;border:none; "><span class="pequeno">  5</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                    </tr>
                                    
                                </table>
                            </td>
                            <td class="tr1" style="width: 20%;" >
                                <div class="input"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr2" colspan="3" style="width:100%;height:30px;"><span class="pequeno">' . $observacao . '</span></td>
                        </tr>';
            
        }
        
        
            
        return
                        '<tr>
                            <td class="tr1" style="width: 30%;">
                                ' . $parametro . '
                            </td>
                            <td class="tr1" style="width: 50%;">
                                <table align="center" style="width:80%;">
                                    <tr>
                                        <td style="width:10%;border:none; "><span class="pequeno">  1</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                        <td style="width:10%;border:none; "><span class="pequeno">  2</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                        <td style="width:10%;border:none; "><span class="pequeno">  3</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                        <td style="width:10%;border:none; "><span class="pequeno">  4</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                        <td style="width:10%;border:none; "><span class="pequeno">  5</span></td>
                                        <td style="width:10%;border:none; "><div class="checkbox"></div></td>
                                    </tr>
                                    
                                </table>
                            </td>
                            <td class="tr1" style="width: 20%;" >
                                <div class="input"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr2" colspan="3" style="width:100%;height:30px;"><span class="pequeno">' . $observacao . '</span></td>
                        </tr>';
    }
?>

<style>

    table.page_header {
        width: 100%;  
        background-color: #10773A; 
         
        padding: 2mm 
    }
    
    table.page_footer {
        width: 100%; 
        background-color: #10773A; 
        border-top: solid 1mm #006600; 
        padding: 2mm
    }
    
    .input{
        width: 99%;
        height: 20px;
        border:1px solid black;   
    }
    .nosplit { page-break-inside: avoid; }

    table, table th,table td
    {
       
        border:1px solid black;
        border-collapse:collapse;
        
    }
    
    .checkbox{
        width: 10px;
        height: 10px;
        border:1px solid black;
        border-radius: 5px;
    }
    
    .pequeno{
        font-size: 50%;
    }
    
    .tr1{
        border:none;
        border-top:1px solid black;
        padding-top: 10px;
        padding-bottom: 10px;
        
    }
    .tr2{
        border:none;
        border-bottom:1px solid black;
    }
    
    
</style>

<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt" >
                
    <page_header>
        <table class="page_header" style="border:none;">
            <tr>
                <td style="text-align:right; width:100%;border:none;">
                    <?php echo date("d/m/Y"); ?> 
                </td>
            </tr>
        </table>
    </page_header>

    <page_footer>
        <table class="page_footer" style="border:none;">
            <tr>
                <td style="text-align:left; width:50%;border:none;">
                    www.eagleflores.com.br
                </td>
                <td style="text-align:right; width:50%;border:none;">
                    page [[page_cu]]/[[page_nb]]
                </td>

            </tr>
        </table>

    </page_footer>
    

    <table> 
        <tr>
            <td colspan="2" style="text-align: center;">
                <b>Testemunha</b>
            </td>
        </tr>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <td class="tr2" style="width: 30%;">Parâmetro</td>
                            <td class="tr2" style="width: 40%;">Valor</td>
                            <td class="tr2" style="width: 20%;">Leitura</td>
                        </tr>
                    </thead>
                    <tbody>
<?php 
                        foreach( $this->lista_grupoavaliativo_set_parametros_especie_model as $parametro )
                        {
                            for ($index = 0; $index < ceil( ($parametro->getNro_avaliacoes() - $parametro->getLeituras_feitas() ) /2); $index++) 
                            {
                            
                                if( $parametro->getObrigatorio() == 1 )
                                {
                                    if( $parametro->getQuantitativo() == 1)
                                    {
                                        echo criaParametroQuantitativo( $parametro->getParametro_avaliacao(), true, $parametro->getObservacao() ); 

                                    }
                                    else
                                    {
                                        echo criaParametroQualitativo( $parametro->getParametro_avaliacao(), true, $parametro->getObservacao() ); 

                                    }

                                }
                                else
                                {
                                    if( $parametro->getQuantitativo())
                                    {
                                        echo criaParametroQuantitativo( $parametro->getParametro_avaliacao(), false, $parametro->getObservacao() ); 

                                    }
                                    else
                                    {
                                        echo criaParametroQualitativo( $parametro->getParametro_avaliacao(), false, $parametro->getObservacao() );

                                    }

                                }
                            }
                            
                        }
                           
?>
                        
                    </tbody>

                </table>
                    
            </td>
            <td style="width: 50%;vertical-align: top;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <td class="tr2" style="width: 30%;">Parâmetro</td>
                            <td class="tr2" style="width: 40%;">Valor</td>
                            <td class="tr2" style="width: 20%;">Leitura</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach( $this->lista_grupoavaliativo_set_parametros_especie_model as $parametro )
                        {
                            for ($index = 0; $index < floor(($parametro->getNro_avaliacoes() - $parametro->getLeituras_feitas() ) /2); $index++) {
                            
                                if( $parametro->getObrigatorio() == 1 )
                                {
                                    if( $parametro->getQuantitativo() == 1)
                                    {
                                        echo criaParametroQuantitativo( $parametro->getParametro_avaliacao(), true, $parametro->getObservacao() ); 

                                    }
                                    else
                                    {
                                        echo criaParametroQualitativo( $parametro->getParametro_avaliacao(), true, $parametro->getObservacao() ); 

                                    }

                                }
                                else
                                {
                                    if( $parametro->getQuantitativo())
                                    {
                                        echo criaParametroQuantitativo( $parametro->getParametro_avaliacao(), false, $parametro->getObservacao() ); 

                                    }
                                    else
                                    {
                                        echo criaParametroQualitativo( $parametro->getParametro_avaliacao(), false, $parametro->getObservacao() );

                                    }

                                }
                            }
                            
                        }
                           
?>
                    </tbody>

                </table>
            </td>
        </tr>

    </table>
    
<?php $i = 1;foreach( $this->lista_amostra_produto_marca_fase_model as $amostra ){ ?>
    <br><br><br>
    
    <div class='nosplit'>
    <table> 
        <tr>
            <td colspan="2" style="text-align: center;">
                <b><?php echo 'Amostra ' . $i . ' &lt;' . $amostra->getProduto_nome() . '&gt; &lt;' . $amostra->getNro_estaca() . '&gt;'; $i++; ?> </b>
            </td>
        </tr>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <td class="tr2" style="width: 30%;">Parâmetro</td>
                            <td class="tr2" style="width: 40%;">Valor</td>
                            <td class="tr2" style="width: 20%;">Leitura</td>
                        </tr>
                    </thead>
                    <tbody>
                        
<?php 
                        foreach( $this->lista_grupoavaliativo_set_parametros_especie_model as $parametro )
                        {
                            for ($index = 0; $index < ceil(($parametro->getNro_avaliacoes() - $parametro->getLeituras_feitas() ) /2); $index++) {
                            
                                if( $parametro->getObrigatorio() == 1 )
                                {
                                    if( $parametro->getQuantitativo() == 1)
                                    {
                                        echo criaParametroQuantitativo( $parametro->getParametro_avaliacao(), true, $parametro->getObservacao() ); 

                                    }
                                    else
                                    {
                                        echo criaParametroQualitativo( $parametro->getParametro_avaliacao(), true, $parametro->getObservacao() ); 

                                    }

                                }
                                else
                                {
                                    if( $parametro->getQuantitativo())
                                    {
                                        echo criaParametroQuantitativo( $parametro->getParametro_avaliacao(), false, $parametro->getObservacao() ); 

                                    }
                                    else
                                    {
                                        echo criaParametroQualitativo( $parametro->getParametro_avaliacao(), false, $parametro->getObservacao() );

                                    }

                                }
                            }
                            
                        }
                           
?>
                        
                    </tbody>

                </table>
                    
            </td>
            <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <td class="tr2" style="width: 30%;">Parâmetro</td>
                            <td class="tr2" style="width: 40%;">Valor</td>
                            <td class="tr2" style="width: 20%;">Leitura</td>
                        </tr>
                    </thead>
                    <tbody>
                        
<?php 
                        foreach( $this->lista_grupoavaliativo_set_parametros_especie_model as $parametro )
                        {
                            for ($index = 0; $index < floor(($parametro->getNro_avaliacoes() - $parametro->getLeituras_feitas() ) /2); $index++) {
                            
                                if( $parametro->getObrigatorio() == 1 )
                                {
                                    if( $parametro->getQuantitativo() == 1)
                                    {
                                        echo criaParametroQuantitativo( $parametro->getParametro_avaliacao(), true, $parametro->getObservacao() ); 

                                    }
                                    else
                                    {
                                        echo criaParametroQualitativo( $parametro->getParametro_avaliacao(), true, $parametro->getObservacao() ); 

                                    }

                                }
                                else
                                {
                                    if( $parametro->getQuantitativo())
                                    {
                                        echo criaParametroQuantitativo( $parametro->getParametro_avaliacao(), false, $parametro->getObservacao() ); 

                                    }
                                    else
                                    {
                                        echo criaParametroQualitativo( $parametro->getParametro_avaliacao(), false, $parametro->getObservacao() );

                                    }

                                }
                            }
                            
                        }
                           
?>
                        
                    </tbody>

                </table>
            </td>
        </tr>

    </table>
    </div>
    
<?php } ?>

</page>