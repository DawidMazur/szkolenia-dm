"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function _defineProperties(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function _createClass(e,t,r){return t&&_defineProperties(e.prototype,t),r&&_defineProperties(e,r),Object.defineProperty(e,"prototype",{writable:!1}),e}var PCCookies=function(){function e(){_classCallCheck(this,e)}return _createClass(e,null,[{key:"setCookie",value:function(e,t){var r=2<arguments.length&&void 0!==arguments[2]?arguments[2]:365,n=new Date,r=(n.setTime(n.getTime()+24*r*60*60*1e3),"expires="+n.toUTCString());document.cookie=e+"="+t+";"+r+";path=/"}},{key:"getCookie",value:function(e){for(var t=e+"=",r=decodeURIComponent(document.cookie).split(";"),n=0;n<r.length;n++){for(var i=r[n];" "==i.charAt(0);)i=i.substring(1);if(0==i.indexOf(t))return i.substring(t.length,i.length)}return""}}]),e}(),parallax=document.querySelectorAll("[data-parallax]"),rellax=(0<parallax.length&&parallax.forEach(function(e){new Parallax(e)}),new Rellax(".rellax"));function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function _defineProperties(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function _createClass(e,t,r){return t&&_defineProperties(e.prototype,t),r&&_defineProperties(e,r),Object.defineProperty(e,"prototype",{writable:!1}),e}var ViewerJs=function(){function t(){var e=!(0<arguments.length&&void 0!==arguments[0])||arguments[0];_classCallCheck(this,t),e&&this.reinit()}return _createClass(t,[{key:"search",value:function(){this.objs=document.querySelectorAll("[data-js-viewer-js]")}},{key:"reinit",value:function(){this.search(),this.init()}},{key:"init",value:function(){return"function"!=typeof Viewer?(console.error("Nie znaleziono klasy ViewerJS"),!1):(this.objs&&this.objs.forEach(function(t){new Viewer(t,{navbar:!0,filter:function(e){return!t.dataset.viewerFilter||!!e.dataset.viewer}})}),!0)}}]),t}(),viewerJS=new ViewerJs;