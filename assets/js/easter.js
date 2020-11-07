var ball = document.getElementById("ball");
var box = document.getElementById("game");
var playScreen = document.getElementById("play");
var startScreen = document.getElementById("start-screen");
var scoreScreen = document.getElementById("score-screen");
var playBtnStart = document.getElementById("btn-play-start");
var playBtnScore = document.getElementById("btn-play-score");
var boxwidth = parseInt(window.getComputedStyle(box).getPropertyValue("width"));
var boxheight = parseInt(window.getComputedStyle(box).getPropertyValue("height"));
var ballheight = parseInt(window.getComputedStyle(ball).getPropertyValue("height"));

function leftMovement(){
	var left = parseInt(window.getComputedStyle(ball).getPropertyValue("left"));
	if (left > 0){
		ball.style.left = left - 2 + "px";
	}
}
function rightMovement(){
	var left = parseInt(window.getComputedStyle(ball).getPropertyValue("left"));
	var ballwidth = parseInt(window.getComputedStyle(ball).getPropertyValue("width"));
	var boxright = parseInt(window.getComputedStyle(box).getPropertyValue("width"));
	if (left < (boxright-ballwidth-40)){
		ball.style.left = left + 2 + "px";
	}
}

playBtnStart.addEventListener("click", play);
playBtnScore.addEventListener("click", reloadPage);

function reloadPage(){
	location.reload();
}

function play(){
	var interval;
	var both;
	var counter = 0;
	var blocksOnScreen =  [];
	startScreen.style.display = "none";
	scoreScreen.style.display = "none";
	playScreen.style.display = "block";
	document.addEventListener("keydown", event => {
		if (both == 0){
			both++;
			
			if(event.key == "ArrowLeft"){
				interval = setInterval(leftMovement, 1);
			}else if(event.key == "ArrowRight"){
				interval = setInterval(rightMovement, 1);
			}
		}
	});

	document.addEventListener("keyup", event => {
		clearInterval(interval);
		both = 0;
	});
	var blocks = setInterval(function(){
		var lastBlock = document.getElementById("block" + (counter - 1));
		var lastBlockTop = -100;
		if (counter >  0){ 
			lastBlockTop = parseInt(window.getComputedStyle(lastBlock).getPropertyValue("top"));
		}
		if (lastBlockTop < (boxheight - 100)){
			let block = document.createElement("div");
			let hole = document.createElement("div");
			block.setAttribute("class", "block");
			hole.setAttribute("class", "hole");
			block.setAttribute("id", "block" + counter);
			hole.setAttribute("id", "hole" + counter);
			let rnd =  Math.floor(Math.random() * (boxwidth - ballheight - 40));
			hole.style.left = rnd + "px";
			hole.style.top = lastBlockTop + 100 + "px";
			block.style.top = lastBlockTop +  100 + "px";
			playScreen.appendChild(block);
			playScreen.appendChild(hole);
			blocksOnScreen.push(counter);
			counter++;
		}
		var ballTop = parseInt(window.getComputedStyle(ball).getPropertyValue("top"));
	    var ballLeft = parseInt(window.getComputedStyle(ball).getPropertyValue("left"));
	    var drop = 0;
		for(var i = 0; i < blocksOnScreen.length; i++){
			let current = blocksOnScreen[i];
			let iblock = document.getElementById("block" + current);
			let ihole = document. getElementById("hole" + current);
			let iblockTop = parseFloat(window.getComputedStyle(iblock).getPropertyValue("top"));
			let iholeLeft = parseFloat(window.getComputedStyle(ihole).getPropertyValue("left"));
			iblock.style.top = iblockTop - .5 + "px";
			ihole.style.top = iblockTop - .5 + "px";
			if (iblockTop < - 20){
				blocksOnScreen.shift();
				iblock.remove();
				ihole.remove();
			}
			if(iblockTop-20<ballTop && iblockTop>ballTop){
	            drop++;
	            if(iholeLeft<=ballLeft && iholeLeft+20>=ballLeft){
	                drop = 0;
	            }
	        }
		}
		if(ballTop <= 0){
	        let score = document.getElementById("score");
	        score.innerHTML = "Score: " + (counter - 11);
	        clearInterval(blocks);
	      	scoreFun();
	    }
		if(drop==0){
	        if(ballTop < boxheight - ballheight - 40){
	            ball.style.top = ballTop + 2 + "px";
	        }
	    }else{
	       ball.style.top = ballTop - .5 + "px";
	    }
	} ,1);
}

function scoreFun(){
	scoreScreen.style.display = "block";
}