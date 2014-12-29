/*
	*	Title: trialgroups.js
	*	Authors: Frederico, Gustavo
	*	Date: 27/03/2014
*/
var rowNum = 0;
function addRow1(frm, n, codAtt) {
    
	if($(".attTrialG"+codAtt).length < 2){
		if($("#qtIns").val() == 0){
			$("#ItemRows").find("h4").remove();
		}
        var row = $('<tr class="linha'+rowNum+' attTrialG'+$("#cod" + n).val()+'">'+
				        '<td><input name="codPar[]" type="hidden" class="hide" value="'+$("#cod"+n).val()+'" /><h4>'+$("#nome" + n).text()+'</h4></td>'+
                        //'<td><input type="checkbox" class="req" value="0" onclick="if($(this).val() == 1) $(this).val(0); else $(this).val(1); $(\'#required'+$('#qtIns').val()+'\').val($(this).val());"><label>&nbsp;Required</label>'+
                        '<td class="reqAtt'+$(".attTrialG"+codAtt).length+'">'+
                            '<input type="checkbox" class="req" value="0" onclick="alteraCheckbox($(this), '+$("#cod" + n).val()+');" /><label>&nbsp;Required</label>'+
                            '<input id="required'+$("#qtIns").val()+'" type="hidden" class="hidden hidReq" name="required[]" value="0" />'+
                        '</td>'+
			        	'<td class="form-group has-success form-inlinha">'+
			        		'<table>'+
			        			'<tr>'+
			        				'<th><label>Min:&nbsp;</label></th>'+
		        					'<td><input name="min[]"type="text" class="form-control input-sm min" placeholder="MIN" /></td>'+
		        				'</tr>'+
		        				'<tr>'+
		        					'<th><label>Max:&nbsp;</label></th>'+
		        					'<td><input name="max[]"type="text" class="form-control input-sm max" placeholder="MAX" /></td>'+
	        					'</tr>'+
	        				'</table>'+
	        			'</td>'+
	        			'<td class="form-group has-success form-inlinha">'+
	        				'<input type="button" value="Remove" class="btn btn-danger btn-sm pull-right" onclick="removeRow1('+rowNum+','+n+');" />'+
        				'</td>'+
    				'</tr>'+
        			'<tr class="linha'+rowNum+'">'+
        				'<th>Coments: </th>'+
        				'<td colspan="2"><textarea name="coments[]" class="form-control" value=""></textarea></td>'+
        				'<td><label>N&deg; of usage:</label><input name="n_ava[]" type="text" class="form-control input-sm nava" value="1" />'+
        			'</tr>');

        var row1 = $('<tr class="linha' + rowNum + ' attTrialG'+$("#cod" + n).val()+'">' +
				        '<td><input name="codPar[]" type="hidden" class="hide" value="'+$("#cod"+n).val()+'" /><h4>' + $("#nome" + n).text() + '</h4></td>' +
                        //'<td><input type="checkbox" class="req" value="0" onclick="if($(this).val() == 1) $(this).val(0); else $(this).val(1); $(\'#required'+$('#qtIns').val()+'\').val($(this).val());"><label>&nbsp;Required</label>'+
				        '<td class="reqAtt'+$(".attTrialG"+codAtt).length+'">'+
                            '<input type="checkbox" class="req" value="0" onclick="alteraCheckbox($(this), '+$("#cod" + n).val()+');" /><label>&nbsp;Required</label>'+
                            '<input id="required'+$("#qtIns").val()+'" type="hidden" class="hidden hidReq" name="required[]" value="0" />'+
                        '</td>'+
			        	'<td class="form-group has-success form-inlinha hidden">' +
			        		'<table>' +
			        			'<tr>' +
			        				'<th><label>Min:&nbsp;</label></th>' +
		        					'<td><input name="min[]"type="text" class="form-control input-sm" placeholder="MIN" value="1" /></td>' +
		        				'</tr>' +
		        				'<tr>' +
		        					'<th><label>Max:&nbsp;</label></th>' +
		        					'<td><input name="max[]"type="text" class="form-control input-sm" placeholder="MAX" value="5"/></td>' +
	        					'</tr>' +
	        				'</table>' +
	        			'</td>' +
	        			'<td class="form-group has-success form-inlinha" colspan="2">' +
	        				'<input type="button" value="Remove" class="btn btn-danger btn-sm pull-right" onclick="removeRow1(' + rowNum + ',' + n + ');" />' +
        				'</td>' +
    				'</tr>' +
        			'<tr class="linha' + rowNum + '">' +
        				'<th>Coments: </th>' +
        				'<td colspan="2" style="min-width: 280px;"><textarea name="coments[]" class="form-control" value="Teste" ></textarea></td>' +
        				'<td><label>N&deg; of usage:</label><input name="n_ava[]" type="text" class="form-control input-sm nava" value="1" />' +
        			'</tr>');

        if($("#quant"+n).data("quant") == "1")
            row.appendTo($('#newatts'));
        else
            row1.appendTo($('#newatts'));

        $("#qtIns").val(parseInt($("#qtIns").val())+1);
        
	    if($(".attTrialG"+codAtt).length == 2){
	        if($(".attTrialG"+codAtt).eq(0).find(".hidReq").val() == 0){

	        	$(".attTrialG"+codAtt).eq(1).find(".hidReq").val(1);
	        	$(".attTrialG" + codAtt).eq(1).find(".req").val(1);
                $(".attTrialG"+codAtt).eq(1).find(".req").attr("checked", true);
	        	//$(".attTrialG"+codAtt).eq(1).find(".req").attr("checked", "checked");
	        	//$(".attTrialG" + codAtt).find(".req").attr("disabled", "disabled");
	        }else{

	        	$(".attTrialG"+codAatt).eq(1).find(".hidReq").val(0);
	        	$(".attTrialG" + codAtt).eq(1).find(".req").val(0);
                $(".attTrialG"+codAtt).eq(1).find(".req").attr("checked", false);
	        	//$(".attTrialG"+codAtt).eq(1).find(".req").removeAttr("checked");
                //$(".attTrialG" + codAtt).find(".req").attr("disabled", "disabled");
	        }
	    }

		$(document).ready(function(){
			$(".min, .max, .nava").keyup(function(){
				justNumbers($(this));	
			});
		});
        //alert($("#qtIns").val());
        rowNum++;
    }
};

function removeRow1(rnum) {
	$('.linha'+rnum).remove();
    $("#qtIns").val(parseInt($("#qtIns").val())-1);
    rowNum--;
    if(!$("#qtIns").val()){
    	$("#oldattsCap").hide();
    };	
};

function justNumbers(elem){
	var expre = /[^0-9]/g;
	// REMOVE OS CARACTERES DA EXPRESSAO ACIMA
	if (elem.val().match(expre))
	elem.val(elem.val().replace(expre,''));
};

$(document).ready(function(){
	$(".min, .max, .nava").keyup(function(){
		justNumbers($(this));	
	});
});

// Valida se existem espécies cadastradas
function verificaSpecie(){
	if(!$("#specie").find("option.species").length){
		novaMensagem("erro", "None specie was registered, please record them first!");
		return 0;
	}
	return 1;
}

// Caso não existam espécies cadastradas exibe mensagem de erro ao clicar no botão "New Param"
$(document).ready(function(){
	$("#openModal").on("click", function(){
		if(verificaSpecie()){
			$("#openModal").attr("data-toggle", "modal");	
		}
	});
});

/* Esta função altera o valor do checkbox ao clicar nele e o valor do campo hidden */
function alteraCheckbox(item, num){

    if(item.parent().attr("class") == "reqAtt0"){
        if(item.val() == 0){
            item.val(1);
            item.parent().children(".hidReq").val(item.val());
            item.attr("checked", true);

            if($(".attTrialG"+num).length == 2){
               
                $(".attTrialG"+num).children(".reqAtt1").children(".req").attr("checked", false);
                //$(".attTrialG"+num).children(".reqAtt1").children(".req").removeAttr("checked");
                
                $(".reqAtt1").children(".req").val(0);
                $(".reqAtt1").children(".hidReq").val(0);
            }
        }else{
            item.val(0);
            item.parent().children(".hidReq").val(item.val());
            item.attr("checked", false);
            if($(".attTrialG"+num).length == 2){

                $(".attTrialG"+num).children(".reqAtt1").children(".req").attr("checked", true);
                //$(".attTrialG"+num).children(".reqAtt1").children(".req").attr("checked", "checked");
                
                $(".reqAtt1").children(".req").val(1);
                $(".reqAtt1").children(".hidReq").val(1);
            }
        }
    }else if(item.parent().attr("class") == "reqAtt1"){
        if(item.val() == 0){
            item.val(1); 
            item.parent().children(".hidReq").val(item.val());
            item.attr("checked", true);

            if($(".attTrialG"+num).length == 2){

                $(".attTrialG"+num).children(".reqAtt0").children(".req").attr("checked", false);
                //$(".attTrialG"+num).children(".reqAtt0").children(".req").removeAttr("checked");
                    
                $(".reqAtt0").children(".req").val(0);
                $(".reqAtt0").children(".hidReq").val(0);
            }
        }else{
            item.val(0);
            item.parent().children(".hidReq").val(item.val());
            item.attr("checked", false);

            if($(".attTrialG"+num).length == 2){

                $(".attTrialG"+num).children(".reqAtt0").children(".req").attr("checked", true);
                //$(".attTrialG"+num).children(".reqAtt0").children(".req").attr("checked", "checked");
                
                $(".reqAtt0").children(".req").val(1);
                $(".reqAtt0").children(".hidReq").val(1);
            }
        }
    }
    /*
    if(item.val() == 1){ 
        item.val(0);
        item.removeAttr("checked");
    }else{ 
        item.val(1); 
        item.attr("checked", "checked"); 
    }
    $("#required"+num).val(item.val());
    */
}

/*
function alteraCheckbox(item, num){
    
    if(item.val() == 1){ 
        item.val(0);
        item.removeAttr("checked");
    }else{ 
        item.val(1); 
        item.attr("checked", "checked"); 
    }
    $("#required"+num).val(item.val());
}
*/