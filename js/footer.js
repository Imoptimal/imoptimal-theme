/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-csspointerevents-setclasses !*/
!function(e,n,s){function t(e,n){return typeof e===n}function o(){var e,n,s,o,a,i,f;for(var c in l)if(l.hasOwnProperty(c)){if(e=[],n=l[c],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(s=0;s<n.options.aliases.length;s++)e.push(n.options.aliases[s].toLowerCase());for(o=t(n.fn,"function")?n.fn():n.fn,a=0;a<e.length;a++)i=e[a],f=i.split("."),1===f.length?Modernizr[f[0]]=o:(!Modernizr[f[0]]||Modernizr[f[0]]instanceof Boolean||(Modernizr[f[0]]=new Boolean(Modernizr[f[0]])),Modernizr[f[0]][f[1]]=o),r.push((o?"":"no-")+f.join("-"))}}function a(e){var n=c.className,s=Modernizr._config.classPrefix||"";if(u&&(n=n.baseVal),Modernizr._config.enableJSClass){var t=new RegExp("(^|\\s)"+s+"no-js(\\s|$)");n=n.replace(t,"$1"+s+"js$2")}Modernizr._config.enableClasses&&(n+=" "+s+e.join(" "+s),u?c.className.baseVal=n:c.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):u?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}var r=[],l=[],f={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var s=this;setTimeout(function(){n(s[e])},0)},addTest:function(e,n,s){l.push({name:e,fn:n,options:s})},addAsyncTest:function(e){l.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=f,Modernizr=new Modernizr;var c=n.documentElement,u="svg"===c.nodeName.toLowerCase();Modernizr.addTest("csspointerevents",function(){var e=i("a").style;return e.cssText="pointer-events:auto","auto"===e.pointerEvents}),o(),a(r),delete f.addTest,delete f.addAsyncTest;for(var p=0;p<Modernizr._q.length;p++)Modernizr._q[p]();e.Modernizr=Modernizr}(window,document);

//Prevent images to be right clicked or dragable
jQuery(function() {

    if (Modernizr.csspointerevents) {	// supported

        jQuery('img').css({
            'pointer-events': 'auto'
        });

        function prevent() {
            // this part disables the right click
            jQuery('img').on('contextmenu', function(e) {
                return false;
            });
            //this part disables dragging of image
            jQuery('img').on('dragstart', function(e) {
                return false;
            });

        }
        prevent();

    } else {	// not-supported

        function prevent() {
            // this part disables the right click
            jQuery('img').on('contextmenu', function(e) {
                return false;
            });
            //this part disables dragging of image
            jQuery('img').on('dragstart', function(e) {
                return false;
            });

        }
        prevent();
    }
});

// Fix skip-link focus in IE11
jQuery(function() {
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);   
});

// Dropdown menu
jQuery(function($) {
    var handle = $('.imothm-container .site-header .dropdown-menu .handle');
    var toggler = $('.imothm-container .site-header .dropdown-menu .toggle-menu');
    var headerMenu = $('.imothm-container .site-header .dropdown-menu .header-menu');
    var skipLink = $('.imothm-container .skip-link');
    $(headerMenu).prepend('<a class="close-menu" href="#"></a>');
    $(headerMenu).append('<a class="auto-close" href="#"></a>');
    var closeButton = $('.imothm-container .site-header .dropdown-menu .close-menu');
    var autoClose = $('.imothm-container .site-header .dropdown-menu .auto-close');
    // Enable menu to remain open with keyboard tab through menu
    handle.on('focus', function() {
        if (headerMenu.hasClass('slided')) {
            headerMenu.removeClass('slided');
            toggler.removeClass('clicked');
        } else {
            headerMenu.addClass('slided');
            toggler.addClass('clicked');
        }
    });
    // Close on last tab trough dropdown menu
    $(autoClose).on('keyup', function(e) { 
        if (e.key === 'Tab' || e.key === 'Space' || e.key === 'Enter') {
            e.preventDefault();
            if (headerMenu.hasClass('slided')) {
                headerMenu.toggleClass('slided');
                toggler.removeClass('clicked');
            }
        }
    });
    // Close on shift+tab on skip-link
    $(skipLink).on('keyup', function(e) { 
        if (e.shiftKey && e.key === 'Tab') {
            e.preventDefault();
            if (headerMenu.hasClass('slided')) {
                headerMenu.toggleClass('slided');
                toggler.removeClass('clicked');
            }
        }
    });
    // Close menu on esc button
    $(document).on( 'keydown', function( e ) {
        if ( e.keyCode === 27 ) {
            e.preventDefault();
            if (headerMenu.hasClass('slided')) {
                headerMenu.toggleClass('slided');
                toggler.removeClass('clicked');
            }
        }
    });
    // Open/close on toggle-menu click
    $(toggler).on('click', function() {
        if ($(this).hasClass('clicked')) {
            $(this).removeClass('clicked');
        } else {
            $(this).addClass('clicked');
        }
        headerMenu.toggleClass('slided');
        return false;
    });
    // Close on close button click
    $(closeButton).on('click', function() {
        toggler.removeClass('clicked');
        headerMenu.removeClass('slided');
        return false;
    });
    // Close on any other item click
    $(document).on('click', function(event) {	
        if (headerMenu.hasClass('slided') && $(event.target).closest(headerMenu).length == 0) {
            headerMenu.toggleClass('slided');
            toggler.removeClass('clicked');  
        }
    });
    
});
