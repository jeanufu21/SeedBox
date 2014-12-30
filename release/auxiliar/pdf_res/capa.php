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
    
    div.dados_ensaio {
        width: 100%;
        height: 60%;
        border: solid 1px black;
        padding: 2mm;
    }
    
    
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
    
    <div style="text-align: center; width: 100%;">
        <br>
        <img src="../resource/image/logo.png" style="width: 150mm">
        <br>
    </div>
    
    <br>
    
    <h3 style="text-align: center;">Relatório de Avaliação de Ensaio</h3>
    
    <br><br>
    
    <div class="dados_ensaio">

        <table style="border:1px solid black; border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th colspan='4' style="border:1px solid black; width: 25%;" align='center'>Campo</th>
                </tr>
                
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid black; width: 25%;" >Cidade: <?php echo utf8_encode($this->capa_pdf->getCidade()); ?></td>
                    <td style="border:1px solid black; width: 25%;" >UF: <?php echo $this->capa_pdf->getUf(); ?></td>
                    <td style="border:1px solid black; width: 25%;" >Localização: <?php  echo round($this->capa_pdf->getLatitude(),2) . ', '. round($this->capa_pdf->getLongitude(),2); ?> </td>
                    <td style="border:1px solid black; width: 25%;" >Altura: <?php echo round($this->capa_pdf->getAltitude(),2); ?></td>
                </tr>
            </tbody>
        </table>
        
        <br><br>
        
        <table style="border:1px solid black; border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th colspan='3' style="border:1px solid black; width: 100%;" align='center'>Ensaio</th>
                </tr>
                
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid black;" >Data Semeio: <?php if($this->capa_pdf->getData_semeio() != null) echo DateTime::createFromFormat('Y-m-d', $this->capa_pdf->getData_semeio())->format('d/m/Y'); ?></td>
                    <td style="border:1px solid black;" >Data Transplante: <?php  if($this->capa_pdf->getData_transplante() != null) echo DateTime::createFromFormat('Y-m-d', $this->capa_pdf->getData_transplante())->format('d/m/Y'); ?> </td>
                    <td style="border:1px solid black;" >Data Colheita: <?php if($this->capa_pdf->getData_colheita() != null) echo DateTime::createFromFormat('Y-m-d', $this->capa_pdf->getData_colheita())->format('d/m/Y'); ?></td>
                </tr>
                <tr>
                    <td colspan='3' style="border:1px solid black;width: 100%;" >Produto Testemunha: <?php echo utf8_encode($this->capa_pdf->getProduto_testemunha()) ?></td>
                </tr>
                <tr>
                    <td colspan='3' style="border:1px solid black; width: 100%;" >Empresa: <?php echo utf8_encode($this->capa_pdf->getEmpresa()); ?></td>
                </tr>
                <tr>
                    <td colspan='3' style="border:1px solid black; " >Produtor: <?php echo utf8_encode($this->capa_pdf->getProdutor()); ?></td>
                </tr>
                <tr>
                    <td colspan='3' style="border:1px solid black; " >Responsavel: <?php echo utf8_encode($this->capa_pdf->getResponsavel()); ?></td>
                </tr>
                <tr>
                    <td colspan='3' style="border:1px solid black; " >Supervisor: <?php  echo utf8_encode($this->capa_pdf->getSupervisor()); ?> </td>
                </tr>
                <tr>
                    <td colspan='3' style="border:1px solid black; " >Avaliador: <?php echo utf8_encode($this->capa_pdf->getAvaliador()); ?></td>
                </tr>
                   
            </tbody>
        </table>
        
        <br><br>
        
        <?php $set_array = explode('#', utf8_encode($this->capa_pdf->getValores_set())); ?>
                   
        
        <table style="border:1px solid black; border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th colspan='3' style="border:1px solid black; width: 100%;" align='center'>Espécie: <?php echo  $this->lista_especie_patrametrosespecie_model[0]->getEspecie();  ?></th>
                </tr>
                
            </thead>
            <tbody>
                
                <?php
                    for($i = 1; $i < count($set_array) - 1; $i++ )
                    {
                         echo '<tr><td style="border:1px solid black;" >' . $this->lista_especie_patrametrosespecie_model[ $i - 1 ]->getNome_par_especie() . ': ' . $set_array[$i] . '</td></tr>';
                    }
                    
                    $fase = $set_array[$i] == 1 ? 'Screning' :  $set_array[$i] == 2 ? 'Pre Commercial' : 'Commercial';  
  
                    echo '<tr><td style="border:1px solid black;" >Fase: ' . $fase . '</td></tr>';       
                ?>
                 
            </tbody>
        </table>
                         
    </div>

</page>