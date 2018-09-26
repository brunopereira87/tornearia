function abreModal(){
	console.log("largura da tela:"+window.screen.width);
	if(window.screen.width < 700){
		document.getElementById('myModal').style.display = "table";
	}
	else{
		document.getElementById('myModal').style.display = "block";
	}
}
function fechaModal(){
	document.getElementById('myModal').style.display = "none";
}
var indiceSlide = 0;
mostraSlide(indiceSlide);

function moveSlide(valor){
	mostraSlide(indiceSlide+= valor);
}
function slideAtual(valor){
	mostraSlide(indiceSlide = valor);
}

function mostraSlide(valor){
	var slides = document.getElementsByClassName("img_modal");
	var miniaturas = document.getElementsByClassName("demo");
	console.log("Valor:"+valor);
	if(valor > slides.length-1){
		indiceSlide = 0;
	}
	if(valor < 0){
		indiceSlide = slides.length-1;
	}
	for(let i=0;i< slides.length;i++){
		slides[i].style.display = "none";
	}
	for(let i=0;i< miniaturas.length;i++){
		miniaturas[i].style.border ="1px solid #000"; 
	}
	slides[indiceSlide].style.display = "block";
	miniaturas[indiceSlide].style.border ="2px solid #fff"; 
	
}