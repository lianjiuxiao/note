
![ScreenShot](/samples/images/header.jpg)

v11.2014 (Anna)

## For impatient: look at few demos   

   * Zebra rich set of UI components: http://repo.zebkit.org/latest/samples/uidemo.html
   * Zebra UI engine simple samples: http://repo.zebkit.org/latest/samples/uiengine.html
   * Zebra UI documentation http://www.zebkit.org/documentation

## What is Zebra ?

Zebra is a JavaScript library that implements a graceful and easy to use OOP concept together with a rich set of UI components, decoupled UI engine, IO and other packages. UI are fully based on the HTML5 Canvas element. This approach differs from traditional WEB UI, where user interface is built around HTML DOM and then "colored" with CSS.

### Features

   *  Zebra's easy OOP concept JavaScript: classes, interfaces, overriding, overloading, constructors, packaging, anonymous class, access to super class methods, mixing, etc
   *  **Zebra UI Engine can be used as powerful basis for:**
      * Pixel by pixel UI components rendering controlling
      * Simple and flexible events (keyboard, mouse, etc) manipulation, advanced event technique to develop composite UI components
      * Laying out UI components using a number of predefined layout managers
      * Easy developing of own layout managers
      * Full control of UI components rendering
      * **Play video in Zebra UI panel**
      * **Flash-free, pure web native clipboard paste and copy support**
      * **Font metrics calculation**
      * Layered UI architecture
      * and many more ...
   *  Zebra's rich UI Components set is developed based on the Zebra UI Engine:
      * More than 40 various UI components
      * Look and feel customization
      * Complex UI components: Grid, Tree, Tabs, Combo, Designer, Scroll, Menu, etc
      * Thanks to easy OOP concept and proper design: expandable and fully customizable UI components
      * **Simple data model description**
      * **HTML DOM as part of Zebra UI**
      * and many more ...
   *  **JSON as Zebra UI form descriptive language**
   *  **JSON as Zebra UI look and feel configuration**
   *  **Zebra IO**   
      *  GET/POST/etc Ajax requests  
      *  XML-RPC, JSON-RPC Service communication
      *  binary data handling
   * **Mobile devices support**
      * **Touch screen support**
      * **Inertial scrolling**
      * **Virtual keyboard input**


### Build and run zebra demos

To build zebra artifacts and run zebra samples you have to install nodejs (http://nodejs.org/) on your PC. Then go to zebra home directory and deploy required node JS packages:

```bash
    $ npm install
```

Then re-build zebra artifacts:
```bash
    $ gulp
```

And if you want to open demos and samples on your computer in a browser start the simple test HTTP server:
```bash
    $ gulp http
```

To track changes and zebra artifact re-building you should start the watch task:
```bash
    $ gulp watch
```

To generate api doc install yuidoc once:
```bash
   $ [sudo] npm -g install yuidocjs.
```
and then run the following command from zebra home:
```bash
   $ yuidoc -t yuidoc/themes/default -c yuidoc/yuidoc.json -n -C -o apidoc .
```


Open demos in a browser: http://127.0.0.1:8090/

### Zebra package structure:

      ```bash
      zebra-home
        |
        +--- [src]        # zebra source code
        +--- [apidoc]     # the latest zebra API documentation
        +--- [samples]    # various zebra snippets and general UI set demo
        +--- gulpfile.js  # zebra building and deploying tasks
        +--- package.json # nodejs package descriptor
        +--- index.html   # index WEB page to see main samples and demos
        +--- zebra.png         # zebra (Runtime) UI elements icons
        +--- zebra.json        # zebra (Runtime) JSON configuration
        +--- zebra.js          # Zebra (Runtime) JS code
        +--- zebra.min.js      # minified (Runtime) Zebra JS code
        +--- zebra.runtime.zip # zipped all you need in runtime
      ```

**Use artifacts packaged in "zebra.runtime.zip" file if you need to keep zebra on your web site. Unpack it in your web folder and include "zebra.min.js" in your HTML page.**

### Simple UI Zebra application

To write the first application **no zebra stuff on your PC has to be downloaded and deployed (you need only this readme file :).** Let's start writing simple Zebra HTML following traditional style:

```html
<!DOCTYPE html>
<html>
	<head>
		<script src='http://repo.zebkit.org/latest/zebra.min.js'
                type='text/javascript'></script>
		<script type='text/javascript'>
		    zebra.ready(function() {
				// import classes and variables from "ui" and "layout" packages in local space
				eval(zebra.Import("ui", "layout"));
				// create Canvas
			    var root = (new zCanvas()).root;
				// define layout
				root.setLayout(new BorderLayout());
				// add button to center
				root.add(CENTER, new Button("Ok"));
				...
	 		});
		</script>
	</head>
	<body></body>
</html>
```

We can write the application following more graceful manner using JSON-like style:

```html
<!DOCTYPE html>
<html>
	<head>
		<script src='http://repo.zebkit.org/latest/zebra.min.js'
                type='text/javascript'></script>
		<script type='text/javascript'>
		    zebra.ready(function() {
				// import classes and variables from "ui" and "layout" packages in local space
				eval(zebra.Import("ui", "layout"));
				// create Canvas using JSON like style
			    (new zCanvas()).root.properties({
			    	layout: new BorderLayout(),
			    	kids  : {
			    		CENTER: new TextField("", true),
			    		TOP   : (new BoldLabel("Sample application")).properties({
			    			padding : 8
			    		}),
			    		BOTTOM: new Button("Ok")
			    	}
			    });
			}); 
		</script>
	</head>
	<body></body>
</html>
```

### Keeping UI forms in JSON

JSON can be interpreted as Zebra UI form definition language. For instance, use UI definition shown below and store it in "myform.json" file located in the same place where HTML is hosted:
```json
{
	"padding": 8, 
	"layout" : { "$zebra.layout.BorderLayout":[ 4] },
	"kids"   : {
		"CENTER": { "$zebra.ui.TextField": ["", true]  },
		"BOTTOM": { "$zebra.ui.Panel": [],
			"layout": { "$zebra.layout.FlowLayout": [] },
			"kids"  : [
				{ "$zebra.ui.Button": "Clear" } 
			]  
		}
	}
}
```

Load the JSON UI form definition as it is illustrated below:
```html
<!DOCTYPE html>
<html>
	<head>
		<script src='http://repo.zebkit.org/latest/zebra.min.js'
                type='text/javascript'></script>
		<script type='text/javascript'>
		    zebra.ready(function() {
				// load UI form from JSON file
			    var root = (new zebra.ui.zCanvas()).root;
			    root.load("myform.json");
			    // find by class "Button" component and register button
			    // event handler to clear text field content by button click
			    root.find("//zebra.ui.Button").bind(function() {
				    root.find("//zebra.ui.TextField").setValue("");
				});	    
			});
		</script>
	</head>
	<body></body>
</html>
```


### Native clipboard support

Zebra supports native browser clipboard. The implementation doesn't require any Flash or other plug-in installed. It is pure WEB based solution !

By implementing special methods __"clipCopy()"__  and/or __"clipPaste(s)"__ a focusable UI component can start participating in clipboard data exchange. For instance:

```html
<!DOCTYPE html>
<html>
	<head>		
		<script src='http://repo.zebkit.org/latest/zebra.min.js'
                type='text/javascript'></script>
		<script type='text/javascript'>
			zebra.ready(function() {
				eval(zebra.Import("ui", "layout"));
				// define our own UI component class that wants to handle 
                // clipboard events
				var MyComponent = zebra.Class(MLabel, [
				    // override "canHaveFocus" method to make your component
                    // focusable
				    function canHaveFocus() { return true; },

				    // returns what you want to put in clipboard
				    function clipCopy() {
				    	this.setColor("#FF3311");
				    	return this.getValue();
				    },

				    // this method is called when paste event has 
                    // happened for this component 
				    function clipPaste(s) { 
				    	this.setColor("#000000");
				    	this.setValue(s); 
				    },

				    // use border as an indication the component has focus
				    function focused() {
				    	this.$super() // call super
				    	this.setBorder(this.hasFocus() ? new Border("red",2,3) : borders.plain);
				    }
				]); 
				// create UI application with our clipboard handler UI
                // component
				(new zCanvas()).root.properties({
					background: "#EEEEEE",
					layout: new BorderLayout(8,8), 
                    padding: 8,
					kids  : {
						TOP   : new BoldLabel("Copy/Paste in box below"),
						CENTER: new MyComponent("Copy me in clipboard").properties({border:borders.plain, padding:8})
					}
				});
			});
		</script>
	</head>
	<body></body>
</html>
```

### UI look and feel customization

Default values of UI components properties can be controlled by JSON configuration. You can define your own JSON configuration to override default Zebra configurations (that is stored in "zebra.json"). For instance, imagine we need to define new background and font for __"zebra.ui.Button"__ component. It can be done by providing the following JSON configuration file:

```json
{
	"Button" : {
        "font"      : { "$Font": ["Arial", "bold", 18 ] },
        "background": "#DDDDEF"
    }
}
```

As soon as the file is added in the configuration chain, every new Button instance will get the new font and background properties' values.


### IO API: HTTP POST/GET, JSON-RPC or XML-RPC

The module provides handy manner to interact with remote services.

#### POST and GET requests:

```js
// get, post data
var gdata = zebra.io.GET(url),
	pdata = zebra.io.POST(url, "request");
// async GET/POST
zebra.io.GET(url, function(request) {
    if (request.status == 200) {
    	// handle result
    	request.responseText	
	}
	else {
		// handle error
	}
    ...
})
```

####  Interact to remote XML-RPC server:

```js
// XML-RPC server
var s = new zebra.io.XRPC(url, [ "method1", "method2", "method3" ]);
// call remote methods
s.method1(p1, p2);
var res = s.method2(p2);
// async remote method call
s.method1(p1, p2, function(res) {
    ...
});
```

####  Interact to remote JSON-RPC server

```js
// JSON-RPC server
var s = new zebra.io.JRPC(url, [ "method1", "method2", "method3" ]);
// call remote methods
s.method1(p1, p2);
var res = s.method2(p2);
// async remote method call
s.method1(p1, p2, function(res) {
    ...
});
```

#### Shortcuts to call remote services:

```js
// JSON-RPC remote method execution
var res = zebra.io.JRPC.invoke(url, "method1")(param1, param2);
// Async JSON-RPC remote method execution
zebra.io.JRPC.invoke(url, "method1")(param1, param2, function(res) {
  ....
});
```

### License

Apache License, Version 2.0
http://www.apache.org/licenses/LICENSE-2.0.html

### Contact

   * WEB     : http://www.zebkit.org
   * e-mail  : ask@zebkit.org
   * linkedin: http://nl.linkedin.com/pub/andrei-vishneuski/14/525/34b/
