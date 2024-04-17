
(function($) {
  $.fn.magnify = function(oOptions) {
    // Default options
    oOptions = $.extend({
      'src': '',
      'speed': 100,
      'timeout': -1,
      'touchBottomOffset': 0,
      'finalWidth': null,
      'finalHeight': null,
      'magnifiedWidth': null,
      'magnifiedHeight': null,
      'limitBounds': false,
      'mobileCloseEvent': 'touchstart',
      'afterLoad': function(){}
    }, oOptions);

    let $that = this, // Preserve scope
      $html = $('html'),

      // Initiate
      init = function(el) {
        let $image = $(el),
          $anchor = $image.closest('a'),
          oDataAttr = {};

        // Get data attributes
        for (let i in oOptions) {
          oDataAttr[i] = $image.attr('data-magnify-' + i.toLowerCase());
        }

        // Disable zooming if no valid large image source
        let sZoomSrc = oDataAttr['src'] || oOptions['src'] || $anchor.attr('href') || '';
        if (!sZoomSrc) return;

        let $container,
          $lens,
          nImageWidth,
          nImageHeight,
          nMagnifiedWidth,
          nMagnifiedHeight,
          nLensWidth,
          nLensHeight,
          nBoundX = 0,
          nBoundY = 0,
          nPosX, nPosY,     // Absolute cursor position
          nX, nY,           // Relative cursor position
          oContainerOffset, // Relative to document
          oImageOffset,     // Relative to container
          // Get true offsets
          getOffset = function() {
            let o = $container.offset();
            // Store offsets from container border to image inside
            // NOTE: .offset() does NOT take into consideration image border and padding.
            oImageOffset = {
              'top': ($image.offset().top-o.top) + parseInt($image.css('border-top-width')) + parseInt($image.css('padding-top')),
              'left': ($image.offset().left-o.left) + parseInt($image.css('border-left-width')) + parseInt($image.css('padding-left'))
            };
            o.top += oImageOffset['top'];
            o.left += oImageOffset['left'];
            return o;
          },
          // Hide the lens
          hideLens = function() {
            if ($lens.is(':visible')) $lens.fadeOut(oOptions['speed'], function() {
              $html.removeClass('magnifying').trigger('magnifyend'); // Reset overflow-x
            });
          },
          moveLens = function(e) {
            // Reinitialize if image initially hidden
            if (!nImageHeight) {
              refresh();
              return;
            }
            if (e) {
              e.preventDefault();
              
              nPosX = e.pageX || e.originalEvent.touches[0].pageX;
              nPosY = e.pageY || e.originalEvent.touches[0].pageY;
              $image.data('lastPos', {
                'x': nPosX,
                'y': nPosY
              });
            } else {
              nPosX = $image.data('lastPos').x;
              nPosY = $image.data('lastPos').y;
            }
         
            nX = nPosX - oContainerOffset['left'],
            nY = (nPosY - oContainerOffset['top']) - oOptions['touchBottomOffset'];
            // Toggle magnifying lens
            if (!$lens.is(':animated')) {
              if (nX>nBoundX && nX<nImageWidth-nBoundX && nY>nBoundY && nY<nImageHeight-nBoundY) {
                if ($lens.is(':hidden')) {
                  $html.addClass('magnifying').trigger('magnifystart'); // Hide overflow-x while zooming
                  $lens.fadeIn(oOptions['speed']);
                }
              } else {
                hideLens();
              }
            }
            if ($lens.is(':visible')) {
          
              let sBgPos = '';
              if (nMagnifiedWidth && nMagnifiedHeight) {
                let nRatioX = -Math.round(nX/nImageWidth*nMagnifiedWidth-nLensWidth/2),
                  nRatioY = -Math.round(nY/nImageHeight*nMagnifiedHeight-nLensHeight/2);
                if (oOptions['limitBounds']) {
                  let nBoundRight = -Math.round((nImageWidth-nBoundX)/nImageWidth*nMagnifiedWidth-nLensWidth/2),
                    nBoundBottom = -Math.round((nImageHeight-nBoundY)/nImageHeight*nMagnifiedHeight-nLensHeight/2);
                  // Left and right edges
                  if (nRatioX>0) nRatioX = 0;
                  else if (nRatioX<nBoundRight) nRatioX = nBoundRight;
                  // Top and bottom edges
                  if (nRatioY>0) nRatioY = 0;
                  else if (nRatioY<nBoundBottom) nRatioY = nBoundBottom;
                }
                sBgPos = nRatioX + 'px ' + nRatioY + 'px';
              }
              $lens.css({
                'top': Math.round(nY-nLensHeight/2) + oImageOffset['top'] + 'px',
                'left': Math.round(nX-nLensWidth/2) + oImageOffset['left'] + 'px',
                'background-position': sBgPos
              });
            }
          };

        // Data attributes have precedence over options object
        if (!isNaN(+oDataAttr['speed'])) oOptions['speed'] = +oDataAttr['speed'];
        if (!isNaN(+oDataAttr['timeout'])) oOptions['timeout'] = +oDataAttr['timeout'];
        if (!isNaN(+oDataAttr['finalWidth'])) oOptions['finalWidth'] = +oDataAttr['finalWidth'];
        if (!isNaN(+oDataAttr['finalHeight'])) oOptions['finalHeight'] = +oDataAttr['finalHeight'];
        if (!isNaN(+oDataAttr['magnifiedWidth'])) oOptions['magnifiedWidth'] = +oDataAttr['magnifiedWidth'];
        if (!isNaN(+oDataAttr['magnifiedHeight'])) oOptions['magnifiedHeight'] = +oDataAttr['magnifiedHeight'];
        if (oDataAttr['limitBounds']==='true') oOptions['limitBounds'] = true;
        if (typeof window[oDataAttr['afterLoad']]==='function') oOptions.afterLoad = window[oDataAttr['afterLoad']];

        // Implement touch point bottom offset only on mobile devices
        if (/\b(Android|BlackBerry|IEMobile|iPad|iPhone|Mobile|Opera Mini)\b/.test(navigator.userAgent)) {
          if (!isNaN(+oDataAttr['touchBottomOffset'])) oOptions['touchBottomOffset'] = +oDataAttr['touchBottomOffset'];
        } else {
          oOptions['touchBottomOffset'] = 0;
        }

        $image.data('originalStyle', $image.attr('style'));
        let elZoomImage = new Image();
        $(elZoomImage).on({
          'load': function() {
            $image.css('display', 'block');
            // Create container div if necessary
            if (!$image.parent('.magnify').length) {
              $image.wrap('<div class="magnify"></div>');
            }
            $container = $image.parent('.magnify');
            // Create the magnifying lens div if necessary
            if ($image.prev('.magnify-lens').length) {
              $container.children('.magnify-lens').css('background-image', 'url(\'' + sZoomSrc + '\')');
            } else {
              $image.before('<div class="magnify-lens loading" style="background:url(\'' + sZoomSrc + '\') 0 0 no-repeat"></div>');
            }
            $lens = $container.children('.magnify-lens');
            // Remove the "Loading..." text
            $lens.removeClass('loading');
        
            nImageWidth = oOptions['finalWidth'] || $image.width();
            nImageHeight = oOptions['finalHeight'] || $image.height();
            nMagnifiedWidth = oOptions['magnifiedWidth'] || elZoomImage.width;
            nMagnifiedHeight = oOptions['magnifiedHeight'] || elZoomImage.height;
            nLensWidth = $lens.width();
            nLensHeight = $lens.height();
            oContainerOffset = getOffset(); // Required by refresh()
            // Set zoom boundaries
            if (oOptions['limitBounds']) {
              nBoundX = (nLensWidth/2) / (nMagnifiedWidth/nImageWidth);
              nBoundY = (nLensHeight/2) / (nMagnifiedHeight/nImageHeight);
            }
            // Enforce non-native large image size?
            if (nMagnifiedWidth!==elZoomImage.width || nMagnifiedHeight!==elZoomImage.height) {
              $lens.css('background-size', nMagnifiedWidth + 'px ' + nMagnifiedHeight + 'px');
            }
            // Store zoom dimensions for mobile plugin
            $image.data('zoomSize', {
              'width': nMagnifiedWidth,
              'height': nMagnifiedHeight
            });
            // Store mobile close event for mobile plugin
            $container.data('mobileCloseEvent', oDataAttr['mobileCloseEvent'] || oOptions['mobileCloseEvent']);
            // Clean up
            elZoomImage = null;
            // Execute callback
            oOptions.afterLoad();

            if ($lens.is(':visible')) moveLens();
            // Handle mouse movements
            $container.off().on({
              'mousemove touchmove': moveLens,
              'mouseenter': function() {
                // Need to update offsets here to support accordions
                oContainerOffset = getOffset();
              },
              'mouseleave': hideLens
            });

            // Prevent magnifying lens from getting "stuck"
            if (oOptions['timeout']>=0) {
              $container.on('touchend', function() {
                setTimeout(hideLens, oOptions['timeout']);
              });
            }
            // Ensure lens is closed when tapping outside of it
            $('body').not($container).on('touchstart', hideLens);

            // Support image map click-throughs while zooming
            let sUsemap = $image.attr('usemap');
            if (sUsemap) {
              let $map = $('map[name=' + sUsemap.slice(1) + ']');
              // Image map needs to be on the same DOM level as image source
              $image.after($map);
              $container.click(function(e) {
                // Trigger click on image below lens at current cursor position
                if (e.clientX || e.clientY) {
                  $lens.hide();
                  let elPoint = document.elementFromPoint(
                      e.clientX || e.originalEvent.touches[0].clientX,
                      e.clientY || e.originalEvent.touches[0].clientY
                    );
                  if (elPoint.nodeName==='AREA') {
                    elPoint.click();
                  } else {
                 
                    $('area', $map).each(function() {
                      let a = $(this).attr('coords').split(',');
                      if (nX>=a[0] && nX<=a[2] && nY>=a[1] && nY<=a[3]) {
                        this.click();
                        return false;
                      }
                    });
                  }
                }
              });
            }

            if ($anchor.length) {
              // Make parent anchor inline-block to have correct dimensions
              $anchor.css('display', 'inline-block');
              // Disable parent anchor if it's sourcing the large image
              if ($anchor.attr('href') && !(oDataAttr['src'] || oOptions['src'])) {
                $anchor.click(function(e) {
                  e.preventDefault();
                });
              }
            }

          },
          'error': function() {
            // Clean up
            elZoomImage = null;
          }
        });

        elZoomImage.src = sZoomSrc;
      }, 
      nTimer = 0,
      refresh = function() {
        clearTimeout(nTimer);
        nTimer = setTimeout(function() {
          $that.destroy();
          $that.magnify(oOptions);
        }, 100);
      };

    this.destroy = function() {
      this.each(function() {
        var $this = $(this),
          $lens = $this.prev('div.magnify-lens'),
          sStyle = $this.data('originalStyle');
        if ($this.parent('div.magnify').length && $lens.length) {
          if (sStyle) $this.attr('style', sStyle);
          else $this.removeAttr('style');
          $this.unwrap();
          $lens.remove();
        }
      });
      // Unregister event handler
      $(window).off('resize', refresh);
      return $that;
    }
    // Handle window resizing
    $(window).resize(refresh);
    return this.each(function() {
      // Initiate magnification powers
      init(this);
    });
  };
}(jQuery));


$(document).ready(function() {
  $('.zoom').magnify();
  });



