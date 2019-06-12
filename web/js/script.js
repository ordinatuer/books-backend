(function(){
	var canvas = null,
		box = null,
		map = L.map("mapId"),
 		Box = function() {
			this.L = 35*1000+34*200;
			this.H = 15*1500+14*200;
			this.container = "mapId";
			this.canvas = "svgBox";

			this.real = function() {
				let el = document.getElementById(this.container);
				return [el.clientWidth, el.clientHeight];
			};

			this.el = document.createElementNS("http://www.w3.org/2000/svg", "svg");
			this.el.setAttribute("xmlns", "http://www.w3.org/2000/svg");
			this.el.setAttribute("viewBox", "0 0 "+this.L+" "+this.H);
			this.el.setAttribute("id", this.canvas);

			this.bounds = [[0, 0], [this.L, this.H]];
		};

	box = new Box();
	
	map.fitBounds(box.bounds);
	map.setMaxBounds(box.bounds);

	L.svgOverlay(
		box.el,
		box.bounds,
		{
			interactive: true
		}
	).addTo(map);

	canvas = SVG("svgBox");

	canvas.rect(box.L, box.H).fill('white');

// -----------------------

})();

var lines = function() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'http://joo25.loc/lines', false);
    xhr.send();

    if( 200 === xhr.status ) {
        var res = JSON.parse(xhr.responseText);
        return res;
    } else {
        //alert( xhr.status );
        return -1;
    }
};

var l = lines();

console.log( l );
