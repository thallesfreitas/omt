//playlist init
var myPlaylist, player;
player = jQuery("#jpId").jPlayer({
  supplied: "mp3",
  swfPath: MyVar.path + "/js",
  verticalVolume: "true",
  solution : "flash,html",
  cssSelector: {
    play: ".audio-play",
    pause: ".audio-pause",
    stop: ".audio-stop",
    mute: ".audio-mute",
    unmute: ".audio-unmute",
    currentTime: ".currentTime",
    duration: ".duration",
    title: ".song-title",
  },
});

myPlaylist = new jPlayerPlaylist({
  jPlayer: "#jpId",
  cssSelectorAncestor: ".audio-player"
}, [], {
  playlistOptions: {
    enableRemoveControls: false,
  },
  swfPath: "/plugins/jplayer",
  supplied: "mp3",
  smoothPlayBar: true,
  keyEnabled: true,
  audioFullScreen: true,
});

//adding the default song to the player
jQuery.post(MyAjax.ajaxurl, {
    action : 'teo_defaultsongs',
    },
    function(data) {
        //we sent the data, now we update the button bg color and tooltip
        var object = jQuery.parseJSON(data);
        jQuery.each(object, function(index, obj) {
            myPlaylist.add({
                title: obj.title,
                artist: obj.artist,
                mp3: obj.mp3,
                price: obj.currency + obj.price,
                thumbnail : obj.thumbnail,
                song_id   : obj.song_id,
                cart_added : obj.cart_added,
                wishlist_added : obj.wishlist_added
            });
            
            if(index == 0) {
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
            }

            MyVar.count++;
        } );
});

//footer player add to cart and wishlist actions
var cart, wishlist;
wishlist = jQuery('.add-to-wishlist-button.footer-button');
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
            nritems = parseInt(count.html() ) - 1;
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

        //updating the add to wishlist svg effect on the page too, not just on the player
        var button = jQuery('.add-to-wishlist-button[data-id=' + id + ']').not('footer-button');
        undoWishListEffect(button);
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
            nritems = parseInt(count.html() ) + 1;
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

        //updating the add to wishlist svg effect on the page too, not just on the player
        var button = jQuery('.add-to-wishlist-button[data-id=' + id + ']').not('footer-button');
        doWishListEffect(button);
    }
});
      
cart = jQuery('button.add-to-cart-button.footer-button');
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
            nritems = parseInt(count.html() ) - 1;
        count.html(nritems);
        jQuery('.account-hover-box .count2').html(nritems);

        if(nritems === 1) {
            jQuery('.cart-hover-box .singular').removeClass('hidden');
            jQuery('.cart-hover-box .plural').addClass('hidden');
        }
        else if(nritems === 0) {
            jQuery('.cart-hover-box .singular').addClass('hidden');
            jQuery('.cart-hover-box .plural').removeClass('hidden');
        }

        //updating the add to cart svg effect on the page too, not just on the player
        var button = jQuery('.add-to-cart-button[data-id=' + id + ']').not('footer-button');
        undoCartEffect(button);

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
            nritems = parseInt(count.html() ) + 1;
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

        //updating the add to cart svg effect on the page too, not just on the player
        var button = jQuery('.add-to-cart-button[data-id=' + id + ']').not('footer-button');
        doCartEffect(button);
    }
});

//header cart and wishlist remove buttons
jQuery(document).on('click', '.wishlist-hover-box span.remove', function() {
    var id = jQuery(this).data('id');
    wishlist = jQuery('.add-to-wishlist-button[data-id=' + id + ']').not('.footer-button');
    wishlist.each(function() {
      var action, item, id = jQuery(this).data('id');
      item = jQuery(this);
      if (item.hasClass("added")) {
        item.find('.added-animate-first').each(function() {
          return this.beginElement();
        });
        item.removeClass("added");
      }
    });

    jQuery.post(MyAjax.ajaxurl, {
        action : 'teo_removefromwishlist',
        product_id : id
      });

    removeHeaderIconsHover(2, id);

    //updating header cart icons
    var count = jQuery('.add-to-wishlist .count'),
        nritems = parseInt(count.html() ) - 1;
    count.html(nritems);
    jQuery('.wishlist-hover-box .count2').html(nritems);

    if(nritems === 1) {
        jQuery('.wishlist-hover-box .singular').removeClass('hidden');
        jQuery('.wishlist-hover-box .plural').addClass('hidden');
    }
    else if(nritems === 0) {
        jQuery('.wishlist-hover-box .singular').addClass('hidden');
        jQuery('.wishlist-hover-box .plural').removeClass('hidden');
    }

    //making the chance in the footer player as well
    var footer_button = jQuery('.audio-player .add-to-wishlist-button');
    if(footer_button.data('id') == id) {
        undoWishListEffect(footer_button);
    }
    //updating the wishlist status for the individual song play button
    jQuery('.play-song-individual[data-id=' + id + ']').data('wishlist_added', 0);
});

jQuery(document).on('click', '.cart-hover-box span.remove', function() {
    var id = jQuery(this).data('id');
    cart = jQuery('.add-to-cart-button[data-id=' + id + ']').not('.footer-button');
    cart.each(function() {
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
        item.removeClass("added")
      }
    });

    jQuery.post(MyAjax.ajaxurl, {
        action : 'teo_removefromcart',
        product_id : id
      });

    removeHeaderIconsHover(1, id);

    //updating header cart icons
    var count = jQuery('.add-to-cart .count'),
        nritems = parseInt(count.html() ) - 1;
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
});


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