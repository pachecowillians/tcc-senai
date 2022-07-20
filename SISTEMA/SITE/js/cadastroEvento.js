$(function(){
    if ($("#imgPrincipal").attr("src") == 'img/imgUsuario/EvSemImg.png' || $("#imgPrincipal").attr("src") == 'img/addImg.png') {
        $('#btRemp').hide();
    }
    else{
        $('#btRemp').show();
    }

    if ($("#img1").attr("src") == 'img/imgUsuario/addImg.jpg') {
        $('#btRem1').hide();
    }
    else{
        $('#btRem1').show();
    }

    if ($("#img2").attr("src") == 'img/imgUsuario/addImg.jpg') {
        $('#btRem2').hide();
    }
    else{
        $('#btRem2').show();
    }

    if ($("#img3").attr("src") == 'img/imgUsuario/addImg.jpg') {
        $('#btRem3').hide();
    }
    else{
        $('#btRem3').show();
    }
});
$('#txtTelefone').mask('(00) 00000-0000');
$('#btRemp').click(function(){
    $("#fileUploadPrincipal").val('');
    $("#imgPrincipal").attr("src","img/imgUsuario/EvSemImg.png"); 
    $("#txtFotoPrincipal").attr('value','s');
    $(this).hide();
    
});

$('#btRem1').click(function(){
    $("#fileUpload1").val('');
    $("#img1").attr("src","img/imgUsuario/addImg.jpg"); 
    $("#txtFotoSec1").attr('value','s');
    $(this).hide();
    
});

$('#btRem2').click(function(){
    $("#fileUpload2").val('');
    $("#img2").attr("src","img/imgUsuario/addImg.jpg"); 
    $("#txtFotoSec2").attr('value','s');
    $(this).hide();
    
});

$('#btRem3').click(function(){
    $("#fileUpload3").val('');
    $("#img3").attr("src","img/imgUsuario/addImg.jpg"); 
    $("#txtFotoSec3").attr('value','s');
    $(this).hide();
    
});


$("#fileUploadPrincipal").on('change', function () {

    if (typeof (FileReader) != "undefined") {

        var image_holder = $("#image-holder");
        image_holder.empty();

        var reader = new FileReader();
        reader.onload = function (e) {
        	$("#imgPrincipal").attr("src",e.target.result);
            $('#btRemp').show();
        }
        image_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
        
    } else{
        alert("Este navegador nao suporta FileReader.");
    }
});

$("#fileUpload1").on('change', function () {

    if (typeof (FileReader) != "undefined") {

        var image_holder = $("#image-holder");
        image_holder.empty();

        var reader = new FileReader();
        reader.onload = function (e) {
        	$("#img1").attr("src",e.target.result);
            $('#btRem1').show();
        }
        image_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
    } else{
        alert("Este navegador nao suporta FileReader.");
    }
});

$("#fileUpload2").on('change', function () {

    if (typeof (FileReader) != "undefined") {

        var image_holder = $("#image-holder");
        image_holder.empty();

        var reader = new FileReader();
        reader.onload = function (e) {
        	$("#img2").attr("src",e.target.result);
            $('#btRem2').show();
        }
        image_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
    } else{
        alert("Este navegador nao suporta FileReader.");
    }
});
$("#fileUpload3").on('change', function () {

    if (typeof (FileReader) != "undefined") {

        var image_holder = $("#image-holder");
        image_holder.empty();

        var reader = new FileReader();
        reader.onload = function (e) {
        	$("#img3").attr("src",e.target.result);
            $('#btRem3').show();
        }
        image_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
    } else{
        alert("Este navegador nao suporta FileReader.");
    }
});

$("#imgPrincipal").click(function(){
	$("#fileUploadPrincipal").click();
    $("#txtFotoPrincipal").attr("value","s");
    $(this).src("");
});


$("#img1").click(function(){
	$("#fileUpload1").click();
    $("#txtFotoSec1").attr("value","s");
    $(this).src("");
});

$("#img2").click(function(){
	$("#fileUpload2").click();
    $("#txtFotoSec2").attr("value","s");
    $(this).src("");
});

$("#img3").click(function(){
	$("#fileUpload3").click();
    $("#txtFotoSec3").attr("value","s");
    $(this).src("");
});
$(window).resize(function(){
  var largura = $(window).width();
  var src = $('#imgPrincipal').attr('src');
  console.log(src);
  if (src == 'img/banner.svg' || src == 'img/imgEvento.svg') {
    if (largura < 740) {
        $('#imgPrincipal').attr('src','img/imgEvento.svg');
    }
    else{
        $('#imgPrincipal').attr('src','img/banner.svg');
    }
}
});
$(document).ready(function(){
  var largura = $(window).width();
  var src = $('#imgPrincipal').attr('src');
  console.log(src);
  if (src == 'img/banner.svg' || src == 'img/imgEvento.svg') {
    if (largura < 740) {
        $('#imgPrincipal').attr('src','img/imgEvento.svg');
    }
    else{
        $('#imgPrincipal').attr('src','img/banner.svg');
    }
}
});