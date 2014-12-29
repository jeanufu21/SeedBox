<?php
    function criaLeitura( $nro_leitura ) {
        return 
                            '<tr>
                                <td style="width: 25%; border:none;padding-top: 10px;">
                                    Leitura '. $nro_leitura . ': 
                                </td>
                                <td style="width: 20%; border:none;padding-top: 10px;">
                                    __/__/__
                                </td>
                                <td style="width: 55%; border:none;padding-top: 10px;" >
                                    ____________________
                                </td>
                            </tr>
                            
                            ';
    }                                  
?>

<style>
    
    table.page_header {
        width: 100%; 
        border: none; 
        background-color: #10773A; 
        border-bottom: solid 1mm #006600; 
        padding: 2mm 
    }
    
    table.page_footer {
        width: 100%; 
        border: none; 
        background-color: #10773A; 
        border-top: solid 1mm #006600; 
        padding: 2mm
    }
    
    div.resumo {
        width: 100%;
        height: 90%;
        border: solid 1px black;
        padding: 2mm;
    }
    table.resumo,table.resumo th,table.resumo td
    {
        width: 100%; 
        height: 99.5%;
        border:1px solid black;
        border-collapse:collapse;
    }
/*    table.resumo2,td {
        width: 100%;
        height: 100%;
        border-collapse:collapse;
        border: solid 1px black;
        padding: 2mm;
    }*/
    
    
</style>

<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt" >
                
    <page_header>
        <table class="page_header">
            <tr>
                <td style="text-align:right; width:100%">
                    <?php echo date("d/m/Y"); ?> 
                </td>
            </tr>
        </table>
    </page_header>

    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="text-align:left; width:50%;">
                    www.eagleflores.com.br
                </td>
                <td style="text-align:right; width:50%;">
                    page [[page_cu]]/[[page_nb]]
                </td>

            </tr>
        </table>

    </page_footer>
    
    <h3 style="text-align: center;">Resumo da Avaliação</h3>
    <div class="resumo">
        
        <table class="resumo" align="center"> 
            <tr>
                <td style="width: 50%; text-align: left;">
                    <table style="width: 100%; height: 10px; border:none;">
                        <thead>
                            <tr>
                                <th style="width: 25%; border:none;">Leitura</th>
                                <th style="width: 20%; border:none;">Data</th>
                                <th style="width: 55%; border:none;">Avaliador</th>
                            </tr>
                        </thead>
                        <tbody>
<?php 
                            $total_leituras = 0;

                            foreach( $this->lista_grupoavaliativo_set_parametros_especie_model as $parametro )
                            {
                                $total_leituras += $parametro->getNro_avaliacoes() - $parametro->getLeituras_feitas(); 
                            }

                            $total_leituras *= count($this->lista_grupoavaliativo_set_parametros_especie_model);

                            for ($i=0; $i < ceil( $total_leituras / 2 ) ; $i++) { 
                                echo criaLeitura( $i );
                            }
        
 ?>
                        </tbody>
                        
                    </table>
                        
                </td>
                <td style="width: 50%; text-align: left;">
                    <table style="width: 100%; height: 10px; border:none;">
                        <thead>
                            <tr>
                                <th style="width: 25%; border:none;">Leitura</th>
                                <th style="width: 20%; border:none;">Data</th>
                                <th style="width: 55%; border:none;">Avaliador</th>
                            </tr>
                        </thead>
                        <tbody>
                            
<?php
                            for ($i=ceil( $total_leituras / 2 ); $i < $total_leituras; $i++) { 
                                echo criaLeitura( $i );
                            }

?>
                                   
                        </tbody>
                        
                    </table>

                </td>
            </tr>
      
        </table>
    </div>
    
    
    

</page>