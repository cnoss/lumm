// The statements in the setup() function 
// execute once when the program begins
function setup () {
	// createCanvas should be the first statement
	createCanvas(720, 400);  
	noLoop();
}

// The statements in draw() are executed until the 
// program is stopped. Each statement is executed in 
// sequence and after the last line is read, the first 
// line is executed again.
function draw () { 
	background(255);   // Set the background to black
	
	var colors = {};
	colors[0] = [0,76,147];
	colors[1] = [139,160,2];
	colors[2] = [198,81,20];
	colors[4] = [227,72,249];
	colors[3] = [198,70,68];
		
	for (var i = 0, l = Math.random() * 50 + 25; i < l; i++) {
		var opacity = Math.random() * 100;
		var bw = Math.random() * 75 + 25;
		var bh = Math.random() * Math.random() * 175 + 25;
		var bl = Math.random() * (width - bw);
		
		var col = Math.floor(Math.random() * 3);
		noStroke();
		//fill(19, 67, 146, opacity);
		var c = colors[col];
		c.push(opacity + 100);
		fill(c);
		rect(bl, height, bw, -bh);
		
		var opacity = Math.random() * 10;
		fill(0,0,0,125);
		rect(bl+bw, height, 2, -bh);
		
	}	
		
 
} 

window.setInterval(draw, 1000);