// Generated by CoffeeScript 1.8.0
(function() {
  var MusicTheme;

  MusicTheme = (function() {
    function MusicTheme() {
      this.initLandingPage();
      this.initSelect();
      this.addResizeActions();
      this.initResizeActions();
      this.initSearchNavigation();
      this.initSearch();
      this.initMobileMenu();
      this.initFooterHeights();
      //this.initArtistContainers();
      this.initSliders();
      this.initProductHover();
      this.initSmoothNavigation();
      this.initAlbumContainers();
      this.initRatingInput();
      this.initProductCountForm();
      this.initProductInfo();
      this.getPlaylist();
      this.initModals();
      this.initSvgs();

      //custom fixes
      var album_info = jQuery('.aq-block .album-main-container .album-info');
      album_info.css("margin-top", ((230 - album_info.height()) / 2) + "px" );

      //vertically centering the text on album big image page
      var header_text = jQuery('.aq-block .album-header-text'),
          main_container = jQuery('.aq-block .album-main-container');

      header_text.css('margin-top', ( (main_container.height() - header_text.height() ) / 2) );

      //custom submit button on add to review form on merchandise
      jQuery('#merchandise-review-submit, .price_slider_amount button, .wysija-submit').addClass('btn btn-default');

      jQuery('#ajax-content').fitVids();

    }

    MusicTheme.prototype.initSvgs = function() {
      var cart, wishlist;
      wishlist = jQuery('.add-to-wishlist-button').not('.footer-button');
      wishlist.on('click', function() {
        var action, item, id = jQuery(this).data('id');
        item = jQuery(this);
        if (item.hasClass("added")) {
          item.find('.added-animate-first').each(function() {
            return this.beginElement();
          });
          jQuery.post(MyAjax.ajaxurl, {
              action : 'teo_removefromwishlist',
              product_id : jQuery(this).data('id')
            },
            function() {
              item.removeClass("added");
          });

          removeHeaderIconsHover(2, id);

          //updating header cart icons
          var count = jQuery('.add-to-wishlist .count'),
              nritems = parseInt(count.html(), 10 ) - 1;
          count.html(nritems);
          jQuery('.wishlist-hover-box .count2').html(nritems);

          if(nritems === 1) {
            jQuery('.wishlist-hover-box .singular').removeClass('hidden');
            jQuery('.wishlist-hover-box .plural').addClass('hidden');
          }
          else if(nritems === 0) {
            jQuery('.wishlist-hover-box .singular').removeClass('hidden');
            jQuery('.wishlist-hover-box .plural').addClass('hidden');
          }

          //making the chance in the footer player as well
          var footer_button = jQuery('.audio-player .add-to-wishlist-button');
          if(footer_button.data('id') == id) {
            undoWishListEffect(footer_button);
          }
          //updating the wishlist status for the individual song play button
          jQuery('.play-song-individual[data-id=' + id + ']').data('wishlist_added', 0);
        } else {
          item.find('.animate-first').each(function() {
            return this.beginElement();
          });
          action = function() {
            return item.find('.animate-second').each(function() {
              return this.beginElement();
            });
          };
          setTimeout(action, 200);
          jQuery.post(MyAjax.ajaxurl, {
              action : 'teo_addtowishlist',
              product_id : id
            },
            function() {
              item.addClass("added");
          });

          addHeaderIconsHover(2, id);

          //updating header cart icons
          var count = jQuery('.add-to-wishlist .count'),
              nritems = parseInt(count.html(), 10 ) + 1;
          count.html(nritems);
          jQuery('.wishlist-hover-box .count2').html(nritems);

          if(nritems === 1) {
            jQuery('.wishlist-hover-box .singular').removeClass('hidden');
            jQuery('.wishlist-hover-box .plural').addClass('hidden');
          }
          else if(nritems === 2) {
            jQuery('.wishlist-hover-box .singular').addClass('hidden');
            jQuery('.wishlist-hover-box .plural').removeClass('hidden');
          }

          //making the chance in the footer player as well
          var footer_button = jQuery('.audio-player .add-to-wishlist-button');
          if(footer_button.data('id') == id) {
            doWishListEffect(footer_button);
          }
          //updating the cart status for the individual song play button
          jQuery('.play-song-individual[data-id=' + id + ']').data('wishlist_added', 1);
        }
      });
      cart = jQuery('button.add-to-cart-button').not('.footer-button');
      cart.on('click', function(e) {
        e.preventDefault();
        var action2, action4, action5, item, id = jQuery(this).data('id');
        item = jQuery(this);
        if (item.hasClass("added")) {
          item.find('.added-animate-first').each(function() {
            return this.beginElement();
          });
          action2 = function() {
            return item.find('.added-animate-second').each(function() {
              return this.beginElement();
            });
          };
          setTimeout(action2, 200);
          jQuery.post(MyAjax.ajaxurl, {
              action : 'teo_removefromcart',
              product_id : id
            },
            function() {
              item.removeClass("added")
          });

          removeHeaderIconsHover(1, id);

          //updating header cart icons
          var count = jQuery('.add-to-cart .count'),
              nritems = parseInt(count.html(), 10 ) - 1;
          count.html(nritems);
          jQuery('.cart-hover-box .count2').html(nritems);

          if(nritems === 1) {
            jQuery('.cart-hover-box .singular').removeClass('hidden');
            jQuery('.cart-hover-box .plural').addClass('hidden');
          }
          else if(nritems === 0) {
            jQuery('.cart-hover-box .singular').addClass('hidden');
            jQuery('.cart-hover-box .plural').removeClass('hidden');
          }

          //making the chance in the footer player as well
          var footer_button = jQuery('.audio-player .add-to-cart-button');
          if(footer_button.data('id') == id) {
            undoCartEffect(footer_button);
          }
          //updating the wishlist status for the individual song play button
          jQuery('.play-song-individual[data-id=' + id + ']').data('cart_added', 0);
        } else {
          item.find('.animate-first').each(function() {
            return this.beginElement();
          });
          action4 = function() {
            return item.find('.animate-second').each(function() {
              return this.beginElement();
            });
          };
          setTimeout(action4, 200);
          action5 = function() {
            return item.find('.animate-third').each(function() {
              return this.beginElement();
            });
          };
          setTimeout(action5, 400);
          jQuery.post(MyAjax.ajaxurl, {
              action : 'teo_addtocart',
              product_id : id
            },
            function() {
              item.addClass("added")
            });

          addHeaderIconsHover(1, id);

          //updating header cart icons
          var count = jQuery('.add-to-cart .count'),
              nritems = parseInt(count.html(), 10 ) + 1;
          count.html(nritems);
          jQuery('.cart-hover-box .count2').html(nritems);
          if(nritems === 1) {
            jQuery('.cart-hover-box .singular').removeClass('hidden');
            jQuery('.cart-hover-box .plural').addClass('hidden');
          }
          else if(nritems === 2) {
            jQuery('.cart-hover-box .singular').addClass('hidden');
            jQuery('.cart-hover-box .plural').removeClass('hidden');
          }

          //making the chance in the footer player as well
          var footer_button = jQuery('.audio-player .add-to-cart-button');
          if(footer_button.data('id') == id) {
            doCartEffect(footer_button);
          }
          //updating the cart status for the individual song play button
          jQuery('.play-song-individual[data-id=' + id + ']').data('cart_added', 1);
        }
      });

      jQuery('.add-to-cart-button.added').each(function() {
        var action4, action5, item = jQuery(this);
        item.find('.animate-first').each(function() {
          return this.beginElement();
        });
        action4 = function() {
          return item.find('.animate-second').each(function() {
            return this.beginElement();
          });
        };
        setTimeout(action4, 200);
        action5 = function() {
          return item.find('.animate-third').each(function() {
            return this.beginElement();
          });
        };
        setTimeout(action5, 400);
      });

      jQuery('.add-to-wishlist-button.added').each(function() {
        var item = jQuery(this);
        item.find('.animate-first').each(function() {
            return this.beginElement();
          });
          action = function() {
            return item.find('.animate-second').each(function() {
              return this.beginElement();
            });
          };
          setTimeout(action, 200);
      });
    };

    MusicTheme.prototype.initModals = function() {
      jQuery('header').find('.modal').find('.register').click(function() {
        jQuery('#login-modal').modal('hide');
        return jQuery('#register-modal').modal('show');
      })
        .end()
        .find('.modal').find('.log-in').click(function() {
          jQuery('#register-modal').modal('hide');
          return jQuery('#login-modal').modal('show');
        })
        .end()
        .find('.modal').find('.forgot').click(function() {
          jQuery('#login-modal').modal('hide');
          return jQuery('#forgot-modal').modal('show');
        });
      jQuery('.modal').on('show.bs.modal', function() {
        var dialog, item, offset;
        item = jQuery(this);
        item.css('display', 'block');
        dialog = item.find(".modal-dialog");
        offset = (jQuery(window).height() - item.find(".modal-content").height()) / 2;
        return dialog.css("margin-top", offset);
      });
      return jQuery('#view-review-modal').on('show.bs.modal', function() {
        return jQuery('.review-slider').flexslider({
          animation: "slide",
          controlNav: true,
          directionNav: false,
          animationLoop: true,
          slideshow: false
        });
      });
    };

    MusicTheme.prototype.initPlaylist = function() {
      return jQuery.ajax({
        type: 'GET',
        url: MyVar.path + "/media/songs.json",
        success: function(data) {
          return function(i) {
            return MusicTheme.getPlaylist(i.myPlaylist);
          }
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    };

    MusicTheme.prototype.getPlaylist = function() {
      var $musictheme = this;
      jQuery('.audio-player').css("top", jQuery(window).height() - 70 + "px");

      jQuery('.replay').click(function() {
        var item;
        item = jQuery(this);
        if (item.hasClass('off')) {
          jQuery('#jpId').bind(jQuery.jPlayer.event.ended, function() {
            return player.jPlayer("play");
          });
          item.removeClass('off');
          item.addClass('on');
        } else {
          jQuery('#jpId').unbind(jQuery.jPlayer.event.ended);
          item.removeClass('on');
          item.addClass('off');
        }

        return false;
      });

      jQuery("#jpId").bind(jQuery.jPlayer.event.play, function() {
        var price, thumb, song_id, cart_added, wishlist_added;
        price = myPlaylist.playlist[myPlaylist.current].price;
        thumb = myPlaylist.playlist[myPlaylist.current].thumbnail;
        song_id = myPlaylist.playlist[myPlaylist.current].song_id;
        cart_added = myPlaylist.playlist[myPlaylist.current].cart_added;
        wishlist_added = myPlaylist.playlist[myPlaylist.current].wishlist_added;

        jQuery('.audio-player .song .price').text(price);
        jQuery('.audio-player .song-image').attr('src', thumb);
        jQuery('.audio-player .add-to-cart-button, .audio-player .add-to-wishlist-button').data('id', song_id);

        var cart_button = jQuery('.audio-player .add-to-cart-button'),
            wishlist_button = jQuery('.audio-player .add-to-wishlist-button');

        if(cart_button.hasClass('added') ) {
            if(cart_added === 0) {
                cart_button.removeClass('added');
                undoCartEffect(cart_button);
            }
        }
        else {
            if(cart_added === 1) {
                cart_button.addClass('added');
                doCartEffect(cart_button);
            }
        }

        if(wishlist_button.hasClass('added') ) {
            if(wishlist_added === 0) {
                wishlist_button.removeClass('added');
                undoWishListEffect(wishlist_button);
            }
        }
        else {
            if(wishlist_added === 1) {
                wishlist_button.addClass('added');
                doWishListEffect(wishlist_button);
            }
        }
      });

      jQuery(".play-song").click(function() {
              var index;
              index = jQuery(this).data("play");
              myPlaylist.play(index);
              return false;
          });
          jQuery(".song").find(".pause-song").click(function() {
              var item;
              item = jQuery(this).closest(".song");
              item.find(".play-song-individual").css("display", "block");
              item.find(".pause-song").css("display", "none");
              myPlaylist.pause();
              return false;
          });

      jQuery(".song").find(".play-song-individual").click(function() {
        var index = MyVar.count;
        var id = jQuery(this).data('id'),
            $this = jQuery(this);
        if(jQuery(this).data('play') ) {
          index = jQuery(this).data('play');
          var item;
          item = $this.closest(".song");
          jQuery(".play-song-individual").css("display", "block");
          jQuery(".pause-song").css("display", "none");
          item.find(".play-song-individual").css("display", "none");
          item.find(".pause-song").css("display", "block");

          jQuery(".audio-player .song-image").attr('src', $this.data('thumbnail') );
          jQuery(".audio-player .song .price").text($this.data('currency') + $this.data('price') );
          jQuery('.audio-player .add-to-cart-button, .audio-player .add-to-wishlist-button').data('id', $this.data('id') );

          var cart_button = jQuery('.audio-player .add-to-cart-button'),
            wishlist_button = jQuery('.audio-player .add-to-wishlist-button');

          if(cart_button.hasClass('added') ) {
            if($this.data('cart_added') === 0) {
              cart_button.removeClass('added');
              undoCartEffect(cart_button);
            }
          }
          else {
            if($this.data('cart_added') === 1) {
              cart_button.addClass('added');
              doCartEffect(cart_button);
            }
          }

          if(wishlist_button.hasClass('added') ) {
            if($this.data('wishlist_added') === 0) {
              wishlist_button.removeClass('added');
              undoWishListEffect(wishlist_button);
            }
          }
          else {
            if($this.data('wishlist_added') === 1) {
              wishlist_button.addClass('added');
              doWishListEffect(wishlist_button);
            }
          }

          myPlaylist.play(index);
        }
        else {
          jQuery.post(MyAjax.ajaxurl, {
              action : 'teo_songdetails',
              song_id : id
            },
            function(data) {
              //we sent the data, now we update the button bg color and tooltip
              var obj = jQuery.parseJSON(data);
              myPlaylist.add({
                title: obj.title,
                artist: obj.artist,
                mp3: obj.mp3,
                price: obj.price,
              });

              $this.data('play', index);
              $this.data('price', obj.price);
              $this.data('currency', obj.currency);
              $this.data('thumbnail', obj.thumbnail);
              $this.data('id', obj.song_id);
              $this.data('cart_added', obj.cart_added);
              $this.data('wishlist_added', obj.wishlist_added);

              var item;
              item = $this.closest(".song");
              jQuery(".play-song-individual").css("display", "block");
              jQuery(".pause-song").css("display", "none");
              item.find(".play-song-individual").css("display", "none");
              item.find(".pause-song").css("display", "block");
              myPlaylist.play(index);

              jQuery(".audio-player .song .price").text(obj.currency + obj.price);
              jQuery(".audio-player .song-image").attr('src', obj.thumbnail);
              jQuery('.audio-player .add-to-cart-button, .audio-player .add-to-wishlist-button').data('id', obj.song_id);

              var cart_button = jQuery('.audio-player .add-to-cart-button'),
                  wishlist_button = jQuery('.audio-player .add-to-wishlist-button');

              if(cart_button.hasClass('added') ) {
                if(obj.cart_added === 0) {
                  cart_button.removeClass('added');
                  undoCartEffect(cart_button);
                }
              }
              else {
                if(obj.cart_added === 1) {
                  cart_button.addClass('added');
                  doCartEffect(cart_button);
                }
              }

              if(wishlist_button.hasClass('added') ) {
                if(obj.wishlist_added === 0) {
                  wishlist_button.removeClass('added');
                  undoWishListEffect(wishlist_button);
                }
              }
              else {
                if(obj.wishlist_added === 1) {
                  wishlist_button.addClass('added');
                  doWishListEffect(wishlist_button);
                }
              }

              MyVar.count++;
            }
          );
        }
      });    
    };

    MusicTheme.prototype.doCartEffect = function(selector) {
        var action4, action5, item = selector;
        item.find('.animate-first').each(function() {
          return this.beginElement();
        });
        action4 = function() {
          return item.find('.animate-second').each(function() {
              return this.beginElement();
          });
        };
          
        setTimeout(action4, 200);
        action5 = function() {
            return item.find('.animate-third').each(function() {
              return this.beginElement();
            });
        };
        setTimeout(action5, 400);

        if(!selector.hasClass('added') ) {
          selector.addClass('added');
        }
    };

    MusicTheme.prototype.doWishListEffect = function(selector) {
      var item = selector;
      item.find('.animate-first').each(function() {
        return this.beginElement();
      });
      action = function() {
        return item.find('.animate-second').each(function() {
          return this.beginElement();
        });
      };
      setTimeout(action, 200);

      if(!selector.hasClass('added') ) {
        selector.addClass('added');
      }
    };

    MusicTheme.prototype.undoCartEffect = function(selector) {
      var item = selector;
      item.find('.added-animate-first').each(function() {
        return this.beginElement();
      });
      action2 = function() {
        return item.find('.added-animate-second').each(function() {
          return this.beginElement();
        });
      };
      setTimeout(action2, 200);

      if(selector.hasClass('added') ) {
        selector.removeClass('added');
      }
    };

    MusicTheme.prototype.undoWishListEffect = function(selector) {
      var item = selector;
      item.find('.added-animate-first').each(function() {
        return this.beginElement();
      });

      if(selector.hasClass('added') ) {
        selector.removeClass('added');
      }

    };

    MusicTheme.prototype.initProductInfo = function() {
      return jQuery('.product-info').each(function() {
        var item;
        item = jQuery(this);
        item.find('.close').click(function(event) {
          event.preventDefault();
          item.removeClass('info-shown');
          return item.addClass('info-hidden');
        });
        return item.find('.more').click(function(event) {
          event.preventDefault();
          item.addClass('info-shown');
          return item.removeClass('info-hidden');
        });
      });
    };

    MusicTheme.prototype.initProductCountForm = function() {
      var countInput;
      countInput = jQuery('.product-add').find('.count');
      jQuery('.product-add').find('.minus').click(function(event) {
        var countInputValue;
        event.preventDefault();
        countInputValue = countInput.attr("value");
        if (parseInt(countInputValue, 10) - 1 > 1) {
          return countInput.attr("value", parseInt(countInputValue, 10) - 1);
        } else {
          return countInput.attr("value", 1);
        }
      });
      return jQuery('.product-add').find('.plus').click(function(event) {
        var countInputValue;
        event.preventDefault();
        countInputValue = countInput.attr("value");
        return countInput.attr("value", parseInt(countInputValue, 10) + 1);
      });
    };

    MusicTheme.prototype.initLandingPage = function() {
      var windowHeight, windowWidth;
      windowWidth = jQuery(window).width();
      windowHeight = jQuery(window).height();
      jQuery('body.full-background').css("width", windowWidth + "px");
      return jQuery('body.full-background').css("height", windowHeight + "px");
    };

    MusicTheme.prototype.initRatingInput = function() {
      var rating_input = jQuery('.rating-input');
      rating_input.find('.stars').find('li').mouseenter(function() {
        var index, item;
        rating_input.find('.stars').find('li').removeClass("checked");
        item = jQuery(this);
        index = item.index();
        rating_input.find('.stars').find('li:lt(' + index + ')').addClass('checked');
        return item.addClass('checked');
      });
      rating_input.find('.stars').find('li').mouseleave(function(index) {
        var item;
        item = jQuery(this);
        index = item.index();
        rating_input.find('.stars').find('li:lt(' + index + ')').removeClass('checked');
        item.removeClass('checked');
        return rating_input.find('.stars').find('li:lt(' + jQuery('#rating').attr("value") + ')').addClass('checked');
      });
      return rating_input.find('.stars').find('li').click(function(e) {
        var index, item;
        rating_input.find('.stars').find('li').removeClass("checked");
        item = jQuery(this);
        index = item.index();
        jQuery('#rating').attr("value", index + 1);
        return e.preventDefault();
      });
    };

    MusicTheme.prototype.initSmoothNavigation = function() {
      return jQuery('.more-with-navigation').click(function(event) {
        var dest;
        event.preventDefault();
        dest = 0;
        if (jQuery(this.hash).offset().top > jQuery(document).height() - jQuery(window).height()) {
          dest = jQuery(document).height() - jQuery(window).height();
        } else {
          dest = jQuery(this.hash).offset().top;
        }
        return jQuery('html,body').animate({
          scrollTop: dest
        }, 1000, 'swing');
      });
    };

    MusicTheme.prototype.initProductHover = function() {
      jQuery('.product .with-title-effect').mouseenter(function() {
        var item;
        item = jQuery(this);
        return item.closest('.product').find('.name').css("left", "20px");
      });
      return jQuery('.product .with-title-effect').mouseleave(function() {
        var item;
        item = jQuery(this);
        return item.closest('.product').find('.name').css("left", "0");
      });
    };

    MusicTheme.prototype.initSliders = function() {
      var noOfItems, priceSlider, thumbSlider;
      jQuery('.introductory-slider').flexslider({
        animation: "slide",
        controlNav: true,
        directionNav: false,
        animationLoop: true,
        slideshow: false
      });
      thumbSlider = jQuery('.thumb-slider');
      thumbSlider.flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        itemWidth: 100,
        itemMargin: 0,
        asNavFor: '.main-slider'
      });
      jQuery('.main-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        sync: ".thumb-slider"
      });
      noOfItems = thumbSlider.find('.slides').find('li').length;
      thumbSlider.css('margin-left', -(noOfItems * 50) + "px");


      priceSlider = jQuery(".widget_merchandisefilter .price").bootstrapSlider({});
      if (jQuery('.widget_merchandisefilter .price').length) {
        return priceSlider.on('slide', function() {
          var inputSlider, currency = jQuery(this).parent().find('input[name=currency]').val();
          inputSlider = jQuery(this).parent().find('.price').attr("value").split(',');

          jQuery(this).parent().find('.min').text(currency + inputSlider[0]);
          jQuery(this).parent().find('input[name=min_price]').val(inputSlider[0]);

          jQuery(this).parent().find('.max').text(currency + inputSlider[1]);
          jQuery(this).parent().find('input[name=max_price]').val(inputSlider[1]);
        });
      }
    };

    MusicTheme.prototype.initFooterHeights = function() {
      var minHeight, windowWidth;
      windowWidth = jQuery(window).width();
      if (windowWidth > 767) {
        minHeight = 0;
        jQuery('.footer-widget').each(function() {
          var itemHeight;
          itemHeight = jQuery(this).height();
          if (minHeight < itemHeight) {
            return minHeight = itemHeight;
          }
        });
        return jQuery('.footer-widget').css("height", minHeight + 40 + "px");
      }
    };

    MusicTheme.prototype.initSelect = function() {
      jQuery('.form-select select').selectric({
        maxHeight: 250
      });
      jQuery('.form-select').find('select').on('selectric-open', function() {
        jQuery(this).closest('.form-box').addClass('no-border');
        return jQuery('.selectricItems').each(function() {
          var item, itemWidth;
          item = jQuery(this);
          itemWidth = Math.round(item.prev('.selectric').width());
          return item.css("width", itemWidth + 4 + "px");
        });
      });
      return jQuery('.form-select').find('select').on('selectric-close', function() {
        return jQuery(this).closest('.form-box').removeClass('no-border');
      });
    };

    MusicTheme.prototype.initSearchNavigation = function() {
      jQuery('.tab-content .navbar-nav>li').each(function() {
        var item;
        item = jQuery(this);
        if (item.find('>ul').length > 0) {
          return item.find('.show-more').css("display", "block");
        }
      });
      return jQuery('.tab-content .navbar-nav>li>a ').click(function(event) {
        event.preventDefault();
        var item;
        item = jQuery(this).closest('li');
        if (item.find('>ul').length > 0) {
          item.find('>ul').slideToggle();
          item.find('.show-more').toggle();
          item.find('.show-less').toggle();
          return event.preventDefault;
        }
      });
    };

    MusicTheme.prototype.initResizeActions = function() {
      return jQuery(window).resize(this.addResizeActions);
    };

    MusicTheme.prototype.initArtistContainers = function() {
      var action, windowWidth;
      windowWidth = jQuery(window).width();
      if (windowWidth > 750) {
        action = function() {
          if (jQuery('.artist-main-container').length && jQuery('.artist-second-container').length) {
            jQuery('.artist-second-container').css("height", jQuery('.artist-main-container').outerHeight() + "px");
          }
          if (jQuery('.artist-songs-container').length && jQuery('.artist-about-container').length) {
            return jQuery('.artist-about-container').css("height", jQuery('.artist-songs-container').outerHeight() + "px");
          }
        };
        return setTimeout(action, 100);
      } else {
        jQuery('.artist-second-container').css("height", "350px");
        return jQuery('.artist-about-container').css("height", "auto");
      }
    };

    MusicTheme.prototype.initAlbumContainers = function() {
      var action, windowWidth;
      windowWidth = jQuery(window).width();
      if (windowWidth > 750) {
        action = function() {
          if (jQuery('.album-main-container').length && jQuery('.album-second-container').length) {
            return jQuery('.album-second-container').not('.full-width').css("height", jQuery('.album-main-container').outerHeight() + "px");
          }
        };
        return setTimeout(action, 100);
      }
    };

    MusicTheme.prototype.addResizeActions = function() {
      var documentHeight, itemWidth, headerHeight, minFooterWidgetHeight, noOfItems, numberOfColumns, rightContainerHeight, rightSidebarLinks, searchNavHeight, thumbSlider, windowHeight, windowWidth;
      windowHeight = jQuery(window).height();
      windowWidth = jQuery(window).width();
      documentHeight = jQuery(document).height();
      headerHeight = jQuery('header.top_header > div').height();
      jQuery('.simple-sidebar').css("height", windowHeight - 94 + "px");
      jQuery('.right-sidebar').css("height", windowHeight + headerHeight - 94 + "px");
      rightSidebarLinks = jQuery('.right-sidebar-links');
      rightSidebarLinks.css("width", windowHeight - 94 + "px");
      rightSidebarLinks.css("top", rightSidebarLinks.width() / 2 - 50 + "px");
      rightSidebarLinks.css("right", -rightSidebarLinks.width() / 2 + 45 + "px");
      jQuery('.links-wrapper').css("height", windowHeight + headerHeight - 94 + "px");

      if (windowWidth > 767) {
        numberOfColumns = jQuery('.song-list-container').find('table').find('th').length;
        jQuery('.hover-row').attr("colspan", numberOfColumns);
      } else {
        jQuery('.hover-row').attr("colspan", "2");
      }
      if (windowWidth < 768) {
        jQuery('.simple-header .navbar-collapse').css("width", windowWidth + "px");
        jQuery('.image-header .navbar-collapse').css("width", windowWidth + "px");
      } else {
        jQuery('.simple-header .navbar-collapse').css("width", "auto");
        jQuery('.image-header .navbar-collapse').css("width", "auto");
      }
      jQuery('.footer-widget').removeAttr("style");
      if (windowWidth > 767) {
        minFooterWidgetHeight = 0;
        jQuery('.footer-widget').each(function() {
          var itemHeight;
          itemHeight = jQuery(this).height();
          if (minFooterWidgetHeight < itemHeight) {
            return minFooterWidgetHeight = itemHeight;
          }
        });
        jQuery('.footer-widget').css("height", minFooterWidgetHeight + 40 + "px");
      }
      var artist_main_container = jQuery('.artist-main-container'),
          artist_second_container = jQuery('.artist-second-container'),
          artist_songs_container = jQuery('.artist-songs-container'),
          artist_about_container = jQuery('.artist-about-container'),
          album_main_container = jQuery('.album-main-container'),
          album_second_container = jQuery('.album-second-container');

      if (windowWidth > 767) {
        if (artist_main_container.length && artist_second_container.length) {
          artist_second_container.css("height", artist_main_container.outerHeight() + "px");
        }
        if (artist_songs_container.length && artist_about_container.length) {
          artist_about_container.css("height", artist_songs_container.outerHeight() + "px");
        }

        if (album_main_container.length && album_second_container.length) {
          album_second_container.not('.full-width').css("height", album_main_container.outerHeight() + "px");
        }

      } else {
        artist_second_container.css("height", "350px");
        artist_about_container.css("height", "auto");

        if (album_main_container.length && album_second_container.length) {
          album_second_container.not('.full-width').css("height", "auto");
        }
      }

      if (windowWidth < 768) {
        jQuery('.search-header').find('.form-control').removeAttr("placeholder");
      }
      jQuery('.full-background').css("width", windowWidth + "px");
      jQuery('.full-background').css("height", windowHeight + "px");
      thumbSlider = jQuery('.thumb-slider');
      noOfItems = thumbSlider.find('.slides').find('li').length;
      itemWidth = thumbSlider.find('.slides').find('li').first().width();
      thumbSlider.css('margin-left', -(noOfItems * itemWidth / 2) + "px");
      return jQuery('.audio-player').css("top", jQuery(window).height() - 70 + "px");
    };

    MusicTheme.prototype.initSearch = function() {
      var windowWidth;
      windowWidth = jQuery(window).width();
      if (windowWidth < 768) {
        jQuery('.search-header').find('.form-control').removeAttr("placeholder");
      }
      jQuery('header').find('.search-button').click(function() {
        return jQuery('.search-box').addClass('shown');
      });
      jQuery('.search-box').find('.close-search').click(function() {
        return jQuery('.search-box').removeClass('shown');
      });
      jQuery('.simple-header .search-group').find('.btn').click(function(event) {
        var searchGroup;
        event.preventDefault();
        searchGroup = jQuery('.simple-header .search-group');
        if (searchGroup.hasClass('open')) {
          return searchGroup.removeClass('open');
        } else {
          searchGroup.addClass('open');
          return searchGroup.find('.form-control').focus();
        }
      });
      return jQuery('.image-header .search-group').find('.btn').click(function(event) {
        var searchGroup;
        event.preventDefault();
        searchGroup = jQuery('.image-header .search-group');
        if (searchGroup.hasClass('open')) {
          return searchGroup.removeClass('open');
        } else {
          searchGroup.addClass('open');
          return searchGroup.find('.form-control').focus();
        }
      });
    };

    MusicTheme.prototype.initMobileMenu = function() {
      return jQuery('.navbar-nav >li').each(function() {
        var button, el;
        el = jQuery(this);
        button = jQuery('<button class="dropdown-toggle"><i class="fa fa-angle-down"></i></button>');
        if (el.find('>ul').length) {
          el.append(button);
          return button.click(function() {
            var submenu;
            submenu = jQuery(this).parent().find(">ul");
            if (submenu.is(':visible')) {
              submenu.slideUp(300);
              return jQuery(this).html('<i class="fa fa-angle-down"></i>');
            } else {
              submenu.slideDown(300);
              return jQuery(this).html('<i class="fa fa-angle-up"></i>');
            }
          });
        }
      });
    };

    return MusicTheme;

  })();

  jQuery(document).ready(function() {
    var musictheme;
    return musictheme = new MusicTheme();
  });

}).call(this);

function doCartEffect(selector) {
    var action4, action5, item = selector;
    item.find('.animate-first').each(function() {
        return this.beginElement();
    });
    action4 = function() {
        return item.find('.animate-second').each(function() {
            return this.beginElement();
        });
    };
          
    setTimeout(action4, 200);
    action5 = function() {
        return item.find('.animate-third').each(function() {
            return this.beginElement();
        });
    };
    setTimeout(action5, 400);

    if(!selector.hasClass('added') ) {
        selector.addClass('added');
    }
};

function doWishListEffect(selector) {
    var item = selector;
    item.find('.animate-first').each(function() {
        return this.beginElement();
    });
    action = function() {
        return item.find('.animate-second').each(function() {
            return this.beginElement();
        });
    };
    setTimeout(action, 200);

    if(!selector.hasClass('added') ) {
        selector.addClass('added');
    }
};

function undoCartEffect(selector) {
    var item = selector;
    item.find('.added-animate-first').each(function() {
        return this.beginElement();
    });
    action2 = function() {
        return item.find('.added-animate-second').each(function() {
            return this.beginElement();
        });
    };
    setTimeout(action2, 200);

    if(selector.hasClass('added') ) {
        selector.removeClass('added');
    }
};

function undoWishListEffect(selector) {
    var item = selector;
    item.find('.added-animate-first').each(function() {
        return this.beginElement();
    });

    if(selector.hasClass('added') ) {
        selector.removeClass('added');
    }

};


function addHeaderIconsHover(type, product_id) {
  if(type !== 1 && type !== 2) {
    return false; 
    //1 = cart
    //2 = wishlist
  }

  var main_selector;
  if(type === 1) {
    main_selector = jQuery('.cart-hover-box');
  }
  else {
    main_selector = jQuery('.wishlist-hover-box');
  }

  jQuery.post(MyAjax.ajaxurl, {
      action : 'teo_songdetails',
      song_id : product_id
  },
  function(data) {
    //we sent the data, now we update the button bg color and tooltip
    var obj = jQuery.parseJSON(data),
        html = '';

    html += '<li id="header_product_' + obj.song_id + '">';
    if(obj.thumbnail !== '') {
      html += '<a href="' + obj.permalink + '">';
      html += '<figure><img src="' + obj.thumbnail + '" alt="' + obj.title + '" /></figure>';
      html += '</a>';
    }
    html += '<a href="' + obj.permalink + '" class="title">' + obj.title + '</a>';
    if(obj.mp3 !== '') {
      html += '<div class="type">Song</div>';
    }
    else {
      html += '<div class="type">Product</div>';
    }
    html += '<div class="price">' + obj.currency + obj.price + '</div>';
    html += '<span class="remove" data-id="' + obj.song_id + '"><i class="fa fa-times"></i></span>';
    html += '</li>';

    var total = main_selector.find('footer .amount .price'),
        price = parseFloat(total.html() );

    price += parseFloat(obj.price);

    total.html(price.toFixed(2));

    main_selector.find('.items').append(html);
  });
};

function removeHeaderIconsHover(type, product_id) {
  if(type !== 1 && type !== 2) {
    return false; 
    //1 = cart
     //2 = wishlist
  }

  var main_selector;
  if(type === 1) {      
    main_selector = jQuery('.cart-hover-box');
  }
  else {
    main_selector = jQuery('.wishlist-hover-box');
  }

  jQuery.post(MyAjax.ajaxurl, {
      action : 'teo_songdetails',
      song_id : product_id
  },
  function(data) {
    //we sent the data, now we update the button bg color and tooltip
    var obj = jQuery.parseJSON(data);
    main_selector.find('#header_product_' + product_id).remove();

    var total = main_selector.find('footer .amount .price'),
        price = parseFloat(total.html() );

    price -= parseFloat(obj.price);

    total.html(price.toFixed(2));
  });
};


//# sourceMappingURL=main.js.map
