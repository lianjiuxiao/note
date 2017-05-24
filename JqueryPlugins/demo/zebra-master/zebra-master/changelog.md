**03.2015 (Anna)**

   * New UI component tree. Add UI components directly as tree nodes  
   * Grid cell marker mode support
   * Own zebra custom virtual keyboard implementation 
   * Remove "zebra.ui.Composite" interface, use "catchInput" field as boolean flag to say if component composite or as a method to say it dynamically
   * Remove zebra.ui.CopyCutPaste interface. Use "clipCopy", "clipPaste" method to catch clipboard events
   * Reorganized tree component
   * Tabs setOrientation method added
   * Singleton classes
   * Text field performance of cursor position detection has been improved 
   * OOP Singleton classes support
   * Use nodejs/gulp to as deployment tool
   * Fixes and improvements
   * Matrix model has been extended with rows and columns insertion methods 
   * package objects and classes can be defined with a special "package" method
   * remove possibility to composite UI JSON configuration 
   * remove %root% variable from JSON BAG, use relative to loaded JSON path or absolute path  
   * zebra sources has been moved from "lib/zebra" to "src"
   * json bag utility class has been updated:
      - Use classAliases property to define short names for classes
      - Use variables property to define variables
      - Variables can be classes and structure
      - loadByUrl has been removed, use in all cases "load" method instead
      - load can be run asynchronously 
   * new "zebra.Runner" class has been added. It provides graceful way to represent sync and async code as sequence of tasks
   * virtual keyboard hindi layout has been added
   * Matrix model has been re-worked to be less resource consuming 
   * For the really big number for that can be used as a component coordinates (for instance large grid) a fix of 2S Context precision issue can be used by including 'src/fix2d.precision.js' script
   * TextField component supports right alignment 
   *  zebra.package(...) method has been used as more graceful and safe method of an own package definition.
   *  UI components can handle mouse scroll (wheel) events by implementing "doScroll(dx, dy, source)" method.
   
**4.2014 (Luda)**

   * Reduce number of zebra artifact required to host zebra on a user side. To host zebra only three artifacts are required:
       - zebra.min.js
       - zebra.png (UI elements set)
       - zebra.json (configuration)
   * Completely re-worked popup menu component. Menu events can be handled globally by registering a listener in popup manager
   * Simplified input events handling. An UI component should not anymore implements appropriate input listener interface, just add appropriate method to handle required event
   * Polished zebra.ui.Extender component
   * Polished zebra.ui.Toolbar component
   * New component grid caption component is provided. The component allows developer to to use any UI component as a title of a grid column. 
   * Support sortable grid columns
   * Component based grid caption is supported
   * Grid columns data sorting is available out of box 
   * Polished and re-designed grid editor provider
   * Tabs border rendering is much more accurate and well done
   * Tabs icon and title control is much more simple
   * Radiobox component rendering is done more accurate
   * More accurate HTML Element as a zebra UI component integration
   * Faster and simpler StringRender is implemented 
   * List components are review-ed and partially re-implemented 
   * Better support of mobile devices
   * Simpler popup menus and tooltip support
   * Smother painting when a browser window is resized
   * Bloody IE10/11 canvas clipping and filling bugs workarounds 
   * More detailed API docs  
   * Load JSON from JSON what allows developers to split it in logical parts 
   * More smooth rendering control (with request animation frame whenever it is possible)   
   * Tooltip manager has been merged with popup manager
   * Better test cases coverage 
   * +1000 other changes and bug fixes

** 8.2013 (Gleb) Zebra documentation is available !**

   * Zebra start supporting mobile !
   * Tutorial is written published on WEB site
   * API doc is written and published on WEB site  
   * +100 fixes and small changes


### Contact

   * WEB     : http://www.zebkit.org
   * e-mail  : ask@zebkit.org 
   * linkedin: http://nl.linkedin.com/pub/andrei-vishneuski/14/525/34b/