/*
	*	Title: menu.js
	*	Author: Frederico
	*	Date: 17/07/2014
*/

$(document).ready(function () {
    $(".opcao").on("click", function () {
        $(".opcao").removeClass("opcaoSelected");
        if (!$(this).hasClass("opcaoSelected")) {
            $(this).addClass("opcaoSelected");
        }
    });
});