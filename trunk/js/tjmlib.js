// overly simplistic test for IE
isIE = (document.all ? true : false);
// both IE5 and NS6 are DOM-compliant
isDOM = (document.getElementById ? true : false);

// get the true offset of anything on NS4, IE4/5 & NS6, even if it's in a table!
function getAbsX(elt) { return (elt.x) ? elt.x : getAbsPos(elt,"Left"); }
function getAbsY(elt) { return (elt.y) ? elt.y : getAbsPos(elt,"Top"); }
function getAbsPos(elt,which) {
 iPos = 0;
 while (elt != null) {
  iPos += elt["offset" + which];
  elt = elt.offsetParent;
 }
 return iPos;
}

function getDivStyle(divname) {
 var style;
 if (isDOM) { style = document.getElementById(divname).style; }
 else { style = isIE ? document.all[divname].style
                     : document.layers[divname]; } // NS4
 return style;
}

function hideElement(divname) {
 getDivStyle(divname).visibility = 'hidden';
}

// annoying detail: IE and NS6 store elt.top and elt.left as strings.
function moveBy(elt,deltaX,deltaY) {
 elt.left = parseInt(elt.left) + deltaX;
 elt.top = parseInt(elt.top) + deltaY;
}

function toggleVisible(divname) {
 divstyle = getDivStyle(divname);
 if (divstyle.visibility == 'visible' || divstyle.visibility == 'show') {
   divstyle.visibility = 'hidden';
   return false;
 } else {
   divstyle.visibility = 'visible';
   return true;
 }
}

function setPosition(elt,positionername,isPlacedUnder) {
 var positioner;
 if (isIE) {
  positioner = document.all[positionername];
 } else {
  if (isDOM) {
    positioner = document.getElementById(positionername);
  } else {
    // not IE, not DOM (probably NS4)
    // if the positioner is inside a netscape4 layer this will *not* find it.
    // I should write a finder function which will recurse through all layers
    // until it finds the named image...
    positioner = document.images[positionername];
  }
 }
 elt.left = getAbsX(positioner);
 elt.top = getAbsY(positioner) + (isPlacedUnder ? positioner.height : 0);
}

function numpad(number) { return (number < 10) ? '0' + number : number; }