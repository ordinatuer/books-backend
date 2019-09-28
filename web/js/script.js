(function(){
	var canvas = null,
		box = null,
		map = L.map("mapId"),
 		Box = function() {
            this.l = 1000;
            this.h = 1500;
            this.padding = 200;
			this.L = 65 * this.l + 64 * this.padding;
			this.H = 15 * this.h + 14 * this.padding;
            this.Ox = this.L/2;
            this.Oy = this.H/2;
			this.container = "mapId";
			this.canvas = "svgBox";
            this.default = {
                fill : '#999'
            };
            
            this.lineColors = [];
            this.lineColors[0] = 'black';
            this.lineColors[-1] = 'red';
            this.lineColors[1] = 'green';

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
            
            this.lines = [];
            this.teils = [];
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

    Box.prototype.getData = function(table, page) {
        var xhr = new XMLHttpRequest(),
            page = page ? page : 1;
            api = {
                line : 'http://joo25.loc/lines',
                teil : 'http://joo25.loc/teils'
            };
            
        page = '?page=' + page;
        
        xhr.open('GET', api[table] + page, false);
        xhr.send();

        if( 200 === xhr.status ) {
            let res = JSON.parse(xhr.responseText),
                next = xhr.getResponseHeader("x-pagination-page-count") !==
                xhr.getResponseHeader("x-pagination-current-page");

            return [
                res,
                next
            ];
        } else {
            //console.log( xhr.status );
            return [
                [],
                -1
            ];
        }
    };
    
    Box.prototype.setData = function(){
        let page = 1,
            data = null;
        do {
            data = this.getData('line', page);
            this.lines = this.lines.concat(data[0]);
            page++;
        } while ( data[1] && -1 !== data[1] );
        
        page = 1,
        data = null;

        do {
            data = this.getData('teil', page);
            this.teils = this.teils.concat(data[0]);
            page++;
        } while ( data[1] && -1 !== data[1] );
        
    };
    
    box.setData();
    
//    var lines = box.getData('line')[0];
//    var teils = box.getData('teil')[0];
    var lines = box.lines;
    var teils = box.teils;
    
    lines.forEach(function(item) {
        let line = [ 
            this.Ox + item.lineFrom.x * (this.l + this.padding),
            this.Oy + item.lineFrom.y * (this.h + this.padding),
            this.Ox + item.lineTo.x * (this.l + this.padding),
            this.Oy + item.lineTo.y * (this.h + this.padding)
        ],
        color = this.lineColors[ ( item.answer ) ? item.answer : 0 ];
        
        canvas
            .line(line)
            .stroke({
                color: color,
                width: 20,
                linecap: 'round'
            })
            .attr({
                'data-mark': item.line_id + ' | ' + item.answer
            });
    }, box);
    
    teils.forEach(function(item){
        var point = [
            this.Ox + item.x * (this.l + this.padding),
            this.Oy + item.y * (this.h + this.padding)
        ], f = null;
        
        if ( !item.fill ) {
            item.fill = this.default.fill;
        }
        
        if ( item.image !== null ) {
            // image teil
            point[0] -= this.l/2;
            point[1] -= this.h/2;
            
            let size = [this.l, this.h];
            f = canvas
                .image('/img/' + item.image)
                .loaded(function(loader) {
                    let dx = 0;
                    dx = Math.ceil( (1 - loader.ratio ) * size[0] / 2 );
                    
                    this.size(size[0]* loader.ratio, size[1] );
                    this.move(point[0] + dx, point[1]);
                });
            //f.move(point[0], point[1]);
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
                    size: 150,
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
