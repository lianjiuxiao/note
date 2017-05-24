
(function(pkg, Class) {

eval(zebra.Import("ui", "layout", "util"));

pkg.borderColor = "#FFFFFF";
pkg.borderSize = 6;

pkg.Shape = Class(View, [
    function(){
        this.$this("white");
    },

    function(c){
        this.color = c;
        this.lineWidth = pkg.borderSize;
    },

    function paint(g,x,y,w,h,d){
        this.outline(g,x,y,w,h,d);
        var prev = g.lineWidth;
        g.lineWidth = this.lineWidth;
        g.setColor(this.color);
        g.stroke();
        g.lineWidth = prev;
    }
]);

pkg.Triangle =  Class(pkg.Shape, [
    function outline(g,x,y,w,h,d) {
        g.beginPath();
        g.lineWidth = this.lineWidth;
        x += this.lineWidth;
        y += this.lineWidth;
        w -= 2*this.lineWidth;
        h -= 2*this.lineWidth;

        g.moveTo(x + w/2 - 1, y);
        g.lineTo(x + w - 1, y + h - 1);
        g.lineTo(x, y + h - 1);
        g.lineTo(x + w/2 + 1, y);
        return true;
    }
]);

pkg.Oval = Class(pkg.Shape, [
    function outline(g,x,y,w,h,d) {
        g.beginPath();
        g.lineWidth = this.lineWidth;
        g.ovalPath(0, 0, w, h);
        return true;
    }
]);

pkg.Pentahedron =  Class(pkg.Shape, [
    function outline(g,x,y,w,h,d) {
        g.beginPath();
        g.lineWidth = this.lineWidth;
        x += this.lineWidth;
        y += this.lineWidth;
        w -= 2*this.lineWidth;
        h -= 2*this.lineWidth;
        g.moveTo(x + w/2, y);
        g.lineTo(x + w - 1, y + h/3);
        g.lineTo(x + w - 1 - w/3, y + h - 1);
        g.lineTo(x + w/3, y + h - 1);
        g.lineTo(x, y + h/3);
        g.lineTo(x + w/2, y);
        return true;
    }
]);

pkg.EditablePan = Class(Panel, [
    function() {
        this.$this("white");
    },

    function(color) {
        this.color = color;
        this.showCursor = false;
        this.ch = '';
        this.font = new Font("Arial", "bold", 32);
        this.$super();
    },

    function paint(g) {
        var l = this.ch !== '' ? this.font.stringWidth(this.ch) : 0;
        if (this.hasFocus() && this.showCursor) {
            g.setColor("red");
            g.fillRect(this.width/2 + l/2, (this.height-this.font.height)/2, 4, this.font.height);
        }

        g.setFont(this.font);
        g.setColor(this.color);
        g.fillText(this.ch, this.width/2 - l/2, (this.height-this.font.height)/2);
    },

    function keyTyped(e) {
        this.ch = e.ch;
        this.repaint();
    },

    function focusGained(e) {
        this.pcolor = this.border.color;
        this.border.color = "red";
        this.task = task(this).run(50, 500);
        this.repaint();
    },

    function focusLost(e) {
        this.border.color = this.pcolor;
        if (this.task != null) { 
            this.task.shutdown();
            this.task = null;
        }
        this.repaint();
    },

    function run(t) {
        this.showCursor = !this.showCursor;
        this.repaint();
    },

    function canHaveFocus() {
        return true;
    }
]);

pkg.MouseEventHandlerPan = Class(Panel, [
    function() {
        this.gx = this.gy = 0;
        this.font = new Font("Helvetica", "bold", 12);
        this.color1 = '#C7D3FC';
        this.color2 = '#316F92';
        this.$super();
    },

    function mouseMoved(e) {
        this.gx = e.x;
        this.gy = e.y;
        this.repaint();
    },

    function mousePressed(e) {
        this.color1 = '#F7F3FC';
        this.color2 = '#417F92';
        this.repaint();
    },

    function mouseReleased(e) {
        this.color1 = '#C7D3FC';
        this.color2 = '#316F92';
        this.repaint();
    },

    function paint(g) {
        if (this.gx === 0) this.gx = this.width/2;
        if (this.gy === 0) this.gy = this.height/2;
        var rg = g.createRadialGradient(this.width/2, this.height/2, 0,
                                        this.gx, this.gy, this.width/1.5);
        rg.addColorStop(0, this.color1);
        rg.addColorStop(1, this.color2);
        g.fillStyle = rg;
        g.fillRect(0, 0, this.width, this.height);

        g.setColor("black");
        g.setFont(this.font);
        g.fillText("(" + ~~this.gx + "," + ~~this.gy + ")", this.gx + 10, this.gy);
    }
]);

pkg.CursorPan = Class(Panel, [
    function(cursor, bg, picture) {
        this.$super();
        this.setPreferredSize(50,50);
        this.setBackground(bg);
        this.picture = picture;
        this.cursorType = cursor;
    },

    function paint(g) {
        var ps = this.picture.getPreferredSize();
        this.picture.paint(g, (this.width - ps.width)/2, (this.height - ps.height)/2, ps.width, ps.height, this);
    }
]);
    
pkg.Components = Class(Panel, [
    function () {
        function makePanel(brColor, txtCol, txt, constr) {
            if (zebra.isString(txtCol)) {
                constr = txt;
                txt = txtCol;
                txtCol = brColor;
            }

            return (new Panel([
                        function paint(g) {
                            var font = new Font("Arial", "bold", 16);
                            
                            g.setColor(txtCol);
                            g.setFont(font);

                            var x = (this.width - font.stringWidth(txt))/2,
                                y = (this.height - font.height)/2;

                            g.fillText(txt, x, y);
                        }
                    ])).properties({
                            border      : new Border(brColor, 4, 6),
                            preferredSize: [35, 35],
                            constraints  : constr
                    });
        }

        this.$super();

        var constr = new Constraints(), col = "#DDEEEE", constr2 = new Constraints();
        constr.setPadding(4);
        constr2.setPadding(4);
        constr2.ax = LEFT ;
        constr2.ay = TOP;

        this.properties({
            layout: new BorderLayout(6,6),
            kids  : {
                TOP   : makePanel(rgb.gray, rgb.white, "TOP"),
                CENTER: makePanel(rgb.gray, rgb.white, "").properties({
                    layout : new FlowLayout(CENTER, CENTER),
                    kids: [ new Panel().properties({
                        layout : new ListLayout(STRETCH, 2),
                        padding: 4,
                        kids   : [
                            makePanel(rgb.black, rgb.black, "Item 1"),
                            makePanel(rgb.black, rgb.black, "Item 2"),
                            makePanel(rgb.black, rgb.black, "").properties({
                                layout: new GridLayout(2, 3),
                                preferredSize:[-1,-1],
                                padding:4,
                                kids  : [
                                    makePanel(col, "1", constr2),
                                    makePanel(col, "2", constr).properties({ preferredSize: [70, 40] }),
                                    makePanel(col, "3", constr).properties({ preferredSize: [20, 70] }),
                                    makePanel(col, "4", constr2),
                                    makePanel(col, "5", constr),
                                    makePanel(col, "6", constr2)
                                ]
                            })
                        ]
                    })]
                }),
                LEFT  :  makePanel(rgb.gray, rgb.white, "L"),
                RIGHT :  makePanel(rgb.gray, rgb.white, "R"),
                BOTTOM:  makePanel(rgb.gray, rgb.white, "BOTTOM")
            }
        });
    },

    function childInputEvent(e){
        if (e.ID == MouseEvent.ENTERED) {
            this.counter = 0;
            this.target = e.source;
            this.task = task(this).run(50, 90);
        }
        else {
            if (e.ID == MouseEvent.EXITED) {
                if (this.task != null) {
                    this.task.shutdown();
                    this.task = null;
                }
                e.source.setBackground(null);
            }
        }
    },

    function run(t) {
        this.counter++;
        if (this.counter > 3) t.shutdown();
        this.target.setBackground(new rgb(200, 20, 80, 0.3*this.counter));
    }
]);

pkg.CirclePan = Class(Panel, [
    function(r) {
        this.$super();
        this.setPreferredSize(2*r, 2*r);
        this.setBorder(new pkg.Oval("red"));
    },

    function contains(x, y) {
        var rx = ~~(this.width/2), ry = ~~(this.height/2);
        return (ry - y) * (ry - y) + (rx - x) * (rx - x) < rx * rx;
    },

    function mouseEntered(e) {
        this.setBackground("rgba(100,222,80,0.4)");
    },

    function mouseExited(e) {
        this.setBackground(null);
    }
]);

pkg.TrianglePan = Class(Panel, [
    function() {
        this.$super();
        this.setBorder(new pkg.Triangle("orange"));
        this.setPreferredSize(200, 200);
    },

    function contains(x, y) {
        var ax = ~~(this.width/2), ay = 0,
            bx = this.width - 1, by = this.height - 1,
            cx = 0, cy = this.height - 1,
            ab = (ax - x)*(by- y)-(bx-x)*(ay-y);
            bc = (bx-x)*(cy-y)-(cx - x)*(by-y);
            ca = (cx-x)*(ay-y)-(ax - x)*(cy-y);
        return ab > 0 && bc > 0 && ca > 0;
    },

    function mouseEntered(e) {
        this.setBackground("rgba(220,80,80, 0.4)");
    },

    function mouseExited(e) {
        this.setBackground(null);
    }
]);

pkg.SimpleChart = Class(Panel, [
    function(f, x1, x2, dx, col) {
        this.f = f;
        this.x1 = x1;
        this.x2 = x2;
        this.dx = dx;
        this.color = col;
        this.lineWidth = 4;
        this.$super();
        this.setPadding(8);
    },

    function validate() {
        var b = this.isLayoutValid;
        this.$super();
        if (b) return;

        var maxy = -1000000, miny = 1000000, fy = [];
        for(var x = this.x1, i = 0; x < this.x2; x += this.dx, i++) {
            fy[i] = this.f(x);
            if (fy[i] > maxy) maxy = fy[i];
            if (fy[i] < miny) miny = fy[i];
        }

        var left = this.getLeft() + this.lineWidth, top = this.getTop() + this.lineWidth,
            ww = this.width  - left - this.getRight()  - this.lineWidth*2,
            hh = this.height - top  - this.getBottom() - this.lineWidth*2,
            cx  = ww/(this.x2 - this.x1), cy = hh/ (maxy - miny);

        var t = function (xy, ct) {
            return ct * xy;
        };

        this.gx = [ left ];
        this.gy = [ top + t(fy[0] - miny, cy) ];
        for(var x = this.x1 + this.dx, i = 1; i < fy.length; x += this.dx, i++) {
            this.gx[i] = left + t(x - this.x1, cx);
            this.gy[i] = top  + t(fy[i] - miny, cy);
        }
    },

    function isInside(x, y) {
        for(var i = 0; i < this.gx.length; i++) {
            var rx = this.gx[i], ry = this.gy[i];
            if ((ry - y) * (ry - y) + (rx - x) * (rx - x) < 4 * this.lineWidth * this.lineWidth) {
                return i;
            }
        }
        return -1;
    },

    function setHighlight(b) {
        this.highlight = b;
        this.repaint();
    },

    function paint(g) {
        g.beginPath();
        g.setColor(this.color);
        var prev = g.lineWidth;
        g.lineWidth = this.lineWidth;
        g.moveTo(this.gx[0], this.gy[0]);
        for(var i = 1; i < this.gx.length; i++) {
            g.lineTo(this.gx[i], this.gy[i]);
        }
        g.stroke();

        if (this.highlight) {
            g.lineWidth = this.lineWidth*3;
            g.beginPath();
            g.setColor("rgba(255,10,10, 0.3)");
            g.moveTo(this.gx[0], this.gy[0]);
            for(var i = 1; i < this.gx.length; i++) {
                g.lineTo(this.gx[i], this.gy[i]);
            }
            g.stroke();
        }

        g.lineWidth = prev;
    }
]);

pkg.CustomLayer = Class(BaseLayer, [
    function() {
        this.$super("CUSTOM");
        this.setLayout(new StackLayout());
    
        var $this = this, font = new Font("Arial", "bold", 24);
        this.add(USE_PS_SIZE, new Panel([
            function paint(g) {
                if ($this.bg != null) {
                    var s = "ALT-D to enable", l = font.stringWidth(s);
                    g.setColor("white");
                    g.setFont(font);
                    g.fillText(s, this.width / 2 - l / 2, (this.height - font.height)/2);
                }
            }
        ])).properties({
            preferredSize: [240, 100],
            border       : new Border(null, 4, 8)
        });

        this.font = new Font("Arial", "bold", 22);
    },

    function $prototype() {
        this.isLayerActiveAt = function(x, y) {
            return this.bg != null;
        };

        this.layerKeyPressed = function(code, m){
            if (code == 68 && (m & KeyEvent.M_ALT) > 0) {
                if (this.bg == null ) this.setBackground("rgba(255, 255, 255, 0.5)");
                else                  this.setBackground(null);
                this.activate(this.bg != null);
                this.kids[0].setBackground(this.bg ? "rgba(180,180,180, 0.9)" : null);
            }
            return this.bg != null;
        };

        this.paint = function(g) {
            if (this.bg == null) {
                var s = "ALT-D to disable", l = this.font.stringWidth(s);
                g.setColor("white");
                g.setFont(this.font);
                g.fillText(s, this.width/2 - l/2, (this.height - this.font.height - 10));
            }
        };
    }
]);


})(zebra("ui.samples"), zebra.Class);