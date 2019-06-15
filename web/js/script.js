(function(){
	var canvas = null,
		box = null,
		map = L.map("mapId"),
 		Box = function() {
            this.l = 1000;
            this.h = 1500;
            this.padding = 0;
			this.L = 35 * this.l + 34 * this.padding;
			this.H = 15 * this.h + 14 * this.padding;
            this.Ox = this.L/2;
            this.Oy = this.h;
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
            
            this.xMap = [];
            this.yMap = [];
            
            this.xMap[-1] = this.h;
            this.xMap[1] = this.l;
            this.yMap[-1] = this.l;
            this.yMap[1] = this.h;
            
            
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

    Box.prototype.getData = function(table) {
        var xhr = new XMLHttpRequest(),
        api = {
            line : 'http://joo25.loc/lines',
            teil : 'http://joo25.loc/teils'
        };

        xhr.open('GET', api[table], false);
        xhr.send();

        if( 200 === xhr.status ) {
            var res = JSON.parse(xhr.responseText);
            return res;
        } else {
            //console.log( xhr.status );
            return -1;
        }
    };
    
    var lines = box.getData('line');
    var tiles = box.getData('teil');
    
    lines.forEach(function(item) {
        let line = [ 
            this.Ox + item.lineFrom.x * this.l,
            this.Oy + item.lineFrom.y * this.h,
            this.Ox + item.lineTo.x * this.l,
            this.Oy + item.lineTo.y * this.h
        ];
        
        canvas
        .line(line)
        .stroke({
            color: 'black',
            width: 20,
            linecap: 'round'
        });
    }, box);
    
    tiles.forEach(function(item){
        var point = [
            this.Ox + item.x * this.l,
            this.Oy + item.y * this.h
        ], f = null;
        
        if ( item.image !== null ) {
            // image teil
            point[0] -= this.l/2;
            point[1] -= this.h/2;
            
            let size = [this.l, this.h];
            f = canvas
                .image('/img/' + item.image)
                .move(point[0], point[1])
                .loaded(function(loader) {
                    this.size(size[0]* loader.ratio, size[1] );
                });
        } else {
            // shape teil
            if ( item.l && item.h ) {
                // draw the rectangle
                f = canvas.rect(
                    this.xMap[item.l],
                    this.yMap[item.h]
                );
                if ( item.r !== null ) {
                    f.radius( item.r );
                }
            } else {
                // draw the circle
                f = canvas.circle(this.yMap[item.r]);
            }
        
            f
            .fill( item.fill )
            .center(point[0], point[1]);
            
            if ( item.text ) {
                // type text in teilbox
                let text = item.text.split('\\n'),
                    teilText = null,
                    i = 0;
                
                teilText = canvas.text(function( str ) {
                    
                    text.forEach(function( row ) {
                        if ( 0 !== i ) {
                            str.tspan(row).newLine();
                        } else {
                            str.tspan(row);
                        }
                        i++;
                    });
                });
                
                teilText.font({
                    size: '150',
                    anchor: 'middle'
                })
                .move(point[0], point[1]-90*i);
            }
        }
        
        f.attr({
            'data-mark': item.teil_id + ' | ' + item.x + ' - ' + item.y
        });
    }, box);
        
})();
